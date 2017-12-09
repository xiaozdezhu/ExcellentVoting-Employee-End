<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0029)http://www.menkor.com/#/login -->
<html lang="en" ng-app="SuperIdApp" class="no-js" hola_ext_inject="disabled"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}</style>
    <meta name="fragment" content="!">
    <!-- Web爬虫对于JavaScript的胖客户端应用无能为力。为了在应用的运行过程中给爬虫提供支持，我们需要在头部添加meta标签。这个元标记会让爬虫请求一个带有空的转义片段参数的链接 !-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="http://www.menkor.com/favicon.ico" type="image/x-icon">
    <meta name="baidu-site-verification" content="E3RFXALuK3">

    <!--<meta name="viewport" id="viewport" content="minimal-ui, width=device-width, initial-scale=1.0, user-scalable=no">-->
    <title ng-bind="SuperIdTitle">登录 - SuperId</title>
    <link rel="stylesheet" type="text/css" href="/Public/css/login.css">
    <link rel="stylesheet" href="/Public/css/trip.nodep.min.css">
    <script src="./登录 - SuperId_files/hm.js"></script><script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?7241db0dad30798666736ffbd5b5651b";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script><style type="text/css"></style>

    <!-- 引入插件，兼容低 IE8+ 等低版本浏览器，注意看下面的注释。如果不需要兼容，可以去掉这部分。 -->
    <!--[if lt IE 10]>
    <script src="js/lib/es5-shim.min.js"></script>
    <script type="text/javascript" src="js/lib/realtime/plugin/web-socket-js/swfobject.js"></script>
    <script type="text/javascript" src="js/lib/realtime/plugin/web-socket-js/web_socket.js"></script>
    <script type="text/javascript">
        // 设置变量，配置插件中 WebSocketMain.swf 的引用路径
        WEB_SOCKET_SWF_LOCATION = "js/lib/realtime/plugin/web-socket-js/WebSocketMain.swf";
        // 如果不使用webpack打包,取消注释这一段代码 !IMPORTANT
        //        window.require = function(){};
    </script>
    <![endif]-->
    <!-- 引入插件部分结束 -->
    <!--<!if chrome>-->
    <!--<script src="js/lib/realtime/reconnecting-websocket.min.js"></script>-->
    <!--<![endif]>-->
    <script src="./登录 - SuperId_files/settings.js"></script>
    <script src="./登录 - SuperId_files/bundle.lib.min.1460456660699.js"></script>
    <script src="./登录 - SuperId_files/head.min.1460456660699.js"></script>
</head>
<body style="overflow-x: hidden;">
<iframe src="" style="display: none" id="commonUploadIframe" name="commonUploadIframe"></iframe>
<iframe src="" style="display: none" id="commonUploadIframe1" name="commonUploadIframe1"></iframe>
<iframe src="" style="display: none" id="commonUploadIframe2" name="commonUploadIframe2"></iframe>
<iframe src="" style="display: none" id="commonUploadIframe3" name="commonUploadIframe3"></iframe>
<iframe src="" style="display: none" id="commonUploadIframe4" name="commonUploadIframe4"></iframe>
<a href="" download="" id="downloadFileLink" style="display: none;"></a>


</div></script>

<script type="text/ng-template" id="js/common/component/date-input.html"><div class="date-input-panel-out" style="display: inline-block;">
        <div class="calendarOut" tabindex="-1"
style="width:182px;display: inline-block;float:left;line-height:20px;"
ng-click="showCalendar($event)">
        <label style="line-height: 30px;float:left;margin-left: 10px;font-size:12px;"
ng-bind="getCurrentDate() | date: 'yyyy-MM-dd'"></label>

        <div ng-class="isCalendarOpen?'calendarStyleChange':'calendarStyle'"></div>
        <datetimepicker data-ng-model="currentDate"
style="width: 200px;margin-left:185px;margin-top:-1px;"
ng-if="isCalendarOpen"
    ng-click="timeClick()"
data-on-set-time="onTimeSet(newDate, oldDate)"></datetimepicker>
        </div>
        <div class="clearfix"></div>
        </div></script>


<script src="./登录 - SuperId_files/area.js"></script>
<script src="./登录 - SuperId_files/nations.js"></script>
<!-- ngView:  --><div ng-view="" class="route"><div class="container-full" ng-controller="mainCtrl" style="position: relative">

    <div class="login-left-panel"></div>
    <div class="login-right-panel">
        <div class="login-logo"></div>
    </div>
    <div class="login-panel">
        <div class=" form-width" style="height: 3px">
            <div id="loginBtn" class="rg-title left rg-title-selected" ng-class="{&#39;rg-title-selected&#39;:model.isLogin}" ng-click="change(true)"><a href="login.html">登录</a></div>
            <div id="regBtn" class="right rg-title cursor-pointer" ng-class="{&#39;rg-title-selected&#39;:!model.isLogin}" ng-click="change(false)"><a href="register.html">注册</a></div>
            <div class="login-underline" ng-style="!model.isLogin&amp;&amp;{&#39;margin-left&#39;:220}"></div>
        </div>
        <!-- ngIf: !model.isLogin -->

        <!-- ngIf: model.isLogin --><div ng-if="model.isLogin" ng-controller="loginCtrl" ng-enter="login()" class="">
        <form class="ng-pristine ng-valid" action="/index.php/Login/login.html" method="post">
            <div style="margin-top: 30px" class="rg-form">
                <input type="text" class="rg-input ng-pristine ng-untouched ng-valid" ng-model="lgUser.username" ng-blur="checkSuperId(true)" placeholder="手机/邮箱" name="username" id="username">
                <div ng-show="!validUname" class="error-tag ng-hide"></div>
            </div>
            <div class="rg-form">
                <input type="password" class="rg-input ng-pristine ng-untouched ng-valid" ng-model="lgUser.password" placeholder="密码" name="password" id="password">
                <div ng-show="!validPwd" class="error-tag ng-hide"></div>
            </div>
            <div style="width: 250px;height: 16px">
                <div class="rg-remember" ng-click="remember()">
                    <div class="rg-checked">
                        <div class="sp-checkbox">
                            <input type="checkbox" id="sp-checkbox" name="check">
                            <label for="sp-checkbox"><div class="sp-checkbox-content sp-checkbox-content-active" ng-class="hasChecked?&#39;sp-checkbox-content-active&#39;:&#39;&#39;"></div></label>
                        </div>
                    </div>
                    <p class="rg-remember-text">记住账号</p>
                </div>
                <div class="right">
                    <a href="http://www.menkor.com/find-password.html" class="rg-script-big">忘记密码?</a>
                </div>

            </div>
            <div style="position: absolute;margin-top: 10px;color: red" ng-show="getLoginMessage()" ng-bind="getLoginMessage()" class="ng-hide"></div>
            <button type="submit" class="rg-btn" ng-class="login_ing?&#39;rg-btn-click&#39;:&#39;&#39;" ng-bind="login_ing ? &#39;登录中...&#39;:&#39;登录&#39;">登录</button>
        </form>
    </div><!-- end ngIf: model.isLogin -->

    </div>
    <div style="position: fixed;bottom: 10px;color: #a97c0f;text-align: center;width: 100%">版权所有 © 思目创意设计产业江苏有限公司</div>
</div></div>
<script src="./登录 - SuperId_files/bundle.min.1460456660699.js"></script>

</body></html>