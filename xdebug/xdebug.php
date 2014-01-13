<?php


xdebug_start_code_coverage();

/**
 * 排列组合
 * 采用二进制方法进行组合的选择，如表示5选3时，只需有3位为1就可以了，所以可得到的组合是 01101 11100 00111 10011 01110等10种组合
 *
 * @param 需要排列的数组 $arr
 * @param 最小个数 $min_size
 * @return 满足条件的新数组组合
 */
function pl($arr,$size=5) {
  $len = count($arr);
  $max = pow(2,$len);
  $min = pow(2,$size)-1;
  $r_arr = array();
  for ($i=$min; $i<$max; $i++){
   $count = 0;
   $t_arr = array();
   for ($j=0; $j<$len; $j++){
    $a = pow(2, $j);
    $t = $i&$a;
    if($t == $a){
     $t_arr[] = $arr[$j];
     $count++;
    }
   }   
   if($count == $size){
    $r_arr[] = $t_arr;    
   }   
  }
  return $r_arr;
 }

 

$pl = pl(array(1,2,3,4,5,6,7),5);

var_dump($pl);

    function a($a) {
		if($a)
		{
			$a * 2.5;
		}
		else
		{
			$a = 0;
		}
    }

    function b($count) {
        for ($i = 0; $i < $count; $i++) {
			
            a($i + 0.17);
        }
    }
	
	

    b(6);
    b(10);

    print_r(xdebug_get_code_coverage());
	exit(0);
	//print_r($cover);
	
?>