<aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="#">
                        <!-- <img src="assets/img/ui-sam.jpg" class="img-circle" width="60"> -->
                        <i class="fa fa-user user-icon" width="60"></i>
                    </a>
                </p>
              	  <h5 class="centered"><?php echo $_SESSION['login'];?></h5>
                    <span class='menu-title'>Menu</span>
                  <li class="sub-menu">
                      <a href="dashboard.php" >
                          <i class="fa fa-tachometer"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="manage-users.php" >
                          <i class="fa fa-users"></i>
                          <span>Manage Users</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="dealers.php" >
                          <i class="fa fa-thumbs-up"></i>
                          <span>Dealers</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="construction_materials.php" >
                          <i class="fa fa-truck"></i>
                          <span>Materials</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="change-password.php">
                          <i class="fa fa-file"></i>
                          <span>Change Password</span>
                      </a>
                  </li>
              </ul>
          </div>
      </aside>