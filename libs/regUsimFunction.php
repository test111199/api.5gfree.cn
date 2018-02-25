<?PHP

$lastUpdate = date("YmdH");
echo "最后更新时间为：".$lastUpdate;

function checkIccidExists(&$getArray,$arrayRow)
{

echo "显示获得的二维数组内容为：".$getArray[$arrayRow][0]."ICCID: ".$getArray[$arrayRow][2];
$timesCount = $arrayRow + 1;
return $timesCount;

}



?>