<?php
include "includes/session.php";
include "includes/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><a href="students.php">Back</a><div class="box"><div class="container">

<form  method="post" id="f2" class="login_sign"  enctype="multipart/form-data">
                    <h1>ADD STUDENT</h1>
                <input type="file" name="stu_img" class="log" id="">
                <input name="name" type="text" placeholder="Name" class="log">
                <input name="dob" type="date"   id="date">
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
                $course = $_POST['course'];
                $stu_id = $_POST['stu_id'];
                $college = $_POST['college'];
                $email = $_POST['email'];
                $pwd = $_POST['pwd'];
                $total=1;
                $Q = "INSERT INTO students(stu_img ,stu_name, Dob , course , Stu_id , college , email , password , total ) VALUES ('$folder', '$name', '$dob', '$course', '$stu_id', '$college', '$email', '$pwd', '$total')";
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

    
</body>
<style>
    
</html>