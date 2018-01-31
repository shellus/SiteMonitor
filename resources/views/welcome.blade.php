<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <style>
        /*底部*/
        .footer {
            background: #000000;
            width: 100%;
            position: relative;
            z-index: 8;
            padding: 20px 0;
            overflow: hidden;
        }

        .footer .foot {
            line-height: 36px;
            max-width: 1020px;
            margin: 0 auto;
            font-size: 12px;
            color: #ffffff;
        }

        .footer .foot a {
            color: #ffffff;
        }

        .footer .foot a img {
            max-width: 124px;
        }

        .footer .f-box {
            float: left;
            width: 100px;
            margin: 0 8% 0 0;
        }

        .footer .f-box05 .ico {
            background: url(/images/ico_12.png) left 9px no-repeat;
            display: inline-block;
            padding: 0 0 0 23px;
            cursor: default;
        }

        .footer .f-box05 .qq {
            background-position: 0 -27px;
        }

        .footer .f-box05 .email {
            background-position: 0 -63px;
        }

        .footer .icon {
            background: url(/images/share.png) 0 2px no-repeat;
            padding: 0 0 0 25px;
            display: inline-block;
        }

        .footer .sina {
            background-position: 0 -23px;
        }

        .footer .tqq {
            background-position: 0 10px;
        }

        .footer .f-box h5 {
            line-height: 42px;
            font-size: 14px;
        }

        .footer .f-box h5 span {
            display: inline-block;
        }

        .footer .f-box01 {
            margin: 0 7% 0 0;
            width: 130px;
        }

        .font-14 {
            font-size: 14px;
            line-height: 60px;
        }

        .footer .f-box01 h3 {
            padding: 0 0 8px;
        }

        .footer .f-box01 p {
            padding: 10px 0;
        }

        .footer .f-box05 {
            width: 120px;
        }

        .footer .wx-box {
            float: right;
            width: 150px;
            margin-top: 47px;
        }

        .footer .wx-box p {
            text-align: center;
            line-height: 20px;
            margin-top: 10px;
        }

        .footer .copyright {
            margin: 5% 0 0;
            font-size: 12px;
            text-align: center;
            width: 100%;
            float: left;
            line-height: 24px;
        }

        .footer .copyright a {
            display: inline-block;
            padding: 0 10px 0 14px;
            background: url("/images/jkb_modal/b_l.jpg") no-repeat left center;
        }

        .footer .copyright a:first-child {
            background: none;
        }

        .footer .copyright span {
            display: inline-block;
            margin-left: 25px;
        }
    </style>
    <style>
        body {
            margin: 0;
        }

        .index .article03 .point a {
            display: block;
            max-width: 119px;
            margin: 0 auto;
            font-size: 16px;
            color: #595757;
            padding: 20px 53px;
            background-color: transparent;
            cursor: pointer;
            box-sizing: content-box;
        }

        .index .article01 h1 {
            font-size: 38px;
            margin: 12px 0 0;
        }

        section h1 {
            color: inherit;
        }

        .article {
            position: relative;
            text-align: center;
            overflow: hidden;
        }

        .article01 {
            color: #FFFFFF;
            padding: 8% 0;
            background: url(/images/bg.jpg) no-repeat center center;
        }
        .article01 a{
            color: #FFFFFF;
        }

        .full-height {
            min-height: 80vh;
        }

        .top-bar {
            position: absolute;
            z-index: 1;
            right: 0;
        }

        .top-right {
            padding-right: 30px;
        }

        .links > a {
            padding: 10px 20px;
            background: #52e9e9ad;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .article03 {
            padding: 50px;
        }

        .article03 ul, li {
            padding: 0;
            margin: 0;
        }

        .article03 ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .article03 li {
            float: left;
            width: 21%;
            padding: 50px 2% 0;
            box-sizing: content-box;
        }

        .article03 .point a {
            display: block;
            max-width: 119px;
            margin: 0 auto;
            font-size: 16px;
            color: #595757;
            padding: 20px 53px;
            background-color: transparent;
            cursor: pointer;
            box-sizing: content-box;
            outline: none
        }

        .article03 .point a:hover, .article03 .point a:active {
            background-color: #efefef;
        }
    </style>
</head>
<body>
<div class="top-bar">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('monitor.index') }}">Monitor</a>
                @else
                    <a href="{{ route('login') }}">登录</a>
                    <a href="{{ route('register') }}">注册</a>
                    @endauth
        </div>
    @endif
