<?php 
namespace mvc;

class Controller 
{
    private $reg;

    private function __construct()
    {
        $this->reg = Registry::instance();//单例模式
    }

    //启动
    public static function run()
    {
        $controller =  new Controller();
        $controller->init();
        $controller->handleRequest();
    }

    //初始化
    private function init()
    {
        $this->reg->getApplicationHelper()->init(); //初始化注册表的命令和请求       
    }

    //执行请求
    private function handleRequest()
    {
        $request = $this->reg->getRequest();//获取请求
        // $resolver = new CommandResolver(); 
        // $cmd = $resolver->getCommod($request);//命令模式
        // $cmd->execute($request);//执行命令

        $controller = new AppController(); 
        $cmd = $controller->getCommod($request);//命令模式
        $cmd->execute($request);//执行命令
        $view = $controller->getView($request);
        $view->render($request);
    }
}

?>