<?php

namespace App\Http\Controllers\Inventory\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\ContactRequest;
use App\Services\Modules\Customers\ContactService;


class ContactController extends Controller
{

    public function __construct(private ContactService $contactService) {}

    public function index()
    {
        return $this->contactService->getContacts();
    }

    public function store(ContactRequest $request)
    {
        return $this->contactService->storeContact($request->validated());
    }
}
