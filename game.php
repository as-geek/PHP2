<?php

class Unit {
    public $name;
    public $health;
    public $damage;

    public function __construct($name = null, $health = null, $damage = null)
    {
        $this->name = $name;
        $this->health = $health;
        $this->damage = $damage;
    }

    public function attack(Unit $unit) {
        echo $this->name . " атакует " . $unit->name . " на " . $this->damage . " урона.<br>";
        $unit->health -= $this->damage;
    }

}

class Doctor extends Unit {
    public $medicine;

    public function __construct($name = null, $health = null, $damage = null, $medicine = null)
    {
        parent::__construct($name, $health, $damage);
        $this->medicine = $medicine;
    }

    public function cure(Unit $unit) {
        echo $this->name . " лечит " . $unit->name . " на " .$this->medicine . " здоровья.";
        $unit->health += $this->medicine;
    }
}

class Boss extends Unit {
    public $power;

    public function __construct($name = null, $health = null, $damage = null, $power = null)
    {
        parent::__construct($name, $health, $damage);
        $this->power = $power;
    }

    public function attack(Unit $unit) {
        parent::attack($unit);
        $this->health += $this->power;
        echo "И " . $this->name . " восстанавливает своё здоровье на " . $this->power;
    }
}

$player = new Unit("Игрок", 200, 100);
$monster = new Unit("Монстр", 100, 10);
$doctor = new Doctor("Врач", "", "", 50);
$boss = new Boss("Босс", 300, 50, 10);

var_dump($monster);
var_dump($player);

$monster->attack($player);

var_dump($monster);
var_dump($player);

$player->attack($monster);

var_dump($monster);
var_dump($player);

$doctor->cure($player);

var_dump($player);
var_dump($doctor);

$player->attack($boss);

var_dump($player);
var_dump($boss);

$boss->attack($player);

var_dump($player);
var_dump($boss);
