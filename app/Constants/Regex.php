<?php


namespace App\Constants;


class Regex
{
    const PHONE = "/\((\d+)\) ?(.*)$/";
    const CAMERON_PHONE = "/\(237\) ?[2368]\d{7,8}$/";
    const ETHIOPIA_PHONE = "/\(251\) ?[1-59]\d{8}$/";
    const MOROCCO_PHONE = "/\(212\) ?[5-9]\d{8}$/";
    const MOZAMBIQUE_PHONE = "/\(258\) ?[28]\d{7,8}$/";
    const UGANDA_PHONE = "/\(256\) ?\d{9}$/";


}
