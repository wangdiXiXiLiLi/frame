<?php
namespace core;

/*
* 这是该框架的解析路由类
* 设置了两种路由方式
* 常规和pathinfo
*/
class Router
{
	public $url_query; //url串
	public $url_type; 	//url模式
	public $route_url=[]; //url数组

	function __construct()
	{
		$this->url_query = parse_url($_SERVER['REQUEST_URI']);
	}

	/*设置url模式
	*默认是pathinfo()模式
	*/
	public function setUrlType($url_type = 2)
	{
		$pathmodel=array(
			1,	//普通模式
			2	//pathinfo模式
		);
		if(in_array($url_type,$pathmodel)){
			$this->url_type = $url_type;
		}else{
			exit('have not this url_type');
		}
	}

	//获取url数组
	public function getUrlArray()
	{
		$this->makeUrl();
		return $this->route_url;
	}

	//处理url
	public function makeUrl()
	{
		if($this->url_type == '1'){
			$this->queryToArray();
		}else{
			$this->pathinfoToArray();
		}

	}

	//将参数转化为数组
	public function queryToArray()
	{
		$arr = isset($this->url_query['query']) ? explode ('&', $this->url_query['query']) : [];
		$array = [];
		$tmp = [];
		if(count($arr)>0) {
			foreach ($arr as $key => $value) {
				$tmp = explode('=', $value);
				$array[$tmp['0']] = $tmp['1'];
			}
		}
		if(isset($array['model'])){
			$this->route_url['model']=$array['model'];
			unset($array['model']);
		}
		if(isset($array['controller'])){
			$this->route_url['controller']=$array['controller'];
			unset($array['controller']);
		}
		if(isset($array['action'])){
			$this->route_url['action']=$array['action'];
			unset($array['action']);
		}
		if(isset($this->route_url['action']) && strpos($this->route_url['action'],'.')){
			//判断url方法名的后缀，如果不是配置项的话返回error
			$url_action=explode('.', $this->route_url['action']);

			if($url_action[1]!=Config::get('url_html_suffix')){
				exit('shuffix_error');
			}else{
				$this->route_url['action']=$url_action[0];
			}
		}else{
			$this->route_url['action']=null;
		}

	}

	//将pathinfo转化为数组
	public function pathinfoToArray()
	{
		$arr=isset($this->url_query['path']) ? explode('/', $this->url_query['path']) : [];
		$array = [];
		$tmp = [];
		if(count($arr)>0){
			//以www.xxx.com/index.php开头
			if($arr[2] == 'index.php'){
				//确定model
				if(isset($arr[3]) && !empty($arr[3])){
					$this->route_url['model'] = $arr[3];
				}
				//确定controller
				if(isset($arr[4]) && !empty($arr[4])){
					$this->route_url['controller'] = $arr[4];
				}
				//确定action
				if(isset($arr[5]) && !empty($arr[5])){
					$this->route_url['action'] = $arr[5];
				}

				if(isset($this->route_url['action']) && strrpos($this->route_url['action'], '.')){
					$url_action = explode('.',$this->route_url['action']);
					if($url_action['1'] != Config::get('url_html_suffix')){
						exit('shuffix_error');
					}else{
						$this->route_url['action'] = $url_action[0];
					}
				}

			}else{
			//以www.xxx.com开头
				//确定model
				if(isset($arr[2]) && !empty($arr[2])){
					$this->route_url['model'] = $arr[2];
				}
				//确定controller
				if(isset($arr[3]) && !empty($arr[3])){
					$this->route_url['controller'] = $arr[3];
				}
				//确定action
				if(isset($arr[4]) && !empty($arr[4])){
					$this->route_url['action'] = $arr[4];
				}

				// if(isset($this->route_url['action']) && strpos($this->route_url['action'], '.')){
				// 	$url_action = explode($this->route_url['action'], '.');
				// 	if($url_action[1] != Config::get('url_html_suffix')){
				// 		exit('shuffix_error');
				// 	}else{
				// 		$this->route_url['action'] = $url_action[0];
				// 	}
				// }
			}
	
		}else{
			$this->route_url=[];
		}

	}


}


?>