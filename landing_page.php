<?php 
require_once("db.php");
session_start();
if(isset($_POST["Submit"])){
    if(!empty($_POST["emp_no"]) && !empty($_POST["password"]) ){
        $emp_no = $_POST["emp_no"];
        $password = $_POST["password"];
        global $ConnectingDB;
        $sql = "SELECT COUNT(*) FROM DEPT_MANAGER WHERE emp_no = '$emp_no' AND dept_no ='$password' ";
        $stmt = $ConnectingDB ->prepare($sql);
        $EXE = $stmt->execute();
        $count = $stmt->fetchColumn();
        if ($count!=0 && $EXE) {
            $_SESSION['username'] = $emp_no;
            header('Location: simple.php');
            exit();



        }
        else{
            echo '<div class="ee">*Please enter a valid info</div>';
            

        }


    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    
    <style>
        body{
            background-image: url('landing.webp');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .ee{
            color: red;
            margin-top: 500px;
            margin-left: 100px;
        }
        form{
            width: 400px;
            margin-left: 100px;
            margin-top: 200px;
            background-color:transparent;
            display: block;
        }
        .form-floating{
            display: flex;
            flex-direction: column;
        }
        .form-floating input{
            background-color: transparent;
            width: 90%;
            padding: 15px;
            border: 2px solid black;
            border-radius: 5px;
        }
        .form-floating label{
            color: white;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 5px;
        }
        input[type="submit"]{
            margin-top: 15px;
            border: 2px solid transparent;
            border-radius: 20px;
            width:100%;
            background-image: linear-gradient(to top right,blue,black,aquamarine);
            padding: 6px;
            cursor: pointer;
        }
        h3{
            text-align: center;
            color: darkgrey;
            font-family: cursive;
            font-weight: bold;
            font-size: large;
        }
        input{
            color: white;
        }
        
    </style>
</head>
<body>
    
<form class="" action="landing_page.php" method="post">
    <h3>LOGIN</h3>
    <div class="form-floating">
    <label for="floatingInput">Employee number</label>
        <input type="number" class="form-control" id="floatingInput" placeholder="Please Enter Your number...." name="emp_no" >
        
    </div>
    <div class="form-floating">
    <label for="floatingPassword">Password</label>
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password..." name="password" >
        
    </div>
    <input type="submit" name="Submit" value="Log In" >
    </form>




</body>
</html>