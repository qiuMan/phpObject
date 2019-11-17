<?php 
namespace mvc;

abstract class Command
{
    final public function __construct()
    {

    }

    public function execute(Request $request)
    {
        $this->doExecute($request);
    }

    abstract function doExecute(Request $request);

}



?>