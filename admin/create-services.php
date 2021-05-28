<?php
session_start();
include'dbconnection.php';
//Checking session is valid or not
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

    if(isset($_POST['dealer_create_form']))
    {
        $owner_name=$_POST['owner_name'];
        $company_name=$_POST['company'];
        $city=$_POST['city'];
        $service_type=$_POST['service_type'];
        $contact_number=$_POST['contact_number'];
        $email=$_POST['email'];
        $state=$_POST['state'];
    $query="insert into service_owner (owner_name,company_name,city,service_type,contact_number,email,state) values('$owner_name','$company_name','$city','$service_type',$contact_number,'$email','$state')";
    if ($con->query($query) === TRUE) {
        $_SESSION['msg']="Profile Updated successfully";
    }
    // header('location:dealers.php');
    }

if(isset($_POST['material_create_form']))
{
	$name=$_POST['name'];
	$company_name=$_POST['company'];
	$city=$_POST['city'];
	$material=$_POST['material'];
	$contact_number=$_POST['contact_number'];
	$email=$_POST['email'];
	$state=$_POST['state'];
  $query="insert into materials (name,company_name,city,material,contact_number,email,state) values('$name','$company_name','$city','$material',$contact_number,'$email','$state')";
if ($con->query($query) === TRUE) {
    $_SESSION['msg']="Material Added successfully";
}
header('location:construction_materials.php');
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
                            ?>
                           <form name="dealer_create_form" method="post" action="">
                                <div class="form-group">
                                    <label for="owner_name">Owner Name</label>
                                    <input type="text" name="owner_name" class="form-control"  id="owner_name" placeholder="Enter owner name" required>
                                </div>
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" class="form-control" id="company" placeholder="Enter your Company" required>
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
                                    <input type="number" class="form-control" name="contact_number" id="contact_number" placeholder="Enter contact number" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email ID" required>
                                </div>
                                <button type="submit" name='dealer_create_form' class="btn btn-primary">Submit</button>
                            </form>
                          <?php } 
                          else if($_GET['type']=='construction_services') {?>
                          <form name="material_create_form" method="post" action="">
                                <div class="form-group">
                                    <label for="owner_name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter owner name" required>
                                </div>
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" class="form-control" id="company" placeholder="Enter your Company" required>
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
                                    <input type="number" class="form-control" name="contact_number" id="contact_number" placeholder="Enter contact number" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"  id="email" placeholder="Enter Email ID" required>
                                </div>
                                <button type="submit" name='material_create_form' class="btn btn-primary">Submit</button>
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