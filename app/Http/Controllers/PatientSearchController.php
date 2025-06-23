<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

final class PatientSearchController
{
    public function __invoke(Request $request)
    {
        $patients = Patient::query();

        if ($name = $request->input('name')) {
            $patients->where(function ($query) use ($name, $patients) {
                $patients->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%'.$name.'%']);
            });
        }

        $patients = $patients->limit(3)->get();

        return view('components.search-suggestions', compact('name', 'patients'));
    }
}
