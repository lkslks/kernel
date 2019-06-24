<?php
/**
 * Created by PhpStorm.
 * User: lks
 * Date: 2019/6/24
 * Time: 14:02
 */
namespace kernel;

class Config
{
    protected $module;
    protected $method;
    protected $action;

    /**
     * 容器对象实例
     * @var Container
     */
    protected static $instance;

    /**
     * 获取当前容器的实例（单例）
     * @access public
     * @return static
     */
    protected static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    static public function set($key, $value)
    {
        self::getInstance()->$key = $value;
    }

    static public function get($key)
    {
        return self::getInstance()->$key;
    }
}