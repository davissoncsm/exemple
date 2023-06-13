<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\GetPatientsResource;
use App\Services\GetPatientByIdService;

class GetPatientByIdController extends Controller
{
    public function __invoke(int $patientId)
    {
        $patients = app(GetPatientByIdService::class)
            ->setPatientId(patientId: $patientId)
            ->run();

        return new GetPatientsResource($patients);
    }
}
