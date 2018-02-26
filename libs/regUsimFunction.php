<?PHP

$lastUpdate = date("YmdH");
echo "最后更新时间为：".$lastUpdate."<br>\n";

function checkIccidExists(&$getArray,$arrayRow)
{

echo "第".$arrayRow."次:";
//var_dump($getArray);
echo $getArray[$arrayRow]["B"]." - ".$getArray[$arrayRow]["D"];
$timesCount = $arrayRow + 1;
return $timesCount;

}



?>