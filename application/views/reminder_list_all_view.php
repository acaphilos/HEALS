<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg/Circles-bg.svg" style="height:30vh;">
<div class="container h-100">
  <div class="hero-content text-white">
    <div class="row">
      <div class="title">
        <h2>All Reminder List</h2>
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
  <div class="d-flex justify-content-center"><h2>All Reminders</h2></div>
  <div class="container d-flex justify-content-center">
    <table class="styled-table">
      <thead>
      <tr>
        <th> ID </th>
        <th> Meds Name </th>
        <th> Dosage </th>
        <th> Frequency </th>
        <th> Taken </th>
        <th> Before/After Meal </th>
        <th> Meds for </th>
        <th> Remark </th>
        <th> Date </th>
        <th> User ID </th>
        <th> Action </th>
      </tr>
    </thead>

    <tbody>
      <?php
        if (!empty($all_reminders)) {
            foreach ($all_reminders as $row) {
                ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->dosage; ?></td>
                    <td><?php echo $row->frequency; ?></td>
                    <td><?php echo $row->taken; ?></td>
                    <td><?php echo $row->meal; ?></td>
                    <td><?php echo $row->disease; ?></td>
                    <td><?php echo $row->remark; ?></td>
                    </td>
                    <td><?php echo $row->date; ?></td>
                    <td><?php echo $row->uId; ?></td>
                    
                    </td>
                    <td class="d-flex">

                    <?php
                        
                    echo '<form method="post" action="' . base_url('EmailReminder/viewUpdateReminder/' . $row->id) . '" onsubmit="return confirmEdit(' . $row->id . ')">
                              <button type="submit" value="Edit" class="m-2 btn btn-secondary"><h6 class ="text-white">Edit</h6></i></button>
                              </form>';
                        
                    echo '<form method="post" action="' . base_url('EmailReminderList/deleteReminder/' . $row->id) . '" onsubmit="return confirmDelete(' . $row->id . ')">
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
                <td colspan="8">You have no Reminders</td>
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
        const remarkSpans = document.querySelectorAll('.doctor-remark');

        editButtons.forEach((editButton) => {
            editButton.addEventListener('click', function () {
                const appointmentId = this.getAttribute('data-id');
                const inputField = document.querySelector(`.doctor-remark-input[data-id="${appointmentId}"]`);
                const spanField = document.querySelector(`.doctor-remark[data-id="${appointmentId}"]`);
                const saveButton = document.querySelector(`.save-remark[data-id="${appointmentId}"]`);
                const cancelButton = document.querySelector(`.cancel-remark[data-id="${appointmentId}"]`);

                inputField.style.display = 'inline-block';
                spanField.style.display = 'none';
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
                const spanField = document.querySelector(`.doctor-remark[data-id="${appointmentId}"]`);
                const editButton = document.querySelector(`.edit-remark[data-id="${appointmentId}"]`);
                const saveButton = document.querySelector(`.save-remark[data-id="${appointmentId}"]`);
                const cancelButton = document.querySelector(`.cancel-remark[data-id="${appointmentId}"]`);

                inputField.style.display = 'none';
                spanField.style.display = 'inline-block';
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