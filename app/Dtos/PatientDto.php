<?php

declare(strict_types=1);

namespace App\Dtos;

use Illuminate\Http\UploadedFile;

class PatientDto extends BaseDto
{
    /**
     * @param string $name
     * @param string $cpf
     * @param string $cns
     * @param string $motherName
     * @param string $birthdate
     * @param UploadedFile|null $photo
     * @param string|null $filePath
     */
    public function __construct(
        public string $name,
        public string $cpf,
        public string $cns,
        public string $motherName,
        public string $birthdate,
        public UploadedFile|null $photo = null,
        public string|null $filePath = null,
    )
    {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'cpf' => $this->cpf,
            'cns' => $this->cns,
            'mother_name' => $this->motherName,
            'birthdate' => $this->birthdate,
            'photo' => $this->filePath,
        ];
    }
}
