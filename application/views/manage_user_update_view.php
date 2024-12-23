<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg/Circles-bg.svg" style="height:30vh;">
<div class="container h-100">
  <div class="hero-content text-white">
    <div class="row">
      <div class="title">
        <h2>Manage All User</h2>
      </div>
    </div>
  </div>
</div>
</section>

<section class="timetable">
    
    <p><?php echo $this->session->flashdata('status'); ?></p>
        <?php $string = validation_errors(); if(!empty($string)): ?>
        <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
        <?php endif; ?>
  
  <div class="container d-flex justify-content-center">
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
                    <!-- <form  class="form px-4" style="width: fit-content;"> -->
                    <?php
                    echo '<form method="post" action="' . base_url('ManageAllUser/updateUserProfile/' . $row->uId) . '" onsubmit="return confirmUpdate(' . $row->uId . ')" class="form px-4">';
                    ?>
                    <td><input type="text" id="userId" name="userId" class="form-control" placeholder="Enter Phone Number" value="<?php echo $row->uId?>" readonly></td>
                    <td><input type="text" id="userFname" name="userFname" class="form-control" placeholder="Enter Full Name" value="<?php echo $row->userFname?>"></td>
                    <td><input type="date" id="userDate" name="userDate" class="form-control" placeholder="Birthday" value="<?php echo $row->userDate?>"></td>
                    <td><input type="text" id="userNric" name="userNric" class="form-control" placeholder="Enter NRIC Number" value="<?php echo $row->userNric?>"></td>
                    <td><input type="text" id="userPhone" name="userPhone" class="form-control" placeholder="Enter Phone Number" value="<?php echo $row->userPhone?>"></td>
                    <td><input type="Email" id="userEmail" name="userEmail" class="form-control" placeholder="Enter Email" value="<?php echo $row->userEmail?>"></td>
                    
                    <td class="d-flex">

                    <?php

                    echo '<button type="submit" value="Update" class="m-2 btn btn-secondary"><h6 class ="text-white">Update</h6></i></button>';
                      ?>
                    </form>
                    <?php

                    echo '<form method="post" action="' . base_url('ManageAllUser/viewUser/' . $row->uId) . '" onsubmit="return confirmUpdate(' . $row->uId . ')">
                          <button type="submit" value="View" class="m-2 btn btn-secondary"><h6 class ="text-white">View</h6></i></button>
                          </form>';

                    echo '<form method="post" action="' . base_url('ManageAllUser/deleteUserData/' . $row->uId) . '" onsubmit="return confirmDelete(' . $row->uId . ')">
                  <button type="submit" value="Delete" class="m-2 btn btn-danger"><i class="bx bxs-trash"></i></button>
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

<script>

    function confirmDelete(appointmentId) {
        confirm('Are you sure you want to delete this user?')
    }

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