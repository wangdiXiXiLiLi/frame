<?php
namespace core; 

/*
* 这里是该框架的视图类
* 根据是否开启缓存判断引入
*/

class View{

	public $vars = []; //

    function __construct($vars){
    	if(!is_dir(Config::get('cache_path'))){
    		exit('缓存路径不存在');
    	}
    	if(!is_dir(Config::get('view_path'))){
    		exit('模板路径不存在');
    	}

    	$this->vars = $vars;
    }

    public function display($file){

    	$tpl_file = ''; //模板文件;
    	// $parser_file = ''; //编译文件;
    	$cache_file = ''; //缓存文件;

    	$tpl_file = Config::get('view_path').$file.Config::get('view_suffix');
    	$cache_file = Config::get('cache_path').$file.'.html';
    	if(!file_exists($tpl_file)){
    		print_r($cache_file);

    		exit($tpl_file.'该模板不存在');
    	}


    	// $parser_file = Config::get('compile_path').MD5($file).$file.'.php';


    	if(Config::get('auto_cache')){
    		if(file_exists($cache_file)){
    			if((filemtime($cache_file)>filemtime($tpl_file))){
    				extract($this->vars);
    			    return include $cache_file;
    			}
    		}
    	}
		extract($this->vars);

		include $tpl_file ;
    	if(Config::get('auto_cache')){ 
			if(file_put_contents($cache_file,ob_get_contents())){
				echo 'yes';
			}else{
				echo 'no';
			}
			ob_end_clean();
		}
    }



}

?>