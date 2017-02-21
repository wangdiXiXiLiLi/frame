<?php
namespace core;

use core\Config;	//使用配置类
use core\Router;  	//使用路由类
/*
 * 这是该框架的启动类
 * 引用配置和路由
 */
class App
{
public static $router;  //定义一个静态路由实例

	//框架启动
	public static function run(){
		self::$router=new Router();
		self::$router->setUrlType(2);
		$url_array=self::$router->getUrlArray();
		self::dispatch($url_array);

	} 

	//路由分配

	public static function dispatch($url_array=[]){
		$model = '';
		$controller = '';
		$action = '';
		//判断model是否存在
		if(isset($url_array['model'])){
			$model = $url_array['model'];
		}else{
			$model = Config::get('default_module');
		}
		//判断controller时候存在
		if(isset($url_array['controller'])){
			$controller = $url_array['controller'];
		}else{
			$controller = Config::get('default_controller');
		}
		//controller文件路径
		$controller_file = APP_PATH.$model.DS.'controller'.DS.$controller.'Controller.php';

		//判断action是否存在
		if(isset($url_array['action'])){
			$action = $url_array['action'];
		}else{
			$action = Config::get('default_action');
		}
		if(file_exists($controller_file)){
			require $controller_file;
			//调用这个方法
			$classname='model\controller\IndexController';

			$classname = str_replace('model', $model, $classname);

			$classname = str_replace('IndexController', $controller.'Controller', $classname);

			$contro= new $classname;
			
			if(method_exists($contro, $action)){
				$view=$controller.'_'.$action;
            	$contro->setTpl($view);    //视图模板分发

				$contro->$action();			//执行该方法
			}else{
				exit('this action does not exists');
			}

		}else{
			//找不到这个控制器
			exit('this controller does not exists');
		}


	}
}
?>