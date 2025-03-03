<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCompanyRequest;
use Exception;
use Illuminate\Support\Str;
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
        try {
            $validated = $request->validated();

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = 'logo_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $validated['logo'] = $file->storeAs('logos', $filename, 'public');
            }
            Company::create($validated);

            return redirect()
                ->route('companies.index')
                ->with('success', 'Azienda creata con successo!');
        } catch (Exception $e) {
            return back()->withErrors('Errore nella creazione dell\'azienda' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $company = Company::findOrFail($id);
            return view('companies.show', compact('company'));
        } catch (Exception $e) {
            return redirect()->route('companies.index')->withErrors('Azienda non trovata.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $company = Company::findOrFail($id);
            return view('companies.edit', compact('company'));
        } catch (Exception $e) {
            return redirect()->route('companies.index')->withErrors('Azienda non trovata.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCompanyRequest $request, string $id)
    {
        try {
            $company = Company::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('logo')) {
                if ($company->logo) {
                    Storage::disk('public')->delete($company->logo);
                }

                $file = $request->file('logo');
                $filename = 'logo_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $data['logo'] = $file->storeAs('logos', $filename, 'public');
            }

            $company->update($data);

            return redirect()
                ->route('companies.show', $company->id)
                ->with('status', 'Azienda aggiornata con successo!');
        }  catch (Exception $e) {
            return back()->withErrors('Errore nell\'aggiornamento dell\'azienda: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $company = Company::findOrFail($id);

            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $company->delete();

            return redirect()
                ->route('companies.index')
                ->with('status_delete', 'Azienda eliminata con successo!');
        } catch (Exception $e) {
            return back()->withErrors('Errore nell\'eliminazione dell\'azienda: ' . $e->getMessage());
        }
    }
}
