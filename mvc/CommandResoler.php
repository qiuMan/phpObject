<?php
namespace mvc;

class CommandResolver
{
    private $refcmd = null;
    private static $defaultCmd = DefaultCommand::class;

    public function __construct()
    {
        self::$refcmd = new \ReflectionClass(Command::class);
    }

    public function getCommand(Request $request)
    {
        $reg = Registry::instance();
        $commands = $reg->getCommands();//get a Conf object
        $path = $request->getPath();

        $class = $commands->get($path);

        if (is_null($class)) {
            $request->addFeedback("path '$path' not matched");
            return self::$defaultCmd($request);
        }

        if ( ! class_exists($class)) {
            $request->addFeedback("class '$class' not matched");
            return self::$defaultCmd($request);
        }

        $refclass = new \ReflectionClass($class);

        if ( ! $refclass->isSubclassOf(self::$refcmd)) {
            $request->addFeedback("command '$refclass' is not a command");
            return self::$defaultCmd($request);
        }

        return $refclass->newInstance();

    }
    
}


?>