<?php
/**
 * Created by PhpStorm.
 * User: lks
 * Date: 2019/6/24
 * Time: 10:47
 */
namespace kernel;

/**
 * 加载类
 * Class Loader
 * @package kernel\load
 */
class Loader
{
    /**
     * 执行
     */
    static public function register()
    {
//        echo 333;
        // 注册系统自动加载
        spl_autoload_register('kernel\\Loader::autoload', true, true);

        try{
            require_once ROOT_PATH . '/vendor/autoload.php';
            self::checkRoute();
        }catch(\Exception $e){
            var_dump($e);
        }
    }

    static public function autoload( $class )
    {
        $file = ROOT_PATH . '\\' . $class . '.php';
        if ( is_file($file) ) {
            require_once($file);
        }
    }

    /**
     * 检查路由
     * @throws \Exception
     */
    static protected function checkRoute()
    {
        $server = $_SERVER['PHP_SELF'];
        $location = strripos($server, '.php');
        $route = substr($server, $location + 5);
        if(empty($route)){
            $route = [
                'index',
                'Index',
                'index',
            ];
        }else{
            $route = explode('/', $route);
        }
        $length = count($route);

        if($length == 1){
            array_push($route, 'Index');
        }
        if(in_array($length, [ 1, 2 ])){
            array_push($route, 'index');
        }

        $length = $length > 3 ? $length : 3;

        $file = APP_PATH;
        $namespace = '\\app';
        foreach($route as $key => $value){
            if($key != $length - 1){
                $file .= '/' . $value;
            }
            if($key != $length - 1 && $key != $length - 2){
                $namespace .= '\\' . $value;
            }
            if($key == $length - 2){
                Config::set('method', $value);
                $file .= '.php';
            }
            if($key == $length - 3){
                $file .= '/controller';
                $namespace .= '\\controller';
            }
        }

        if(is_file($file)){
            $className = $namespace . '\\' . $route[$length - 2];
            $obj = new $className();
            $action = $route[$length - 1];
            Config::set('action', $action);
            $obj->$action();
        }else{
            throw new \Exception(11);
        }
    }

}