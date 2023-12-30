<?php
include "includes/session.php";
include "includes/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> <a href="search.php">Back</a>
    <div class="box">
        <div class="container">
            
                <form method="post" id="form" enctype="multipart/form-data">
                    Name: <input id="i1" efw onkeyup="tx(this)"  class="ip" type="text" Name="Name"><br>
                    ISBN: <input id="i2" required type="text" oninput="tx(this)" class="ip" name="ISBN"><br>
                    Author: <input id="i3" oninput="tx(this)" type="text" oninput="tx()" class="ip" name="Written_By"><br>
                    Publication: <input id="i4" oninput="tx(this)" type="text" class="ip" name="Publications"><br>
                    Genre: <input id="i5" oninput="tx(this)" type="text" name="Genre" class="ip"><br>
                    Volumes: <input id="i6" oninput="tx(this)" type="text" name="Volumes" class="ip"><br>
                    Location: <input type="text" id="i7" oninput="tx(this)" name="location" class="ip"><br>
                    Coverpage: <input id="pic" onfocusout="bg()" type="file" name="cover" ><br>
                    source: <input type="file" name="dnld" id="src"><br>
                    <input name="add" type="submit" class="btn" value="submit">
                    <input name="res" class="btn" type="reset" value="reset">
                </form>
            </div>
            <div id="book" class="book">
                <p class="ch" id="p1">Name</p>
                <p class="ch" id="p2">ISBN</p>
                <p class="ch" id="p3">Written By</p>
                <p class="ch" id="p4">Publication</p>
                <p class="ch" id="p5">Genre</p>
                <p class="ch" id="p6">Volumes</p>
                <p class="ch" id="p7">Location</p>
            </div>
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
        flex-direction: row;
        align-items:center;
        justify-content:center;
    }
       
    .container{
        padding:15px;
        margin-top: 50px;                            
        width:45%;
        height:550px;
        display:flex;
        flex-direction: column;
        box-shadow:2px 2px 3px 2px grey ;
        gap:5%;

    }
   
    input{
        margin: 10px;
        height:28px;
        width:80%;
        border:none;
        border-bottom: 1px solid;
        outline-style: none;
        border-bottom:2px solid green;

    }
    
    input:focus{
        caret-color: green;
        border-bottom: 3.5px solid green;

    }
    .login_sign{
        margin-top:30px;
        margin-left: 20px;
    }
    
    @media screen and (max-width: 900px){
        .container{
            width:100%;
        }


    }
       
    
    .book{
        background-image:url('Screenshot2023-06-21184918.png'); position:relative;
        border: solid  2px;
        width:20%;
        aspect-ratio:1/1.5;
        float:right;
        margin-left: 50px;
        border-radius: 3px 10px 10px 3px;
        box-shadow:5px 5px 2px 2px green ;
    }
    
      
        
        p{  
            width:auto;  
            font-size:xx-large;          
            text-align: center;
        }
       
    
</style>
<script>
    
    function tx(get){
             
        var pd='p'+get.id.slice(-1); 
        
        var change=document.getElementById(get.id);
        change.value=change.value.toUpperCase();
        if (change.value!=""){
            document.getElementById(pd).innerHTML=change.value;
        }
        else if(change.value==""){
            document.getElementById(pd).innerHTML=change.name;
        }
 }
 function bg(){
    var image =document.getElementById('pic').value;
    console.log(image);
    document.getElementById('book').style.backgroundImage=

 }
 
 
</script>


<?php
if (isset($_POST['add'])) {
    $n = $_POST['Name'];
    $I = $_POST['ISBN'];
    $aut = $_POST['Written_By'];
    $pub = $_POST['Publications'];
    $gen = $_POST['Genre'];
    $vol = $_POST['Volumes'];
    $loc = $_POST['location'];
    $filename=$_FILES['cover']['name'];
    $temp=$_FILES['cover']['tmp_name'];
    $folder="Covers/".$filename;
    move_uploaded_file($temp,$folder);
    $dnld=$_FILES['dnld']['name'];
    $dtemp=$_FILES['dnld']['tmp_name'];
    $lc="books/".$dnld;
    move_uploaded_file($dtemp,$lc);
    $status = 1;

    $Q = "INSERT INTO books(Cover, isbn, Name, Author, Publication, Genre, Volumes, Location, Status,source) VALUES ('$folder', '$I', '$n', '$aut', '$pub', '$gen', '$vol', '$loc', '$status','$lc')";
    try{
    $r = mysqli_query($con, $Q);
    if ($r) {
        echo "<script>alert('Book added successfully!')</script>";
    } else {
        echo "Failed to add book.";
    }
}
    catch(Exception $e){
        echo"<script>window.location.load();</script>";
    }
    mysqli_close($con);
}

?>
</html>
