<?php

namespace PatrykSawicki\DpdApi\app\Classes;

class Dpd
{
    public static function findPostalCode(): FindPostalCode
    {
        return new FindPostalCode();
    }

    public static function generateWaybillLabel(): GenerateWaybillLabel
    {
        return new GenerateWaybillLabel();
    }

    public static function generateShippingLabel(): GenerateShippingLabel
    {
        return new GenerateShippingLabel();
    }
}