<?php
require_once __DIR__.'/../app/App.php';
require_once __DIR__.'/../app/MonthlyProductData.php';
require_once __DIR__.'/../app/ProductData.php';
require_once __DIR__.'/../app/RevenueCalculator.php';

$app = new App(__DIR__.'/../data/sales.csv', new RevenueCalculator());

//function f($getal, $k)
//{
//    $getal = $getal*$k();
//    $getal++;
//    return $getal;
//}
//
//function f2($getal)
//{
//    $getal = $getal*rand(1, 10);
//    $getal++;
//    return $getal;
//}
//
//
//
//function klok()
//{
//    return rand(1, 10);
//}

try{
    $p = $app->exec();
    echo $p;


}catch (Exception $e) {
    echo $e->getMessage();
}

