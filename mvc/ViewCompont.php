<?php
namespace mvc;

interface ViewComponent
{
    public function render(Request $request);
}

?>