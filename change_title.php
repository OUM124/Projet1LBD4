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
            // Changing the to_date
            $sql = "UPDATE TITLES set to_date='$newDate' WHERE emp_no='$number'";
            global $ConnectingDB;
            $stmt = $ConnectingDB ->prepare($sql);
            $Execute = $stmt->execute();
            //Insert
            $todate = date('9999-01-01');
            $sql1 = "INSERT INTO  TITLES (emp_no,title,from_date,to_date)
            VALUES('$number','$new','$newDate','$todate')";
            global $ConnectingDB;
            $stmt1 = $ConnectingDB ->prepare($sql1);
            $Execute1 = $stmt1->execute();
            if($Execute1 && $Execute ){
                echo '<script>alert("Title updated!")</script>';
            } 
        } 
        else{
            echo '<script>alert("This Employee is not Here")</script>';
        }
        
    }
    else{
            echo '<script>alert("ALL the fields are obligatory")</script>';
            

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
    <style>
        body{
            background-image:url(CH.png) ;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            
        }
        form{
            background-color: transparent;
            position: absolute;
            top: 200px;
            left: 10px;
            width: 400px;
            border: 1px solid transparent;
        }
        input{
            background-color: transparent;
            width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
            height: 20px;
            color: azure;
        }
        .fieldinfo{
            color: rgb(251, 174, 44);
            font-family: Bitter, Georgia, 'Times New Roman', Times, serif;
            font-size: 1em;
            margin-top: 10px;
        }
        input[type="submit"]{
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
            float: left;}
            h1{
                color: purple;
                font-weight: bold;
            }

    </style>
</head>
<body>
    <div class="">
        <h1>
            Chnage the title of an Employee
        </h1>
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



