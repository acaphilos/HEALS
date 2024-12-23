
<body>
	<div class="row" style="height: fit-content;">
		<div class="col mx-5 p-3 text-center" style="margin-top: 50px;background: #5D73D8;height: fit-content;border-radius: 10px;">
		<div class="col p-5" style="background: #40415E;border-radius: 10px;height: auto;">

			<?php //echo "Machine Learning Output: " . $output; ?>
			<h2 class="text-white">Symptom Checkup Result</h2>
			<div class="row">
				<div class="col-6 align-items-start">
					<h3 class="m-2 p-2 text-white">Symptoms:</h3>
		            <div class="m-2 p-4" style="background: #E6E3F2; width:auto;border-radius: 10px;">
					<?php foreach ($symptoms as $symptom): ?>
					<div class="m-1" style="background: #AFA5D9; width:fit-content;border-radius: 10px;"><h5 class="m-2 p-1" ><?php echo $symptom; ?><br></h5></div>
		        	<?php endforeach; ?>
		        	</div>


				</div>
				<div class="col-6 text-left" style="font-size: 4rem;">
					<h3 class="m-2 p-2 text-white">Possible Disease:</h3>
					<div style="background: #FF0000; width:100%; "><h4 class="m-2 p-4 " ><?php echo $result[0]; ?></h4></div>
					<div style="background: #FF5B5B; width:80%; "><h4 class="m-2 p-4" ><?php echo $result[1]; ?></h4></div>
					<div style="background: #FFADAD; width:60%; "><h4 class="m-2 p-4" ><?php echo $result[2]; ?></h4></div>
				</div>
			
			</div>
		</div>
		</div>
	</div>

	<div class="row d-flex justify-content-center align-items-center">
		<div class="col mx-5 my-1 p-3 text-center" style="background: #5D73D8;height: fit-content;border-radius: 10px;">
			<div class="col p-2" style="background: #40415E;border-radius: 10px;height: auto;">
				<div class="m-3">
				<h4 class="text-white">Book for an appointment?</h4>
					<a href="<?=base_url()?>Appointment">
					<button type="button" class="btn btn-primary"> Click Here </button>
					</a>
					<a href="<?=base_url()?>CheckupHistory">
					<button type="button" class="btn btn-primary"> Checkup History </button>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>