<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>支付</title>
    <link rel="stylesheet" href="{{ asset('css/weui.min.css') }}" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <meta name="_token" content="{{ csrf_token() }}"/>
</head>
<body ontouchstart>
<div class="weui-msg">
    <div class="weui-msg__icon_area"><i class="weui-icon-waiting-circle weui-icon_msg"></i></div>
    <div class="weui_textarea">
        <h2 class="weui-msg__title">操作中...</h2>
        <p class="weui-msg__desc">内容详情，可根据实际需要安排</p>
    </div>
    @if($agent == 'alipay' || $agent == 'wechat')
        <iframe style="display: none;" src="{{ url('pay?agent='.$agent.'&order=asdasd') }}"></iframe>
        @else
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area" id="btnSub">
                <a href="javascript:pay('alipay')" class="weui-btn weui-btn_primary">支付宝</a>
                <a href="javascript:pay('wechat')"  class="weui-btn weui-btn_default">微信</a>
            </p>
        </div>
    @endif
    <div class="weui-extraarea">
        <a href="">查看详情</a>
    </div>
</div>
<div id="modal" style="display: none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-icon_toast"></i>
        <p class="weui-toast__content">
        <div class="weui-loadmore"><i class="weui-loading"></i><span class="weui-loadmore__tips">正在支付...</span></div>
        </p>
    </div>
</div>
<script>
    function pay(type) {
        var orderSn = "{{ $orderSn  }}";
        $("#modal").show();
        window.open("/pay?agent="+type+"&order="+orderSn);
    }
</script>
</body>
</html>