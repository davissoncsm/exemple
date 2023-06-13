<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class GetCepService
{
    const CEP_SITE = 'https://viacep.com.br/ws/';

    private string $cep;

    /**
     * @param string $cep
     * @return static
     */
    public function setCep(string $cep): static
    {
        $this->cep = $cep;
        return $this;
    }


    /**
     * @return mixed
     */
    public function run(): mixed
    {
        return $this->getCep();
    }

    /**
     * @return mixed|string[]
     */
    private function getCep(): mixed
    {
        if (Cache::has($this->cep)) {
            return Cache::get($this->cep);
        }

        return $this->callViaCep();
    }

    /**
     * @return mixed|string[]
     */
    private function callViaCep(): mixed
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        $url = self::CEP_SITE . $this->cep . '/json';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);

        $output = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($output);

        if (isset($result->erro)) {
            return ['message' => 'O CEP informado não existe, por favor refvise os dados'];
        }

        $this->saveCache($result);

        return $result;
    }

    /**
     * @param object $cepData
     * @return void
     */
    private function saveCache(object $cepData): void
    {
        Cache::put(key: $this->cep, value: $cepData, ttl: 3600);
    }

}
