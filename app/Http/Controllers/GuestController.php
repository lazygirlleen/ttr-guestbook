<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guest.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dump($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'email' => 'email|string|max:255',
            'phone_number' => 'string|max:13'
        ]);

        if($request->hasFile('avatar')){
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp,svg|max:2048',
            ]);
            $imagePath = $request->file('avatar')->store('public/');
            $validated['avatar'] = $imagePath;
        }

        $guest = Guest::create([
            'name'=> $validated['name'],
            'message'=> $validated['message'],
            'email'=> $validated['email'],
            'phone_number'=> $validated['phone_number'],
            'avatar'=> $validated['avatar'] ?? null,
        ]);

        return $guest;
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return view('guests.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        return view('guests.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        //
    }
}
