<?php
namespace home\controller;
use core\Controller;
use core\Model;


Class ThisController extends Controller{

	public function hello(){
		$type=new Model('type');
		$result=$type->Columns();
		$this->assign('result',$result);
		$this->assign('c',22);
		$this->assign('d',33);
		$this->display();
	}

	public function great(){
		print_r('great');
	}
}

?>