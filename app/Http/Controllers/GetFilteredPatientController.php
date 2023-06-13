<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\GetPatientsResource;
use App\Services\GetFilteredPatientService;
use Illuminate\Http\Request;

class GetFilteredPatientController extends Controller
{
    public function __invoke(Request $request)
    {
        $patient = app(GetFilteredPatientService::class)
            ->setFilters(filters: $request->all() ?? null)
            ->run();

        return new GetPatientsResource($patient);
    }
}
