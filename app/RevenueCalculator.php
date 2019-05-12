<?php

class RevenueCalculator
{
    /**
     *
     * @param $price  string e.g 1.378,42
     * @param $quantity integer
     * @return float
     */
    public function calcRevenue($price, $quantity)
    {
        return round(str_replace([".", ","], ["", "."], $price) * $quantity, 2);
    }
}