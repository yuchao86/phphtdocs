<?php
$code =<<<PHP_CODE
<?php
$str = "Hello, nowamagic\n";
function a($a){
	echo $a+12132;
	return $a+12123;
	}
echo $str;
?>
PHP_CODE;
 
var_dump(token_get_all($code));
?>
