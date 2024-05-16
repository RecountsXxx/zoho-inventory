<?php

namespace App\Http\Controllers\Inventory\Items;

use App\Http\Controllers\Controller;
use App\Http\Requests\Items\TaxRequest;
use App\Services\Modules\Items\TaxService;

class TaxController extends Controller
{
    public function __construct(private TaxService $taxService) {}

    public function index()
    {
        return $this->taxService->getTaxs();
    }

    public function store(TaxRequest $request)
    {
        return $this->taxService->storeTax($request->validated());
    }
}
