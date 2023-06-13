<?php

declare(strict_types=1);

namespace App\Services;

use App\Jobs\ImportPatientData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImportService
{
    private UploadedFile $file;

    private string $path;

    /**
     * @param UploadedFile $file
     * @return static
     */
    public function setFile(UploadedFile $file): static
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->uploadFile();
        $this->dispath();
    }

    private function uploadFile(): void
    {
        $name = uniqid(date('HisYmd'), true);
        $extension = $this->file->extension();

        $fileName = "{$name}.{$extension}";

        $this->path = Storage::putFileAs(
            path: 'patients/imports',
            file: $this->file,
            name: $fileName
        );
    }

    /**
     * @return void
     */
    private function dispath(): void
    {
        ImportPatientData::dispatch($this->path);
    }


}
