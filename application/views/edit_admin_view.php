<section class="hero-section hero-title set-bg" data-setbg="<?=base_url()?>public/img/bg/bg-virus.svg">
  <div class="container h-100">
    <div class="hero-content text-white">
      <div class="row">
        <div class="title">
          <h2>Edit Profile</h2>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container" style="height: fit-content;">
	
	<p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>

	<form class="form px-4" id="adminFormUpdate" action="<?=base_url()?>UpdateAdmin/updateAdminProfile" method="post">

	  <div class="row justify-content-center align-items-center">
	  <div class="col">
	    
	    <label class="form-label" for="adminFname">Full Name</label>
	    <input type="text" id="adminFname" name="adminFname" class="form-control" placeholder="Enter Full Name" value="<?php echo $adminFname?>">

	    <label class="form-label" for="adminDate">Birthday</label>
	    <input type="date" id="adminDate" name="adminDate" class="form-control" placeholder="Birthday" value="<?php echo $adminDate?>">

	    <label class="form-label" for="adminEmail">Email</label>
	    <input type="Email" id="adminEmail" name="adminEmail" class="form-control" placeholder="Enter Email" value="<?php echo $adminEmail?>">

	    <label class="form-label" for="userNric">NRIC Number</label>
      <input type="text" id="adminNric" name="adminNric" class="form-control" placeholder="Enter NRIC Number" value="<?php echo $adminNric?>">

	    
	    <label class="form-label" for="adminPhone">Phone No.</label>
	    <input type="text" id="adminPhone" name="adminPhone" class="form-control" placeholder="Enter Phone Number" value="<?php echo $adminPhone?>">

	  </div>
	</div>

		  <button type="submit" class="btn btn-dark btn-block">Confirm</button>
	</form>
</div>

<style>   

.hero-title {
    height: 160px;

}                                                                               
                                                                             

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
  height: fit-content;
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