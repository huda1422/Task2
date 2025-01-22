<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['update', 'destroy']);
    }

    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image'
        ]);

        $country = new Country();
        $country->name = $request->name;
        $country->image = $request->file('image')->store('countries');

        $country->save();
        return redirect()->route('countries.index');
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image'
        ]);

        $country->name = $request->name;
        if ($request->hasFile('image')) {
            $country->image = $request->file('image')->store('countries');
        }

        $country->save();
        return redirect()->route('countries.index');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries.index');
    }
}
