<?php

class MonthlyProductData {

    /**
     * @var string
     */
    private $productName;

    /**
     * List of monthly revenue voor a given product.
     * @var array
     */
    private $data = [];

    /**
     * MonthlyProductData constructor.
     * @param string $productName
     */
    public function __construct($productName)
    {
        $this->productName = $productName;
    }

    public function addRevenue($date, $revenue)
    {
        //2018-08-01
        $period = substr($date,0,7);
        $this->data[$period] = ($this->data[$period] ?? 0) + $revenue;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function getSortedData(): array
    {
        ksort($this->data, SORT_ASC);
        return $this->data;
    }


}
