<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg/Circles-bg.svg" style="height:30vh;">
<div class="container h-100">
  <div class="hero-content text-white">
    <div class="row">
      <div class="title">
        <h2>All Apointment List</h2>
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


  <div class="container d-flex justify-content-center">
    <table class="styled-table">
      <thead>
      <tr>
        <th> ID </th>
        <th> Full Name </th>
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
        if (!empty($user_appointments)) {
            foreach ($user_appointments as $row) {
                ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><a  href="<?=base_url()?>RecordUserList/viewUserRecordsUser/<?php echo $row->uId; ?>" class="text-dark"><?php echo $row->userFname; ?></a></td>
                    <td><?php echo $row->date; ?></td>
                    <td><?php echo $row->time_slot; ?></td>
                    <td>
                        <?php 
                        if ($row->checkupId == 0 ){
                            echo 'None'; 
                        } else {
                            echo '<a href="' . base_url('CheckupHistory') . '" class="text-dark">' . $row->checkupId . '</a>';
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
                              <button type="submit" value="Cancel" class="btn btn-secondary"><h6 class ="text-white">Cancel Appointment</h6></i></button>
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
    width: 80%;
}

th,
td {
    border: 1px solid black;
}

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

