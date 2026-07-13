<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController
{
    public function create()
    {
        return view('inquiry-form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email',
            'from_city' => 'nullable|string',
            'to_city' => 'nullable|string',
            'desired_date' => 'nullable|date',
            'number_of_adults' => 'nullable|integer|min:0',
            'number_of_children' => 'nullable|integer|min:0',
            'number_of_babies' => 'nullable|integer|min:0',
            'message' => 'required|string|min:10'
        ]);

        Inquiry::create($validated);

        return redirect()->back()
            ->with('success', 'شكراً لك! سيتم التواصل معك قريباً');
    }

    // للأدمن
    public function adminIndex()
    {
        $inquiries = Inquiry::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,read,responded'
        ]);

        $inquiry->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
    }

    public function markAsRead(Inquiry $inquiry)
    {
        $inquiry->update(['status' => 'read']);
        return redirect()->back()->with('success', 'تم تحديث الحالة');
    }
}