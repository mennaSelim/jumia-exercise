<?php

/**
 * Business logic for Customer
 */

namespace App\Services;


use App\Constants\Country;
use App\Constants\Regex;
use App\Repository\CustomerRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class CustomerService
{

    /**
     * @var CustomerRepository
     */
    private $customerRepository;
    /**
     * @var GeneralService
     */
    private $generalService;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepository
     * @param GeneralService $generalService
     */
    public function __construct(CustomerRepository $customerRepository, GeneralService $generalService)
    {
        $this->customerRepository = $customerRepository;
        $this->generalService = $generalService;
    }

    /**
     * get customer phones
     * @param $country
     * @param $isValidPhone
     * @return LengthAwarePaginator
     */
    public function getCustomerPhones($country = null, $isValidPhone = null)
    {
        $customers = $this->customerRepository->getCustomers();
        $customerPhones = $customers->map(function ($customer) {
            $customer->is_valid_phone = $this->isValidPhone($customer->phone);
            $customer->country = $this->getPhoneCountry($customer->phone);
            $customer->country_code = $this->getPhoneCode($customer->phone);
            $customer->phone = $this->trimPhoneCode($customer->phone);
            return $customer;
        })->filter(function ($customerPhone) use ($country) {
            return !is_null($country) ? $customerPhone->country === $country : true;
        })->filter(function ($customerPhone) use ($isValidPhone) {
            return !is_null($isValidPhone) ? $customerPhone->is_valid_phone === intval($isValidPhone) : true;
        });
        return $this->generalService->paginate($customerPhones, Config::get('pagination.recordsPerPage'));
    }

    /**
     * extract phone code from phone
     * @param $phone
     * @return mixed
     */
    private function getPhoneCode($phone)
    {
        $matches = [];
        /**
         * matches i.e.
         * [
         *     0 => [ 0 => "(212) 6007989253" ],
         *     1 => [ 0 => "212" ],
         *     2 => [ 0 => "6007989253" ]
         * ]
         */
        preg_match_all(Regex::PHONE, $phone, $matches, PREG_PATTERN_ORDER);
        return $matches[1][0];
    }

    /**
     * get phone's country according to phone code
     * @param $phone
     * @return string
     */
    private function getPhoneCountry($phone)
    {
        foreach (Country::COUNTRY_CODE_ARRAY as $key => $countryCode) {
            if ($this->getPhoneCode($phone) === $countryCode) {
                return Country::COUNTRY_NAME_ARRAY[$key];
            }
        }
    }

    /**
     * check  phone number's validity
     * @param $phone
     * @return int
     */
    private function isValidPhone($phone)
    {
        foreach (Country::COUNTRY_PHONE_REGEX_ARRAY as $key => $countryRegex) {
            if (preg_match($countryRegex, $phone)) {
                return 1;
            }
        }
        return 0;
    }

    /**
     * trim phone code from phone number
     * @param $phone
     * @return mixed
     */
    private function trimPhoneCode($phone)
    {
        $matches = [];
        /**
         * matches i.e.
         * [
         *     0 => [ 0 => "(212) 6007989253" ],
         *     1 => [ 0 => "212" ],
         *     2 => [ 0 => "6007989253" ]
         * ]
         */
        preg_match_all(Regex::PHONE, $phone, $matches, PREG_PATTERN_ORDER);
        return $matches[2][0];
    }

}
