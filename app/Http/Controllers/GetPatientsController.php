<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\GetPatientsResource;
use App\Services\GetPatientService;

class GetPatientsController extends Controller
{
    public function __invoke()
    {
        $patients =  app(GetPatientService::class)->run();
        return GetPatientsResource::collection($patients);
    }
}
