<?PHP

$lastUpdate = date("YmdH");
echo "最后更新时间为：".$lastUpdate."<br>\n";

function checkIccidExists(&$getArray,$arrayRow)
{

echo "第".$arrayRow."次:";
var_dump($getArray);
//echo "显示获得的二维数组内容为：".$getArray[$arrayRow][0]."ICCID: ".$getArray[$arrayRow][2];
$timesCount = $arrayRow + 1;
return $timesCount;

}



?>