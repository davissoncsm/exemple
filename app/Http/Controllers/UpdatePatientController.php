<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\AddressDto;
use App\Dtos\PatientDto;
use App\Http\Requests\PatientRequestValidator;
use App\Services\UpdatePatientService;

class UpdatePatientController extends Controller
{
    public function __invoke(int $patientId, PatientRequestValidator $request)
    {
        $patient = new PatientDto(...$request->pacient);
        $address = new AddressDto(...$request->address);

        app(UpdatePatientService::class)
            ->setPatientId(patientId: $patientId)
            ->setPatientDto(patientDto: $patient)
            ->setAddressDto(addressDto: $address)
            ->run();

        return response()->json([], 204);
    }
}
