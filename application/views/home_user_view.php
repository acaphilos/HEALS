<body>

<!-- Hero Section -->
<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg/World-bg.svg" style="height:40vh;border-radius: 15px;">
  <div class="container h-100">
    <div class="hero-content text-white">
      <div class="row">
        <div class="col-lg-6 pr-0">
          <h2>Welcome!</h2>
          <p>
           Instantly schedule appointments, access your medical records, and receive timely reminders – all in one place. Your time is precious – prioritize your health with HEALS today!
          </p>
        </div>
        <div class="col-lg-6 pr-0">
          
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <!-- <table> -->
    <td>                         
      <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime mt-3">Your Upcoming Appointment</p>
      <center>
        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
          <table width="85%" class="sub-table scrolldown" border="0" >
            <thead>
                
            <tr>
              <th class="table-heading">Appoint. Number</th>
              <th class="table-heading">Session Date</th>
              <th class="table-heading">Session Time</th>
              <th class="table-heading">Checkup Id</th>
              <th class="table-heading">Session Title</th>
              <th class="table-heading">Status</th>
              <th class="table-heading">Remark</th>
              </tr>
              </thead>
              
              <tbody>

                  <?php
                        
                  if (!empty($user_appointments)) {
                      foreach ($user_appointments as $row) {
                          ?>
                          <tr>
                              <td><?php echo $row->id; ?></td>
                              <td><?php echo $row->date; ?></td>
                              <td><?php echo $row->time_slot; ?></td>
                              <td><?php 
                              if ($row->checkupId == 0 ){
                                echo 'None'; 
                              } else {
                                  echo $row->checkupId; 
                              } ?>
                              </td>
                              <td><?php echo $row->reason; ?></td>
                              <td><?php echo $row->status; ?></td>
                              <td><?php echo $row->remark; ?></td>
                          </tr>
                          <?php
                        }
                    } else {
                      ?>
                      <tr>
                          <td colspan="7">You have no upcoming appointment</td>
                      </tr>
                      <?php
                    }
                  ?>

                
              </tbody>
            </table>
          </div>
      </center>
    </td>
  <!-- </table> -->
</div>



<!-- News Section -->
<section class="news-section">
<!-- <div class="section-title">
  <h2> Latest News & Updates </h2>
</div> -->

<div class="container">
  <div class="news-sliders owl-carousel">
    
    <?php foreach ($announce_data as $row) { ?>
    <div class="news-card">
    <img src="<?=base_url()?>public/img/clinic.jpg" alt="news icon">
      <div class="news-content">
        <h3 class="text-white"> <?php echo $row->announcementTitle;?></h3>
        <span>Published: </b><?php echo $row->date;?></span><br>
        <span><?php echo $row->announcementContent;?></span>
      </div>
    </div>
    <?php } ?> 
    
  </div>
</div>
</section>

<!-- Course Section -->
<section class="course-section spad">
<div class="section-title">
  <h2> Our Features </h2>
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-4">
      <div class="course-card ">
      <div class="course-content">
        <img src="<?=base_url()?>public/img/features-thumb/symptom.jpg" alt="Features icon">
        <h4> Symptom Checking </h4>
        <p> Check for your possible disease simply by providing us your symptom. This feature only serve as symptom checkup for  appointment purposes and does not considered as final health diagnosis. </p>
        <a href="<?=base_url()?>CheckupSymptom">
        	<button type="button" onclick="#" class="course-card-btn site-btn"> Check Now </button>
        </a>
      </div>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="course-card">
      <div class="course-content">
        <img src="<?=base_url()?>public/img/features-thumb/appointment.jpg" alt="Features icon">
        <h4> Book appointment </h4>
        <p> Booking appointment with your doctor now all ready at your fingertips. </p>
        <a href="<?=base_url()?>Appointment">
        	<button type="button" onclick="#" class="course-card-btn site-btn"> Book Now </button>
        </a>
      </div>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="course-card">
      <div class="course-content">
        <img src="<?=base_url()?>public/img/features-thumb/medicine.jpg" alt="Features icon">
        <h4> Medication Reminder </h4>
        <p> Never forget to take your medicine ever again.</p>
        <a href="<?=base_url()?>ReminderEmail">
        	<button type="button" onclick="#" class="course-card-btn site-btn"> Try Now </button>
        </a>
      </div>
      </div>
    </div>     
  </div>
</div>
</section>
		
</body>

<style>

.hero-title
{
  height:270px;
  overflow:hidden;
}

/*Table*/
.table-heading{
    font-size: 16px;
    font-weight: 500;
    padding: 10px;
    border-bottom: 3px solid #0A76D8;
}

.sub-table{
    border: 1px solid #ebebeb;
    border-radius: 8px;
    
}

.sub-table, .anime {
    animation: transitionIn-Y-bottom 0.5s
}

.abc{
  width: 100%;
  height: 550px;
  overflow: auto;
}


</style>