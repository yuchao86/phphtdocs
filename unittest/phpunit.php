<?php

include_once "PHPUnit/Autoload.php";

class DataTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @dataProvider provider
     */
    public function testAdd($data){
		foreach($data as $each){
		$a = $each[0];
		$b = $each[1];
		$c = $each[2];
		echo $a."a".$b."b".$c."c";
        $this->assertEquals($c,$a+$b);
		}

    }

    public function provider(){

        return array(
            array(1,1,2),
            array(4,1,5),
            array(1,3,4),
            array(1,1,3));

    }

}

$DataTest = new DataTest();
$data = $DataTest->provider();

$vode =  $DataTest-> testAdd($data);
echo "===";
var_dump($vode);






?>
