<?php

namespace App;

use App\Models\Refilling\FuelSupplier;
use Illuminate\Support\Facades\Http;

class MonopolyService
{
    public function callContracts()
    {
        $response = Http::withToken(config('services.monopoly.access_token'))
            ->get(config('services.monopoly.url') . 'api/v1/contracts')
            ->json();

        if (isset($response)) {
            foreach ($response ?? [] as $contract) {
                if (!FuelSupplier::where('contract_id', $contract['id'])->exists()) {
                    FuelSupplier::create([
                        'name' => 'Монополия',
                        'contract_id' => $contract['id'],
                        'number' => $contract['number'],
                        'inn' => $contract['inn'],
                        'kpp' => $contract['kpp'],
                        'date' => $contract['date'],
                        'balance' => $contract['balance'],
                    ]);
                } else {
                    $Contract = FuelSupplier::where('contract_id', $contract['id'])->first();
                    $Contract->balance = $contract['balance'];
                    $Contract->save();
                };
            }
        }
    }
}
