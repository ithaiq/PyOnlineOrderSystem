<?php 
//包含数据库连接文件
require_once('./db.php');
//得到数据库连接，我们可以直接使用类文件中的子方法，是不必实例化这个类
$conn = db::getInstance()->connect();
//执行数据库查询，使用query方法来执行SQL语句
$result = $conn-> query("select * from category");
//显示到页面上的例子，执行后会得到一个对象，使用while循环得到我们数据。
while($row=$result->fetch_assoc()){
    echo $row['id']."+".$row['category']."<br />";
}