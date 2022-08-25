<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;

class DocumentPriceService
{
    protected function getMethod()
    {
        return 'getDocumentPrice';
    }

    public function getDocumentPrice($request): Collection
    {

        $response = Http::post(Env::get('NOVA_POSHTA_ENDPOINT'), [
            'apiKey' => Env::get('NOVA_POSHTA_API_KEY'),
            'modelName' => 'InternetDocument',
            'calledMethod' => $this->getMethod(),
            'methodProperties' => [
                'CitySender' => $request->citySender,
                'CityRecipient' => $request->cityRecipient,
                'Weight' => $request->weight,
                'ServiceType' => $request->serviceType,
                'Cost' => $request->cost,
                'CargoType' => $request->cargoType,
                'SeatsAmount' => $request->seatsAmount,
                'PackRef' => $request->packRef,
                'PackCount' => $request->packCount,
            ]
        ]);

        return collect($response->json());
    }
}
