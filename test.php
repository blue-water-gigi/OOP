<?php
declare(strict_types=1);

class A
{
    public function sayHello(): string
    {
        return "Hello, i'm A\n";
    }
}

class B extends A
{
    public function sayHello(): string
    {
        return parent::sayHello() . "\tbut really, i'm B\n";
    }
}

$a = new A();
$b = new B();
echo $a->sayHello();
echo $b->sayHello();
