<html>
<head>
<style>
table, td, th {
    border: 1px solid black;
}
table {
    border-collapse: collapse;
    width: auto;
}
th {
    text-align: left;
}
</style>
</head>
<body>
<?php
function stats($id){
//      $id=$_GET['id'];
        $request = 'http://{instance_public_ip}:4243/containers/'.$id.'/stats?stream=false';
        $response  = file_get_contents($request);
        $j  = json_decode($response,true);
//      echo "<br>$response";
//      echo $jsonobj["read"];
        echo "<tr><td>Total CPU Usage \t</td><td><b>".round($j["cpu_stats"]["cpu_usage"]["total_usage"]/(1024*1024*1024),2)."GHz</b></td></tr>";
        echo "<tr><td>kernel Usage \t</td><td><b>".round($j["cpu_stats"]["cpu_usage"]["usage_in_kernelmode"]/(1024*1024*1024),2)."GHz</b></td></tr>";
        echo "<tr><td>User Usage \t</td><td><b>".round($j["cpu_stats"]["cpu_usage"]["usage_in_usermode"]/(1024*1024*1024),2)."GHz</td></tr>";
        echo "<tr><td>Memory Limit \t</td><td><b>".round($j["memory_stats"]["limit"]/(1024*1024),2)."MB</b></td></tr>";
        echo "<tr><td>Memory Usage \t</td><td><b>".round($j["memory_stats"]["usage"]/(1024*1024),2)."MB</b></td></tr>";
        $date = date_create($jsonobj["read"]);
                echo "</table>";
        echo "<br>Last Updated \t<b>".date_format($date, 'Y-m-d H:i:s')."</b><br>";
}
$id=$_GET['id'];
echo "<h1>Details of Selected Container</h1>";
$request = 'http://{instance_public_ip}:4243/containers/json?all=1';
$response  = file_get_contents($request);
$jsonobj  = json_decode($response,true);
//echo $jsonobj;
//echo('<ul ID="resultList">');
echo "<table>";
foreach($jsonobj as $item) { //foreach element in $arr
    //$uses = $item[0]; //etc
       if($id==$item["Id"])
        {
                                echo "<tr><td>Container Name \t</td><td>".$item["Names"][0]."</b></td></tr>";
                echo "<tr><td>Image \t</td><td>".$item["Image"]."</b></td></tr>";
                echo "<tr><td>Status \t</td><td>".$item["Status"]."</b></td></tr>";
                echo "<tr><td>State \t</td><td>".$item["State"]."</b></td></tr>";
                stats($id);
        }
}
?>
</body>
</html>