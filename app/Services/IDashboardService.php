<?php

namespace App\Services;

use App\Http\Requests\Dashboard\StoreDashboardRequest;
use App\Http\Requests\Dashboard\UpdateDashboardRequest;

interface IDashboardService
{
    public function getAll();

}
