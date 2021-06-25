<?php
//require_once './classes/BaseTag.php';

    // Fluent interface and method chaining
//$link = new Tag('a');
/*$link->setAttribute('href', 'google')
    ->appendAttribute('href', '.com')
    ->prependAttribute('href', 'https://')
    ->append("Google");*/
//echo $link;

    # Testing magical method __call
/*echo $link
    ->href('https://google.com')
    ->append('Google');*/


    # Testing magical method __get, __set
/*$input = new Tag('input');

echo $input
    ->attr('name', 'email')
    ->type('email')
    ->placeholder('Enter your email...');*/


    // static functions
/*echo Tag::make('a')
    ->href('//google.com')
    ->append('Google');*/

    // __callStatic
//echo Tag::a()->href('//example.com')->append("Example");

    # Static classes
/*class Foo {
    protected static string $bar = 'Hello';
    protected const user = 'Bob'; # const is static but not modifiable

    static function getBar(): string
    {
//        return Foo::$bar; # right but not good
        return self::$bar; # accepted way
        // self means the classname which is early linking
    }

    static function getUser(): string
    {
        return self::user;
    }
}

# getting access to static
//echo Foo::$bar;
//echo Foo::getBar();
echo Foo::getUser();*/

#region Singleton Implementation
/*class Example {
    static protected $instance;

    protected function __construct(){}

    static function instance(): Example
    {
        if(self::$instance)
            return self::$instance;

        self::$instance = new self;
        return self::$instance;
    }
}

$one = Example::instance();
$two = Example::instance();

echo $one === $two;*/
#endregion

#region AppendTo
/*$container = Tag::div();

$link = Tag::a()
    ->href('//example.com')
    ->append('Example')
    ->appendTo($container);

$span = Tag::span()
    ->append('Some ')
    ->appendTo($link);

echo $container;*/
#endregion

    # Inheritance
//class MyParent {
////    private $message = 'Hello';
////
////    function getMessage()
////    {
////        // if $message is private it will be called anyway
////        // even if child calls it
////        return $this->message;
////    }
//    static protected $message = 'hello';
//
//    static function getMessage() {
//        // self converts to MyParent, so use
//        // static which will get $message
//        // from the child (late-binding)
//        return static::$message;
//    }
//}

//class Child extends MyParent {
//    //protected $message = 'Bye';
//    static protected $message = 'Bye';
//
//}
//$child = new Child;
//echo $child::getMessage();


/*require_once __DIR__ . '/classes/Container.php';

$c = new Container;
echo $c->append('Inside');*/


    # 25.06.2021
/**
 * Autoloader -
 * It will automatically add require_once for classes
 * that are being used
 */

use App\Tag;

require_once './autoload.php';

/*new NotExists();
NotExists::call();*/

echo Tag::make('div');


    # Use keyword
//use App\Hello\Classes\MyClass;
# this way we add namespaces

/*use App\Hello\Classes\MyClass as AnotherClass;
require_once 'MyClass.php';

class MyClass() {} # but what if we have 2 same-named classes

$class = new AnotherClass();
echo $class->message;*/

//use App\Tag\Predefined\Container;

/*require_once './autoload.php';

//echo new Container();

echo \App\Tag::make('div')->append('Hello');*/


/*# Interfaces
interface VehicleInterface {
    function getWheels();
    function drive();
}

interface CarInterface extends VehicleInterface {
    function drive($road = null);
}

class Car implements CarInterface {

    function drive($road = null)
    {
        echo 'Drive';
    }

    public function getWheels()
    {
    }
}*/

/*# Traits(PHP only)

trait CanFly {
    function fly() {}
}

trait IsPredator {
    protected bool $night_vision = true;
    function hunt() {}
}

class Animal {
    function sleep() {}
    function move() {}
}

// Everything inside trait will be
// copy-pasted where it is used
class Bird extends Animal{
    use CanFly; # using traits
    //function fly() will be written automatically
}

class Eagle extends Bird {
    use IsPredator; # using traits
    //protected bool $night_vision = true;
    // function hunt() {}
    // will be written
}

(new Eagle())->hunt();
(new Eagle())->fly();*/

