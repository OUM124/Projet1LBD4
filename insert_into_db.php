
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert data into database</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table, th, td {
            color: white;
            font-size: 17px;
            width:160px;
            padding: 12px 15px;
        }
        th {
            background-color: #009879;
            color: #ffffff;
            text-align: left;

        }
        tr{
            width:160px;
            background-color: lightgrey;
            color: black;
        }
        table{
            position: absolute;
            top: 50%;
            left: 4%;
            padding: 12px 15px;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            border-radius: 4px;


        }
        body{
            background-image:url(b.jpg) ;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        #date{
            width: 100%;
            height: 30px;
            border-radius: 10px;
        }
        #select{
            width: 100%;
            height: 30px;
            border-radius: 10px; 
        }
        .sub
        {
            margin-top: 20px;
            width: 200px;
            margin: 0 auto;
        }
        form{
            background-color: transparent;
            margin-left: 350px;
            padding: 20px;
            
        }
        h1{
            width: 300px;
            margin: 0 auto;
            color: deeppink;
        }

        input{
            background-color: transparent;
            color: white;
            
        }
    </style>
</head>
<body>
    <div class="">
        <h1>Insert An employee</h1>
        <form class="" action="insert_into_db.php" method="post">
            <fieldset>
                <span class="fieldinfo">emp_no</span>
                <br>
                <input type="number" name="emp_no" value="">
                <br>
                <span class="fieldinfo">birth_date</span>
                <br>
                <input type="date" name="birth_date" value="" id="date">
                <br>
                <span class="fieldinfo"> first_name</span>
                <br>
                <input type="text" name="first_name" value="">
                <br>
                <span class="fieldinfo"> last_name</span>
                <br>
                <input type="text" name="last_name" value="">
                <br>
                <span class="fieldinfo">  gender</span>
                <br>
                <input type="radio" name="gender" value="F">F
                <br>
                <input type="radio" name="gender" value="M">M
                <br>
                <span class="fieldinfo">  hire_date</span>
                <br>
                <input type="date" name="hire_date" value="" id="date">
                <br>
                <span class="fieldinfo">  salary</span>
                <br>
                <input type="number" name="salary" value="">
                <br>
                <span class="fieldinfo">  title</span>
                <br>
                <select name="title" id="select">
                    <option value="">Please select a title</option>
                    <option value="Staff">Staff</option>
                    <option value="Senior Engineer">Senior Engineer</option>
                    <option value="Engineer">Engineer</option>
                    <option value="Senior Staff">Senior Staff</option>
                    <option value="Assistant Engineer">Assistant Engineer</option>
                </select>              
                 <br>
                <span class="fieldinfo">  dept_name</span>
                <br>
                <select name="dept_name" id="select">
                    <option value="">Please Choose a departement</option>
                    <option value="Customer Service">Customer Service</option>
                    <option value="Development"> Development</option>
                    <option value="Finance">Finance</option>
                    <option value="Human Resources">Human Resources</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Production">Production</option>
                    <option value="Quality Management">Quality Management</option>
                    <option value="Research">Research</option>
                    <option value="Sales">Sales</option>

                </select>              
               
                 <br><br>

                <input type="submit" name="Submit" value="submit it" class="sub">
           
            </fieldset>
</form>

    </div>
   
</body>
</html>
<?php 
echo '<br>';

