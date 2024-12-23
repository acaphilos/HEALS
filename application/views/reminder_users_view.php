<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg/Circles-bg.svg" style="height:30vh;">
<div class="container h-100">
  <div class="hero-content text-white">
    <div class="row">
      <div class="title">
        <h2>Medication Pickup Reminder</h2>
      </div>
    </div>
  </div>
</div>
</section>

<div class="container mt-3">
    <input type="text" id="appointmentSearch" class="form-control" placeholder="Search">
</div>

<section class="timetable">
    
    <p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>
  
  <div class="container d-flex flex-column justify-content-center align-items-center">
    <h2 class="mb-4">All Pickup Reminder</h2>
    <a href="<?=base_url()?>EmailReminderList">
    <button type="button" class="btn btn-info"><i class='bx bx-history nav_icon'></i> View All Pickup Reminder</button>
    </a>
  </div>

  <div class="container d-flex flex-column justify-content-center align-items-center">
    <h2 class="mt-5">Add New Medication Pickup Reminder</h2>
    <table class="styled-table">
      <thead>
      <tr>
        <th> uId </th>
        <th> userFname </th>
        <th> userDate </th>
        <th> userNric </th>
        <th> userPhone </th>
        <th> userEmail </th>
        <th> Action </th>
      </tr>
    </thead>

    <tbody>
      <?php
        if (!empty($all_users)) {
            foreach ($all_users as $row) {
                ?>
                <tr>
                    <td><?php echo $row->uId; ?></td>
                    <td><?php echo $row->userFname; ?></td>
                    <td><?php echo $row->userDate; ?></td>
                    <td><?php echo $row->userNric; ?></td>
                    <td><?php echo $row->userPhone; ?></td>
                    <td><?php echo $row->userEmail; ?></td>
                    
                    <td class="d-flex">

                    <?php

                    echo '<form method="post" action="' . base_url('EmailReminder/viewAddReminder/' . $row->uId) . '" onsubmit="return confirmUpdate(' . $row->uId . ')">
                          <button type="submit" value="Update" class="m-2 btn btn-success"><h6 class ="text-white">Add</h6></i></button>
                          </form>';

                    echo '<form method="post" action="' . base_url('EmailReminderList/viewUserReminderAdmin/' . $row->uId) . '" onsubmit="return confirmUpdate(' . $row->uId . ')">
                          <button type="submit" value="View" class="m-2 btn btn-secondary"><h6 class ="text-white">View</h6></i></button>
                          </form>';


                    ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">No user</td>
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