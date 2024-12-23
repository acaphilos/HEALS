<body>
	<!-- application/views/appointment_form.php -->
	<div class="container">
		<div class="hero-section hero-title set-bg mb-5" data-setbg="<?=base_url()?>public/img/bg/Shiny-bg.svg">
	        <div class="container h-100">
	          <div class="hero-content text-white">
	            <div class="row">
	              <div class="title">
	                <h2>Update a reminder</h2>
	              </div>
	            </div>
	          </div>
	        </div>
	    </div>

	  <p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>
		
		<form method="post" action="<?=base_url()?>EmailReminder/update/<?php echo $user_data->id; ?>">
	    
	    <label for="name">Medication Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Paracetamol 500mg" value="<?php echo $user_data->name?>" required><br>

        <label for="dosage">Dosage: </label>
        <input type="text" name="dosage" class="form-control" placeholder="(eg. 1 tablet/5 ml)" value="<?php echo $user_data->dosage?>" required><br>

        <label for="frequency">Frequency:</label>
        <select id="frequency" name="frequency" class="form-control" required>
            <option value="1 Times" <?= ($user_data->frequency == '1 Times') ? 'selected' : '' ?>>1 Times</option>
            <option value="2 Times" <?= ($user_data->frequency == '2 Times') ? 'selected' : '' ?>>2 Times</option>
            <option value="3 Times" <?= ($user_data->frequency == '3 Times') ? 'selected' : '' ?>>3 Times</option>
            <option value="4 Times" <?= ($user_data->frequency == '4 Times') ? 'selected' : '' ?>>4 Times</option>
            <option value="5 Times" <?= ($user_data->frequency == '5 Times') ? 'selected' : '' ?>>5 Times</option>
        </select><br>

        <label for="taken">Taken:</label>
        <select id="taken" name="taken" class="form-control" required>
            <option value="Daily" <?= ($user_data->taken == 'Daily') ? 'selected' : '' ?>>Daily</option>
            <option value="Weekly" <?= ($user_data->taken == 'Weekly') ? 'selected' : '' ?>>Weekly</option>
        </select><br>

        <label for="meal">Before/After Meal:</label>
        <select id="meal" name="meal" class="form-control" required>
            <option value="Before meal" <?= ($user_data->meal == 'Before meal') ? 'selected' : '' ?>>Before meal</option>
            <option value="After meal" <?= ($user_data->meal == 'After meal') ? 'selected' : '' ?>>After meal</option>
        </select><br>

        <label for="">Meds for:</label>
        <textarea name="disease" class="form-control" placeholder="Disease for the medicine"><?php echo $user_data->disease?></textarea><br>

        <label for="">Remark</label>
        <textarea name="remark" class="form-control" placeholder="Remark for the medicine"><?php echo $user_data->remark?></textarea><br>

        <label for="">Choose Pickup Date</label>
        <input type="date" name="date" class="form-control" placeholder="Appointment" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $user_data->date?>" required>

	    <button type="submit" class="btn btn-primary btn-block my-3">Update</button>
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