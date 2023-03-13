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
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url(mm.avif);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        form {
            background-color: transparent;
            position: absolute;
            top: 100px;
            left: 350px;
            width: 400px;
            border: 1px solid transparent;
        }

        input {
            background-color: transparent;
            width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
            height: 20px;
            color: azure;
        }

        .fieldinfo {
            color: rgb(251, 174, 44);
            font-family: Bitter, Georgia, 'Times New Roman', Times, serif;
            font-size: 1em;
            margin-top: 10px;
        }

        input[type="submit"] {
            color: white;
            font-size: 1.0em;
            font-family: Bitter, Georgia, 'Times New Roman', Times, serif;
            width: 200px;
            height: 40px;
            background-color: #5d05805d;
            border: 5px solid;
            border-bottom-left-radius: 35px;
            border-bottom-right-radius: 35px;
            border-top-right-radius: 35px;
            border-top-left-radius: 35px;
            border-color: rgb(221, 216, 212);
            font-weight: bold;
            <<<<<<< HEAD float: left;
        }

        h1 {
            color: white;
            font-weight: bold;
        }
    </style>
    =======
    float: left;}
    h1{
    color: white;
    font-weight: bold;
    text-align: center;
    }
    </style>
    >>>>>>> 2d89dc77beba155cb26f410485a31f964f61c484
</head>

<body>
    <div class="">
        <h1>Update salary for an employee</h1>

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