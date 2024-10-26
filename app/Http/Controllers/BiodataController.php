<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();

        if(!$user->biodata){
            $user->biodata()->create();
        }

        return view('biodata.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('biodata.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'about_me' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'website' => 'required|string|max:255'
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $user->biodata()->update([
            'about_me' => $validated['about_me'],
            'address' => $validated['address'],
            'website' => $validated['website'],
        ]);

        return redirect()->route('biodata.show')->with('success', 'Biodata has successfully update');
    }
}