require_once("db.php");
if(isset($_POST["Submit"])){
    if(!empty($_POST["emp_no"]) && !empty($_POST["first_name"])  && !empty($_POST["birth_date"])&&!empty($_POST["last_name"])&& !empty($_POST["gender"])  && !empty($_POST["hire_date"]) && !empty($_POST["salary"]) &&!empty($_POST["title"]) && !empty($_POST["dept_name"])){
        $emp_no = $_POST["emp_no"];
        $first_name = $_POST["first_name"];
        $birth_date = $_POST["birth_date"];
        $last_name = $_POST["last_name"];
        $gender = $_POST["gender"];
        $hire_date = $_POST["hire_date"];
        $salary = $_POST["salary"];
        $title = $_POST["title"];
        $dept_name = $_POST["dept_name"];
        $date = date("Y-m-d");
        $date1 = date("9999-01-01");
        $assoc = array("Customer Service"=>"d009", "Development"=>"d005", "Finance"=>"d002" , "Human Resources"=>"d003","Marketing"=>"d001","Production"=>"d004","Quality Management"=>"d006","Research"=>"d008","Sales"=>"d007");


        global $ConnectingDB;

        $q= "SELECT * FROM EMPLOYEES WHERE emp_no=$emp_no";
        $s = $ConnectingDB ->prepare($q);
        $s->execute();
        if($s->rowCount()==1){
            echo '<script>alert("Employee already exists!")</script>';

        }
        else{
            $sql = "INSERT INTO EMPLOYEES(emp_no,birth_date,first_name,last_name,gender,hire_date)
            VALUES (:emp_nO,:birth_datE,:first_namE,:last_namE,:gendeR,:hire_datE)";
            $query = "INSERT INTO SALARIES(emp_no,salary,from_date,to_date)
            VALUES(:emp_nO,:salarY,'$date','$date1')";
            $query1 = "INSERT INTO TITLES(emp_no,title,from_date,to_date)
            VALUES(:emp_nO,:titlE,'$date','$date1')";
            $query3 = "INSERT INTO DEPT_EMP(emp_no,dept_no,from_date,to_date)
            VALUES(:emp_nO,:dept_nO,'$date','$date1')";
            $stmt = $ConnectingDB ->prepare($sql);
            $stmt ->bindValue(":emp_nO",$emp_no);
            $stmt ->bindValue(":birth_datE",$birth_date);
            $stmt ->bindValue(":first_namE",$first_name);
            $stmt ->bindValue(":last_namE",$last_name);
            $stmt ->bindValue(":gendeR",$gender);
            $stmt ->bindValue(":hire_datE",$hire_date);
            $stm = $ConnectingDB ->prepare($query);
            $stm ->bindValue(":emp_nO",$emp_no);
            $stm ->bindValue(":salarY",$salary);
            $stm1 = $ConnectingDB ->prepare($query1);
            $stm1 ->bindValue(":emp_nO",$emp_no);
            $stm1 ->bindValue(":titlE",$title);
            $stm3 = $ConnectingDB ->prepare($query3);
            $stm3 ->bindValue(":emp_nO",$emp_no);
            $stm3 ->bindValue(":dept_nO",$assoc[$dept_name]);
            $Execute = $stmt->execute();
            $ExecutE = $stm->execute();
            $ExecutE1 = $stm1->execute();
            $ExecutE3 = $stm3->execute();
    
    
    
            if($Execute && $ExecutE && $ExecutE1  && $ExecutE3 ){
                echo '<script>alert("Employee has been added successfully")</script>';
                $st = $ConnectingDB->prepare("SELECT * FROM EMPLOYEES
                WHERE emp_no=$emp_no");
                $st->execute();
                echo '<br>';
                echo "<table>";
                echo "<tr><th>emp_no</th><th>birth_date</th><th>first_name</th><th>last_name</th><th>gender</th><th>hire_date</th></tr>";
                while ($row = $st->fetch(PDO::FETCH_ASSOC) ) {
                echo "<tr>";
                echo "<td>" . $row["emp_no"] . "</td>";
                echo "<td>" . $row["birth_date"] . "</td>";
                echo "<td>" . $row["first_name"] ."</td>";
                echo "<td>" .$row["last_name"] ."</td>";
                echo "<td>" . $row["gender"] ."</td>";
                echo "<td>" .$row["hire_date"]  ."</td>";
                echo "</tr>";
                }               
                echo "</table>";
    
                echo '<br>';
    
            }

        }

    }
    else{
        echo '<script>alert("All fields are required!")</script>';
    }
}
?>
