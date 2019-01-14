<?php
require 'script.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

</head>

<body>
<div id="wrap">
    <div class="container">
        <div class="row">

            <form class="form-horizontal" action="script.php" method="post" name="upload_excel" enctype="multipart/form-data">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Import</legend>

                    <!-- File Button -->
                    <div class="form-group">
                        <label class="control-label" for="filebutton">Select File</label>

                            <input type="file" name="file" id="file" class="input-large">

                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="update" value="update" checked>
                        <label class="form-check-label" for="update">
                            Update Data
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="new" value="new">
                        <label class="form-check-label" for="new">
                            Add new data
                        </label>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                    </div>

                </fieldset>
            </form>

        </div>
        <?php
        get_all_records();
        ?>
    </div>
</div>
</body>

</html>