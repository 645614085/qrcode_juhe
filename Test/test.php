<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/12
 * Time: 11:28
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Converge\Converge;

$agent = "alipay";
return Converge::Handel(time().mt_rand(1000,9999),0.01,"测试支付数据",$agent);