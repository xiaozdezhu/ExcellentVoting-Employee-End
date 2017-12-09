<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>报名页面</title>
    <link href="/Public/css/reset.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/style.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/main.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/zebra.css" type="text/css" rel="stylesheet">
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
    <div id="container" >
        <form action="/vote-fe/index.php/home/employee/signup.html" method="post">
            <table class="zebra">
                <thead>
                <tr>
                    <th colspan="2" style="font-size:20px; font-weight:normal;"><?php echo session('realname');?>报名表</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>员工ID</td>
                    <td>
                        <input type="text" id="id" name="id" value="<?php echo session('id');?>" readonly onClick="alert('这个我们知道')"/>
                    </td>
                </tr>
                <tr>
                    <td>姓名</td>
                    <td>
                        <input type="text" id="name" name="name" value="<?php echo session('realname');?>" readonly onClick="alert('请实名参加投票哦')"/>
                    </td>
                </tr>
                <tr>
                    <td>性别</td>
                    <td>
                        <select id="gender" name="gender">
                            <option value="1">男</option>
                            <option value="2">女</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>部门Id</td>
                    <td>
                        <input type="text" id="department_id" name="department_id" value="<?php echo session('departmentId');?>" readonly onclick="alert('我们知道你的部门')"/>
                    </td>
                </tr>
                <tr>
                    <td>职位</td>
                    <td>
                        <input type="text" id="position" name="position"/>
                    </td>
                </tr>
                <tr>
                    <td>个人介绍</td>
                    <td>
                        <textarea id="description" name="description"></textarea>
                    </td>
                </tr>
                </tbody>
            </table>
            <button type="submit">报名</button>
        </form>
    </div>
</div>
</body>


</html>