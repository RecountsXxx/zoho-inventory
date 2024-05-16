<?php

namespace App\Http\Controllers\Inventory\Items;

use App\Http\Controllers\Controller;
use App\Services\Modules\Items\ItemService;


class ItemController extends Controller
{
    public function __construct(private ItemService $itemService) {}

    public function index()
    {
        return $this->itemService->getItems();
    }

    public function show(string $id)
    {
        return $this->itemService->getItem($id);
    }
}
