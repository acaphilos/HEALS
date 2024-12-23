<section class="hero-section hero-title set-bg" data-setbg="<?= base_url() ?>public/img/bg/Circles-bg.svg">
    <div class="container h-100">
        <div class="hero-content text-white">
            <div class="row">
                <div class="title">
                    <h2>Search Disease</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row" style="height: fit-content;">
        <div class="col m-4" style="background: #EEECF5;">
            <p><?php echo $this->session->flashdata('status'); ?></p>
            <?php $string = validation_errors(); if(!empty($string)): ?>
            <?php echo'<div class="alert" style="width:100%">' .validation_errors(). '</div>' ?>
            <?php endif; ?>
            <div class="d-flex mb-5 justify-content-center">
            <form method="post" action="<?=base_url()?>DiseaseSearch/addBookmark" style="width:100%">
                
                <input type="text" id="condition" name="search" class="form-control" style="width:100%" placeholder="Enter Disease" required>
                <button type="button" class="mt-3 btn btn-info" id="generateSummary"><i class='bx bx-search nav_icon'> Search</i></button>

                <button type="submit" class="btn btn-primary btn-block my-3" style="width:fit-content;"><i class="bx bx-bookmark m-1"></i>Add to Bookmark</button>
                <a href="<?=base_url()?>DiseaseBookmark">
                <button type="button" class="btn btn-primary"><i class='bx bx-history nav_icon'></i> View All Bookmark</button>
                </a>
            </form>
            </div>
            <!-- <div class="text-center" style="font-size: 50px;">Summary:</div> -->
            <div class="p-5 text-justify" id="summary" style="font-size: 20px;background: #EEECF5;"></div>
            <div class="p-2 d-flex justify-content-center align-items-center text-justify" id="summaryBg" style="font-size: 20px; background: #EEEFC5;">
                <a href="https://health.gov/myhealthfinder" title="MyHealthfinder">
                <h6>Powered by </h6>
                <img style="width: 200px;" src="https://health.gov/themes/custom/healthfinder/images/MyHF.svg" alt="MyHealthfinder"/>
                </a>
            </div>
        </div>
    </div>
</div>

<script>

function getHealthGovSummary(diseaseQuery, callback) {
    const apiUrl = `https://health.gov/myhealthfinder/api/v3/topicsearch.html?lang=en&keyword=${encodeURIComponent(diseaseQuery)}`;

    // Use jQuery for AJAX request
    $.ajax({
        url: apiUrl,
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            callback(data);
        },
        error: function () {
            callback('Summary not found.');
        }
    });
}

document.getElementById('generateSummary').addEventListener('click', () => {
    const diseaseQuery = document.getElementById('condition').value;
    const summaryDiv = document.getElementById('summary');

    if (diseaseQuery) {
        getHealthGovSummary(diseaseQuery, (summary) => {
            summaryDiv.innerHTML = summary;
        });
    } else {
        summaryDiv.innerHTML = 'Please enter a valid disease query.';
    }
});

</script>


