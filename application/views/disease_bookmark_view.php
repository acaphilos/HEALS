<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg/Circles-bg.svg" style="height:30vh;">
<div class="container h-100">
  <div class="hero-content text-white">
    <div class="row">
      <div class="title">
        <h2>All Bookmarks</h2>
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
        <th> ID </th>
        <th> Date and Time </th>
        <th> Search History </th>
        <th> Action </th>
      </tr>
    </thead>

    <tbody>
      <?php
        if (!empty($bookmarks)) {
            foreach ($bookmarks as $row) {
                ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->datetime; ?></td>
                    <td><?php echo $row->content; ?></td>

                    <td>
                    <?php
                    echo '<form method="post" action="' . base_url('DiseaseBookmark/deleteBookmark/' . $row->id) . '" onsubmit="return confirmDelete(' . $row->id . ')">
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
                <td colspan="4">You have no bookmark</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    </table>
  </div>
</section>

<script>
    function confirmDelete(bookmarkId) {
        confirm('Are you sure you want to delete this bookmark?')
    }
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

