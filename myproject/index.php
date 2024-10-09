<!DOCTYPE html>
<html>
    <head>
        <title>New Tech</title>
        <link rel="icon" href="resources/icons8-economy-64.png">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="index.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
 
    </head>

    <body class="body">
        <div class="container-fluid">

            <!--content-->

            <div class="row mb-5">
                <div class="col-12 logo"></div>
                <div class="col-12 text-1">Welcome to New Tech</div>
            </div>
           

            <!--signup box--->
            <div class="" id="signupbox">

                <div class="row mb-5">
                    <div class="col-12 text-center fs-1">Creat A New Account</div>
                </div>

                <div class="row gap-3 ">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-6">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="ex : jhon" id="fname">
                        </div>
                        <div class="col-lg-4 col-6">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="ex : doer" id="lname">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="ex : jhondore@gmail.com" id="email">
                        </div>
                        <div class="col-lg-4 col-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="email" class="form-control" placeholder="ex : 12346" id="password">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-6">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" placeholder="ex : 0772346099" id="mobile">
                        </div>
                        <div class="col-lg-4 col-6">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender">
                                <option value="">Select Your Gender</option>
                                
                                <?php

                                    require "connection.php";

                                    $rs = Database::search("SELECT * FROM `gender`;");
                                    $n = $rs->num_rows;

                                    for ($x=0; $x<$n; $x++){
                                        $d = $rs->fetch_assoc();
                                    
                                    
                                ?>
                                
                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>
                                 
                                <?php

                                    }
                                ?>

                                
                            </select>
                        </div>
                    
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-6 mt-4">
                            <button type="button" class="btn btn-primary w-100" onclick="signup();">Sign Up</button>
                        </div>
                        <div class="col-lg-4 col-6 mt-4">
                            <button type="button" class="btn btn-danger w-100 " onclick="changeview();">Already Have An Account Sign in </button>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!--signup box--->

            <!---signin box--->
            <div class="d-none" id="signinbox">
                <div class="row mb-5">
                    <div class="col-12 text-center fs-1">Signin To Your Account</div>
                </div>

                <?php
                $email = "";
                $password = "";

                if(isset($_COOKIE["email"])){
                    $email = $_COOKIE["email"];
                }

                if(isset($_COOKIE["password"])){
                    $password = $_COOKIE["password"];
                }
                ?>

                <div class="row gap-3 ">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-12  mt-5">
                            <label for="email3" class="form-label" >Email</label>
                            <input type="text" class="form-control" value="<?php echo $email;?>" placeholder="ex : jhon" id="email2">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-12 mt-2">
                            <label for="password3" class="form-label">Password</label>
                            <input type="password" class="form-control" value="<?php  echo $password;?>" placeholder="ex : ********" id="password2">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-6  rounded-5" style="background-color: rgb(229, 228, 226);">
                            <input type="checkbox" class="form-check-input" value="" id="rem">
                            <label  class="form-check-label" for="rem">Remember Me</label>
                        </div>
                        <div class="col-lg-3 col-6 text-end  rounded-5" style="background-color: rgb(229, 228, 226);">
                            <a href="#" onclick="forgotPassword();" class=""><b>Forgot Password</b></a>
                        </div>

                    </div>

                    <div class="row justify-content-center mt-2">
                        <div class="col-lg-3 col-6  mt-2">
                            <button type="button" class="btn btn-primary w-100" onclick="signin();">Sign In </button>
                        </div>
                        <div class="col-lg-3 col-6  mt-2">
                            <button type="button" class="btn btn-danger w-100" onclick="changeview();">Creat New Account  </button>
                        </div>
                    </div>
                </div>


            </div>
            <!---signin box--->
            

            <div class="row justify-content-center mt-5 ">
                
                <div class="" id="msg">
                    <p id="p" style="height: 1px;"></p>
                </div>
                
            </div>

            <!--content-->

            <!--modal-->

                <div class="modal" tabindex="-1" id="forgotPasswordModal">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Forgot Password?</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <div class="row g-3">

                                  <div class="col-6">
                                      <label class="form-label">New Password</label>
                                      <div class="input-group mb-3">
                                          <input type="password" class="form-control" id="np" />
                                          <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();">
                                              <i class="bi bi-eye"></i>
                                          </button>
                                      </div>
                                  </div>

                                  <div class="col-6">
                                      <label class="form-label">Retype New Password</label>
                                      <div class="input-group mb-3">
                                          <input type="password" class="form-control" id="rnp" />
                                          <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">
                                              <i class="bi bi-eye"></i>
                                          </button>
                                      </div>
                                  </div>

                                  <div class="col-12">
                                      <label class="form-label">Verifiction Code</label>
                                      <input type="text" class="form-control" id="vc" />
                                  </div>

                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                          </div>
                      </div>
                  </div>
                </div>
            <!--modal-->


        </div>
        <script src="script.js"></script>
        <script src="bootstrap.js"></script>

    </body>
</html>