<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SearchCepRequestValidator;
use App\Services\GetCepService;

class GetCepController extends Controller
{
    public function __invoke(SearchCepRequestValidator $request)
    {
        return app(GetCepService::class)
            ->setCep(cep: $request->cep)
            ->run();
    }
}
