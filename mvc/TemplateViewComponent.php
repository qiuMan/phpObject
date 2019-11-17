<?php
namespace mvc;

class TemplateViewComponent implements ViewComponent
{
    private $name;
    
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render(Request $request)
    {
        include("view.php");
    }
}

?>