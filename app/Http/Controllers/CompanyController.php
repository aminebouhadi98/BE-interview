<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
       $validated = $request->validated();

       if($request->hasFile('logo')){
        $validated['logo'] = $request->file('logo')->store('logos', 'public');
       }
       Company::create($validated);

       return redirect()->route('companies.index')->with('success', 'Azienda creata con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::find($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCompanyRequest $request, string $id)
    {
        $company = Company::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('logo')) {

            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }


        $company->update($data);

        return redirect()->route('companies.show', $company->id)
                         ->with('status', 'Azienda aggiornata con successo!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $company = Company::findOrFail($id);


        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()->route('companies.index')
                         ->with('status_delete', 'Azienda eliminata con successo!');
    }

}
