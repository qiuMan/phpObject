<?php 
namespace mvc;

class ApplicationHelper
{

    private $config = '';
    private $reg;

    public function __construct()
    {
        $this->reg = Registry::instance();
    }

    public function init()
    {
        $this->setupOptions();//设置命令

        if (isset($_SERVER['REQUEST_MOTHOD'])) {
            $request = new HttpRequest();
        } else {
            $request = new CliRequest();
        }

        $this->reg->setRequest($request);//设置请求
    }

    private function setupOptions()
    {
        if ( ! file_exists($this->config)) {
            throw new \Exception("Could not find options file");
        }

        $options = parse_ini_file($this->config, true);
    
        $conf = new Conf($options['config']);
        $this->reg->setConf($conf);

        $commands = new Conf($options['commands']);
        $this->reg->setCommands($commands);

    }
}


?>