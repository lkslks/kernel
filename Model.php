<?php
/**
 * Created by PhpStorm.
 * User: lks
 * Date: 2019/6/24
 * Time: 11:22
 */
namespace kernel;

class Model
{
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
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function test()
    {
        echo 333;
    }
}