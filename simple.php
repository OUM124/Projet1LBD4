<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>choose one of the 4</title>
    <style>
        
        body{
            background-image: linear-gradient(to top,blue,black);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        .title{
            color:white;
            font-weight: bold;
            font-size:x-large;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            width: 500px;
            font-family: Bitter;
            margin: 0 auto;
        }
        .form1{
            width: 1100px;
            margin-top: 215px;
        }

        
        input[type="submit"]{
            color: white;
            font-size: 1.0em;
            font-family: Bitter, Georgia, 'Times New Roman', Times, serif;
            width: 300px;
            height: 50px;
            background-color: #5d05805d;
            border: 5px solid;
            border-bottom-left-radius: 35px;
            border-bottom-right-radius: 35px;
            border-top-right-radius: 35px;
            border-top-left-radius: 35px;
            border-color: rgb(221, 216, 212);
            font-weight: bold;
            float: left;
            cursor: pointer;

        }
        
        small{
            color: red;

        }
    </style>
</head>
<?php
    require_once('db.php');
    session_start();
    $num = $_SESSION['username'];
    global $ConnectingDB;
    $sql = "SELECT first_name,last_name FROM employees WHERE emp_no = '$num'  ";
    $stmt = $ConnectingDB ->prepare($sql);
    $EXE = $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($EXE)
    {
        echo '<div class="title"><small>Welcome</small> '.$results[0]['first_name'].'  '.$results[0]['last_name'].'</div>';
    }
    ?>
<body>
    <div class="all">
    <div class="form1">
    <form class="" action="insert_into_db.php" method="post">
    <input type="submit" name="Submit0" value="insert a new employee" id="salary">
    <br>
    </div>

    </form>
    <div class="form2">
    <form class="" action="update_salary.php" method="post">
    <input type="submit" name="Submit1" value="update the salary of an employee">
    <br>
    </div>
    </form>
    <div class="form3">
    <form class="" action="change_title.php" method="post">
    <input type="submit" name="Submit2" value="change the title of an employee">
    <br></div>

    </form>
    <div class="form4">
    <form class="" action="affectation.php" method="post">
    <input type="submit" name="Submit3" value="affect an employee to a department">
    <br>
    </div>
    </form></div>
    
    

    

    
</body>
</html>