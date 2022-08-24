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
                'CitySender' => $request->CitySender,
                'CityRecipient' => $request->CityRecipient,
                'Weight' => $request->Weight,
                'ServiceType' => $request->ServiceType,
                'Cost' => $request->Cost,
                'CargoType' => $request->CargoType,
                'SeatsAmount' => $request->SeatsAmount,
                'PackRef' => $request->PackRef,
                'PackCount' => $request->PackCount,
            ]
        ]);

        return collect($response->json());
    }
}
