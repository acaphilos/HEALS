<body>
	<!-- application/views/appointment_form.php -->
	<div class="container">
		<div class="hero-section hero-title set-bg mb-5" data-setbg="<?=base_url()?>public/img/bg/Shiny-bg.svg">
	        <div class="container h-100">
	          <div class="hero-content text-white">
	            <div class="row">
	              <div class="title">
	                <h2>Book a scheduled appointment</h2>
	              </div>
	            </div>
	          </div>
	        </div>
	    </div>

	  <p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>
		
		<form method="post" action="<?=base_url()?>ScheduledAppointment/create/<?php echo $user_data->uId; ?>">
	    
	    <label for="">Full Name</label>
	    <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php echo $user_data->userFname?>" disabled>
	    <label for="">NRIC</label>
	    <input type="text" name="contact" class="form-control" placeholder="Contact Number" value="<?php echo $user_data->userNric?>" disabled>
	    <label for="">Choose Date</label>
	    <input type="date" name="date" class="form-control" placeholder="Appointment" min="<?php echo date('Y-m-d'); ?>">
	    <label for="">Choose Time Slot</label>
	    <select name="time_slot" class="form-control">
	        <option value="" disabled selected>Select Time Slot</option>
	            <option value="08:00">08:00:00</option>
	            <option value="09:00">09:00:00</option>
	            <option value="10:00">10:00:00</option>
	            <option value="11:00">11:00:00</option>
	            <option value="12:00">12:00:00</option>
	            <option value="13:00">13:00:00</option>
	            <option value="14:00">14:00:00</option>
	            <option value="15:00">15:00:00</option>
	            <option value="16:00">16:00:00</option>
	            <option value="17:00">17:00:00</option>
	            <option value="18:00">18:00:00</option>
	            <option value="19:00">19:00:00</option>
	            <option value="20:00">20:00:00</option>
	            <option value="21:00">21:00:00</option>
	    </select>
	    <label for="">Reason</label>
	    <textarea name="reason" class="form-control" placeholder="Reason for the appointment (eg. Medical Checkup)"></textarea>
	    <button type="submit" class="btn btn-primary btn-block my-3">Schedule Appointment</button>
	</form>
	</div>
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