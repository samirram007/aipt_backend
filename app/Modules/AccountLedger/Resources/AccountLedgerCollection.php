<?php

namespace App\Modules\AccountLedger\Resources;

use App\Http\Resources\SuccessCollection;
use Illuminate\Http\Request;

/**
 * Summary of AccountLedgerCollection
 */
class AccountLedgerCollection extends SuccessCollection
{  /**
   * Transform the resource collection into an array.
   *
   * @return array<int|string, mixed>
   */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
