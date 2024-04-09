<?php

namespace App\Http\Controllers;

use App\Models\laptop;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laptop = laptop::all();

        return response()->json($laptop);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $laptop = laptop::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return response()->json([
            'status' => 'success',
            'laptop' => $laptop
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(laptop $laptop)
    {
        $laptop = laptop::all();

        return response()->json([
            'status' => 'success',
            'laptop' => $laptop
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, laptop $laptop)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'price' => 'nillable|string|max:255'
        ]);
        $newData = [];
        if (isset($request->name)) {
            $newData['name'] = $request->name;
        }
        if (isset($request->price)) {
            $newData['price'] = $request->price;
        }
        $laptop->update($newData);

        return response()->json([
            'status' => 'success',
            'laptop' => $laptop
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(laptop $laptop)
    {
        $laptop->delete();
    }
}
