<?php

include "dbconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $services=['material'=>'materials','worker'=>'service_owner'];
    $state=null;
    $city=null;
    $service=null;
    if(isset($_POST['state'])&& $_POST['state']!='all')
    {
        $state=$_POST['state'];
    }
    if(isset($_POST['city']) && $_POST['city']!='all')
    {
        $city=$_POST['city'];
    }
    if(isset($_POST['service']) && $_POST['service']!='all')
    {
        $service=$_POST['service'];
    }
    if(isset($_POST['type']))
    {
        if(!in_array($_POST['type'],array_keys($services)))
        {
            echo json_encode([]);
            exit;
        }
        $query = "select * from ".$services[$_POST['type']];
        
        if($state!=null)
        {
            $query=$query." where state= '".$state."'";
            if($city!=null)
            {
                $query=$query." and city='".$city."'";
            }  
        } 
        if(!empty($service))
        {
            if($_POST['type']=='worker')
            {
                    $query=$query." and service_type='".$service."'";
            } 
            else{
                if ((strpos($query, 'where') == false)) 
                {
                    $query=$query." where material='".$service."'";
                }
                else
                {
                    $query=$query." and material='".$service."'";
                }
                
            }
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