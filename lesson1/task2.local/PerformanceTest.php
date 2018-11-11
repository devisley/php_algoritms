<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 10.11.2018
 * Time: 18:26
 */

require_once('TestObject.php');

class PerformanceTest
{
    private $items;

    public function __construct($itemsCount)
    {
        for($i = 0; $i < $itemsCount; $i++) {
            $this->items[$i] = new TestObject();
//            $this->items[$i] = 'TestVal';
//            $this->items[$i] = $i;
        }
    }

    public function startTest() {
        echo "<h2>Тест производительности итераторов. Число элементов в массиве:" . count($this->items) . "</h2>" . '<br>';

        echo '1. Тестируем foreach..' . '<br>';
        $timeStart = microtime(true);

        foreach ($this->items as $item) {
            $item++;
        }
        $timeEnd = microtime(true);
        $res1 = $timeEnd - $timeStart;
        echo "Результат: $res1 секунд". '<br>';

        echo '2. Тестируем итераторы..' . '<br>';
        $obj = new ArrayObject($this->items);
        $iter = $obj->getIterator();

        $timeStart = microtime(true);

        while( $iter->valid() )
        {
            //
            $iter->next();
        }

        $timeEnd = microtime(true);

        $res2 = $timeEnd - $timeStart;
        echo "Результат: $res2 секунд". '<br>';

        $gain = $res2 / $res1;
        $gain = ($res2 < $res1) ? $res1/$res2 : $res2/$res1;
        $str = ($res2 < $res1) ? 'быстрее' : 'медленнее';

        echo '<br>' . "<b>ИТОГ:  Итераторы $str в $gain раз </b>". '<br>';
    }

}