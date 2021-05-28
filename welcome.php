<?php
session_start();
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{
	
?><!DOCTYPE html>
<html lang="en">
<?php include "cdn.php"?>
<body>
    <?php include "nav.php"?>
    <div class="">
       <!-- Topic Cards -->
       <div id="cards_landscape_wrap-2">
        <div class="container">
            <div class='welcome-heading'>
                Welcome <?php echo $_SESSION['name'];?>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a href="list.php?type=material">
                        <div class="card-flyer">
                            <div class="text-box">
                                <div class="image-box">
                                    <img src="images/materials.jpg" alt="" />
                                </div>
                                <div class="text-container">
                                    <h6>Building Raw Materials contacts</h6>
                                    <p>Find all kinds of constuction side raw materials contact. In which you can find all contactor and their company detials</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a href="list.php?type=worker">
                        <div class="card-flyer">
                            <div class="text-box">
                                <div class="image-box">
                                    <img src="images/worker.jpg" alt="" />
                                </div>
                                <div class="text-container">
                                    <h6>Worker details</h6>
                                   <p>Find all kinds of worker with their respective service. Which are present in all over</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
    </div>
    </div>
    <?php include "footer.php"?>
</body>

</html>
<?php } ?>