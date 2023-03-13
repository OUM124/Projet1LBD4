<?php
require_once("db.php");

if (isset($_POST["Submit-update"])) {
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
            $standard_date = date('9999-01-01');

            global $ConnectingDB;
            $q = "SELECT salary
            FROM SALARIES
            WHERE emp_no = $emp_no AND to_date ='$standard_date'";
            $query = $ConnectingDB->prepare($q);
            $query->execute();
            $result = $query->fetchAll();

            if ($salary > intval($result[0]["salary"])) {
                $sql = "UPDATE SALARIES
                SET to_date = '$today'
                WHERE emp_no = $emp_no AND salary = " . intval($result[0]["salary"]) . " AND to_date = '$standard_date'";
                $update_stmt = $ConnectingDB->prepare($sql);
                $update_stmt->execute();
                $update_stmt->closeCursor();

                $sql2 = "INSERT INTO SALARIES (emp_no, salary, from_date, to_date)
                VALUES ('$emp_no', '$salary', '$today', '$standard_date')";
                $insert_stmt = $ConnectingDB->prepare($sql2);
                $insert_stmt->execute();
                $insert_stmt->closeCursor();

                echo '<script>alert("Salary updated!")</script>';
            } else {
                echo '<script>alert("The new salary should be greater than the previous salary!")</script>';
            }
        }
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

            <fieldset id="search-salary">
                <span class="fieldinfo">emp_no</span>
                <br>
                <input type="number" name="emp_no_search" value="">
                <br>

                <input type="submit" name="Submit-search" value="Search Salary">
                <?php
                require_once("db.php");

                if (isset($_POST["Submit-search"])) {
                    if (!empty($_POST["emp_no_search"])) {
                        $emp_no_search = $_POST["emp_no_search"];

                        global $ConnectingDB;

                        $stmt = $ConnectingDB->query("SELECT emp_no
                            FROM SALARIES
                            WHERE emp_no = $emp_no_search");
                        $stmt->closeCursor();

                        if ($stmt->rowCount() == 0) {
                            echo '<script>alert("Employee does not exist!")</script>';
                        } else {
                            echo "<br>Employee Number: " . $emp_no_search . "<br>Salary: ";
                            $standard_date = date('9999-01-01');

                            $q = "SELECT salary
                                FROM SALARIES
                                WHERE emp_no = $emp_no_search AND to_date ='$standard_date'";
                            $query = $ConnectingDB->prepare($q);
                            $query->execute();
                            $result = $query->fetchAll();
                            echo intval($result[0]["salary"]);

                        }
                    } else {
                        echo '<script>alert("Please enter an employee!")</script>';
                    }
                }
                ?>
            </fieldset>

            <fieldset id="update-salary">
                <span class="fieldinfo">emp_no</span>
                <br>
                <input type="number" name="emp_no" value="">
                <br>
                <span class="fieldinfo">salary</span>
                <br>
                <input type="number" name="salary" value="">
                <br>

                <input type="submit" name="Submit-update" value="Update">
            </fieldset>

        </form>

    </div>

</body>

</html>