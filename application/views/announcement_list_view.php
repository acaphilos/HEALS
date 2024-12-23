<section class="hero-section hero-title set-bg" data-setbg="<?=base_url()?>public/img/bg/Circles-bg.svg">
<div class="container h-100">
  <div class="hero-content text-white">
    <div class="row">
      <div class="title">
        <h2>Announcement List</h2>
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
  <div class="container d-flex justify-content-center">
    <table class="styled-table">
      <thead>
      <tr>
        <th> ID </th>
        <th> Title </th>
        <th> Content </th>
        <th> Date </th>
        <th> Admin ID </th>
        <th> Action </th>

      </tr>
    </thead>

      
    <tbody>
        <?php
        if (!empty($announcements)) {
            foreach ($announcements as $row) {
                ?>
                <tr>
                <td><?php echo $row->announcementId?></td>  
                <td><?php echo $row->announcementTitle;?></td>  
                <td><?php echo $row->announcementContent;?></td>  
                <td><?php echo $row->date;?></td>  
                <td><?php echo $row->aId;?></td>  
                <td>
                <?php
                echo '<form method="post" action="' . base_url('AnnouncementList/deleteAnnouncement/' . $row->announcementId) . '" onsubmit="return confirmDelete(' . $row->announcementId . ')">
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
                <td colspan="6">You have no announcements</td>
            </tr>
            <?php
        }
        ?> 
      </tbody>
    </table>
  </div>
</section>

<script>
    function confirmDelete(announcementId) {
        confirm('Are you sure you want to delete this announcement?')
    }
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
  margin-top: 120px;
  line-height:1;
}

.timetable {
    padding-left: 30px;
}

h2 {
    padding-top: 20px;
    padding-bottom: 20px;
}

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
    background-color: #341A9E;
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