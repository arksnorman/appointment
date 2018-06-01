<?php

require_once 'functions.php';

require_once 'header.php';

?>

<?php
$appointments = getUserAppointments($_SESSION['userId']);
if (!empty($appointments))
{
    foreach ($appointments as $appointment)
    {
?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><?php echo $appointment['illness']; ?></h5>
                <p class="card-text"><?php echo $appointment['description']; ?></p>
                <a href="#" class="btn btn-danger">Cancel</a>
                <a href="#" class="btn btn-info">Update</a>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php

    }
}
require_once 'footer.php';

?>
