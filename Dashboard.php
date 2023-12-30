<?php

include "includes/connection.php";
include "includes/home.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body  onload="startCounterAnimation()">
    <div id="box">
       <div id="book" class="card">
        <p>
            <h2>Books</h2>
        </p>
       <?php $q="select * from books";
        $res=mysqli_query($con,$q);
        echo  "<h1>".mysqli_num_rows($res)."</h1>";
        ?>
       </div>
       <div id="student" class="card">
        <p>
            <h2>Students</h2>
        </p>
       <?php $q="select * from students";
        $res=mysqli_query($con,$q);
        echo  "<h1>".mysqli_num_rows($res)."</h1>";
        ?>
       </div>
       <div id="totalVolumes" class="card">
        <p><h2>Volumes</h2></p>
       <?php  $q="SELECT SUM(volumes) AS sum_of_column FROM books";
        $res=mysqli_query($con,$q);
        $r=mysqli_fetch_assoc($res);
        echo  "<h1>".$r['sum_of_column']."</h1>";
        ?>
       </div>
       <div id="issuedVolumes" class="card">
       <p>
            <h2>Issued Books</h2>
        </p>
       <?php $q="select * from history";
        $res=mysqli_query($con,$q);
        echo  "<h1>".mysqli_num_rows($res)."</h1>";
        ?>
       </div>
       <div id="post" class="card">
       <p>
            <h2>Posts</h2>
        </p>
       <?php $q="select * from downloads";
        $res=mysqli_query($con,$q);
        echo  "<h1>".mysqli_num_rows($res)."</h1>";
        ?>
       </div>
    </div>
    
</body>
<style>body{
    background:linear-gradient(to bottom,black,green);
    background-size:100% 1000px;
}
#box{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    margin:20px;
    
    
   
}
.card{
    width:20%;
    aspect-ratio:1/.8;
    margin:5px;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    background:white;
    border-radius:5%;
    box-shadow: 2px 2px  2px black;
    animation:rotate 0.5s linear 1 ;
   
}
h1{ font-size:60px;
    box-shadow: 2px 2px  2px black;
    width:50%;
    text-align:center;
    border-radius:50%;
    
    margin:0;
    
}
@keyframes rotate {
      from {
        transform: scale(0.1);
      }
      to {
        transform:scale(1);
      }
    }
    h2{
        margin:0;
    }
</style>






</body>
</html>
