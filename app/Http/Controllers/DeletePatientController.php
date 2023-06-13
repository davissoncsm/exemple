<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DeletePatientService;

class DeletePatientController extends Controller
{
    public function __invoke(int $patientId)
    {
        app(DeletePatientService::class)
            ->setPatientId(patientId: $patientId)
            ->run();

        return response()->json([], 204);
    }
}
