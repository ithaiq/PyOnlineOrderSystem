<?php
require_once('./db.php');
require_once('function.php');
$editId = $_GET['id'];    //分类id
$editName = '';    //分类名
$pid = $_GET['pid'];    //此分类的父级分类id
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <title>添加分类</title>
    <link rel="stylesheet" href="styles/style.css" type="text/css"/>
</head>
<body>
<form name="addForm" action="action.php?action=update" method="post">
    <nav class="nav">
        <a href="index.php">返回列表</a>
    </nav>
    <article class="module width_full">
        <div class="module_content w500">
            <fieldset>
                <label for="txtName">上级菜单</label>
                <select name="pid">
                    <option value="0">作为顶级菜单</option>
                    <?php
                    //把数据放到$rs中
                    $rs = getCate();
                    //遍历数组
                    foreach ($rs as $key => $value) {
                        if ($value['id'] == $pid) {        //如果为次分类的父级分类，则选中状态
                            echo "<option selected='true' value={$value['id']}>{$value['category']}</value>";
                        } else {
                            echo "<option value={$value['id']}>{$value['category']}</value>";
                        }
                        if ($value['id'] == $editId) {        //需要编辑的分类名，去除前面的 `&nbsp;|--`
                            $editName = trim(preg_replace('/(\&nbsp;)*\|--/', '', $value['category']));
                        }
                    }
                    ?>
                </select>
            </fieldset>
            <fieldset>
                <label for="txtName">分类名称</label>
                <input type="text" id="txtName" name="category" value="<?php echo $editName; ?>"/>
                <input type="hidden" name="id" value="<?php echo $editId; ?>">
            </fieldset>

            <div class="tc mt20">
                <a href="javascript:void(0)" class="button green" id="btnAdd" onclick="submitForm();">修改</a>
            </div>
        </div>
    </article>
</form>
<script type="text/javascript" src="js/submitForm.js"></script>
</body>
</html>