<?php

namespace App\Jobs;

use App\Dtos\AddressDto;
use App\Dtos\PatientDto;
use App\Services\CreatePatientService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportPatientData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $path,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $patients = [];

        $i = 0;

        if (($open = fopen(storage_path() . '/app/' . $this->path, "r")) !== false) {
            $columns = fgetcsv($open, 1000, ",");

            while (($row = fgetcsv($open, 1000, ",")) !== false) {
                $csv[$i] = array_combine($columns, $row);
                $i++;

                $patients[] = $row;
            }

            fclose($open);
        }

        foreach ($patients as $key => $patient) {
            $patientDto = new PatientDto(
                name: $patient[0],
                cpf: $patient[1],
                cns: $patient[2],
                motherName: $patient[3],
                birthdate: $patient[4],
            );

            $addressDto = new AddressDto(
                street: $patient[5],
                number: $patient[6],
                neighborhood: $patient[7],
                city: $patient[8],
                state: $patient[9],
                cep: $patient[10],
                complement: $patient[11],
            );

            app(CreatePatientService::class)
                ->setPatientDto(patientDto: $patientDto)
                ->setAddressDto(addressDto: $addressDto)
                ->run();
        }

        unlink(storage_path() . '/app/' . $this->path);

    }
}
