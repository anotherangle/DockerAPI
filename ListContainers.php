<html>
<body>
<?php
$request = 'http://{instance_public_ip}:4243/containers/json?all=1';
$response  = file_get_contents($request);
$jsonobj  = json_decode($response,true);
//echo $jsonobj;
//echo('<ul ID="resultList">');
foreach($jsonobj as $item) { //foreach element in $arr
    //$uses = $item[0]; //etc
        $id=$item["Id"];
?>
<a href="http://{instance_public_ip}/HealthCheck.php?id=<?php echo $id; ?>">
<?php   echo $item["Id"]."\t".$item["Names"][0];?>
</a><br>
<?php } ?>
</body>
</html>