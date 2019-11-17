<?php
namespace mvc;

//解析配置文件类

class ViewComponentCompiler
{
    private $defaultCmd = DefaultCommand::class;
    public function parseFile($file)
    {
        $options = \simplexml_load_file($file);
        $this->parse($options);
    }

    public function parse(\SimpleXMLElement $options)
    {
        $conf = new Conf();

        foreach ($options->control->command as $command) {
            $path = (string) $command['path'] ?: "/";
            $cmdStr = (string) $command['class'] ?: self::$defaultCmd;
            $pathObj = new ComponentDescriptor($path, $cmdStr);
            $this->processView($pathObj, 0, $command);

            if (isset($command->status) && isset($command->status['value'])) {
                foreach ($command->status as $statusEl) {
                    # code...
                }
            }
            
            $conf->set($path, $pathObj);
        }

        return $conf;
    }

    public function processView(ComponentDescriptor $pathObj, int $statusVal, SimpleXMLElement $el)
    {
        if (isset($el->view) && isset($el->view['name'])) {
            $pathObj->setView($statusVal, new TemplateViewComponent((string) $el->view['name']));
        }

        if (isset($el->forward) && isset($el->forward['path'])) {
            $pathObj->setView($statusVal, new TemplateViewComponent((string) $el->forward['path']));
        }

    }
}

?>