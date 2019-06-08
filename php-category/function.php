<?php

function getCate($pid = 0, &$resault = array(), $s = 0)
{
    $s = $s + 4; //分类层级前所需的空格数
    $conn = db::getInstance()->connect();
    //把得到的数据存成一个对象
    $res = $conn->query("select * from category where pid=$pid");
    //把对象循环复制给$row
    while ($row = $res->fetch_assoc()) {
        //得到每次的分类名称和在前面用空格替换，得到层级的深度
        $row['category'] = str_repeat('&nbsp;', $s) . '|--' . $row['category'];
        $resault[] = $row;
        //此处为调用自身。
        getCate($row['id'], $resault, $s);

    }
    //返回一个数组集合
    return $resault;
}
