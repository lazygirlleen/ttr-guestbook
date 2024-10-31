<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Guest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
     {
        $this->middleware('auth')->except('index'); //seluruh fungsi hrs melewati auth kecuali index
    }

    public function index()
    {
        // $guests = Guest::all();
        $guests = Guest::paginate(10);
        return view('guests.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        //mengambil seluruh data category yang tersimpan di database
        return view('guests.create', compact('categories', 'tags'));
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
            'phone_number' => 'string|max:13',
            'category_id' => 'nullable|exists:categories,id' //tambahkan nama tabelnya
        ]);

        if($request->hasFile('avatar')){
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp,svg|max:2048',
            ]);
            $imagePath = $request->file('avatar')->storePublicly('public/images');
            $validated['avatar'] = $imagePath;
        }

        $guest = Guest::create([
            'name'=> $validated['name'],
            'message'=> $validated['message'],
            'email'=> $validated['email'],
            'phone_number'=> $validated['phone_number'],
            'avatar'=> $validated['avatar'] ?? null,
            'category_id'=> $validated['category_id'] ?? null,
            //memastikan agar tetao kosong
        ]);

        if($request->has('tags')) {
            $guest->tags()->attach($request->input('tags'));
        }
        //ini adalah array id_tag dari user

        return redirect()->route('guests.index')->with('success', 'Guest added succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return view('guests.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('guests.edit', compact('guest', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'email' => 'email|string|max:255',
            'phone_number' => 'string|max:13',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        if($request->hasFile('avatar')){
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp,svg|max:2048',
            ]);
            $imagePath = $request->file('avatar')->storePublicly('public/images');

            //Hapus file existing
            if($guest->avatar){
                Storage::delete($guest->avatar);
            }

            $validated['avatar'] = $imagePath;
        }

        $guest->update([
            'name' => $validated['name'],
            'message' => $validated['message'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'avatar' => $validated['avatar'] ?? $guest->avatar,
            'category_id'=> $validated['category_id'] ?? null,
        ]);

        if($request->has('tags')) {
            $guest->tags()->sync($request->input('tags'));
        }
        //sync untuk memperbaharui relasinya
        //akan secara otomatis mencari data id atau data fk yang sebelumnya ada kalau misalnya ada yang sam agak akan dihapus

        return redirect()->route('guests.index')->with('success', 'Guest update succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        if($guest->avatar){
            Storage::delete($guest->avatar);
        }
        $guest->delete();
        return redirect()->route('guests.index')->with('success', 'Guest delete succesfully');
    }
}
