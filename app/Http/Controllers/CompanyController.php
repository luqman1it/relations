<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::with(['laptops' => function ($q) {
            $q->where('price', ">=", 1000);
        }])->get();

        return response()->json($company);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = Company::create([
            'name' => $request->name,
            'city' => $request->city
        ]);

        return response()->json([
            'status' => 'success',
            'company' => $company
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company = Company::all();

        return response()->json([
            'status' => 'success',
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'nullable|string|max;255',
            'city' => 'nullable|string|max:255'
        ]);
        $newData = [];
        if (isset($request->name)) {
            $newData['name'] = $request->name;
        }
        if (isset($request->city)) {
            $newData['city'] = $request->city;
        }
        $company->update($newData);
        return response()->json([
            'status' => 'success',
            'company' => $company
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
    }
}
