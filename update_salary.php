<?php
require_once("db.php");

if (isset($_POST["Submit"])) {
    if (!empty($_POST["emp_no"]) && !empty($_POST["salary"])) {
        $emp_no = $_POST["emp_no"];
        $salary = $_POST["salary"];

        global $ConnectingDB;

        $stmt = $ConnectingDB->query("SELECT emp_no
        FROM SALARIES
        WHERE emp_no = $emp_no");
        $stmt->closeCursor();

        if ($stmt->rowCount() == 0) {
            echo '<script>alert("Employee does not exist!")</script>';
        } else {
            $today = date('Y-m-d');
            // $standard_date = date('9999-01-01');

            $sql = "UPDATE SALARIES
            SET to_date = $today;
            WHERE emp_no = $emp_no AND to_date = '9999-01-01'";
            $update_stmt = $ConnectingDB->prepare($sql);
            $Execute = $update_stmt->execute();
            $update_stmt->closeCursor();

            $sql2 = "INSERT INTO SALARIES (emp_no, salary, from_date, to_date)
            VALUES ('$emp_no', '$salary', '$today', '9999-01-01')";
            $insert_stmt = $ConnectingDB->prepare($sql2);
            $Execute2 = $insert_stmt->execute();
            $insert_stmt->closeCursor();

            echo '<script>alert("Salary updated!")</script>';
        }

        // $Execute = $stmt->execute();
        // if($Execute){
        //     echo $query;

        // }
    } else {
        echo '<script>alert("All fields are required!")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update the salary of an employee</title>
    <link rel="stylesheet" href="include/style.css">
</head>

<body>
    <div class="">
        <form class="" action="update_salary.php" method="post">
            <fieldset>
                <span class="fieldinfo">emp_no</span>
                <br>
                <input type="number" name="emp_no" value="">
                <br>
                <span class="fieldinfo">salary</span>
                <br>
                <input type="number" name="salary" value="">
                <br>

                <input type="submit" name="Submit" value="submit it">

            </fieldset>




        </form>

    </div>

</body>

</html>