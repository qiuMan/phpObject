<?php
namespace mvc;

//管理组件数据类 主要管理命令 视图 转发信息

class ComponentDescriptor
{
    
    
    public function __construct(string $path, string $cmdStr)
    {

    }

    public function setView(int $status, ViewComponent $view)
    {
        $this->views[$status] = $view;
    }
}

?>