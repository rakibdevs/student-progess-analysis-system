<?php 

require_once('connect.php'); ?>
        <div class="header-top-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-top-wraper">
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="menu-switcher-pro">
                                        <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
												<i class="educate-icon educate-nav"></i>
											</button>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="header-top-menu tabl-d-n">
                                        <!-- <ul class="nav navbar-nav mai-top-nav">
                                            <li class="nav-item"><a href="#" class="nav-link">Home</a>
                                            </li>
                                            <li class="nav-item"><a href="#" class="nav-link">About</a>
                                            </li>
                                            <li class="nav-item"><a href="#" class="nav-link">Services</a>
                                            </li>
                                            <li class="nav-item dropdown res-dis-nn">
                                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">Project <span class="angle-down-topmenu"><i class="fa fa-angle-down"></i></span></a>
                                                <div role="menu" class="dropdown-menu animated zoomIn">
                                                    <a href="#" class="dropdown-item">Documentation</a>
                                                    <a href="#" class="dropdown-item">Expert Backend</a>
                                                    <a href="#" class="dropdown-item">Expert FrontEnd</a>
                                                    <a href="#" class="dropdown-item">Contact Support</a>
                                                </div>
                                            </li>
                                            <li class="nav-item"><a href="#" class="nav-link">Support</a>
                                            </li>
                                        </ul> -->
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="header-right-info">
                                        <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                            <li class="nav-item dropdown">
                                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-message edu-chat-pro" aria-hidden="true"></i><span class="indicator-ms"></span></a>
                                                <div role="menu" class="author-message-top dropdown-menu animated zoomIn" style="background:#f0f3f6;">
                                                    <?php include('message.php'); ?>
                                                </div>
                                            </li>
                                            <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-bell" aria-hidden="true"></i><span class="indicator-nt"></span></a>
                                                <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                                                    <div class="notification-single-top">
                                                        <h1>Notifications</h1>
                                                    </div>
                                                    <ul class="notification-menu">
                                                        <li>
                                                            <a href="#">
                                                                <div class="notification-icon">
                                                                    <i class="educate-icon educate-checked edu-checked-pro admin-check-pro" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="notification-content">
                                                                    <span class="notification-date">16 Sept</span>
                                                                    <h2>Advanda Cro</h2>
                                                                    <p>Please done this project as soon possible.</p>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="notification-icon">
                                                                    <i class="fa fa-cloud edu-cloud-computing-down" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="notification-content">
                                                                    <span class="notification-date">16 Sept</span>
                                                                    <h2>Sulaiman din</h2>
                                                                    <p>Please done this project as soon possible.</p>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="notification-icon">
                                                                    <i class="fa fa-eraser edu-shield" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="notification-content">
                                                                    <span class="notification-date">16 Sept</span>
                                                                    <h2>Victor Jara</h2>
                                                                    <p>Please done this project as soon possible.</p>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="notification-icon">
                                                                    <i class="fa fa-line-chart edu-analytics-arrow" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="notification-content">
                                                                    <span class="notification-date">16 Sept</span>
                                                                    <h2>Victor Jara</h2>
                                                                    <p>Please done this project as soon possible.</p>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="notification-view">
                                                        <a href="#">View All Notification</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item user-name">
                                                <?php 
                                                $userName='demo';
                                                $img='man.png';
                                                if(isset($_SESSION['userId'])){
                                                  $userid=$_SESSION['userId'];
                                                  $userCat=$_SESSION['category'];
                                                  $useremail=$_SESSION['username'];
                                                  $userName='none';
                                                  $img='man.png';
                                                  if ($userCat=='Teacher') {
                                                     $query = $mysqli->query("select * from teacher where email='$useremail'");
                                                     while($row = $query->fetch_array()){
                                                        $userName=$row['full_name'];
                                                        $img=$row['image'];
                                                     }

                                                  
                                                  }
                                                  else {
                                                    
                                                  $userName=$_SESSION['username'];
                                                     $img='man.png';
                                                  }
                                              }
                                                ?>


                                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
														<img src="upload/professor/<?php echo $img; ?>" alt="" />
														<span class="admin-name"><?php echo $userName; ?></span>
														<i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
												</a>
                                                <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                  <?php if ($userCat=='Teacher') { 
                                                     $userEmail=$_SESSION['username'];        
                                                     $query_t=$mysqli->query("select id, full_name from teacher where email='$userEmail'");
                                                     $teacher = $query_t->fetch_array();
                                                   ?>                                                     
                                                    <li><a href="teacher.php?id=<?php echo $teacher['id']; ?>&&name=<?php echo $teacher['full_name']; ?>"><span class="edu-icon edu-user-rounded author-log-ic"></span>My Profile</a>
                                                    </li>
                                                    <?php } ?>
                                                    <li><a href="chngpasswd.php" ><span class="edu-icon edu-settings author-log-ic"></span>Change Password</a>
                                                    </li>
                                                    
                                                    <li><a href="logout.php"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                    </li>
                                                </ul>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php  ?>