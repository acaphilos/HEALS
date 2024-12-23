<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg/Circles-bg.svg" style="height:30vh;">
<div class="container h-100">
  <div class="hero-content text-white">
    <div class="row">
      <div class="title">
        <h2>User Records Details</h2>
      </div>
    </div>
  </div>
</div>
</section>

    <p><?php echo $this->session->flashdata('status'); ?></p>
    <?php $string = validation_errors(); if(!empty($string)): ?>
    <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
    <?php endif; ?>
<section class="container">
  
  <div class="d-flex justify-content-center"><h2>User Details</h2></div>
  <div class="m-4 px-4">
    <div class="row justify-content-center align-items-start">
    <div class="col">
      
      <label class="form-label" for="userFname">Full Name as in NRIC</label>
      <input type="text" id="userFname" name="userFname" class="form-control" placeholder="Enter Full Name" value="<?php echo $user_data->userFname?>" disabled>

      <label class="form-label" for="userDate">Date of Birth</label>
      <input type="date" id="userDate" name="userDate" class="form-control" placeholder="Birthday" value="<?php echo $user_data->userDate?>" disabled>

      <label class="form-label" for="userEmail">Email</label>
      <input type="Email" id="userEmail" name="userEmail" class="form-control" placeholder="Enter Email" value="<?php echo $user_data->userEmail?>" disabled>

    </div>

    <div class="col">
      <label class="form-label" for="userNric">NRIC</label>
      <input type="text" id="userNric" name="userNric" class="form-control" placeholder="Enter NRIC Number" value="<?php echo $user_data->userNric?>" disabled>
      
      <label class="form-label" for="userPhone">Phone No.</label>
      <input type="text" id="userPhone" name="userPhone" class="form-control" placeholder="Enter Phone Number" value="<?php echo $user_data->userPhone?>" disabled>

    </div>
    </div>
  </div>
</section>

<div class="container mt-3">
    <input type="text" id="appointmentSearch" class="form-control" placeholder="Search">
</div>

<section class="timetable">
  <div class="d-flex justify-content-center"><h2>All Records</h2></div>
  <div class="container d-flex justify-content-center">
    <table class="styled-table">
      <thead>
      <tr>
        <th> ID </th>
        <th> Date & Time </th>
        <th> Summary </th>
        <th> Prescription </th>
        <th> Appointment ID </th>
        <th> Action </th>

      </tr>
    </thead>

      
    <tbody>
        <?php
        if (!empty($user_record)) {
            foreach ($user_record as $row) {
                ?>
                <tr>
                <td><?php echo $row->recordId?></td>  
                <td><?php echo $row->datetime;?></td>  
                <td><?php echo $row->summary;?></td>  
                <td><?php echo $row->prescription;?></td>  
                <td><?php echo $row->appId;?></td>  
                <td>
                <?php
                echo '<form method="post" action="' . base_url('RecordUserList/deleteRecord/' . $row->recordId) . '" onsubmit="return confirmDelete(' . $row->id . ')">
                      <button type="submit" value="Delete" class="btn btn-danger btn-block"><i class="bx bxs-trash"></i></button>
                      </form>';
                ?>
                </td> 
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5">You have no record</td>
            </tr>
            <?php
        }
        ?> 
      </tbody>
    </table>
  </div>
</section>


<section class="timetable">
  <div class="d-flex justify-content-center"><h2>All Appointments</h2></div>
  <div class="container d-flex justify-content-center">
    <table class="styled-table">
      <thead>
      <tr>
        <th> ID </th>
        <th> Date </th>
        <th> Timeslot </th>
        <th> Checkup ID </th>
        <th> Reason </th>
        <th> Status </th>
        <th> Remark </th>
        <th> Action </th>
      </tr>
    </thead>

    <tbody>
      <?php
        if (!empty($appointments)) {
            foreach ($appointments as $row) {
                ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->date; ?></td>
                    <td><?php echo $row->time_slot; ?></td>
                    <td>
                        <?php 
                        if ($row->checkupId == 0 ){
                            echo 'None'; 
                        } else {
                            echo $row->checkupId; 
                        }
                    
                    ?>
                    </td>
                    <td><?php echo $row->reason; ?></td>
                    <td><?php echo $row->status; ?></td>
                    <td><?php echo $row->remark; ?></td>
                    <td>
                    <?php
                    if ($row->status == 'Pending' ||$row->status == 'Approved') {
                        
                        /*echo '<a href="' . base_url('AppointmentListUser/cancelAppointment/' . $row->id) . '" onclick="confirmCancel(' . $row->id . ')">Cancel</a>';*/

                        echo '<form method="post" action="' . base_url('AppointmentListUser/cancelAppointment/' . $row->id) . '" onsubmit="return confirmCancel(' . $row->id . ')">
                              <button type="submit" value="Cancel" class="btn btn-secondary"><h6 class ="text-white">Cancel</h6></i></button>
                              </form>';
                    } elseif ($row->status == 'Completed' || $row->status == 'Cancelled' || $row->status == 'Declined') {
                        echo '<form method="post" action="' . base_url('AppointmentListUser/deleteAppointment/' . $row->id) . '" onsubmit="return confirmDelete(' . $row->id . ')">
                      <button type="submit" value="Delete" class="m-2 btn btn-danger"><i class="bx bxs-trash"></i></button>
                      </form>';
                    } else {
                        echo 'No Action';
                    }
                    ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="8">You have no appointments</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    </table>
  </div>
</section>


<section class="timetable">
  <div class="d-flex justify-content-center"><h2>All Checkups</h2></div>
  <div class="container d-flex justify-content-center">
    <table class="styled-table">
      <thead>
      <tr>
        <th> ID </th>
        <th> Date & Time </th>
        <th> Symptoms </th>
        <th> Result </th>
        <th> Action </th>

      </tr>
    </thead>

      
    <tbody>
        <?php
        if (!empty($checkups)) {
            foreach ($checkups as $row) {
                ?>
                <tr>
                <td><?php echo $row->id?></td>  
                <td><?php echo $row->datetime;?></td>  
                <td><?php echo $row->symptoms;?></td>  
                <td><?php echo $row->result;?></td>  
                <td>
                <?php
                echo '<form method="post" action="' . base_url('CheckupHistory/deleteCheckup/' . $row->id) . '" onsubmit="return confirmDelete(' . $row->id . ')">
                      <button type="submit" value="Delete" class="btn btn-danger btn-block"><i class="bx bxs-trash"></i></button>
                      </form>';
                ?>
                </td> 
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5">You have no checkups</td>
            </tr>
            <?php
        }
        ?> 
      </tbody>
    </table>
  </div>
</section>

<!-- Include jQuery and Bootstrap JS if not already included -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        $("#appointmentSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


<style>
table {
    border: 1px solid black;
    width: fit-content;
}

/*th,
td {
    border: 1px solid black;
}*/


.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #284B63;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #284B63;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

</style>