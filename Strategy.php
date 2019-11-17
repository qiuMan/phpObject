<?php 
abstract class Question {
    protected $prompt;
    protected $marker;

    public function __construct(string $prompt, Marker $marker)
    {
        $this->prompt = $prompt;
        $this->marker = $marker;
    }
    public function make() 
    {
        $this->marker->make();
    } 
}

class TextQuestion extends Question {
    public function make()
    {
        parent::make();
        var_dump(__CLASS__);
    }   
    
}

class AvQuestion extends Question {
    
}

abstract class Marker {
   abstract public function make();    
}


class Strategy1 extends Marker {
    public function make() 
    {
        var_dump(__CLASS__);
    }
}

class Strategy2 extends Marker {
    public function make() 
    {
        var_dump(__CLASS__);
    }
}

//使用第一个策略
$s1 = new Strategy1();
$testQuestion = new TextQuestion("me: ", $s1);
$testQuestion->make();

//使用第二个策略
$s2 = new Strategy2();
$testQuestion = new $testQuestion("you", $s2);
$testQuestion->make();





?>