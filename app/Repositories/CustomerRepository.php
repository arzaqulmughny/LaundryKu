<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerRepository
{
    /**
     * Store a new customer.
     */
    public static function store(array $data): Customer
    {
        return Customer::create($data);
    }

    /**
     * Update the specified customer
     */
    public static function update(Customer $customer, array $data): bool
    {
        $customer->fill($data);
        $customer->save();

        return true;
    }

    /**
     * Delete the specified customer
     */
    public static function delete(Customer $customer): bool
    {
        return $customer->delete();
    }
}
