<?php
require_once('./db.php');
require_once('function.php');
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <title>添加分类</title>
    <link rel="stylesheet" href="styles/style.css" type="text/css"/>
</head>
<body>
<form name="addForm" action="action.php?action=add" method="post">
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
                        echo "<option value={$value['id']}>{$value['category']}</value>";
                    }
                    ?>
                </select>
            </fieldset>
            <fieldset>
                <label for="txtName">分类名称</label>
                <input type="text" id="txtName" name="category"/>
            </fieldset>

            <div class="tc mt20">
                <a href="javascript:void(0)" class="button green" id="btnAdd" onclick="submutForm();">添加</a>
            </div>
        </div>
    </article>
</form>
<script type="text/javascript" src="js/submitForm.js"></script>
<script>
    function submutForm() {

        if (addForm.category.value == "") {
            alert("请填写分类名称");
            addForm.category.focus();
            return false;
        } else {
            document.addForm.submit();
        }
    }
</script>
</body>
</html>