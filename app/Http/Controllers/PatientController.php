<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

final class PatientController
{
    public function index(Request $request): View|string
    {
        $patients = Patient::query();

        if ($search = $request->input('search')) {
            $patients->where(function ($query) use ($search, $patients) {
                $patients->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%'.$search.'%']);
            });
        }

        $patients = $patients->select('id', 'first_name', 'last_name', 'date_of_birth')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if (htmx()->isRequest()) {
            return view('patients.index', compact('patients'))->fragment('table');
        }

        return view('patients.index', compact('patients'));
    }

    public function create(): View
    {
        return view('patients.create');
    }

    public function store(CreatePatientRequest $request): Response
    {
        Patient::create($request->all());

        if (htmx()->currentUrl() == route('dashboard')) {
            return htmx()->refresh()->response(null);
        }

        return htmx()->trigger('loadPatients')->response(null);
    }

    public function show(Patient $patient): View
    {
        $patient->load('appointments');

        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient): View
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(CreatePatientRequest $request, Patient $patient): Response
    {
        $patient->update($request->all());

        return htmx()->refresh()->response(null);
    }

    public function destroy(string $id)
    {
        //
    }
}
