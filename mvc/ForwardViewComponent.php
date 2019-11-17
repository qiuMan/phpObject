<?php
namespace mvc;

class ForwardViewComponent implements ViewComponent
{
    private $path = null;

    public function __construct(string $path)
    {
        $this->$path = $pathp;
    }

    public function render(Request $request)
    {
        $request->forward($this->path);
    }
}

?>