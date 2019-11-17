<?php
namespace mvc;

class DefaultCommand extends Command
{
    public function doExecute(Request $request) 
    {
        $request->addFeedback("Welcome to WOO");
        include("path");
    }
}


?>