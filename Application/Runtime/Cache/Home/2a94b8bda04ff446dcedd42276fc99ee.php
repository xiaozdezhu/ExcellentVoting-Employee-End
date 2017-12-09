<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>最新动态</title>
    <link href="/Public/css/reset.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/style.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/main.css" type="text/css" rel="stylesheet">
    <link href="/Public/js/skin/layer.css" type="text/css" rel="stylesheet">
    <link href="/Public/js/skin/layer.ext.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/Public/js/layer.js"></script>
    <script type="text/javascript" src="/Public/js/extend/layer.ext.js"></script>

    <style type="text/css">
        #login p{
            margin-top: 15px;
            line-height: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        #login img{
            cursor:pointer;
        }
        .error{
            color:red;
        }
    </style>

</head>
<body>
<!-- 网页头部 -->
<div class="head">
    <div class="login-right-panel">
        <div class="login-logo">
        </div>

    </div>
</div>
    <!--<div class="banner"></div>-->
    <div class="nav" style="height: 35px;">
        <div class="webNav">
            <ul style="padding-left: 115px">
                <?php if(!empty($departmentList)) { ?>
                <?php if(is_array($departmentList)): foreach($departmentList as $key=>$vo): $departmentId = $_GET['departmentId']; $cur = ''; if(empty($departmentId)) { if($key == 0) { $cur = 'cur'; } } if($departmentId == $vo['id']) { $cur = 'cur'; } if($vo == end($departmentList)) { $cur = 'last'; if($departmentId == $vo['id']) { $cur = 'last cur'; } } ?>

                    <li name="city" cityId="<?php echo ($vo["id"]); ?>" class="<?php echo ($cur); ?>"><a href="<?php echo U('home/index/index',array('departmentId'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<!-- 网页内容  -->
<div class="content pageVote">
    <div class="contentInner">
        <form class="form-wrapper" style="float:right;margin-bottom:10px;">
            <input type="text" placeholder="Search here..." required>
            <button type="submit">Search</button>
        </form>

        <div style="color:white;margin-bottom:10px;font-size:15px;">
            <label>您好</label>
            <a href="<?php echo U('home/employee/info');?>" style="color:white;text-decoration:underline;"><?php echo session('username');?></a>
            <button ><a href="<?php echo U('home/login/logout');?>">登出</a> </button>
        </div>

        <div class="mainLeft">
            <div class="leftTitle">
                <?php if(is_array($departmentList)): foreach($departmentList as $key=>$department): if($department['id'] != $departmentId) {continue;} ?>
                    <span><?php echo ($department["name"]); ?></span><?php endforeach; endif; ?>
                <?php if(empty($_GET['departmentId'])){ ?>
                <span><?php echo ($departmentList[0]["name"]); ?></span>
                <?php } ?>
            </div>
            <div class="leftContent">
                <ul>
                    <?php if(!empty($employeeList)) { ?>
                    <?php if(is_array($employeeList)): foreach($employeeList as $key=>$vo): ?><li>
                            <div class="img">
                                <a href="#"><img src="<?php echo ($avatarUrlPrefix); echo ($vo["avatar"]); ?>" width="207px" height="207px" title="<?php echo ($vo["name"]); ?>"></a>
                            </div>
                            <div class="text">
                                <h3 class="companyName" style="text-align:center;"><a href="<?php echo U('home/employee/index',array('employeeId'=>$vo['id'],'departmentId'=>$departmentId));?>" style="color:white;"><?php echo ($vo["name"]); ?></a></h3>
                                <p style="color:white;">个人介绍：<?php echo ($vo["description"]); ?></p>
                            </div>
                            <div class="voteButton">
                                <span employeeId="<?php echo ($vo["id"]); ?>" class="weiboVote"></span>
                                <span class="voteNumber"><?php echo ($vo["votes"]); ?></span>
                            </div>
                        </li><?php endforeach; endif; ?>
                    <?php } ?>

                </ul>
                <!-- 分页 -->
                <div class="pageing">
                    <?php echo ($pageShow); ?>
                    <!--<div class="pWrap">
                        <span class="p-num">
                            <a class="pn-prev disabled"><i>&lt;</i><em>上一页</em></a>
                            <a href="javascript:;" class="curr">1</a>
                            <a href="javascript:;">2</a>
                            <a href="javascript:;">3</a>
                            <a href="javascript:;">4</a>
                            <a class="pn-next" href="javascript:;"><em>下一页</em><i>&gt;</i></a>
                       </span>
                       <span class="p-skip">
                            <em>共<b>100</b>页&nbsp;&nbsp;到第</em><input class="input-txt" type="text" value="1"> <em>页</em>
                            <a class="btn btn-default"href="javascript:;">确定</a>
                       </span>
                    </div>-->
                </div>
                <!-- 分页end-->
            </div>
        </div>
        <div class="mainRigtht">
            <div class="rightTitle">
                <span style="color:#CD0000">TOP 20</span>
            </div>
            <div class="rightContent">
                <div class="rightH">
                    <span class="sort" style="color:#CD0000">排名</span>
                    <span class="name" style="color:#CD0000">名字</span>
                    <span class="voteNum" style="color:#CD0000">得票数</span>
                </div>
                <ul>
                    <?php if(!empty($employeeList)){ $count = 1; ?>
                    <?php if(is_array($employeeList)): foreach($employeeList as $cKey=>$cVo): if($count > 20) {break;} $class = ''; $avatar = ''; if($cKey == 0) { $class = 'item item1'; $avatar = $cVo['avatar']; } else if($cKey == 1) { $avatar = $cVo['avatar']; $class = 'item item2'; } else if($cKey == 2) { $avatar = $cVo['avatar']; $class = 'item item3'; } ?>
                        <li class="<?php echo ($class); ?>">
                            <span class="sortNumber"><?php echo $cKey+1; ?></span>
                            <?php if(!empty($avatar)) { ?>
                            <span class="companyLogo"><img src="<?php echo ($avatarUrlPrefix); echo ($avatar); ?>" width="49px; height="37px"></span>
                            <?php } ?>
                            <span class="companyName"><a href="#"><?php echo ($cVo["name"]); ?></a></span>
                            <span class="number"><?php echo ($cVo["votes"]); ?></span>
                        </li>
                        <?php $count++; endforeach; endif; ?>
                    <?php } ?>

                </ul>
            </div>
            <div style="margin-top:10px;text-align:center;">
                <?php if(!empty($departmentList)) { ?>
                <?php if(is_array($departmentList)): foreach($departmentList as $key=>$department): $departmentId = $_GET['departmentId']; if($department['id'] != $departmentId) {continue;} ?>
                    <button><a href="<?php echo U('home/show/index',array('departmentId'=>$department['id']));?>">查看<?php echo ($department["name"]); ?>投票统计结果</a> </button><?php endforeach; endif; ?>
                <?php if(empty($_GET['departmentId'])){ ?>
                <button><a href="<?php echo U('home/show/index',array('departmentId'=>$departmentList[0]['id']));?>">查看<?php echo ($departmentList[0]["name"]); ?>投票统计结果</a > </button>
                <?php } ?>
                <?php } ?>
            </div>
            <div style="margin-top:10px;text-align:center;">
                <button><a href="<?php echo U('home/employee/signup');?>">我要报名</a> </button>
            </div>
            <div style="margin-top:10px;text-align:center;">
                <button><a href="<?php echo U('home/map/index');?>">投票数据分析</a> </button>
            </div>

            <!--<div>-->
                <!--<button><a href="<?php echo U('home/show/index',array('departmentId'=>$department['id']));?>">查看<?php echo ($department["name"]); ?>投票统计结果</a> </button>-->
            <!--</div>-->
        </div>
    </div>
</div>
<!-- 侧导航 -->
<div class="sidebutton" style="display: none;">
    <ul>
        <li class="weibo"><a href="javascript:;"></a></li>
        <li class="weixin"><a href="javascript:;"></a></li>
        <li class="qq"><a href="javascript:;"></a></li>
    </ul>
</div>
<!-- 弹窗 这是点击微信分享弹出的二维码位置  要修改图片 请更换 src="把这里的地址换掉就可以了" -->
<div class="windower">
    <div class="inner">
        <div class="tit"><span>分享到微信</span><a id="close" href="javascript:;">x</a></div>
        <div class="img"><img src="/Public/img/erweima.jpg" title="" width="178px" height="178px;"></div>
    </div>
</div>
<!--弹窗-->
<div class="footer">
    <div class="inner">
        <div class="footerLeft">
            <img src="/Public/img/muRVP.jpg" title="思目" style="height:160px;width:160px;">
        </div>
        <div class="footerRight">
            <div class="memberList">
                <h5>江苏思目创意设计有限公司联系方式成员</h5>
                <p>戴蓓、王伟、冀静、蒙辉、李可欣、赵敏、李艾薇、黄元浩、吴宏伟、石芳霞、邹爱兰、
                    伍细媚、王槐敏、王炳才、李珍、王顺尧、王成君、张建菊、崔志刚、宋健</p>
            </div>
            <div class="contactInfor">
                <h5>江苏思目创意设计有限公司联系方式</h5>
                <p>邮箱：1493674313@superid.com</p>
                <p>联系人：邹佳琪 （思目创意）13427517856&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;周维（思目创意） 13790005924</p>
            </div>
        </div>
    </div>
    <div class="copyRight">
        <strong>版权所有 思目创意</strong>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.pageing div').addClass('pWrap');
            var wrapHtml = '<span class="p-num" >';
            wrapHtml += $('.pageing div').html();
            wrapHtml +='</span>';
            $('.pageing div').html(wrapHtml);
        });

        $(window).scroll(function(){
            var sh=$(document).scrollTop();
            if(sh>400){
                $(".sidebutton").show();
            }else{
                $(".sidebutton").hide();
            }
        });

        var voteCan = false;
        function judge(){
            var departmentId = "<?php echo ($departmentId); ?>";
            var sendContent = {departmentId:departmentId};
            var judgeURL = "<?php echo U('home/index/judge');?>";
            $.ajax({
                url:judgeURL,
                type:'post',
                data:sendContent,
                dataType:'json',
                success:function(e){
                    console.log(e);
                    if(e.flag == 'fail') {
                        voteCan = false;
                        layer.alert(e.msg);
                    }
                    else{
                        voteCan = true;
                    }
                }
            });

        }

        $('.weiboVote').click(function(){

            var voteObj = $(this);
            var departmentId = "<?php echo ($departmentId); ?>";
            var employeeId = $(this).attr('employeeId');
            var toURL = "<?php echo U('home/index/vote');?>";
            var sendContent = {departmentId:departmentId,employeeId:employeeId};
            var imgUrl = "<?php echo U('home/validate/index');?>";
            var getCodeUrl = "<?php echo U('home/validate/getCode');?>";

            judge();
            if(voteCan){

                layer.open({
                    title: '请输入验证码',
                    content:
                    '<div style="text-align:center;" id="login"><img id="codeImg" title="点击刷新" src="<?php echo U('home/validate/index');?>" onclick="this.src=this.src"><p><input type="text" id="validate" value="" size=10></p><div class="error"></div></div>',
                    yes: function(index, layero){
                        var validate = $("#validate").val();
                        var img = $("#codeImg");
                        if(validate!="")
                        {
                            $.ajax({
                                url:getCodeUrl,
                                type:'post',
                                success:function(e){
                                    if(e.sessionCode == validate) {
                                        //$('.error').html("验证码正确");
                                        layer.close(index);
                                        $.ajax({
                                            url:toURL,
                                            type:'post',
                                            data:sendContent,
                                            dataType:'json',
                                            success:function(e){
                                                console.log(e);
                                                if(e.flag == 'success') {
                                                    var vote = parseInt(voteObj.siblings('.voteNumber').text());
                                                    vote += 1;
                                                    voteObj.siblings('.voteNumber').text(vote);
                                                    layer.alert(e.msg);
                                                }

                                                if(e.flag == 'fail') {
                                                    layer.alert(e.msg);
                                                }
                                            }
                                        });

                                    }
                                    else{
                                        $('.error').html("验证码错误");
                                        img.click();
                                    }
                                }
                            });
                        }
                        else
                        {
                            $('.error').html("请填写验证码");
                        }
                    }
                });
            }

        });


        //微博分享
        $('.weibo').click(function(){
            //微博分享的标题在这里修改
            window.sharetitle = '投票开始啦！快来选出你们心目中的优秀员工#2016思目创意优秀员工评选#';

            //微博分享的图片在这里修改【给的图片链接一定要是公网能够访问的图片】
            window.shareUrl = "http://image.xiaoqianghome.com/655/1438937479569.png";

            //如果你们要分享多张图片，按照下面的格式添加，注意:如果图片路径一样会被去重【去掉重复】
            //添加二张图片: window.shareUrl += "||http://image.xiaoqianghome.com/655/1438920294897.jpg";
            //添加三张图片: window.shareUrl += "||http://image.xiaoqianghome.com/655/1438920294897.jpg";
            share();
        });

        function share(){
            //d指的是window
            (function(s,d,e){try{}catch(e){}var f='http://v.t.sina.com.cn/share/share.php?',u=d.location.href,p=['url=',e(u),'&title=',e(window.sharetitle),'&appkey=2924220432','&pic=',e(window.shareUrl)].join('');function a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=620,height=450,left=',(s.width-620)/2,',top=',(s.height-450)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent)){setTimeout(a,0)}else{a()}})(screen,document,encodeURIComponent);
        }

        //pc微信分享
        $('.weixin').click(function(){
            $('.windower').show();
        });

        $('#close').click(function(){
            $('.windower').hide();
        })

        //QQ空间分享
        $('.qq').click(function(){
            var ShareTip = function(){};

            ShareTip.prototype.sharetoqqzone=function(title,url,picurl){
                var shareqqzonestring='http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?summary='+title+'&url='+url+'&pics='+picurl;
                window.open(shareqqzonestring,'newwindow','height=400,width=400,top=100,left=100');
            }

            var shareQQ = new ShareTip();

            //QQ分享标题， 你们之前定的 # 号，QQ不让用，给你们换成 @ 符号了，要修改在下面修改
            var title = '投票开始啦！快来选出你们心目中的优秀员工@2016思目创意优秀员工评选@';

            //QQ分享内容的链接，下面为当前页面地址
            var url = window.location.href;

            //QQ分享图片链接在这里修改【给的图片链接一定要是公网能够访问的图片】
            var picUrl = "http://image.xiaoqianghome.com/655/1438937479569.png";

            //QQ分享多图片，格式如下
            //分享二张图片: picUrl += "||http://image.xiaoqianghome.com/655/1438920294897.jpg";
            //分享三张图片: picUrl += "||http://image.xiaoqianghome.com/655/1438920294897.jpg";

            shareQQ.sharetoqqzone(title, url, picUrl);
        });


        $('.qqq').click(
            function(){
                var p = {
                    url:window.location.href,
                    showcount:'1',/*是否显示分享总数,显示：'1'，不显示：'0' */
                    desc:'投票开始啦！快来选出你们心目中的优秀员工@2016思目创意优秀员工评选@',/*默认分享理由(可选)*/
                    summary:'',/*分享摘要(可选)*/
                    title:'投票开始啦！快来选出你们心目中的优秀员工@2016思目创意优秀员工评选@',/*分享标题(可选)*/
                    site:'',/*分享来源 如：腾讯网(可选)*/
                    pics:'http://image.xiaoqianghome.com/655/1438937479569.png', /*分享图片的路径(可选)*/
                    style:'203',
                    width:98,
                    height:22
                };
                var s = [];
                for(var i in p){
                    s.push(i + '=' + encodeURIComponent(p[i]||''));
                }
                document.write(['<a version="1.0" class="qzOpenerDiv" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?',s.join('&'),'" target="_blank">分享</a>'].join(''));
            }
        );

    </script>
    <script src="http://qzonestyle.gtimg.cn/qzone/app/qzlike/qzopensl.js#jsdate=20111201" charset="utf-8"></script>
</div>
</body>
</html>