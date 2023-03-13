<?php
require_once("db.php");
if(isset($_POST["Submit"]))
{
    if(isset($_POST["emp_no"]) && isset($_POST["title"]))
    {
        $new = $_POST['title'];
        $newDate = date('Y-m-d');
        $number = $_POST['emp_no'];
        // To check if the employee is there or not by counting the number of rows obtained , if there is no employee whit the given number the the set will be empty , then we cannot update it
        $lol = "SELECT COUNT(*) FROM TITLES WHERE emp_no = $number";
        global $ConnectingDB;
        $st = $ConnectingDB->prepare($lol);
        $Executee = $st->execute();
        $count = $st->fetchColumn();
        if($Executee && $count!=0){
            // Changing the title
            $sql = "UPDATE TITLES set title='$new' WHERE emp_no=$number";
            global $ConnectingDB;
            $stmt = $ConnectingDB ->prepare($sql);
            $Execute = $stmt->execute();
            // Update the date
            $sql1 = "UPDATE TITLES set from_date='$newDate' WHERE emp_no=$number";
            global $ConnectingDB;
            $stm = $ConnectingDB ->prepare($sql1);
            $Execut = $stm->execute();
            if($Execute && $Execute ){
                echo "Title Changed";
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
    <title>Change title </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="">
        <form class="" action="change_title.php" method="post">
            <fieldset>
                <span class="fieldinfo">emp_no</span>
                <br>
                <input type="number" name="emp_no" value="" required>
                <br>
                <span class="fieldinfo">New Title</span>
                <br><br>
                <input type="text" name="title" value="" required> 
                <br>
                <input type="submit" name="Submit" value="submit it">
            
            </fieldset>
</form>

    </div>
    
</body>
</html>



