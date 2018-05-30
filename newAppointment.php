<?php

require_once 'header.php';
require_once 'functions.php';

if (!empty($_POST))
{
    $illness = $_POST['illness'] ?? '';
    $description = $_POST['description'] ?? '';

    if (empty($illness) || empty($description))
        $error = 'All fields are required';
    if (empty($error) && createAppointment($illness, $description))
        $success = 'Appointment successfully created';
}

?>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="card">
  			<div class="card-header text-center">
				<h4>Create a new appointment</h4>
			</div>
			<div class="card-body">
				<form method="post" action="newAppointment.php">
                    <?php
                        if (isset($success))
                            echo '<div class="alert alert-success">' . $success . '</div>';
                        if (isset($error))
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                    ?>
				  <div class="form-group">
				    <label for="illness">Illness</label>
				    <input type="text" class="form-control" id="illness" name="illness">
				  </div>
				  <div class="form-group">
				    <label for="description">Description</label>
				    <textarea class="form-control" id="description" name="description"></textarea>
				  </div>
				  <button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>

<?php

require_once 'footer.php';

?>