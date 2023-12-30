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
<div class="box"><a id="lg" href="profile.php"><h6>Back</h6></a><div id="sticky"><form method="post"><input placeholder='Search Your Downloads' name="val" type="text"><input id="sub" class="btn-primary" name="submit" type="submit" value="search"></form></div>
<div id="view">
       <div class="left">
      
        
        <?php
        if(isset($_POST['submit'])){
            $search=$_POST['val'];
            $search='%'.$search.'%';
            $q="SELECT * FROM books WHERE Name LIKE '$search' or Genre LIKE '$search'";
            $exec=mysqli_query($con,$q);
            if (mysqli_num_rows($exec) > 0) {
                    $id=0;
                while($row = mysqli_fetch_assoc($exec)) {
                    echo"
                  <div  onclick='ha(this)' id=book.$id. class='card'>
                <div class='infos'>
                    <div class='image'><img  class='image' src='".$row['cover']."' width=100% height=100% ></div>
                    <div class='info'>
                        <div>
                            <p class='name'>
                                ".$row['Name']."
                            </p>
                        <p class='hidden'>".$row['isbn']."</p>
                        <p class='function'>
                                ".$row['Author']." 
                            </p>

                            <p class='hidden'>".$row['Publication']."</p>

                        <p class='hidden'>".$row['Genre']."</p>  
                        <p class='hidden'>".$row['Volumes']."</p>
                        <p class='hidden'>".$row['Location']."</p>
                        </div>
                       
                    </div>
                </div>
               <p class='request'>Details</p>
               <style> .hidden{
                display:none;
            }
           
            .image{
        
            background-size:100% 100%;
            border-style:ridge;
            }  
</style>";
               if($row['source'] != NULL){
              echo" <a  class='request'  href='".$row['source']."' download>DOWNLOAD</a>";
               }
               echo"</div>";
               
        
 $id++;
 

                }
        
                
            } 
            else {
                echo "<style>
                .left{
                    background:red;
                }
                
                    </style>";
            }
        }
        ?>




       </div>
       <div id="right"><div id="r1">
        <center><img id="book_cover" src=''></center>
        <div id="br">
        <p class="fix">Name:</p><p class="p">name</p>
        <p  class="fix">isbn:</p> <p id="bid" class="p">isbn</p>
       <p class="fix">Author:</p><p class="p">writer</p>
       <p class="fix">Publication:</p> <p class="p">publications</p>
       <p class="fix">Genre:</p><p class="p">genrer</p>
        <p class="fix">No.of Volumes:</p><p class="p">volumes</p>
        <p class="fix">Is At:</p><p class="p">location</p>
        
       </div>
</body>

<style>
    #update{
        display:none;
        background:transparent;
        width:50%;
        position:relative;
        left:400px;
        bottom:600px;
        
        
    }
    h3{
        margin:0;
    }
    #issue_form{
       width:100%;
    }
    #issue_form >input{
        width:100%;
        margin:2px;
        

    }
  
    .issue{
        width:50%;
        border:solid;
        position:absolute;
        background:white;
        border-color:green;
        display:flex;
        padding:3%;
        border-radius:100px;
        margin-left:25%;
        margin-top:3%;
        aspect-ratio:1/0.5;
        align-items:center;
    }
   
   
   
.card {
  width:200px;
  border-radius: 8%;
  border:solid black;
  background: -webkit-linear-gradient(bottom, black,green);
    background: white;
  padding:1%;
  height:33%;
}


.infos {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  grid-gap: 1%;
  gap: 1%;
}

.image {
  width:100px;
  height:100px;
  border-radius: 15%;
  
 
}

.info {
  height:7rem;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.name {
  font-size:130%;
  line-height:90%;
  font-weight:300px;
  color: black;
  margin:0;
}

.function {
  font-size:100%;
  line-height:90%;
  color: rgba(156, 163, 175, 1);
  margin:5px
}


.request {
    margin:0;
    margin-top:2%;
  max-width: 100%;
  border: 1px solid transparent;
  border-radius: 0.5rem;
  text-align:center;
  font-size:150%;
  color:green;
}
.left{
        width:98%;
        padding:2%;
        padding-left: 60px;
        display:inline-flex;
        flex-wrap:wrap;
        column-gap:20px;
        row-gap:-20px;
        height:700px;
        border-style:none;
        border-top-style: solid;
        overflow: auto;
    }

#view{
    display:flex;
}
#right{
    width:45%;
    height:700px;
    display:none;
    background:white;
    overflow: scroll;

}

#book_cover{
     
    width:60%;
    aspect-ratio:1/1;
    box-shadow: 2px 2px 5px ;
    padding:3px;
    padding: 10px;
    border:solid;
    margin-right: 20px;
    
}
.fix{
margin:0;
padding:0;
display: block;
font-size: large;
font-weight: bolder;
background: white;
color:black;


}
.p{
    margin:0;
    padding:0;
    font-size:larger;
    font-weight:bold;
    text-decoration:underline;
    text-transform: capitalize;
    display: block;
    text-align: center;
    background:whitesmoke;
    color:black;
    


    
}



#r1{ 
    height:auto;
    display:block;
    margin-bottom:5px;
}
#r2{
    display:flex;
    gap:3%;
    height:20px;
}

#r1,#r2,#r3{
    border:solid white;
    
}
#book_cover{
        height:auto;
    }
    
    body{
        background: -webkit-linear-gradient(bottom, black,green);
    background: linear-gradient(to bottom, black,green);
    }
    #right{
    resize:horizontal;
    overflow:auto;
    direction: rtl;
}
#right>*{
    direction: ltr; 
}
               

   

</style>
<script>
  
function ha(ele){
    document.querySelector('#right').style.display='block';
    var b=document.getElementById(ele.id);
    var d=document.getElementById('r1');
    var img=b.querySelector('img').src;
    d.querySelector('#book_cover').src=img;
    var a=d.querySelectorAll('.p');
    var c=b.querySelectorAll('p');
    for (var i=0;i<c.length;i++){
        a[i].innerHTML=c[i].innerHTML;
    }  
    var dnld=document.getElementById('dd');
            document.getElementById('dnd').href=dnld.innerHTML;

}
function up(){
        var v1=document.querySelectorAll('.ip');
        var v2=document.querySelectorAll('.p');
          for(var j=0;j<v2.length;j++){
           v1[j].value=v2[j].innerHTML;
          }



      }  

</script>

</html>