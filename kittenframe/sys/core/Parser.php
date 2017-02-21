<?php
namespace core;

class Parser{

	private $content;

	function __construct($file){
		$this->content=file_get_contents($file);
		if(!$this->content){
			eixt('没有读取到模板文件');
		}
	}


   /* private function parVar()
    {
        $patter = '/\{\$([\w]+)\}/';
        $repVar = preg_match($patter,$this->content);
        if ($repVar) {
            $this->content = preg_replace($patter,"<?php echo \$this->vars['$1']; ?>",$this->content);
        }
    } */

	public function compile($parser_file){
		// $this->parVar();
        file_put_contents($parser_file,$this->content);
	}
}

?>