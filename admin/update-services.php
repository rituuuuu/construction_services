<?php
session_start();
include'dbconnection.php';
//Checking session is valid or not
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

// for updating user info   
if(isset($_POST['dealer_form']))
{
	$owner_name=$_POST['owner_name'];
	$company_name=$_POST['company'];
	$city=$_POST['city'];
	$service_type=$_POST['service_type'];
	$contact_number=$_POST['contact_number'];
	$email=$_POST['email'];
	$state=$_POST['state'];
	$price=$_POST['price'];
    $id=intval($_GET['id']);
$query="update service_owner set owner_name='$owner_name' ,company_name='$company_name' , city='$city',service_type='$service_type' ,contact_number='$contact_number' , email='$email',state='$state',price='$price' where owner_id='$id'";
if ($con->query($query) === TRUE) {
    $_SESSION['msg']="Profile Updated successfully";
}
}

if(isset($_POST['material_form']))
{
	$name=$_POST['name'];
	$company_name=$_POST['company'];
	$city=$_POST['city'];
	$material=$_POST['material'];
	$contact_number=$_POST['contact_number'];
	$email=$_POST['email'];
	$state=$_POST['state'];
  $id=intval($_GET['id']);
$query="update materials set name='$name' ,company_name='$company_name' , city='$city',material='$material' ,contact_number='$contact_number' , email='$email',state='$state' where id='$id'";
if ($con->query($query) === TRUE) {
    $_SESSION['msg']="Profile Updated successfully";
}
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Update Profile</title>
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
      <?php $ret=mysqli_query($con,"select * from users where id='".$_GET['uid']."'");
      ?>
      <section id="main-content">
          <section class="wrapper">    	
				<div class="row">
                  <div class="col-md-12">
                      <div class="content-panel">
                      <?php if(!empty($_SESSION['msg'])){?>
                      <div class="alert alert-success">
                        <?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']=""; ?>
                      </div>
                        <?php
                        }
                            if($_GET['type']=='dealer'){
                                $empRecords=mysqli_query($con,"select * from service_owner where owner_id=".$_GET['id']."");
                                $data=mysqli_fetch_assoc($empRecords);
                            ?>
                           <form name="dealer_form" method="post" action="">
                                <div class="form-group">
                                    <label for="owner_name">Owner Name</label>
                                    <input type="text" name="owner_name" class="form-control" value='<?php echo($data['owner_name'])?>' id="owner_name" placeholder="Enter owner name" required>
                                </div>
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" class="form-control" value='<?php echo($data['company_name'])?>' id="company" placeholder="Enter your Company" required>
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select class="form-control" id="state" name="state">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select class="form-control" id="city" name="city">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="profession">Profession</label>
                                    <select class="form-control" id="profession" name="service_type">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="number" class="form-control" name="contact_number" value='<?php echo($data['contact_number'])?>' id="contact_number" placeholder="Enter contact number" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value='<?php echo($data['email'])?>' id="email" placeholder="Enter Email ID" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Charge Per hour</label>
                                    <input type="number" class="form-control" name="price" value='<?php echo($data['price'])?>' id="price" placeholder="Enter Amount in Indian Rupees" required>
                                </div>
                                <button type="submit" name='dealer_form' class="btn btn-primary">Submit</button>
                            </form>
                          <?php } 
                          else if($_GET['type']=='construction_services') {
                              $empRecords=mysqli_query($con,"select * from materials where id=".$_GET['id']."");
                              $data=mysqli_fetch_assoc($empRecords);
                    
                          ?>
                          <form name="dealer_form" method="post" action="">
                                <div class="form-group">
                                    <label for="owner_name">Name</label>
                                    <input type="text" name="name" class="form-control" value='<?php echo($data['name'])?>' id="name" placeholder="Enter owner name" required>
                                </div>
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" class="form-control" value='<?php echo($data['company_name'])?>' id="company" placeholder="Enter your Company" required>
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select class="form-control" id="state" name="state">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select class="form-control" id="city" name="city">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="material">Material</label>
                                    <select class="form-control" id="material" name="material">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="number" class="form-control" name="contact_number" value='<?php echo($data['contact_number'])?>' id="contact_number" placeholder="Enter contact number" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value='<?php echo($data['email'])?>' id="email" placeholder="Enter Email ID" required>
                                </div>
                                <button type="submit" name='material_form' class="btn btn-primary">Submit</button>
                            </form>
                          <?php } ?>
                      </div>
                  </div>
              </div>
		</section>
      </section></section>
      <script src="assets/js/api.js"></script>  
  </body>
</html>
<?php } ?>