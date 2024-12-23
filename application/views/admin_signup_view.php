<body>

<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg/Circles-bg.svg" style="height:30vh;">
<div class="container h-100">
  <div class="hero-content text-white">
    <div class="row">
      <div class="title">
        <h2>Add an Admin</h2>
      </div>
    </div>
  </div>
</div>
</section>
	
	<p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>

	<form class="form px-4" id="adminFormSignUp" action="<?=base_url()?>AdminSignup/addnewAdmin" method="post">

      <div class="row justify-content-center align-items-center">
      <div class="col">
                    
                    <label class="form-label" for="adminFname">Full Name as in NRIC</label>
                    <input type="text" id="adminFname" name="adminFname" class="form-control" placeholder="Enter Full Name">

                    <label class="form-label" for="adminDate">Birthday</label>
                    <input type="date" id="adminDate" name="adminDate" class="form-control" placeholder="Birthday" max="<?php echo date('Y-m-d'); ?>">

                    <label class="form-label" for="adminEmail">Email</label>
                    <input type="Email" id="adminEmail" name="adminEmail" class="form-control" placeholder="Enter Email">

                  </div>

                  <div class="col">
                    <label class="form-label" for="adminNric">NRIC (eg. 010215081009)</label>
                    <input type="text" id="adminNric" name="adminNric" class="form-control" placeholder="Enter NRIC Number">
                    
                    <label class="form-label" for="adminPhone">Phone No.</label>
                    <input type="text" id="adminPhone" name="adminPhone" class="form-control" placeholder="Enter Phone Number">

                    <label class="form-label" for="adminPassword">Password (Min 6, Max 20 letter)</label>
                    <input type="password" id="adminPassword" name="adminPassword" class="form-control" placeholder="Enter Password">
                  </div>
                </div>

      <button type="submit" class="btn btn-primary btn-block my-3">Signup</button>
    </form>
</body>