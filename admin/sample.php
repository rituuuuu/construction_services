<?php
include 'dbconnection.php';
// ## Fetch records
if ($_SERVER["REQUEST_METHOD"] == "GET") {
   switch($_GET["form_type"])
   {
      case 'construction_materials':
         $data=materials($con,"select * from materials");
         break;
      case 'dealer':
         $data=dealer($con,"select * from service_owner");
         break;
      default:
         $data=[];
         break;
   }

   $response = array(
      "data" => $data
      );
   echo json_encode($response);
}

function materials($con,$empQuery)
{
      $empRecords = mysqli_query($con, $empQuery);
      $data = array();
      while ($row = mysqli_fetch_assoc($empRecords)) {
         $data[] = array( 
            "id"=>$row['id'],
            "material"=>$row['material'],
            "company_name"=>$row['company_name'],
            "name"=>$row['name'],
            "city"=>$row['city'],
            "contact_number"=>$row['contact_number'],
            "email"=>$row['email'],
            "button"=>"<a href='update-services.php?id=".$row['id']."&type=construction_services'><i id=".$row['id']." class='fa fa-reply-all action-icon-update action-icon'></i></a> <i name='construction_materials' id=".$row['id']." class='fa fa-times action-icon-delete action-icon delete-button' ></i>",
         );
      }
      return $data;
     
}

function dealer($con,$empQuery)
{
      $empRecords = mysqli_query($con, $empQuery);
      $data = array();
      while ($row = mysqli_fetch_assoc($empRecords)) {
         $data[] = array( 
            "owner_id"=>$row['owner_id'],
            "owner_name"=>$row['owner_name'],
            "company_name"=>$row['company_name'],
            "service_type"=>$row['service_type'],
            "city"=>$row['city'],
            "contact_number"=>$row['contact_number'],
            "email"=>$row['email'],
            "button"=>"<a href='update-services.php?id=".$row['owner_id']."&type=dealer'><i id=".$row['owner_id']." class='fa fa-reply-all action-icon-update action-icon'></i></a><i id=".$row['owner_id']." class='fa fa-times action-icon-delete action-icon' ></i>",
         );
      }
      return $data;
}


