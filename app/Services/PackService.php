<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;

class PackService
{
    protected function getMethod()
    {
        return 'getPackList';
    }

    public function getPackList($request): Collection
    {
        $response = Http::post(Env::get('NOVA_POSHTA_ENDPOINT'), [
            'apiKey' => Env::get('NOVA_POSHTA_API_KEY'),
            'modelName' => 'Common',
            'calledMethod' => $this->getMethod(),
            'methodProperties' => [
                'Lengthstring' => $request->length,
                'Widthstring' => $request->witdh,
                'Heightstring' => $request->height,
                'VolumetricWeightstring' => $request->volume
            ]
        ]);

        return collect($response->json());
    }
}
