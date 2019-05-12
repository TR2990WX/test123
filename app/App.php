<?php

class App
{
  private $csvFile;

    /**
     * @var RevenueCalculator
     */
  private $revenueCalculator;

    /**
     * App constructor.
     * @param $csvFile
     */
    public function __construct($csvFile, RevenueCalculator $revenueCalculator)
    {
        $this->csvFile = $csvFile;
        $this->revenueCalculator = $revenueCalculator;
    }

    public function exec()
    {
        $lines = str_getcsv(
            file_get_contents($this->csvFile),
            "\r\n"
        );
        $productData = new ProductData($this->revenueCalculator);
        unset($lines[0]);
        foreach ($lines as $line) {
            $line = $this->processLine($line);
            $productName = $line[0];
            $date = $line[3];
            $price = $line[1];
            $quantity = $line[2];
            $productData->addProductData($productName, $price, (int) $quantity, $date);
        }

        return $productData->toJSON();
    }

    private function processLine($line)
    {
        $lineElements = explode(";", $line);
        $lineElements = array_map(function($item) {
            return trim($item, '""');
        }, $lineElements);

        return $lineElements;
    }

}