<body>
	<!-- application/views/appointment_form.php -->
	<div class="container">
		<div class="hero-section hero-title set-bg mb-5" data-setbg="<?=base_url()?>public/img/bg/Shiny-bg.svg">
	        <div class="container h-100">
	          <div class="hero-content text-white">
	            <div class="row">
	              <div class="title">
	                <h2>Add Medical Record</h2>
	              </div>
	            </div>
	          </div>
	        </div>
	    </div>

	  <p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>
		
		<form method="post" action="<?=base_url()?>RecordUserList/create/<?php echo $user_data->id; ?>">
	    
	    <label for="">Full Name</label>
	    <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php echo $user_data->userFname?>" disabled>
	    <label for="">NRIC</label>
	    <input type="text" name="nric" class="form-control" placeholder="Contact Number" value="<?php echo $user_data->userNric?>" disabled>
	    <label for="">Appointment ID</label>
	    <input type="text" name="appId" class="form-control" placeholder="Contact Number" value="<?php echo $user_data->id?>" disabled>
	    
	    <label for="">Date</label>
	    <input type="datetime-local" name="datetime" class="form-control" placeholder="Appointment" value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
	    
	    <label for="">Summary</label>
	    <textarea name="summary" class="form-control" placeholder="Summary for the appointment"></textarea>

	    <label for="">Prescription</label>
	    <textarea name="prescription" class="form-control" placeholder="Prescription for the appointment"></textarea>
	    <button type="submit" class="btn btn-primary btn-block my-3">Submit Record</button>
	</form>
</body>

<style>                                                                                   
body {font-family: Arial, Helvetica, sons-serif;}
* {box-sizing: border-box}

.hero-title
{
  height:270px;
  overflow:hidden;
}
</style>