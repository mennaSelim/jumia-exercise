<?php


namespace App\Constants;


class Country
{
    const CAMERON = 0;
    const ETHIOPIA = 1;
    const MOROCCO = 2;
    const MOZAMBIQUE = 3;
    const UGANDA = 4;

    const COUNTRY_NAME_ARRAY = array(
        self::CAMERON => "Cameroon",
        self::ETHIOPIA => "Ethiopia",
        self::MOROCCO => "Morocco",
        self::MOZAMBIQUE => "Mozambique",
        self::UGANDA => "Uganda",
    );

    const COUNTRY_CODE_ARRAY = array(
        self::CAMERON => '237',
        self::ETHIOPIA => '251',
        self::MOROCCO => '212',
        self::MOZAMBIQUE => '258',
        self::UGANDA => '256',
    );

    const COUNTRY_PHONE_REGEX_ARRAY = array(
        self::CAMERON => Regex::CAMERON_PHONE,
        self::ETHIOPIA => Regex::ETHIOPIA_PHONE,
        self::MOROCCO => Regex::MOROCCO_PHONE,
        self::MOZAMBIQUE => Regex::MOZAMBIQUE_PHONE,
        self::UGANDA => Regex::UGANDA_PHONE,
    );

}
