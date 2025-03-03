<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Exception;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            Employee::create($request->validated());

            return redirect()
                ->route('employees.index')
                ->with('success', 'Dipendente aggiunto con successo!');
        } catch (Exception $e) {
            return back()->withErrors('Errore nella creazione del dipendente: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return view('employees.show', compact('employee'));
        } catch (Exception $e) {
            return redirect()
                ->route('employees.index')
                ->withErrors('Dipendente non trovato.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $companies = Company::all();
            return view('employees.edit', compact('employee', 'companies'));
        } catch (Exception $e) {
            return redirect()
                ->route('employees.index')
                ->withErrors('Dipendente non trovato.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmployeeRequest $request, string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $data = $request->validated();
            $employee->update($data);

            return redirect()
                ->route('employees.show', $employee->id)
                ->with('status', 'Dipendente aggiornato con successo!');
        } catch (Exception $e) {
            return back()->withErrors('Errore nell\'aggiornamento del dipendente: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect()
                ->route('employees.index')
                ->with('success_delete', 'Dipendente eliminato con successo!');
        } catch (Exception $e) {
            return back()->withErrors('Errore nell\'eliminazione del dipendente: ' . $e->getMessage());
        }
    }
}
