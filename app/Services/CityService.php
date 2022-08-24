<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;

class CityService
{
    protected function getMethod()
    {
        return 'getCities';
    }

    public function getCities(): Collection
    {
        $response = Http::post(Env::get('NOVA_POSHTA_ENDPOINT'), [
            'apiKey' => Env::get('NOVA_POSHTA_API_KEY'),
            'modelName' => 'Address',
            'calledMethod' => $this->getMethod(),
            'methodProperties' => [
                'Limit' => 20
            ]
        ]);

        return collect($response->json());
    }

    public function getCityByString($city): Collection
    {
        $response = Http::post(Env::get('NOVA_POSHTA_ENDPOINT'), [
            'apiKey' => Env::get('NOVA_POSHTA_API_KEY'),
            'modelName' => 'Address',
            'calledMethod' => $this->getMethod(),
            'methodProperties' => [
                'FindByString' => $city
            ]
        ]);

        return collect($response->json());
    }
}
