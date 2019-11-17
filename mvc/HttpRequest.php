<?php
namespace mvc;

class HttpRequest extends Request
{
    public function init()
    {
        $this->properties = $_REQUEST;
        $this->path = $_SERVER['PATH_INFO'] ?: '/';
    }

    public function forward(string $path)
    {
        header("Location: {$path}");
        exit;
        
    }
}



?>