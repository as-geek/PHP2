<?php

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}

$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

//Выводит 1234. Обе переменные обращаются к одному классу. И статичная $x не обнуляется после завершения работы функции

/*
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
*/
//Выводит 1122. Эти переменные - экземпляры разных классов, а в каждом классе есть своя статичная переменная $x

/*
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
*/

//Выводит 1122. Тут вижу, что при создании экземпляра нет скобок. Видимо они не обязательны, если в них ничего не
// записывать
