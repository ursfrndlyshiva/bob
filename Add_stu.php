<?php
include "includes/session.php";
include "includes/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><a href="students.php">Back</a><div class="box"><div class="container">

<form  method="post" id="f2" class="login_sign"  enctype="multipart/form-data">
                    <h1>ADD STUDENT</h1>
                    <label class="a" for="dp">choose picture<i class="fas fa-camera"></i></label>
                <input type="file" name="stu_img" class="log" id="dp">
                <input name="name" type="text" placeholder="Name" class="log">
                <input name="dob" type="date"   id="date">
                <select name="gender" id="">
                    <option value=" ">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select>
                <input name="course" type="text" placeholder="Course" class="log">
                <input name="stu_id" type="text"  placeholder="Admission No" class="log">
                <input name="college" type="text"  placeholder="College_Name" class="log">
                <input name="email" type="text" placeholder="Example@gmail.com" class="log">
                <input name="pwd" type="password" placeholder="password" class="log">
                <input name="reg" type="submit" value=" Register" >
            </form>

        </div></div>
        <?php

            if (!empty($_POST['reg'])) {
                $filename=$_FILES['stu_img']['name'];
                $temp=$_FILES['stu_img']['tmp_name'];
                $folder="student_images/".$filename;
                move_uploaded_file($temp,$folder);
                $name = $_POST['name'];
                $dob = $_POST['dob'];
                $gen= $_POST['gender'];
                $course = $_POST['course'];
                $stu_id = $_POST['stu_id'];
                $college = $_POST['college'];
                $email = $_POST['email'];
                $pwd = $_POST['pwd'];
                $total=1;
                $Q = "INSERT INTO students(stu_img ,stu_name, Dob ,Gender, course , Stu_id , college , email , password , total ) VALUES ('$folder', '$name', '$dob','$gen', '$course', '$stu_id', '$college', '$email', '$pwd', '$total')";
                try{
                    $run = mysqli_query($con,$Q);
                if ($run) {
                    echo "<div class='true'>Registered Sucessfully</div>";
                } else {
                    echo "<script>alert('Registered Failed')</script>";
                }
            }
            catch(Exception $e){
                echo"<script>window.location.load();</script>";
            }
            
                
                mysqli_close($con);
            }
            
            ?>
    </div>
    
</body>
<style>
    a{
        font-size:x-large
    }
    h1{
        margin:0;
        margin-bottom: 5px;;
        text-align:center;
        color:green;
        font-weight:bolder;
        font-size:50px;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }
    .box{
        width:100%;
        display:flex;
        align-items:center;
        justify-content:center;
    }
       
    .container{
        margin-top: 50px;                            
        width:45%;
        height:600px;
        display:flex;
        flex-direction: column;
        box-shadow:2px 2px 3px 2px grey ;
        gap:5%;

    }
   

    
    input,select{
        margin: 10px;
        height:28px;
        width:80%;
        border:none;
        border-bottom: 1px solid;
        outline-style: none;

    }
    #f2>input,select{
        border-bottom:2px solid green;
    }
    
    #f2>input:focus{
        caret-color: green;
        border-bottom: 3.5px solid green;

    }
    .login_sign{
        margin-top:30px;
        margin-left: 20px;
    }
    input[type='file']{
        display:none;
    }
    .a{
        margin: 10px;
        height:28px;
        width:80%;
        border:none;
        border-radius:0;
        border-bottom: 1px solid green;
        outline-style: none;
        background:transparent;
        color:white;
        text-align:left;
        font-size:medium;
        color:green
    }
    

       
</style>
</html>