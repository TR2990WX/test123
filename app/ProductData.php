<?php

class ProductData
{
    /**
     * @var MonthlyProductData[]
     */
    private $monthlyProductData = [];

    /**
     * @var RevenueCalculator
     */
    private $revenueCalculator;

    /**
     * ProductData constructor.
     * @param RevenueCalculator $revenueCalculator
     */
    public function __construct(RevenueCalculator $revenueCalculator)
    {
        $this->revenueCalculator = $revenueCalculator;
    }


    public function addProductData(string $productName, string $price, int $quantity, string $date)
    {
        $revenue = $this->revenueCalculator->calcRevenue($price, $quantity);
        $this->getMonthlyProductDataByName($productName)->addRevenue($date, $revenue);
    }


    private function getMonthlyProductDataByName(string $productName) : MonthlyProductData
    {
        if(!isset($this->monthlyProductData[$productName])) {
            $this->monthlyProductData[$productName] = new MonthlyProductData($productName);
        }

        return $this->monthlyProductData[$productName];
    }


    public function toJSON()
    {
        $obj = new stdClass();
        foreach ($this->monthlyProductData as $monthlyProductData) {
            $p  = new stdClass();

            $p->xas = array_keys($monthlyProductData->getSortedData());
            $p->data = array_map(function($total){
                return (string) $total;
            },  array_values($monthlyProductData->getSortedData()));

            $obj->{$monthlyProductData->getProductName()} = $p;
        }

        return json_encode($obj);
    }
}