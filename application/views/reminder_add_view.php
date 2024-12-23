<body>
<div class="container">
<div class="hero-section hero-title set-bg" data-setbg="<?=base_url()?>public/img/bg/Shiny-bg.svg">
    <div class="container h-100">
      <div class="hero-content text-white">
        <div class="row">
          <div class="title">
            <h2>Medication Reminder</h2>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="p-3">
    <form method="post" action="<?= base_url()?>EmailReminder/create/<?php echo $user_data->uId; ?>">
        <label for="name">Medication Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Paracetamol 500mg" required><br>

        <label for="dosage">Dosage: </label>
        <input type="text" name="dosage" class="form-control" placeholder="(eg. 1 tablet/5 ml)" required><br>

        <label for="frequency">Frequency:</label>
        <select id="frequency" name="frequency" class="form-control" required>
            <option value="1 Times">1 Times</option>
            <option value="2 Times">2 Times</option>
            <option value="3 Times">3 Times</option>
            <option value="4 Times">4 Times</option>
            <option value="5 Times">5 Times</option>
        </select><br>

        <label for="taken">Taken:</label>
        <select id="taken" name="taken" class="form-control" required>
            <option value="Daily">Daily</option>
            <option value="Weekly">Weekly</option>
        </select><br>

        <label for="meal">Before/After Meal:</label>
        <select id="meal" name="meal" class="form-control" required>
            <option value="Before meal">Before meal</option>
            <option value="After meal">After meal</option>
        </select><br>

        <label for="">Meds for:</label>
        <textarea name="disease" class="form-control" placeholder="Disease for the medicine"></textarea><br>

        <label for="">Remark</label>
        <textarea name="remark" class="form-control" placeholder="Remark for the medicine"></textarea><br>

        <label for="">Choose Pickup Date</label>
        <input type="date" name="date" class="form-control" placeholder="Appointment" min="<?php echo date('Y-m-d'); ?>">

        <button type="submit" class="btn btn-primary btn-block my-3">Add Reminder</button>
    </form>
    </div>

</div>
</div>


