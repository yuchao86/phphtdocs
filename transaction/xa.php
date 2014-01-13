<?php

$mapfarm = new mysqli("localhost","root","yuchao","xadb1")or die("$mapfarm ：  连接失败");
$map     = new mysqli("localhost","root","yuchao","xadb2")or die("$map     ：  连接失败");

$grid = uniqid("");
$mapfarm->query("SET NAMES 'utf8'");
$map->query("SET NAMES 'utf8'");

$mapfarm->query("XA START '$grid'");//准备事务1
$map->query("XA START '$grid'");//准备事务2


echo "the uniqid is ". $grid;

try {
		$return = $mapfarm->query("UPDATE test_transation1 SET name='第一ssP2P' WHERE id=1");
		//第一个分支事务准备做的事情，通常他们会记录进日志

	if($return == false) {
	   throw new Exception("<a href='http://'>113更新失败!</a>");
	}
		$return = $map->query("UPDATE test_transation2 SET name='网信金融' WHERE id=3") ;
		//第二个分支事务准备做的事情，通常他们会记录进日志

	if($return == false) {
	   throw new Exception("116更新失败!");
	}
	
	$mapfarm->query("XA END '$grid'");
	$mapfarm->query("XA PREPARE '$grid'");//通知是否准备提交

	$map->query("XA END '$grid'");
	$map->query("XA PREPARE '$grid'");//通知是否准备提交

	

	$mapfarm->query("XA COMMIT '$grid'");//这两个基本同时执行
	$map->query("XA COMMIT '$grid'");
} catch (Exception $e) {
	$mapfarm->query("XA ROLLBACK '$grid'");
	$map->query("XA ROLLBACK '$grid'");
	print $e->getMessage();
}

///////////////////////////////////////////////////////////////

$map->query("XA START '$grid'");

$sql = "SELECT * FROM test_transation2 WHERE id=2";
$result = $map->query($sql) or  die("查询失败");
echo "<pre>";
print_r(mysqli_fetch_assoc($result));
echo "</pre>";

$map->query("XA END '$grid'");
$map->query("XA PREPARE '$grid'");

$map->query("XA COMMIT '$grid'");

//////////////////////////////////////////////////////////////

$mapfarm->query("XA start $grid");
$sql="insert into test_transation1 values(4,'小虎')";

$result = $mapfarm->query($sql) ;
$sql="select * from test_transation1";
$result = $mapfarm->query($sql) or  die("查询失败");
echo "<pre>";
print_r(mysqli_fetch_assoc($result));
echo "</pre>";
$mapfarm->query("XA END $grid");
$mapfarm->query("XA  prepare $grid");
$mapfarm->query("XA commit $grid");

$map->close();
$mapfarm->close();
///////////////////////////////////////////////////////////////

?>