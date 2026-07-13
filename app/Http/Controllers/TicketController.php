<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\City;
use Illuminate\Http\Request;

class TicketController
{
    public function index(Request $request)
    {
        $query = Ticket::with(['fromCity', 'toCity']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('airline', 'like', "%{$search}%")
                    ->orWhere('weight', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('fromCity', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('toCity', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('trip_type')) {
            $query->where('trip_type', $request->trip_type);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active === '1');
        }

        if ($request->filled('from_city_id')) {
            $query->where('from_city_id', $request->from_city_id);
        }

        if ($request->filled('to_city_id')) {
            $query->where('to_city_id', $request->to_city_id);
        }

        if ($request->filled('departure_date_from')) {
            $query->whereDate('departure_date', '>=', $request->departure_date_from);
        }

        if ($request->filled('departure_date_to')) {
            $query->whereDate('departure_date', '<=', $request->departure_date_to);
        }

        $tickets = $query->orderBy('departure_date', 'desc')
            ->paginate(15)
            ->appends($request->query());

        $cities = City::all();

        return view('admin.tickets.index', compact('tickets', 'cities'));
    }

    public function create()
    {
        $selectedFrom = old('from_city_id');
        $selectedTo = old('to_city_id');
        
        // تصفية المدن التي يمكن أن تكون نقطة مغادرة
        $fromCities = City::where('can_be_from', true)
            ->when($selectedTo, fn($q) => $q->where('id', '!=', $selectedTo))
            ->get();
        
        // تصفية المدن التي يمكن أن تكون نقطة وصول
        $toCities = City::where('can_be_to', true)
            ->when($selectedFrom, fn($q) => $q->where('id', '!=', $selectedFrom))
            ->get();
        
        return view('admin.tickets.create', [
            'fromCities' => $fromCities,
            'toCities' => $toCities,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'from_city_id' => 'required|exists:cities,id',
            'to_city_id' => 'required|exists:cities,id|different:from_city_id',
            'airline' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'departure_date' => 'required|date|after:now',
            'arrival_date' => 'nullable|date|after:departure_date',
            'duration_days' => 'nullable|integer|min:0',
            'duration_hours' => 'nullable|integer|min:0|max:23',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
            'trip_type' => 'required|in:one_way,round_trip',
            'return_date' => 'nullable|date|after:arrival_date|required_if:trip_type,round_trip',
            'return_arrival_date' => 'nullable|date|after:return_date',
            'return_duration_days' => 'nullable|integer|min:0',
            'return_duration_hours' => 'nullable|integer|min:0|max:23',
            'return_duration_minutes' => 'nullable|integer|min:0|max:59',
            'number_of_adults' => 'required|integer|min:1',
            'number_of_children' => 'integer|min:0',
            'number_of_babies' => 'integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        Ticket::create($validated);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'تم إضافة التذكرة بنجاح');
    }

    public function edit(Ticket $ticket)
    {
        // تصفية المدن التي يمكن أن تكون نقطة مغادرة
        $fromCities = City::where('can_be_from', true)
            ->where('id', '!=', $ticket->to_city_id)
            ->get();
        
        // تصفية المدن التي يمكن أن تكون نقطة وصول
        $toCities = City::where('can_be_to', true)
            ->where('id', '!=', $ticket->from_city_id)
            ->get();
        
        return view('admin.tickets.edit', [
            'ticket' => $ticket,
            'fromCities' => $fromCities,
            'toCities' => $toCities,
        ]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'from_city_id' => 'required|exists:cities,id',
            'to_city_id' => 'required|exists:cities,id|different:from_city_id',
            'airline' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'departure_date' => 'required|date',
            'arrival_date' => 'nullable|date|after:departure_date',
            'duration_days' => 'nullable|integer|min:0',
            'duration_hours' => 'nullable|integer|min:0|max:23',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
            'trip_type' => 'required|in:one_way,round_trip',
            'return_date' => 'nullable|date|after:arrival_date|required_if:trip_type,round_trip',
            'return_arrival_date' => 'nullable|date|after:return_date',
            'return_duration_days' => 'nullable|integer|min:0',
            'return_duration_hours' => 'nullable|integer|min:0|max:23',
            'return_duration_minutes' => 'nullable|integer|min:0|max:59',
            'number_of_adults' => 'required|integer|min:1',
            'number_of_children' => 'integer|min:0',
            'number_of_babies' => 'integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        $ticket->update($validated);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'تم تحديث التذكرة بنجاح');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        
        return redirect()->route('admin.tickets.index')
            ->with('success', 'تم حذف التذكرة بنجاح');
    }

    public function toggle(Ticket $ticket)
    {
        $ticket->update(['is_active' => !$ticket->is_active]);
        
        return redirect()->route('admin.tickets.index')
            ->with('success', 'تم تحديث حالة التذكرة');
    }
}