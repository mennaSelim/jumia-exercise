<?php
/**
 * The controller responsible for handling all customer requests and containing all customer actions
 */

namespace App\Http\Controllers;

use App\Constants\Country;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CustomerController extends BaseController
{
    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * CustomerController constructor.
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * get customer phones
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getCustomerPhones(Request $request)
    {
        // request's input
        $country = $request->input('country');
        $isValidPhoneNumber = $request->input('is_valid_phone');
        // get customer phones
        $customerPhones = $this->customerService->getCustomerPhones($country, $isValidPhoneNumber);
        $countryArr = Country::COUNTRY_NAME_ARRAY;
        // return corresponding view
        return view("phone", compact(['customerPhones', 'country', 'countryArr', 'isValidPhoneNumber']));
    }


}
