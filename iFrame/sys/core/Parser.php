<?php

namespace core;

/**
 *  解析
 */
class Parser
{
    private $content;

    function __construct($file)
    {
        $this->content = file_get_contents($file);
        if (!$this->content) {
            exit('Template file read failed');
        }
    }

    //解析普通变量
    private function parVar()
    {
        $patter = '/\{\$([\w]+)\}/';
        $repVar = preg_match($patter, $this->content);
        if ($repVar) {
            $this->content = preg_replace($patter, "<?php echo \$this->vars['$1']; ?>", $this->content);
        }
    }

    private function parIf(){}
      //编译
    public function compile($parser_file)
    {
        $this->parVar();
        file_put_contents($parser_file, $this->content);
    }
}