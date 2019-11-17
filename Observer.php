<?php 
interface ObservableInterface {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

abstract class Observable implements ObservableInterface {
    protected $observers = [];

    public function attach(Observer $observer) 
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer) 
    {
        $this->observers = array_filter($this->observers, function($ob) use ( $observer) {
            return $ob !== $observer;
        });
    }

    public function notify() 
    {
        foreach($this->observers as $observer) {
            $observer->update($this);
        }
    }
    
}

class Login extends Observable {
    public $status = false; 

     public function loginCheck($id)
     {
        if ($id == 1) {
            $this->status = true;
        }
        $this->notify();
     }
}

abstract class Observer {
    protected $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $this->login->attach($this);
    }
    
    public function update(ObservableInterface $observable) 
    {
        if ($observable === $this->login) {
            $this->doUpdate($observable);
        }
    }

    abstract public function doUpdate(Login $login);
}

class LogLoginObserver extends Observer {
    public function doUpdate(Login $login) {
        if ($login->status == true) {
            var_dump(__CLASS__);
        }
    }
}

$login = new Login();
new LogLoginObserver($login);
$login->loginCheck(1); 



?>