<?php
class RequestHelper {

}

abstract class ProcessRequest {
    abstract public function process(RequestHelper $req);
}

//装饰器
abstract class DecoratorProcess extends ProcessRequest {
    protected $processRequest;
    public function __construct(ProcessRequest $req)
    {
        $this->processRequest = $req;
    }
}

class MainRequest extends ProcessRequest {
    public function process(RequestHelper $req) {
        var_dump(__CLASS__);
    }
}

class LogRequest extends DecoratorProcess {
    public function process(RequestHelper $req) 
    {
        var_dump(__CLASS__);
        $this->processRequest->process($req);
    }
}
class StructureRequest extends DecoratorProcess {
    public function process(RequestHelper $req) 
    {
        var_dump(__CLASS__);
        $this->processRequest->process($req);
    }
}

class AuthRequest extends DecoratorProcess {
    public function process(RequestHelper $req) 
    {
        var_dump(__CLASS__);
        $this->processRequest->process($req);
    }
}

$helper = new RequestHelper();
$mainRequest = new MainRequest();
$mainRequest->process($helper);

$logRequest = new LogRequest($mainRequest);
$authRequest = new AuthRequest($logRequest);
$authRequest->process($helper);



?>