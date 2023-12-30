<?php include"includes\connection.php";

session_start();

if(isset($_SESSION["username"])) {
  header("location: search.php");
}
?>

    <!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script>
     $(document).ready(function(){
  $("#r1").click(function(){
    $("#f1").show();
    $("#f2").hide();
  });
  $("#r2").click(function(){
    $("#f1").hide();
    $("#f2").show();
  });


});
    
    
</script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container"><div class="title"><h1>BOC-HORD

    </h1></div>
        <div class="login_box"> <center>
        <?php
if(!empty($_POST['login'])){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $type=$_POST['typ'];
  $q1="select * from students where Stu_id='$username' and password='$password'";
  $query="select * from librarian where id='$username' and password='$password'";
  if($type == 'librarian'){
  $exec=mysqli_query($con,$query);
  $result=mysqli_num_rows($exec);
  $res=mysqli_fetch_assoc($exec);
   if($result==1){
    $_SESSION["username"] = $username;
    $_SESSION["name"] =$res['Name'];

    
    header("location: search.php");}
 else {
        echo"<div class='alert'>invalid credentials!</div>";
  }
}
else{
    $exec=mysqli_query($con,$q1);
    $result=mysqli_num_rows($exec);
    $res=mysqli_fetch_assoc($exec);
     if($result==1){
      $_SESSION["username"] = $res['stu_name'];
      $_SESSION["id"] =  $res['Stu_id'];
      $_SESSION["dob"] =  $res['Dob'];
      $_SESSION["course"] =  $res['course'];
      $_SESSION["college"] =  $res['college'];
      $_SESSION["email"] =  $res['Email'];
      $_SESSION["stu_img"] =  $res['stu_img'];
      $_SESSION["gen"]= $res['Gender'];
      
      header("location: profile.php");}
   else {
          echo"<div class='alert'>invalid credentials!</div>";
    }

}
}
?>
            <div class="rad"><input class="radio" type="radio" checked name="opt" id="r1"><label class="r1" for="r1">login</label><input  class="radio" type="radio" name="opt" id="r2"><label class="r1" for="r2">Register</label></div>
            <form id="f1" class="login_sign"action="" method="post">
            <div class="rad"><input class="radio" type="radio" value="student" required name="typ" id="l1"><label class="label" for="l1">Student</label> <input class="radio" value="librarian" type="radio" name="typ" id="l2"><label <label class="label" for="l2">Librarian</label></div>
                <input name="username" placeholder="Enter Your Id" class="log" type="text">
                    <input name="password" required placeholder="Password" class="log" type="password">
                    <input class="log" type="submit" name="login" value="Login">
            </form>
            <form  method="post" id="f2" class="login_sign"  enctype="multipart/form-data">
            <label class="a" for="dp">choose picture--<i class="fas fa-camera"></i></label>
                <input type="file" name="stu_img" id="dp" value="Choose Photo">
                <input required name="name" type="text" placeholder="Name" class="log">
                <input required name="dob" type="date"  value="DD/MM/YYYY" id="date">
                <select required name="gender" id="">
                    <option value=" ">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select>
                <input required name="course" type="text" placeholder="Course" class="log">
                <input required name="stu_id" type="text"  placeholder="Admission No" class="log">
                <input required name="college" type="text"  placeholder="College_Name" class="log">
                <input required name="email" type="text" placeholder="Example@gmail.com" class="log">
                <input required name="pwd" type="password" placeholder="password" class="log">
                <input  name="reg" type="submit" value=" Register" >
            </form>

        </div></center>
        <?php

            if (!empty($_POST['reg'])) {
                $filename=$_FILES['stu_img']['name'];
                $temp=$_FILES['stu_img']['tmp_name'];
                $folder="student_images/".$filename;
                move_uploaded_file($temp,$folder);
                $name = $_POST['name'];
                $dob = $_POST['dob'];
                $gen = $_POST['gender'];
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
   
    h1{
        font-size:100px;
        background-color:whitesmoke;
        color:black; 
          margin:0;
        
         text-align: center;
        border-radius:15px;
        border: white ridge;
         mix-blend-mode: screen;
            }
        #f2{
        display:none;
        }
    .container{
        margin-top: 100px;                            
        width:100%;
        height:500px;
        display:flex;
        flex-direction: column;
        gap:5%;
        justify-content:center;
        align-items: center;

    }
    .login_box{
        background:transparent;
        border-radius:15px;
        border: white ridge;
    
        width:40%;
        height: auto;
        box-shadow: 2px 2px 8px grey;
        
    }

   
    .radio{
    display:none
    }
    label{
        border-radius:20px;
        margin-left:10px;
        font-size: larger;
    
        
    }
    
    #r1:hover,#r1:checked +label{
        
        background-color: lightgreen;
        color:white;
        
    }
    #l1:checked +label{
        
        background-color: rgba(0, 0, 255, 0.925);
        color:white;
        
    }
    #l2:checked +label{
        
        background-color: rgba(0, 0, 255, 0.925);
        color:white;
        
    }
    #r2:checked +label{
        background:  darkgreen;
        
        color:white;
    }
    

    input,select{
        margin: 10px;
        height:28px;
        width:80%;
        border:none;
        border-bottom: 1px solid;
        outline-style: none;
        background:transparent;
        color:white;
        

    }
    #f2>input,select{
        border-bottom:2px solid green;
    }
    input::placeholder {
  color:white;}
    
    #f2>input:focus, #f2>input:hover,.a:hover{
        caret-color: green;
        border-bottom: 3.5px solid green;

    }
    .label{
        border:2px solid lightblue;
    }
    .login_sign{
        margin-top:30px;
        margin-left: 20px;
    }
    .log:focus{
        border-bottom:solid blue;
    }
    label{
        display:block;
        width:40%;
        text-align: center;
        color:grey;
        
    }
    .rad{
        margin-top: 20px;
        display:flex;
        
    }
    .alert{
            position:relative;
            display:flex;
            width:99.8%;
            border:2px solid tomato;
            height:50px;
            border-radius: 5px;
            background:lightcoral;
            color:maroon;
            justify-content: center;
            align-items: center;
            font-size: larger;
            text-transform: capitalize;
            opacity: 90%;
            animation:show 0.1s 5;

        }
        @keyframes show {
            from{translate:-10px 0;}
            to {  translate:10px 0;}
        }
        body{
    background: -webkit-linear-gradient(bottom, black,green);
    background: linear-gradient(to bottom, black,green,lightgreen);
    background-size:100% 200%;
      
    }
    select{
        color:black;
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
    }
    .r1:hover{
        border: 1px solid white;
    }
  
        
       
</style>
</html>
