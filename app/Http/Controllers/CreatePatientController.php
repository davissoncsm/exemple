<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\AddressDto;
use App\Dtos\PatientDto;
use App\Http\Requests\PatientRequestValidator;
use App\Services\CreatePatientService;

class CreatePatientController extends Controller
{
    public function __invoke(PatientRequestValidator $request)
    {
        $patient = new PatientDto(...$request->pacient);
        $address = new AddressDto(...$request->address);

        app(CreatePatientService::class)
            ->setPatientDto(patientDto: $patient)
            ->setAddressDto(addressDto: $address)
            ->run();

        return response()->json(['created'], 201);
    }
}
