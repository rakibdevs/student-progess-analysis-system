<div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                    
                    <ul id="myTabedu1" class="tab-review-design login-tab" >
                        <li ><a class="<?php if(isset($error1)){echo 'active';}?>" href="#description">Chairman</a></li>
                        <li class="<?php if(!isset($error1)){echo 'active';}?>"><a href="#reviews">Professor</a></li>
                        <li><a class="<?php if(isset($error3)){echo 'active';}?>" href="#INFORMATION">Student</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                       

                        <div class="product-tab-list tab-pane fade " id="description">
                            <div class="row">
                                 
									<div class="hpanel">
					                    <div class="panel-body">
                                           <!-- if error -->
  					                       <?php   if(isset($error1)){echo $error1;}?>
  					                       <!-- ------- -->
					                        <form action="" id="loginForm" method="post">
					                            <div class="form-group">
					                                <label class="control-label" for="username">Username</label>
					                                <input type="text" placeholder="chairman" title="Please enter you username" required="" value="chairman" name="userCh" id="username" class="form-control" disabled>
					                                
					                            </div>
					                            <div class="form-group">
					                                <label class="control-label" for="password">Password</label>
					                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="passwordCh" id="password" class="form-control">
					                            
					                            </div>
					                            
					                            <input class="login-button" type="submit" name="submitCh" value="Login">
					                        </form>
					                    </div>
					                </div>
								
                             
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade active in" id="reviews">
                            <div class="row">
									<div class="hpanel">
					                    <div class="panel-body">
					                        <form action="" id="loginForm">
					                            <div class="form-group">
					                                <label class="control-label" for="username">Email</label>
					                                <input type="text" placeholder="example@hstu.ac.bd" title="Please enter you email" required="" value="" name="username" id="username" class="form-control">
					                                
					                            </div>
					                            <div class="form-group">
					                                <label class="control-label" for="password">Password</label>
					                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
					                               
					                            </div>
					                            
					                            <input class="login-button" type="submit" name="" value="Login">
					                        </form>
					                    </div>
					                
								</div>
                              
                              
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="INFORMATION">
                            <div class="row">
									<div class="hpanel">
					                    <div class="panel-body">
					                        <form action="" id="loginForm">
					                            <div class="form-group">
					                                <label class="control-label" for="username">Student Id</label>
					                                <input type="text" placeholder="1402170" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">
					                                
					                            </div>
					                            <div class="form-group">
					                                <label class="control-label" for="password">Password</label>
					                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
					                                
					                            </div>
					                            
					                            <input class="login-button" type="submit" name="" value="Login">
					                        </form>
					                    </div>
					                
								</div>
                                
                            </div>
                        </div>
                    </div>
                </div>