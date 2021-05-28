<?php
include "dbconnection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $services=['material'=>'materials','worker'=>'service_owner'];
    $id=$_POST['id'];
    if(isset($_POST['type']))
    {
        if(!in_array($_POST['type'],array_keys($services)))
        {
            echo json_encode([]);
        }
        else{
            $query = "select * from ".$services[$_POST['type']]." where id=".$id;
            if($_POST['type']=='worker')
            {
                $query = "select * from ".$services[$_POST['type']]." where owner_id=".$id;
            }
            $result = $con->query($query);
            $data=[];
            while($row = $result->fetch_assoc()) {
                array_push($data,$row);
            }
            $response=['success'=>true,'data'=>$data];
            echo json_encode($response);
        }
    }
}