<?php

namespace App\Modules\Currency\Resources;

use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'symbol' => $this->symbol,
            'country' => $this->country,
            'exchangeRate' => $this->exchange_rate,
            'decimalPlaces' => $this->decimal_places,
            'status' => $this->status,
            'format' => $this->format,
            'thousandsSeparator' => $this->thousands_separator,
            'decimalSeparator' => $this->decimal_separator,
            'symbolPosition' => $this->symbol_position,
        ];
    }
}
