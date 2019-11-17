<?php 
namespace mvc;

abstract class Request
{
    protected $properties;
    protected $path = "/";
    protected $feedback = [];

    public function __construct()
    {
        $this->init();
    }

    public function addFeedback(string $msg)
    {
        array_push($this->feedback, $msg);
    }

    public function getFeedback(string $msg)
    {
        return $this->feedback;
    }

    public function getPath()
    {
        return $this->path;
    }

    abstract function init();


}


?>