<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ImportValidator;
use App\Services\ImportService;

class ImportController extends Controller
{
    public function __invoke(ImportValidator $request)
    {
        app(ImportService::class)
            ->setFile(file: $request->file)
            ->run();

        return response()->json(['Arquivo enviado com sucesso'], 200);
    }
}
