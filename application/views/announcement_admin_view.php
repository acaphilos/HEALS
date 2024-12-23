<div class="loginform-section">
	<form id="userFormAnnouncement" action="<?=base_url()?>AnnouncementAdmin/addnewAnnouncement" method="post" style="border:1px solid #ccc">

		<section class="hero-section hero-title set-bg" data-setbg="<?=base_url()?>public/img/bg/wave-line.svg">
				<div class="container h-100">
				  <div class="hero-content text-white">
				    <div class="row">
				      <div class="title">
				        <h2>Announcement Submission</h2>
				      </div>
				    </div>
				  </div>
				</div>
			</section>

			<div class="container">
			 <h2>Submit a Announcement</h2>
			 <p>Please fill in this form to submit a Announcement.</p> 
			 
			 <?php echo $this->session->flashdata('status'); ?>
			 <?php $string = validation_errors(); if(!empty($string)): ?>
			 <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
			 <?php endif; ?>
			 
			 <hr>

			 <label for="ftitle"><b>Announcement Title</b></label>
			 <input type="text" placeholder="Enter Announcement Title" id="ftitle" name="fTitle" required>

			 <label for="fcontent"><b>Announcement Content</b></label>
			 <div class="form-group">
				  <textarea class="form-control" rows="5" placeholder="Enter Announcement Content" id="fcontent" name="fContent" style="background: #f1f1f1;" required></textarea>
			 </div>

			 <label for="fdate"><b>Announcement Date</b></label>
			 <input type="datetime-local" placeholder="" id="fdate" name="fDate" value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
	 

			 <div class="clearfix">
			 	<button type="submit" class="btn btn-primary btn-block my-3">Submit</button>
			 </div>
			 <div>
			<a href="<?=base_url()?>AnnouncementList">
		    <button type="button" class="btn btn-info"></i> View All Announcement</button>
		    </a>
		  </div>
			</div>
	</form>
</div>

<style>                                                                                   
body {font-family: Arial, Helvetica, sons-serif;}
* {box-sizing: border-box}

.hero-title
{
  height:270px;
  overflow:hidden;
}

.hero-content h2 
{
  font-size: 5.625rem;
  font-weight:600;
  text-align: center;
  line-height:1;
}
                                                                 
/* Full-width input fields */                                                           
input[type=text], input[type=password],input[type=email], select {
 width: 100%;
 padding: 15px;
 margin: 5px 0 22px 0; 
 display: inline-block; 
 border: none;
 background: #f1f1f1;
}
                                                                                        
input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, select:focus { 
 background-color: #ddd;
 outline: none;
}
                                                                                        
hr {
 border: 1px solid #f1f1f1; 
 margin-bottom: 25px;
}

button {
	background-color: #4CAF50;
	color: white;
	padding: 14px 20px;
	margin: 8px 0;
	border: none;
	cursor: pointer;
	width: 20%;
	opacity: 0.9;
}

button:hover {
	opacity: 1;
}

/* Extra styles for the cancel button */
.cancelbtn {
	padding: 14px 20px;
background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
	float:  left;
	width: 20%;
}

/* Add padding to container elements */
.container {
	padding: 16px;
	width: 80%;
}

/*clear float */
.clearfix::after {
	content: "";
	clear: both;
	display: table;
}

.alert {
	padding: 20px;
	background-color: #f44336;
	color: white;
}

.alert_green {
	padding: 20px;
	background-color: #00cc66;
	color: white;
}

@media screen and (max-width: 20300px) {
	.cancelbtn, .signupbtn {
		width: 20%;
	}
}
</style>