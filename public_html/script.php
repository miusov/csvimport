<?php

$table_name = 'employeeinfo';

function getdb(){
    $servername = "localhost";
    $username = 'root';
    $password = '123456';
    $db = 'importcsv';

    try {

        $conn = mysqli_connect($servername, $username, $password, $db);
    }
    catch(exception $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

$con = getdb();
if (isset($_POST["Import"])) {

    $filename = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");

        if ($_POST['status'] == 'new'){
            $Sql = "TRUNCATE TABLE `$table_name`";
            $result = mysqli_query($con, $Sql);
        }
        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE) {
            if ($getData[0] == 'ID') continue;

            $Sql = "SELECT * FROM `$table_name`";
            $result = mysqli_query($con, $Sql);


            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $sql = "INSERT into `$table_name` (
                                                      emp_id,
                                                      firstname,
                                                      lastname,
                                                      email,
                                                      reg_date
                                                      ) values (
                                                      '" . $getData[0] . "',
                                                      '" . $getData[1] . "',
                                                      '" . $getData[2] . "',
                                                      '" . $getData[3] . "',
                                                      '" . $getData[4] . "'
                                                      )";
                    $result = mysqli_query($con, $sql);
                    if (!isset($result)) {
                        echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						  </script>";
                    } else {
                        echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
                    }
                }
            }else{
                $sql = "INSERT into `$table_name` (emp_id,firstname,lastname,email,reg_date) values ('" . $getData[0] . "','" . $getData[1] . "','" . $getData[2] . "','" . $getData[3] . "','" . $getData[4] . "')";
                $result = mysqli_query($con, $sql);
                if (!isset($result)) {
                    echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						  </script>";
                } else {
                    echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
                }
            }
        }
        fclose($file);
    }
}

function get_all_records()
{
    $con = getdb();
    $table_name = 'employeeinfo';
    $Sql = "SELECT * FROM `$table_name`";
    $result = mysqli_query($con, $Sql);


    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>EMP ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Registration Date</th>
                        </tr></thead><tbody>";


        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr><td>" . $row['emp_id'] . "</td>
                   <td>" . $row['firstname'] . "</td>
                   <td>" . $row['lastname'] . "</td>
                   <td>" . $row['email'] . "</td>
                   <td>" . $row['reg_date'] . "</td></tr>";
        }

        echo "</tbody></table></div>";

    } else {
        echo "you have no records";
    }
}


?>