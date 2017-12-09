<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>候选人详情</title>
    <link href="/Public/css/reset.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/style.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/main.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/zebra.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/talk.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/Public/js/layer.m.js"></script>
</head>
<body>
<div class="head">
    <div class="login-right-panel">
        <div class="login-logo"></div>
    </div>
    <div class="nav" style="height: 35px;">
    </div>
</div>
<!-- 网页内容  -->
<div class="content pageVote">
    <div id="container">

        <table class="zebra">

            <thead>
            <tr>
                <th colspan="2" style="font-size:20px;
	font-weight:normal;"><?php echo ($selectDepartments[0]["name"]); ?>候选人<?php echo ($selectEmployee[0]["name"]); ?>详细信息</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td>姓名</td>
                <td><?php echo ($selectEmployee[0]["name"]); ?></td>
            </tr>
            <tr>
                <td>照片</td>
                <td><img src="<?php echo ($avatarUrlPrefix); echo ($selectEmployee[0]["avatar"]); ?>" width="100px" height="100px" title="<?php echo ($selectEmployee[0]["name"]); ?>"></td>
            </tr>
            <tr>
                <td>性别</td>
                <?php if($selectEmployee[0].gender==1){ ?>
                <td>男</td>
                <?php }else{ ?>
                <td>女</td>
                <?php } ?>
            </tr>
            <tr>
                <td>职位</td>
                <td><?php echo ($selectEmployee[0]["position"]); ?></td>
            </tr>
            <tr>
                <td>个人介绍</td>
                <td><?php echo ($selectEmployee[0]["description"]); ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="voteButton">
                        <span employeeId="<?php echo ($selectEmployee[0]["id"]); ?>" class="weiboVote"></span>
                        <span class="voteNumber"><?php echo ($selectEmployee[0]["votes"]); ?></span>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!--<div>-->
        <!--<form method="post" action="<?php echo U('home/employee/index');?>">-->
            <!--<input type="text" id="userId" name="userId" style="display: none"  value="<?php echo session('id');?>"/>-->
            <!--<input style="display: none" name="employeeId" value="<?php echo ($selectEmployee[0]["id"]); ?>" />-->
            <!--<textarea name="content"></textarea>-->
            <!--<button type="submit">点评</button>-->
        <!--</form>-->
    <!--</div>-->
    <!--<div>-->
        <!--<?php if(!empty($commentList)) { ?>-->
        <!--<?php if(is_array($commentList)): foreach($commentList as $key=>$comment): ?>-->
            <!--<textarea style="color:#CD0000"><?php echo ($comment["content"]); ?></textarea>-->
            <!--<span style="color:#4cd964"> &#45;&#45; <?php echo ($comment["userId"]); ?></span>-->
        <!--<?php endforeach; endif; ?>-->
        <!--<?php } ?>-->
    <!--</div>-->




    <div class="main-home">
        <div class="talk-box">
            <h1 class="box-header"><span id="title_head" style="color:white;"><?php echo ($selectEmployee[0]["name"]); ?>的留言板</span></h1>
            <div class="box-body">
                <div class="m-editor clearfix" id="miniEditor">

                    <form method="post" action="<?php echo U('home/employee/index');?>">
                        <input type="text" id="userId" name="userId" style="display: none"  value="<?php echo session('id');?>"/>
                        <input style="display: none" name="employeeId" value="<?php echo ($selectEmployee[0]["id"]); ?>" />
                        <div class="m-editor-textarea">
                            <textarea name="content" style="height: 70px; margin: 0px; width: 534px;background-color:#404040;color:white;"></textarea>
                        </div>
                        <div class="m-editor-submit">
                            <input type="submit" class="input-button" value=" 留言 " id="commentPostBtn">
                        </div>
                       </form>

                </div>
            </div>
        </div>


        <p id="notice"></p><div id="comment_pager_wrapper" class="clearfix"></div>
        <div id="talk" class="cmt-list">

            <?php if(!empty($commentList)) { ?>
            <?php if(is_array($commentList)): foreach($commentList as $key=>$comment): ?><div class="comment">
                    <div class="cmt-body">
                        <div class="info">
                            <?php if(is_array($userList)): foreach($userList as $key=>$user): if($user[userId] === $comment[userId]) { ?>
                                <span class="author"><a href=""><?php echo ($user["username"]); ?></a></span>
                                    <?php if(session('id') === $comment[userId]) { ?>
                                        <span class="delete" ><a onclick="del(this)" class="commentDel" commentId="<?php echo ($comment[id]); ?>">删除</a></span>
                                        <!--href="<?php echo U('home/employee/del',array('commentId'=>$comment[id]));?>"-->
                                    <?php } ?>
                                <?php } endforeach; endif; ?>
                            <span class="time" style="margin-left:20px;"><?php echo ($comment["time"]); ?></span>
                        </div>
                        <div class="text-content">
                            <span><?php echo ($comment["content"]); ?></span>
                        </div>
                    </div>
                </div><?php endforeach; endif; ?>
            <?php } ?>

        </div>
    </div>




</div>
</body>
<script type="text/javascript">
        function del(obj)
        {
            if(confirm("确定要删除吗？"))
            {
            var commentId = $(obj).attr("commentId");
            $.ajax({
                url:"<?php echo U('home/employee/del');?>",
                type:'post',
                data:{commentId:commentId},
                dataType:'json',
                success:function(e){
                    console.log(e);
                    if(e.flag == 'success') {
                        $("#talk").load(location.href+" #talk");
                        layer.open({content: e.msg, time:2});
                    }
                    if(e.flag == 'fail') {
                        layer.open({content: e.msg, time:2});
                    }
                }

            });
            }
            else
            {
                return false;
            }
        }
        $('.weiboVote').click(function(){
            var voteObj = $(this);
            var departmentId = "<?php echo ($departmentId); ?>";
            var employeeId = $(this).attr('employeeId');
            var toURL = "<?php echo U('home/index/vote');?>";
            var sendContent = {departmentId:departmentId,employeeId:employeeId};
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
                        layer.open({content: e.msg, time:2});
                    }
                    if(e.flag == 'fail') {
                        layer.open({content: e.msg, time:2});
                    }
                }

            });
        });
 </script>
</html>