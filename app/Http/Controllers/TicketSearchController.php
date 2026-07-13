<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\City;

class TicketSearchController
{
    public function index()
    {
        $tickets = Ticket::where('is_active', true)
            ->with(['fromCity', 'toCity'])
            ->orderBy('departure_date')
            ->get();
        
        $cities = City::where(function($query) {
            $query->where('can_be_from', true)
                  ->orWhere('can_be_to', true);
        })->limit(30)->get();

        return view('landing', compact('tickets', 'cities'));
    }

    public function search()
    {
        $from_city_id = request('from_city_id');
        $to_city_id = request('to_city_id');
        $date = request('date');
        $trip_type = request('trip_type');
        $return_date = request('return_date');
        $adults = (int) request('number_of_adults', 1);
        $children = (int) request('number_of_children', 0);
        $babies = (int) request('number_of_babies', 0);

        $query = Ticket::where('is_active', true)
            ->with(['fromCity', 'toCity']);

        if ($from_city_id) {
            $query->where('from_city_id', $from_city_id);
        }

        if ($to_city_id) {
            $query->where('to_city_id', $to_city_id);
        }

        if ($trip_type && in_array($trip_type, ['one_way', 'round_trip'], true)) {
            $query->where('trip_type', $trip_type);
        }

        if ($date) {
            $query->whereDate('departure_date', $date);
        }

        if ($trip_type === 'round_trip' && $return_date) {
            $query->whereDate('return_date', $return_date);
        }

        if ($adults > 0) {
            $query->where('number_of_adults', '>=', $adults);
        }
        if ($children > 0) {
            $query->where('number_of_children', '>=', $children);
        }
        if ($babies > 0) {
            $query->where('number_of_babies', '>=', $babies);
        }

        $tickets = $query->get();

        return response()->json($tickets);
    }

    public function whatsappRedirect(Ticket $ticket)
    {
        $message = request('text');
        
        if (!$message) {
            $message = "أريد حجز تذكرة من {$ticket->fromCity->name} إلى {$ticket->toCity->name}";
            if ($ticket->airline) {
                $message .= "\nشركة الطيران: {$ticket->airline}";
            }
            if ($ticket->weight) {
                $message .= "\nالوزن المسموح: {$ticket->weight}";
            }
            $message .= "\nالتاريخ: " . ($ticket->departure_date ? $ticket->departure_date->format('Y-m-d H:i') : '');
            if ($ticket->trip_type === 'round_trip' && $ticket->return_date) {
                $message .= "\nتاريخ العودة: " . $ticket->return_date->format('Y-m-d H:i');
            }
            $message .= "\nالسعر: {$ticket->price} جنيه";
        }
        
        $whatsapp_url = "https://wa.me/?text=" . urlencode($message);

        return redirect($whatsapp_url);
    }
}