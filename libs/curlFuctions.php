<?php


        $headerArray = array(
                                        "Content-type:application/json;",
                                        "Accept:application/json",
                                        "Authorization: Basic eGlhb3poaWdhbmc6N2IzOTdiNDQtNzZiYy00MjU5LWJhOTYtMDI1MzFhODQ3N2Ni"
                                        );
/*
        $input_iccid = '89860617010001672760';
        $getDetail_url = 'https://api.10646.cn/rws/api/v1/devices/'.$input_iccid; //获取设备详细信息
        $getModify_url = 'https://api.10646.cn/rws/api/v1/devices/'.$input_iccid.'/auditTrails?daysOfHistory=30&pageSize=50&pageNumber=1'; //获取设备修改记录
        $getUse_url =  'https://api.10646.cn/rws/api/v1/devices/'.$input_iccid.'/ctdUsages';  //获取设备周期内使用量
        $putSetup_url = 'https://api.10646.cn/rws/api/v1/devices/'.$input_iccid;
        $putData = array (
                        'status' => 'ACTIVATED',
                        'deviceID' => 'Test Nov 27');
        $postSmsSend_url = 'https://api.10646.cn/rws/api/v1/devices/'.$input_iccid.'/smsMessages';
        $postData = array (
                         'messageText' => '测试2017-Nov-17 13:48');
                         
                         
        $rest = apiCurlGet($getDetail_url,$headerArray);
echo "查询设备详情功能，调用apiCurlGet Function!<br>";
        print_r($rest);
 

echo "查询设备变更功能，调用apiCurlGet Function，url带有参数!<br>";
        $rest = apiCurlGet($getModify_url,$headerArray);
        print_r($rest);


echo "查询设备用量功能，调用apiCurlGet Function，url带有参数!<br>";
        $rest = apiCurlGet($getUse_url,$headerArray);
        print_r($rest);                         
*/

function geturl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output,true);
        return $output;
}


function posturl($url,$data){
        $data  = json_encode($data);    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output，true);
}


function puturl($url,$data){
    $data = json_encode($data);
    $ch = curl_init(); //初始化CURL句柄 
    curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
    curl_setopt ($ch, CURLOPT_HTTPHEADER, $headerArray);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT"); //设置请求方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output,true);
}

function delurl($url,$data){
    $data  = json_encode($data);
    $ch = curl_init();
    curl_setopt ($ch,CURLOPT_URL,$put_url);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, $headerArray);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");   
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output,true);
}

?>