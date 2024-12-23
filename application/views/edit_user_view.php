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

  <form class="form px-4" id="userFormSignUp" action="<?=base_url()?>UpdateUser/updateUserProfile" method="post">

	  <div class="row justify-content-center align-items-center">
	  <div class="col">
	    
	    <label class="form-label" for="userFname">Full Name</label>
	    <input type="text" id="userFname" name="userFname" class="form-control" placeholder="Enter Full Name" value="<?php echo $userFname?>">

	    <label class="form-label" for="userDate">Birthday</label>
	    <input type="date" id="userDate" name="userDate" class="form-control" placeholder="Birthday" value="<?php echo $userDate?>">

	    <label class="form-label" for="userEmail">Email</label>
	    <input type="Email" id="userEmail" name="userEmail" class="form-control" placeholder="Enter Email" value="<?php echo $userEmail?>">

	    <label class="form-label" for="userNric">NRIC Number</label>
      <input type="text" id="userNric" name="userNric" class="form-control" placeholder="Enter NRIC Number" value="<?php echo $userNric?>">
	    
	    <label class="form-label" for="userPhone">Phone No.</label>
	    <input type="text" id="userPhone" name="userPhone" class="form-control" placeholder="Enter Phone Number" value="<?php echo $userPhone?>">

	  </div>
	</div>
		  <button type="submit" class="btn btn-dark btn-block">Confirm</button>
        <button type="button" class="btn btn-secondary btn-block" onclick="history.back()">Cancel</button>
	</form>

  <?php
  echo '<form method="post" action="' . base_url('UpdateUser/deleteUser/' . $uId) . '" onsubmit="return confirmDelete(' . $uId . ')">
  <button type="submit" value="Delete" class="btn btn-danger ml-4">Delete Account Permanently</button>
  </form>';
  ?>
</div>

<script>

    function confirmDelete(userId) {
        confirm('Are you sure you want to permanently delete your account?')
    }
</script>

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