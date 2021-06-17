<?php
/**
 * The repository for customers
 */

namespace App\Repository;


use App\Models\Customer;

class CustomerRepository
{

    /**
     * get customers
     * @return Customer[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCustomers()
    {
        return Customer::all();
    }
}
