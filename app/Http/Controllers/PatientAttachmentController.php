<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadAttachmentRequest;
use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

final class PatientAttachmentController
{
    public function create(Patient $patient): View
    {
        return view('patients.upload', compact('patient'));
    }

    public function store(UploadAttachmentRequest $request, Patient $patient): Response
    {
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $storedName = Str::uuid().'.'.$file->getClientOriginalExtension();

        $path = $file->storeAs(
            "patient_attachments/{$patient->id}",
            $storedName,
            'public'
        );

        $patient->attachments()->create([
            'destination' => $path,
            'description' => $request->description,
        ]);

        return htmx()->refresh()->response(null);
    }
}
