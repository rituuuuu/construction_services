<?php
session_start();
include'dbconnection.php';
// checking session is valid for not 
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
} 
$construction_data=$con->query("select * from service_owner;")->fetch_all(MYSQLI_ASSOC);
// $construction_data=json_encode($construction_data);
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Manage Users</title>
    <?php 
      include "cdn.php";
    ?>
  </head>

  <body>
  <section id="container" >
      <?php 
      include "nav.php"; 
      include "sidebar.php";
      ?>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Users</h3>
				<div class="row"> 
                  <div class="col-md-12">
                  <a class="btn btn-success add-button" href="create-services.php?type=dealer">Add Dealer</a>
                      <div class="content-panel">
                      
                      <table id="example" class="display" style="width:100%">
                      <thead>
                          <tr>
                              <th>Owner id</th>
                              <th>Owner name</th>
                              <th>Company</th>
                              <th>City</th>
                              <th>Profession</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      </table>
                      </div>
                  </div>
              </div>
		</section>
      </section
  ></section>
  </body>
  <script>
    var data= <?php echo json_encode($construction_data, JSON_HEX_TAG); ?>;
    console.log(data);
    
    $('#example').DataTable( {
      'ajax': {
          "type": "GET",
          'url':'sample.php?form_type=dealer',
      },
      "contentType": "application/json",
      "aoColumns":[
        {"data":"owner_id"},
        {"data":"owner_name"},
        {"data":"company_name"},
        {"data":"city"},
        {"data":"service_type"},
        {"data":"button"},
      ],
    } ); 
  </script>
</html>
