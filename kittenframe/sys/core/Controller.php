<?php
namespace core;

use core\View;

/*
* 所有Controller继承此类
* 这里是该框架的基类
* 传值，模板展示
*/
class Controller{

	protected $vars = []; //模板变量;
	protected $tpl ; //视图文件 

    /*
	 * $name 为变量名
	 * $value 为变量值
	 */
	final function assign($name,$value){
		if (is_array($name)) {
		  $this->vars = array_merge($this->vars,$name);
		  return $this;
		} else {
		  $this->vars[$name] = $value;
		}
	}

	/*
	 * 设置模板类
	 * $tplname 模板名称
	 */
	final function setTpl($tplname = ''){
		$this->tpl = $tplname;
	}

	/*
	* 调用视图类
	* 
	*/
	final protected function display(){
		$view = new View($this->vars);

		$view->display($this->tpl);
	}
	
}


?>