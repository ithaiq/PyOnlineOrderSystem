<?php
require_once('./db.php');
require_once('function.php');
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <title>分类管理</title>
    <link rel="stylesheet" href="styles/style.css" type="text/css"/>
</head>
<body>
<nav class="nav">
    <a href="categoryadd.php">添加分类</a>
</nav>

<article class="module width_full">
    <div class="tab_container">
        <table cellspacing="0" class="tablesorter">
            <thead>
            <tr>
                <th width="10%" class="tc">id</th>

                <th width="25%">分类名</th>

                <th width="10%">操作</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $rs = getCate();
            foreach ($rs as $key => $value) {
                ?>
                <tr>
                    <td class="tc"><?php echo $value['id'] ?></td>

                    <td><?php echo $value['category'] ?></td>

                    <td><a href="categoryedit.php?id=<?php echo $value['id'] ?>&pid=<?php echo $value['pid'] ?>"
                           title="编辑">编辑</a> | <a href="action.php?action=del&id=<?php echo $value['id'] ?>" title="删除"
                                                  name="del" eid="1">删除</a></td>
                </tr>


                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</article>
</body>
</html>