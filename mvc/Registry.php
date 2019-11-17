<?php 
namespace mvc;

class Registry
{
    private static $instance = null;
    private $request = null;
    private $commands = null;
    private $conf = null;

    private function __construct()
    {

    }

    static public function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getApplicationHelper(): ApplicationHelper
    {
        return new ApplicationHelper();
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setCommands(Conf $commands)
    {
        $this->commands = $commands;
    }

    public function getCommands(): conf
    {
        return $this->commands;
    }
    
    public function setConf(Conf $conf)
    {
        $this->conf = $conf;
    }

    public function getConf(): Conf
    {
        if (is_null($this->conf))
        {
            $this->conf = new Conf();
        }
        
        return $this->conf;
    }

    

}


?>