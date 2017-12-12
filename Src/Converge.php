<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/7
 * Time: 15:54
 */

namespace Converge;


use Yansongda\LaravelPay\Facades\Pay;

class Converge
{
//    /**
//     * @param $orderSn
//     * @return mixed
//     * 二维码生成
//     */
//    public static function generateQrcode($orderSn)
//    {
//
//        $url = url(config('pay')['qrcode_url'], [$orderSn]);
//
//        return QrCode::size(100)->generate($url);
//    }

    /**
     * @return string
     * 识别浏览器，alipay、wechat、other
     */
    public static function identify(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (stripos($agent, 'alipay')) {//支付宝浏览器
            return "alipay";
        }

        if (stripos($agent, 'micromessenger')) {
            return "wechat";
        }

        return "default";
    }

    /**
     * @param $stream 流水号
     * @param $amount 金额
     * @param string $describe 订单描述
     * @param $agent 浏览器客户端类别
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View 返回一个view
     * html5 支付
     */
    public static function Handel($stream, $amount, $describe = "支付申请！", $agent)
    {
        if(in_array($agent,['alipay','wechat'])){
            if($agent=='alipay'){
                $order = [
                    'out_trade_no' => $stream, //mt_rand(1000,9000).time(),
                    'total_amount' => $amount,//'0.01',
                    'subject' => $describe,
                ];
            }else{
                $order = [
                    'out_trade_no' => $stream, //mt_rand(1000,9000).time(),
                    'total_fee' => $amount,//'0.01',
                    'body' => $describe,
                    'spbill_create_ip'=>$_SERVER['REMOTE_ADDR']
                ];
            }
            return Pay::driver($agent)->gateway("wap")->pay($order);
        }else{
           abort(400);//请求参数有误
        }

    }



}