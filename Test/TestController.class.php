<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/7
 * Time: 16:31
 */

namespace Test;


use Src\Converge;

class TestController extends Controller
{

//    public function getQrcode(){ //获取二维码，
//     return   Converge::generateQrcode(12346);
//    }

    public function confirm($orderSn){//确认订单和浏览器类型，并通过js发起支付
        $agent = Converge::identify();
        if($agent !== "default"){
          return  Converge::Handel(time().mt_rand(1000,9999),0.01,"测试支付数据",$agent);
        }
      //  return view("confirm")->with("agent",$agent)->with("orderSn",$orderSn);
    }

    public function pay(){//通过重定向
//        $agent = $request->input('agent');
//        $orderSn = $request->input('order');
        $orderSn = "123";
        $agent = "alipay";
        return Converge::Handel(time().mt_rand(1000,9999),0.01,"测试支付数据",$agent);
    }

}