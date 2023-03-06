<?php
require_once("db.php");
if(isset($_POST["Submit"]))
{
    if(isset($_POST["emp_no"]) && isset($_POST["title"]))
    {
        $new = $_POST['title'];
        $number = $_POST['emp_no'];
        /*$in = "SELECT * FROM TITLES WHERE emp_no=$number";
        $stm = $ConnectingDB ->prepare($in);
        $Executee = $stm->execute();*/
        $lol = "SELECT COUNT(*) FROM TITLES WHERE emp_no = $number";
        global $ConnectingDB;
        $st = $ConnectingDB->prepare($lol);
        $Executee = $st->execute();
        $count = $st->fetchColumn();
        if($Executee && $count!=0){
            echo "The Employee is there";
            $sql = "UPDATE TITLES set title='$new' WHERE emp_no=$number";
            global $ConnectingDB;
            $stmt = $ConnectingDB ->prepare($sql);
            $Execute = $stmt->execute();
            if($Execute ){
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
                <input type="number" name="emp_no" value="">
                <br>
                <span class="fieldinfo">New Title</span>
                <br>
                <input type="text" name="title" value="">
                <br>

                <input type="submit" name="Submit" value="submit it">
            
            </fieldset>
</form>

    </div>
    
</body>
</html>



