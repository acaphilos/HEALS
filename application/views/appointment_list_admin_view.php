<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg/Circles-bg.svg" style="height:30vh;">
<div class="container h-100">
  <div class="hero-content text-white">
    <div class="row">
      <div class="title">
        <h2>All Appointment List</h2>
      </div>
    </div>
  </div>
</div>
</section>

<div class="container mt-3">
    <input type="text" id="appointmentSearch" class="form-control" placeholder="Search for appointments...">
</div>

<section class="timetable">
    
    <p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>
  
  <div class="d-flex justify-content-center"><h2>Upcoming Appointments</h2></div>
  <div class="container d-flex justify-content-center">
    <table class="styled-table">
    <thead>
    <tr>
      <th>Id</th>
      <th>Full Name</th>
      <th>Session Date</th>
      <th>Session Time</th>
      <th>Session Title</th>
      <th>Status</th>
      <th>Remark</th>
      </tr>
      </thead>
      
      <tbody>
          <?php
                
          if (!empty($all_up_appointments)) {
              foreach ($all_up_appointments as $row) {
                  ?>
                  <tr>
                      <td><?php echo $row->id; ?></td>
                      <td><?php echo $row->userFname; ?></td>
                      <td><?php echo $row->date; ?></td>
                      <td><?php echo $row->time_slot; ?></td>
                      <td><?php echo $row->reason; ?></td>
                      <td><?php echo $row->status; ?></td>
                      <td><?php echo $row->remark; ?></td>
                  </tr>
                  <?php
                }
            } else {
              ?>
              <tr>
                <td colspan="7">No upcoming appointments</td>
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
        <th> Full Name </th>
        <th> Date </th>
        <th> Timeslot </th>
        <th> Reason </th>
        <th> Status </th>
        <th> Remark </th>
        <th> Action </th>
      </tr>
    </thead>

    <tbody>
      <?php
        if (!empty($all_appointments)) {
            foreach ($all_appointments as $row) {
                ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><a  href="<?=base_url()?>RecordUserList/viewUserRecords/<?php echo $row->uId; ?>" class="text-dark"><?php echo $row->userFname; ?></a></td>
                    <td><?php echo $row->date; ?></td>
                    <td><?php echo $row->time_slot; ?></td>
                    <td><?php echo $row->reason; ?></td>
                    <td><?php echo $row->status; ?></td>
                    <td><?php echo $row->remark; ?></td>
                    
                    <td class="d-flex">
                    
                    <?php
                    if ($row->status == 'Pending') {

                        echo '<form method="post" action="' . base_url('AppointmentListAdmin/approveAppointment/' . $row->id) . '" onsubmit="return confirmApprove(' . $row->id . ')">
                              <button type="submit" value="Approve" class="m-2 btn btn-success"><h6 class ="text-white">Approve</h6></i></button>
                              </form>';

                        echo '<form method="post" action="' . base_url('AppointmentListAdmin/declineAppointment/' . $row->id) . '" onsubmit="return confirmDecline(' . $row->id . ')">
                          <button type="submit" value="Decline" class="m-2 btn btn-danger"><h6 class ="text-white">Decline</h6></i></button>
                          </form>';

                    } elseif ($row->status == 'Approved' ) {
                        
                        echo '<form method="post" action="' . base_url('RecordUserList/addUserRecords/' . $row->id) . '" onsubmit="return confirmComplete(' . $row->id . ')">
                              <button type="submit" value="Completed" class="m-2 btn btn-success"><h6 class ="text-white">Completed</h6></i></button>
                              </form>';?>

                        <div class="flex-column">

                            <input type="text" class="form-control doctor-remark-input" data-id="<?php echo $row->id; ?>" style="display:none;" placeholder="Insert cancel Remark">
                                
                            <!-- Hidden form for updating doctor's remark -->
                            <div class="d-flex flex-row">

                            <form method="post" action="<?=base_url()?>AppointmentListAdmin/cancelAppointment/<?php echo $row->id; ?>">
                                <input type="hidden" name="doctor_remark" id="hidden-doctor-remark-<?php echo $row->id; ?>">
                              <button type="submit" value="Cancel" class="m-2 btn btn-info save-remark" data-id="<?php echo $row->id; ?>" style="display:none;"><h6 class ="text-white">Proceed</h6></i></button>
                              <button type="button" class="m-2 btn btn-secondary cancel-remark" data-id="<?php echo $row->id; ?>" style="display:none;">Back</button>
                            
                            </form>


                            <button class="m-2 btn btn-secondary edit-remark" data-id="<?php echo $row->id; ?>"><h6 class ="text-white">Cancel Appointment</h6></button>
                            </div>
                        </div><?php

                    } elseif ($row->status == 'Completed' || $row->status == 'Cancelled' || $row->status == 'Declined') {
                        echo '<form method="post" action="' . base_url('AppointmentListAdmin/deleteAppointment/' . $row->id) . '" onsubmit="return confirmDelete(' . $row->id . ')">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-remark');
        const saveButtons = document.querySelectorAll('.save-remark');
        const cancelButtons = document.querySelectorAll('.cancel-remark');
        const remarkInputs = document.querySelectorAll('.doctor-remark-input');


        editButtons.forEach((editButton) => {
            editButton.addEventListener('click', function () {
                const appointmentId = this.getAttribute('data-id');
                const inputField = document.querySelector(`.doctor-remark-input[data-id="${appointmentId}"]`);

                const saveButton = document.querySelector(`.save-remark[data-id="${appointmentId}"]`);
                const cancelButton = document.querySelector(`.cancel-remark[data-id="${appointmentId}"]`);

                inputField.style.display = 'inline-block';
                saveButton.style.display = 'inline-block';
                cancelButton.style.display = 'inline-block';
                this.style.display = 'none';
            });
        });

        saveButtons.forEach((saveButton) => {
            saveButton.addEventListener('click', function () {
                const appointmentId = this.getAttribute('data-id');
                const inputField = document.querySelector(`.doctor-remark-input[data-id="${appointmentId}"]`);

                // Update the hidden input field with the new value
                const hiddenInput = document.getElementById(`hidden-doctor-remark-${appointmentId}`);
                hiddenInput.value = inputField.value;

                // Submit the form
                document.getElementById(`form-${appointmentId}`).submit();
            });
        });

        cancelButtons.forEach((cancelButton) => {
            cancelButton.addEventListener('click', function () {
                const appointmentId = this.getAttribute('data-id');
                const inputField = document.querySelector(`.doctor-remark-input[data-id="${appointmentId}"]`);
                const editButton = document.querySelector(`.edit-remark[data-id="${appointmentId}"]`);
                const saveButton = document.querySelector(`.save-remark[data-id="${appointmentId}"]`);
                const cancelButton = document.querySelector(`.cancel-remark[data-id="${appointmentId}"]`);

                inputField.style.display = 'none';
                editButton.style.display = 'inline-block';
                saveButton.style.display = 'none';
                this.style.display = 'none';
            });
        });
        
    });

</script>
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