<?php
namespace core;

/*
* 这是该框架的参数配置类
* config/config.php
* 具体请看文件
*/
class Config
{
	private static $config=[];

	/*读取配置
	$name即是参数名
	*/
	public static function get($name=null)
	{
		//若该配置项为空为空则返回整个配置
		if(empty($name)){
			return self::$config;
		}
		//若存在该配置项,则返回该配置项，否则返回null
		return isset(self::$config[strtolower($name)])?self::$config[strtolower($name)]:null;

	}

	/*动态设置配置
	*只有 name（string）：name => null；
	*name（string） 和 value：name => value；
	*name（array）：array_merge
	*name（array）和 value：array_merge 或者 value => $name (二级配置)
	*/
	public static function set($name,$value=null)
	{
		if(is_string($name)){
			self::$config[strtolower($name)]=$value;
		}elseif(is_array($name)){
			if(!empty($value)){
				   self::$config[$value] = isset(self::$config[$value]) ? array_merge(self::$config[$value],$name) : self::$config[$value] = $name;
				}else{
					return self::$config = array_merge(self::$config,array_change_key_case($name));
				}
		}else{
			return self::$config;
		}

	}

	/*判断是否存在配置
	$name即是参数名
	*/
	public static function has($name)
	{
		return isset(self::$config[strtolower($name)]);
	}

	/*加载其他配置文件
	*$file即是文件路径
	*/
	public static function load($file)
	{
		if(is_file($file)){
			$type=pathinfo($file,PATHINFO_EXTENSION);
			if($type!='php'){
				return 'load 文件必须是php文件';
			}else{
				return self::set(include $file);
			}
		}else{
			return self::$config;
		}
	}
}
?>