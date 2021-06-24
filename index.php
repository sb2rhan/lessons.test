<?php
require_once './classes/BaseTag.php';

//$link = new Tag('a');
// Fluent interface and method chaining
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

    # Singleton impl
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

/*$container = Tag::div();

$link = Tag::a()
    ->href('//example.com')
    ->append('Example')
    ->appendTo($container);

$span = Tag::span()
    ->append('Some ')
    ->appendTo($link);


echo $container;*/

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


require_once __DIR__ . '/classes/Container.php';

$c = new Container;
echo $c->append('Inside');
