<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController
{
    public function index(Request $request)
    {
        $query = City::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $normalizedSearch = $this->normalizeArabic($search);
            $query->where(function ($q) use ($normalizedSearch, $search) {
                $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(name, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), 'ة', 'ه') LIKE ?", ['%' . $normalizedSearch . '%'])
                  ->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(city, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), 'ة', 'ه') LIKE ?", ['%' . $normalizedSearch . '%'])
                  ->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(country, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), 'ة', 'ه') LIKE ?", ['%' . $normalizedSearch . '%'])
                  ->orWhere('iata', 'LIKE', '%' . $search . '%');
            });
        }

        if ($request->filled('can_be_from')) {
            $query->where('can_be_from', $request->can_be_from === '1');
        }

        if ($request->filled('can_be_to')) {
            $query->where('can_be_to', $request->can_be_to === '1');
        }

        $cities = $query->paginate(15)->appends($request->query());

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'iata' => 'required|string|size:3|unique:cities,iata',
            'can_be_from' => 'boolean',
            'can_be_to' => 'boolean',
            'description' => 'nullable|string'
        ]);

        $validated['can_be_from'] = $request->has('can_be_from');
        $validated['can_be_to'] = $request->has('can_be_to');

        City::create($validated);

        return redirect()->route('admin.cities.index')
            ->with('success', 'تم إضافة المدينة بنجاح');
    }

    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'iata' => 'required|string|size:3|unique:cities,iata,' . $city->id,
            'can_be_from' => 'boolean',
            'can_be_to' => 'boolean',
            'description' => 'nullable|string'
        ]);

        $validated['can_be_from'] = $request->has('can_be_from');
        $validated['can_be_to'] = $request->has('can_be_to');

        $city->update($validated);

        return redirect()->route('admin.cities.index')
            ->with('success', 'تم تحديث المدينة بنجاح');
    }

    public function destroy(City $city)
    {
        $city->delete();
        
        return redirect()->route('admin.cities.index')
            ->with('success', 'تم حذف المدينة بنجاح');
    }

    private function normalizeArabic($text)
    {
        $text = str_replace(['أ', 'إ', 'آ'], 'ا', $text);
        $text = str_replace('ة', 'ه', $text);
        return $text;
    }

    public function searchApi(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type'); // 'from' or 'to'
        
        $citiesQuery = City::query();
        
        if ($type === 'from') {
            $citiesQuery->where('can_be_from', true);
        } elseif ($type === 'to') {
            $citiesQuery->where('can_be_to', true);
        }
        
        if ($query) {
            $normalizedQuery = $this->normalizeArabic($query);
            $citiesQuery->where(function($q) use ($normalizedQuery, $query) {
                $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(name, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), 'ة', 'ه') LIKE ?", ['%' . $normalizedQuery . '%'])
                  ->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(city, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), 'ة', 'ه') LIKE ?", ['%' . $normalizedQuery . '%'])
                  ->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(country, 'أ', 'ا'), 'إ', 'ا'), 'آ', 'ا'), 'ة', 'ه') LIKE ?", ['%' . $normalizedQuery . '%'])
                  ->orWhere('iata', 'LIKE', '%' . $query . '%');
            });
        }
        
        $cities = $citiesQuery->paginate(15);
        
        return response()->json([
            'items' => $cities->items(),
            'more' => $cities->hasMorePages()
        ]);
    }
}