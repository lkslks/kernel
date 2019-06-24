<?php
/**
 * Created by PhpStorm.
 * User: lks
 * Date: 2019/6/24
 * Time: 10:46
 */
namespace kernel;

//var_dump(111);

$dir = __DIR__ . '/../';
define('PUBLIC_PATH', $dir . '/public');
define('ROOT_PATH', $dir);
define('APP_PATH', $dir . '/app');
define('KERNEL_PATH', __DIR__);

//var_dump(KERNEL_PATH . '/Loader.php');
require_once KERNEL_PATH . '/Loader.php';
Loader::register();