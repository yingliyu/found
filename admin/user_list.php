<?php

#管理 - 信息列表

session_start();
ob_start();
include_once '../inc/conn.php';
include_once '../inc/info_user.php';
?>
<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>失物招领</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <link rel="stylesheet" href='/public/admin/css/bootstrap.min.css'>
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <script src='/public/admin/js/jquery-1.11.3.min.js'></script>
    <script src='/public/admin/js/bootstrap.min.js'></script>
    <script src='/public/admin/js/manager.js'></script>
    <style>
        th{cursor: pointer;}
    </style>
    </head>
    <body>
        <?php include 'head.php';?>
        <div class="col-lg-10 col-md-10">
                <!-- 面板 -->
                <div class="panel">
                    <div class="panel-heading clearfix">
                        <h3 class="pull-left">信息管理<small> 用户信息管理</small></h3>
                        <!-- 面包屑导航 -->
                        <ol class="breadcrumb pull-right">
                            <li>
                                <span class='glyphicon glyphicon-menu-hamburger'></span>
                                <a href="#">管理中心</a>
                            </li>
                            <li>
                                <a href="#">用户管理</a>
                            </li>
                            <li class="active">用户信息编辑</li>
                        </ol>
                    </div>
                </div>
            <?php
            if ($_SESSION['admin'] == "OK") {
                include_once 'head.php';
                // include_once '../pagesql.php';
                // include_once '../page.php';
                ?>
                <p id="hr"></p>
                <div class="ime-wrap">
                    <div class="ime-tab clearfix">
                        <a href="user_add.php" type="button" class="btn-add btn btn-success pull-right">
                            添加用户
                        </a>

                        <div class="ime-inner" ng-controller="myCtrl">

                            <table class='table table-bordered table-hover text-center'>
                                <thead>

                                <tr>
                                    <th>序号</th>
                                    <th>用户名</th>
                                    <th>昵称</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                    $i=0;
                                    // var_dump($rs);
                                    // die();
                                    while ($rs = mysql_fetch_object($result)):
                                        // var_dump($rs);
                                    $i++;
                                ?>
                                    <tr>
                                    <td><?php echo $i; ?></td>

                                    <td><?php echo $rs->username; ?></td>
                                    <td><?php echo $rs->nickname; ?></td>
                                    <td>
                                        <a href="user_edit.php?id=<?=$rs->id?>" type="button" class="btn btn-primary">
                                        <span class='glyphicon glyphicon-edit'></span>
                                        编辑
                                        </a>
                                        <a href="user_delete.php?id=<?=$rs->id?>"  onclick="return confirm('确认删除吗?');" type="button" class="btn btn-warning">
                                        <span class=' glyphicon glyphicon-trash'></span>
                                        删除
                                        </a>
                                    </td>
                                </tr>

                               <?php  endwhile;?>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
    <?php

} else {
    header("location:login.php");
    ob_end_flush();
}
mysql_close();
?>
        </div>
        <!-- 页脚-版权信息-Start  -->
        <?php
        include_once 'foot.php'; //插入foot.php页脚信息
        ?>
        <!-- 页脚-版权信息-End  -->
    </body>
</html>