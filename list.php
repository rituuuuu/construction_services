<?php
session_start();
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

    if(!isset($_GET['type']))
    {
        header('location:welcome.php');
    }
	
?><!DOCTYPE html>
<html lang="en">
<?php include "cdn.php"?>
<body id="list-body">
    <?php include "nav.php"?>
    <div class="">
       <!-- Topic Cards -->
       <div id="">
            <div class="container">
            <?php include "model.php"?>
            <div class='search-div row'>
                <div class="col-sm-4">
                    <h4>Select state</h4>
                    <select class="search-select"  id="state" name="state"></select>
                </div>
                <div class="col-sm-4"   >
                    <h4>Select city</h4>
                    <select class="search-select" id="city" name="city"></select>
                </div>
                <?php if($_GET['type']=='worker'){?>
                    <div class="col-sm-4"   >
                        <h4>Select Profession</h4>
                        <select class="search-select" id="profession" name="service_dropdown"></select>
                    </div>
                <?php }else{?>
                    <div class="col-sm-4"   >
                        <h4>Select material Type</h4>
                        <select class="search-select" id="material" name="service_dropdown"></select>
                    </div>
                <?php } ?>
                
            </div>
            <div class='list-container'>
                <div class="row tile">
                    <div class="col-sm-2">
                        <div class="tile-icon">
                            <img class="tile-icon-image" src="images/plumber.svg" alt="">
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">[name]</h5>
                            <p class="card-text">[company]</p>
                            <p class="card-text">[service]</p>
                            <button id='api-call' class="btn btn-primary">Get details</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <input type="hidden" id='service-type' name='<?php echo $_GET['type']?>'/>
    </div>
    <script src="js/api.js"></script>
</body>
<?php include "footer.php"?>
</html>
<?php } ?>