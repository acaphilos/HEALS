  <body>
    <div class="d-flex justify-content-center align-items-center mt-5 pt-5">

      <div class="card mt-5" style="width: 650px;">

        <p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>
          
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              
              <li class="nav-item text-center">
                <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a>
              </li>
              
              <li class="nav-item text-center">
                <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Signup</a>
              </li>
             
            </ul>
            
            <div class="tab-content" id="pills-tabContent">
              
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                
                <form class="form px-4" id="Loginform" action="<?=base_url()?>Login/verifyUser" method="post">
                  <div class="d-flex row justify-content-center align-items-center">
                  <div class="col">

                  <div class="form-group">
                  <label for="usertype"><b>User type</b></label>
                  <select class="custom-select" name="userType" id="usertype">
                    <option value="" disabled="disabled">Please Select</option> 
                       <option value="1" selected="selected" > User</option>
                       <option value="2" > Admin</option>
                  </select>
                  </div>

                  <label class="form-label" for="userEmail">Email</label>
                  <input type="email" id="userEmail" name="userEmail" class="form-control" placeholder="Email" required>

                  <label class="form-label" for="userPassword">Password</label>
                  <input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="Password" required>
                  <button type="submit" class="btn btn-dark btn-block">Login</button>

                </div>
                </div>
                </form>

              </div>
              
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                

                <form class="form px-4" id="userFormSignUp" action="<?=base_url()?>UserSignup/addnewUser" method="post">


                  <div class="row justify-content-center align-items-center">
                  <div class="col">
                    
                    <label class="form-label" for="userFname">Full Name as in NRIC</label>
                    <input type="text" id="userFname" name="userFname" class="form-control" placeholder="Enter Full Name">

                    <label class="form-label" for="userDate">Birthday</label>
                    <input type="date" id="userDate" name="userDate" class="form-control" placeholder="Birthday" max="<?php echo date('Y-m-d'); ?>">

                    <label class="form-label" for="userEmail">Email</label>
                    <input type="Email" id="userEmail" name="userEmail" class="form-control" placeholder="Enter Email">

                  </div>

                  <div class="col">
                    <label class="form-label" for="userNric">NRIC (eg. 010215081009)</label>
                    <input type="text" id="userNric" name="userNric" class="form-control" placeholder="Enter NRIC Number">
                    
                    <label class="form-label" for="userPhone">Phone No.</label>
                    <input type="text" id="userPhone" name="userPhone" class="form-control" placeholder="Enter Phone Number">

                    <label class="form-label" for="userPassword">Password (Min 6, Max 20 letter)</label>
                    <input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="Enter Password">
                  </div>
                </div>

                  <button type="submit" class="btn btn-dark btn-block">Signup</button>
                </form>
                </div>
              </div>            
            </div>
        </div>
      </div>
  </body>

<style>                                                                                

.card{
  background: white;
  width: 400px;
  height: 500px;
  border:none;
}
.btr{

  border-top-right-radius: 5px !important;
}
.btl{

  border-top-left-radius: 5px !important;
}
.btn-dark {
    color: #fff;
    background-color: #341A9E;
    border-color: #0d6efd;
}
.btn-dark:hover {
    color: #fff;
    background-color: #1d0e58;
    border-color: #0d6efd;
}
.nav-pills{

  display:table !important;
  width:100%;
}
.nav-pills .nav-link {
    border-radius: 0px;

}
.nav-item{
      display: table-cell;
       background: #E2DCF9;
}
.nav-pills .nav-link.active,.nav-pills .show>.nav-link {
    color: #fff;
    background-color: #341A9E
}
a {
    color: #341A9E;
    text-decoration: none;
    background-color: transparent;
    -webkit-text-decoration-skip: objects
}

.form{

  padding: 10px;
      height: 300px;
}
.form input{

  margin-bottom: 12px;
  border-radius: 3px;
}
.form input:focus{

  box-shadow: none;
}
.form button{

  margin-top: 20px;
}
</style>