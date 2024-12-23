<body>
	<!-- application/views/appointment_form.php -->
	<div class="container">
		<div class="hero-section hero-title set-bg mb-5" data-setbg="<?=base_url()?>public/img/bg/Shiny-bg.svg">
	        <div class="container h-100">
	          <div class="hero-content text-white">
	            <div class="row">
	              <div class="title">
	                <h2>Update a scheduled appointment</h2>
	              </div>
	            </div>
	          </div>
	        </div>
	    </div>

	  <p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>
		
		<form method="post" action="<?=base_url()?>ScheduledAppointment/update/<?php echo $user_data->id; ?>">
	    
	    <label for="">Full Name</label>
	    <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php echo $user_data->userFname?>" disabled>
	    <label for="">NRIC</label>
	    <input type="text" name="contact" class="form-control" placeholder="Contact Number" value="<?php echo $user_data->userNric?>" disabled>
	    <label for="">Choose Date</label>
	    <input type="date" name="date" class="form-control" placeholder="Appointment" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $user_data->date?>">
	    <label for="">Choose Time Slot</label>
	    <select name="time_slot" class="form-control">
      		<option value="" disabled selected>Select Time Slot</option>
          <option value="08:00" <?= ($user_data->time_slot == '08:00:00') ? 'selected' : '' ?>>08:00:00</option>
			    <option value="09:00" <?= ($user_data->time_slot == '09:00:00') ? 'selected' : '' ?>>09:00:00</option>
			    <option value="10:00" <?= ($user_data->time_slot == '10:00:00') ? 'selected' : '' ?>>10:00:00</option>
			    <option value="11:00" <?= ($user_data->time_slot == '11:00:00') ? 'selected' : '' ?>>11:00:00</option>
			    <option value="12:00" <?= ($user_data->time_slot == '12:00:00') ? 'selected' : '' ?>>12:00:00</option>
			    <option value="13:00" <?= ($user_data->time_slot == '13:00:00') ? 'selected' : '' ?>>13:00:00</option>
			    <option value="14:00" <?= ($user_data->time_slot == '14:00:00') ? 'selected' : '' ?>>14:00:00</option>
			    <option value="15:00" <?= ($user_data->time_slot == '15:00:00') ? 'selected' : '' ?>>15:00:00</option>
			    <option value="16:00" <?= ($user_data->time_slot == '16:00:00') ? 'selected' : '' ?>>16:00:00</option>
			    <option value="17:00" <?= ($user_data->time_slot == '17:00:00') ? 'selected' : '' ?>>17:00:00</option>
			    <option value="18:00" <?= ($user_data->time_slot == '18:00:00') ? 'selected' : '' ?>>18:00:00</option>
			    <option value="19:00" <?= ($user_data->time_slot == '19:00:00') ? 'selected' : '' ?>>19:00:00</option>
			    <option value="20:00" <?= ($user_data->time_slot == '20:00:00') ? 'selected' : '' ?>>20:00:00</option>
			    <option value="21:00" <?= ($user_data->time_slot == '21:00:00') ? 'selected' : '' ?>>21:00:00</option>
	    </select>

	    <label for="">Reason</label>
	    <textarea name="reason" class="form-control" placeholder="Reason for the appointment (eg. Medical Checkup)"><?php echo $user_data->reason?></textarea>
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