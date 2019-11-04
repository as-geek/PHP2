<?php


abstract class Product
{
    const PERCENT = 10;
    public $price;
    public $count;
    public $total;
    public $profit;

    public function __construct($price, $count)
    {
        $this->price = $price;
        $this->count = $count;

    }


    public function getPrice() {
        return $this->total = $this->price * $this->count;
    }

    public function getProfit() {
        return $this->profit = $this->total * self::PERCENT / 100;
    }
}


class Digital extends Product
{
    public $name = "Цифровой";

    public function __construct($price, $count)
    {
        parent::__construct($price, $count);
    }
}


class Рhysical extends Product
{
    public $name = "Штучный";

    public function __construct($price, $count)
    {
        parent::__construct($price, $count);
    }

    public function getPrice()
    {
        parent::getPrice();
        return $this->total * 2;
    }
    public function getProfit()
    {
        parent::getProfit();
        return $this->profit * 2;
    }
}


class Weight extends Product
{
    public $name = "Весовой";
    public $weight;

    public function __construct($price, $count, $weight)
    {
        parent::__construct($price, $count);
        $this->weight = $weight;
    }

    public function getPrice() {
        return $this->total = $this->price * $this->weight;
    }
    public function getProfit() {
        return $this->profit = $this->total * self::PERCENT / 100;
    }
}


class Total
{
    public $digital;
    public $physical;
    public $weight;

    public function __construct($digital, $physical, $weight)
    {
        $this->digital = $digital;
        $this->physical = $physical;
        $this->weight = $weight;
    }
    public function total() {
        return $this->digital + $this->physical + $this->weight;
    }

}


$digital = new Digital(100, 2);
$physical = new Рhysical(100, 2);
$weight = new Weight(100, 0, 100);
$totalPrice = new Total($digital->getPrice(), $physical->getPrice(), $weight->getPrice());
$totalProfit = new Total($digital->getProfit(), $physical->getProfit(), $weight->getProfit());

echo "{$digital->name}<br>";
echo "Сумма {$digital->getPrice()}<br>";
echo "Прибыль {$digital->getProfit()}<br>";
echo "<hr>";

echo "{$physical->name}<br>";
echo "Сумма {$physical->getPrice()}<br>";
echo "Прибыль {$physical->getProfit()}<br>";
echo "<hr>";

echo "{$weight->name}<br>";
echo "Сумма {$weight->getPrice()}<br>";
echo "Прибыль {$weight->getProfit()}<br>";
echo "<hr>";

echo "Общая сумма {$totalPrice->total()}<br>";
echo "Общая прибыль {$totalProfit->total()}";