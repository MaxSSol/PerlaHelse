<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;

class BackwardDeliveryService
{
    protected function getMethod()
    {
        return 'getBackwardDeliveryCargoTypes';
    }

    public function getBackwardDeliveryTypes(): Collection
    {
        $response = Http::post(Env::get('NOVA_POSHTA_ENDPOINT'), [
            'apiKey' => Env::get('NOVA_POSHTA_API_KEY'),
            'modelName' => 'Common',
            'calledMethod' => $this->getMethod()
        ]);

        return collect($response->json());
    }
}
