<?php
require_once("db.php");
if(isset($_POST["Submit"]))
{
    if(isset($_POST["emp_no"]) && isset($_POST["departement_no"]))
    {
        $new = $_POST['departement_no'];
        $newDate = date('Y-m-d');
        $number = $_POST['emp_no'];
        // To check if the employee is there or not by counting the number of rows obtained , if there is no employee whit the given number the the set will be empty , then we cannot update it
        $lol = "SELECT COUNT(*) FROM DEPT_EMP WHERE emp_no = $number";
        global $ConnectingDB;
        $st = $ConnectingDB->prepare($lol);
        $Executee = $st->execute();
        $count = $st->fetchColumn();
        // Make sure that the departement exist 
        $dept = "SELECT COUNT(*) FROM DEPT_EMP WHERE dept_no = '$new'";
        global $ConnectingDB;
        $req = $ConnectingDB->prepare($dept);
        $Exe = $req->execute();
        $countDept = $req->fetchColumn();
        //
        if( $Executee && $count!=0)
        {
        if($Exe && $countDept!=0 ){
            // Changing the departement_no
            $sql = "UPDATE DEPT_EMP set dept_no='$new' WHERE emp_no=$number";
            global $ConnectingDB;
            $stmt = $ConnectingDB ->prepare($sql);
            $Execute = $stmt->execute();
            // Update the date
            $sql1 = "UPDATE DEPT_EMP set from_date='$newDate' WHERE emp_no=$number";
            global $ConnectingDB;
            $stm = $ConnectingDB ->prepare($sql1);
            $Execut = $stm->execute();
            if($Execute && $Execut ){
                echo "Departement Changed";
            } 
        } 
        else{
            echo "This departement does not exist!";
           
        }
    }
        else{
            echo "This Employee is not Here";
            }
        
    }
    else{
        echo "ALL the fields are obligatory";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="">
        <form class="" action="affectation.php" method="post">
            <fieldset>
                <span class="fieldinfo">emp_no</span>
                <br>
                <input type="number" name="emp_no" value="" required>
                <br>
                <span class="fieldinfo">New Departement</span>
                <br><br>
                <input type="text" name="departement_no" value="" required> 
                <br>
                <input type="submit" name="Submit" value="submit it">
            
            </fieldset>
</form>

    </div>
    
</body>
</html>



