<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 10.11.2018
 * Time: 18:32
 */

require_once('PerformanceTest.php');

//При числе элементов  более 10000 итераторы выполняются быстрее
//Но если мы оббегаем обычный массив (чсиловой, строковый), то foreach всегда быстрее

$test1 = new PerformanceTest(10001);

$test1->startTest();