</div>
<div class="full-height">
    <article class="article article01">
        <div class="box">
            <h1 style="margin-bottom: 30px;">{{ config('app.name') }}&nbsp;网站可用性监控程序</h1>
            <h3>端到端一体化云监控，保障IT系统稳定可靠</h3>
            <p>
                代码开源，免费使用
            </p>
            <p>
                <a href="https://github.com/shellus/SiteMonitor">GitHub</a>
            </p>
        </div>
    </article>

    <article class="article article03">
        <div class="box">
            <ul class="clearfix">

                <li class="point">
                    <a href="/new_site">
                        <p>网站监控</p>
                    </a>
                </li>
                <li class="point">
                    <a href="/new_service">
                        <p>API监控</p>
                    </a>
                </li>
                <li class="point">
                    <a href="/new_server">
                        <p>服务器监控</p>
                    </a>
                </li>
                <li class="point">
                    <a ref="nofollow" href="/new_server">
                        <p>服务监控</p>
                    </a>

                </li>
                <li class="point">
                    <a ref="nofollow" href="/new_server">
                        <p>数据库监控</p>
                    </a>
                </li>
                <li class="point">
                    <a href="/new_process">
                        <p>网页性能管理</p>
                    </a>
                </li>
                <li class="point">
                    <a href="/new_safe">
                        <p>安全监控</p>
                    </a>
                </li>
                <li class="point">
                    <a href="javascript:;">
                        <p>应用监控</p>
                    </a>

                </li>
            </ul>
        </div>
    </article>
</div>
<footer class="footer">
    <div class="foot clearfix">
        <div class="f-box f-box02">
            <h5><span>产品</span></h5>
            <p><a href="/new_site">网站监控</a></p>
            <p><a href="/new_server">服务器监控</a></p>
            <p><a href="/new_service">API监控</a></p>
            <p><a href="/new_safe">安全监控</a></p>
            <p><a href="/new_app">监控宝APP</a></p>
            <p><a href="/new_process">网页性能管理</a></p>
            <p><a href="/new_docker">Docker监控</a></p>
        </div>
        <div class="f-box f-box03">
            <h5><span>支持</span></h5>
            <!--<p><a rel="nofollow" href="/common/api_interface" target="_blank">API文档</a></p>-->
            <p><a rel="nofollow" href="https://help.cloudwise.com/help/18/24" target="_blank">API文档</a></p>
            <!--<p><a rel="nofollow" href="/support" target="_blank">使用说明</a></p>-->
            <p><a rel="nofollow" href="https://help.cloudwise.com/help/18/21" target="_blank">使用说明</a></p>
            <!--<p><a rel="nofollow" href="/common/changelog" target="_blank">更新日志</a></p>-->
            <p><a rel="nofollow" href="https://help.cloudwise.com/help/18/25" target="_blank">更新日志</a></p>
            <p><a rel="nofollow" href="/feedback" target="_blank">在线反馈</a></p>
        </div>
        <div class="f-box f-box04">
            <h5><span>关于</span></h5>
            <p><a rel="nofollow" href="/yunzhihui/about_us">关于我们</a></p>
            <p><a rel="nofollow" href="/yunzhihui/about_us/#contactus">联系我们</a></p>
            <p><a href="/monitor" class="font-14">全球监测网络</a></p>
            <p><a rel="nofollow" href="https://v6.jiankongbao.com/">监控宝6</a></p>

        </div>
        <div class="f-box f-box05">
            <h5><span>联系我们</span></h5>
            <!-- <p><a href="javascript:void(0);" class="icon wx">微信</a></p> -->
            <p><a rel="nofollow" href="http://weibo.com/jiankongbao?sudaref=www.jiankongbao.com" target="blank"
                  rel="nofollow" class="icon sina">新浪微博</a></p>
            <!--<p><a href="http://e.t.qq.com/jiankongbao" target="blank" class="icon tqq">腾讯微博</a></p>-->
            <p><a rel="nofollow" class="ico tel">010-59426322</a></p>
            <p>
                <span class="ico qq">
                    2852373787
                </span>
            </p>
            <p><a rel="nofollow" href="mailto:sales@cloudwise.com" class="ico email" style="cursor:pointer;">sales@cloudwise.com</a>
            </p>
        </div>
        <div class="wx-box">
            <p>掌握更多监控技能<br>微信号：cloudwise2014</p>
        </div>
        <div class="copyright">
            <a href="http://www.cloudwise.com/" target="_blank">云智慧</a>
            <a href="http://www.toushibao.com/" target="_blank">透视宝</a>
            <a href="http://www.yacebao.com/" target="_blank">压测宝</a>
            <span>版权信息：Copyright© 2009-2017 监控宝™ 京ICP备09083760号&nbsp;&nbsp;|&nbsp;&nbsp;京ICP证160666号&nbsp;&nbsp;
                <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010502032537">
                    <img src="/images/beian.png" style="width: inherit;display: inline-block"/>京公网安备 11010502032537号
                </a>
            </span>
            <br>
            云智慧（北京）科技有限公司&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;公司地址：北京市朝阳区霞光里9号中电发展大厦A座16层
        </div>
    </div>
</footer>
</body>