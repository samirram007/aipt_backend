<?php

namespace App\Services;

use App\Http\Requests\FiscalYear\StoreFiscalYearRequest;
use App\Http\Requests\FiscalYear\UpdateFiscalYearRequest;
use App\Http\Resources\FiscalYear\FiscalYearCollection;
use App\Http\Resources\FiscalYear\FiscalYearResource;
use App\Models\FiscalYear;
use Illuminate\Database\Eloquent\Collection;

interface IFiscalYearService
{
    public function getAll():Collection;

    public function getById(int $id):?FiscalYear ;

    public function store(array $data):FiscalYear;

    public function update(array $data, int $id):FiscalYear;

    public function delete(int $id):bool;
}
