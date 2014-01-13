<?php
/**
 * Created by PhpStorm.
 * User: yuchao
 * Date: 13-12-5
 * Time: 下午2:04
 */

require_once "PHPUnit/Autoload.php";

class XmlControl extends PHPUnit_Framework_TestCase
{

    public function test_control()
    {
        // 首先要建一个DOMDocument对象
        $xml = new DOMDocument();
        // 加载Xml文件
        $xml->load("me.xml");
        // 获取所有的message标签
        $getMeg = $xml->getElementsByTagName("message");
		
		foreach ($getMeg as $mess)
		{
			$name = $mess->getAttribute("name");
			
			//echo "name = ".$name;
			
		}
			
			
        //var_dump($getMeg);
        foreach($getMeg as $Meg)
        {
            $used = $Meg->getElementsbyTagName("borrow_used");
			$titles = $Meg->getElementsbyTagName("borrow_user");
			
			foreach ($titles as $title)
			{
				$titleName = $title->getAttribute("name");
				$titlePassword = $title->getAttribute("password");
				//echo $titleName.$titlePassword;
			}
			
            echo "title: " .$titles->item(0)->nodeValue . "<br />";
            echo "borrow_used: " .$used->item(0)->nodeValue . "<br />";
        }
    }
	
	public function testxml($filename)
	{
		if (file_exists($filename)) {
			$xml = simplexml_load_file($filename);
		} else {
			throw new Exception($filename . " does not exist");
		}
		
		//var_dump($xml);
	
		foreach($xml as $key0 => $value){
			echo "..1..[$key0] => $value";
			
			foreach($value->attributes() as $attr => $attrvalue1){
				echo "[$attr] = $attrvalue1";
				}
				echo '<br />';
			foreach($value as $attr => $attrvalue1){
				echo "[$attr] = $attrvalue1";
				}
				echo '<br />';
		}
		////////////////////////////////////////////////
		
	}
}

$phpunit = new XmlControl();

$result = $phpunit -> test_control();
$result = $phpunit -> testxml("me.xml");
return $result;