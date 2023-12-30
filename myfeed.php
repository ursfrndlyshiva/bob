<?php
include "includes/session.php";
include "includes/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>
    <link rel= 'stylesheet' href= 'https://fonts.googleapis.com/icon?family=Material+Icons'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Document</title>
</head>
<body>
<div class="box"><a id="lg" href="profile.php"><h6>Back</h6></a><div id="sticky">My Posts<hr>
</div>
<?php
        $st=$_SESSION["id"];
      $q="select * from downloads where stu_id='$st' ORDER BY Time DESC";
    $res=mysqli_query($con,$q);
    while($var=mysqli_fetch_assoc($res)){
      
        echo"<div  class = 'main panel panel-default z-depth-4'>
        <div class = 'panel-body'>
        
        <div class='media'>
          <div class='media-left'>
            <img src='".$var['picture']."' class='media-object circle'><span><h5>".$var['name']."</h5><span class = 'time'>".$var['Time']."</span></span>
          </div><hr>
          <div class='media-body'>
          ".$var['notes']."

            
          </div>
        </div>
        <hr>
        
        <div class = 'post'>
        <p>".$var['filename']."</p><p class='btn-dark'>".$var['subject']."</p>

        
        </div>
        
       <hr>
        
        <center><a class='btn btn-secondary' href=".$var['source']." download>Download</a>
        </center>
        
        

        
        
        
        
        </div>
        </div>
      ";
    }
  
    ?>
    
  
</body>
<style>
  body {
   background: linear-gradient(to bottom, black ,green,black,green);
   padding: 0;
   margin: 0;
   background-size:100% 5000px;
   font-family: 'Lato', sans-serif;
   color: #000;
  
}

  *{
    margin:0;
  }
  p{
    display:inline-block;
    margin-left:5%;
    padding:1%;
    border:solid;
    border-radius:5%;
    
  }
  .box{
    display:flex;
    flex-direction:column;
    justify-content:center;
  }
  .box>*{
    background:whitesmoke;
  }
  .main{
    width:40%;
    margin:10px;
    margin-left:30%;
    border-radius:1%;
  }
  .media-object{
  width:10%;
   aspect-ratio:1/1;
  margin:3%;
  
  }
  .media-left{
    display:flex;
  }
  .media-body{
    margin-left:10%;
    margin-right:10%;
    width:80%;
    height:auto;
  }
  .media{
    display:block;
    
  }
  a{
    width:80%;
  }
  #lg,h6{
  display:inline-block;
  position:fixed;
    top:0;
    z-index:2;
  }
input{
  width:10%;
  border:1px solid;
  text-align:center;
  

}
input[type='submit']{
  position:relative;
  bottom:35px;
  margin-left:90%;
}
#sticky {position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
  background:transparent;
  color:white;
  font-size:300%;
  text-align:center;
  font-family:times roman;
  font-weight:bolder;
}
#search{
  display:none;
}
hr{
    background:white;
}


</style>
</html>