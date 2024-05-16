<?php

namespace App\Http\Controllers\Inventory\Customers;

use App\Http\Controllers\Controller;
use App\Services\Modules\Customers\VendorService;

class VendorController extends Controller
{
    public function __construct(private VendorService $vendorService) {}

    public function index()
    {
        return $this->vendorService->getVendors();
    }
}
