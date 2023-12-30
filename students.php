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
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
    $(document).ready(function(){
        
  $("#visible").click(function(){
    $("#stu_del").fadeToggle();

    $("#stud_del").val($("#bid").text());
  });
    
$("#return").click(function(){
    $("#return_table").fadeToggle();
    $("#rid").val($("#bid").text());
    
});

 
});
</script>
    <title>Document</title>
</head>
<body>
   
       <div class="top">
       <form id="form1" method="post">
            <input type="text" placeholder="Search_Student" name="stu" id="srch">
            <input class="button" type="submit" name="search" value="search">
            <a href="Add_stu.php"><input class="button" type="button" value="Insert"></a>
        </form>
       </div>
       
       </div>
       <div id="view">
       <div class="left">
      
        
        <?php
                 if(!empty($_POST['search'])){
                   $search=$_POST['stu'];
                   $search='%'.$search.'%';
                 $q="SELECT * FROM students WHERE stu_name LIKE '$search' or stu_id LIKE'$search'";
            $exec=mysqli_query($con,$q);
            if (mysqli_num_rows($exec) > 0) {
                    $id=0;
                while($row = mysqli_fetch_assoc($exec)) {
                    echo"
                  <div  onclick='ha(this)' id=stu.$id. class='card'>
                <div class='infos'>
                    <div class='image'><img class='image' src='".$row['stu_img']."' width=100% height=100% ></div>
                    <div class='info'>
                        <div>
                            <p class='name'>
                                ".$row['stu_name']."
                            </p> 
                        <p class='hidden'>".$row['Dob']."</p>
                        <p class='hidden'>".$row['Gender']."</p>

                        <p class='function'> ".$row['course']." 
                        </p>
                        
                            <p class='hidden'>".$row['Stu_id']."</p>

                           
                        <p class='hidden'>".$row['college']."</p>
                        <p class='hidden'>".$row['Email']."</p>
                        <p class='hidden'>".$row['total']."</p>
                        </div>
                       
                    </div>
                    
                </div>
               <p class='request'>View Details</p>
                </div>
                <style>
                .hidden{
                    display:none;
                }
               
                .image{
            
                background-size:100% 100%;
                border-style:ridge;
                }
    </style>
";
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
    <center><img id="stu_img" src=''></center>
        <div id="br">
        <p class="fix">Name:</p><p class="p">name</p>
       <p class="fix">Date of Birth</p><p class="p">XXXXX</p>
       <p class="fix">Gender</p><p class="p">XXXXX</p>
       <p class="fix">course</p><p class="p">course</p>
        <p class="fix">Student_ID:</p> <p id="bid" class="p">xxxx</p>
        <p class="fix">college_Name</p><p class="p">_____</p>
        <p class="fix">Email:</p><p class="p">____</p>
        <p  class="fix">total books</p> <p id="bid" class="p">number</p>
       </div>
       </div> <div  id="r2">
       <input class="stu_ctrl" type="button" id="visible"  value="Delete"><input class="stu_ctrl" name="rsub" type="button" id="return" value="Return"><input class="stu_ctrl" type="button" value="XXX"></div>
    <div id="r3">
        
       
    <table id="return_table" border=2px>
<tr>
    <th>Book</th>
    <th>Id</th>
    <th>issued</th>
    <th>status</th>
    <th>return</th>
</tr>

<?php if(isset($_POST['rsub']))  {
    $rq="select * from history";
    $rs=mysqli_query($con,$rq);
        while($rr=mysqli_fetch_assoc($rs)){
            echo"<tr><td>".$rr['book_name']."</td></tr>";
        }
    }
    
    ?>
</table>



<center>  <form method="post" id="stu_del">
        <p> do you want to delete this Record ?</p>
        <input type="text" value="" name="del_name" id="stud_del">
        <input type="submit" id="ask" name="delete" value="submit">
        
    </form></center>
        <?php
         if(isset($_POST['delete'])){
            $stu_id=$_POST['del_name'];
           $deq ="DELETE from students where Stu_id='$stu_id'";
           $del= mysqli_query($con,$deq);
           if($del){
            echo"<script>alert('record deleted sucessfully');</script>";
           }
           mysqli_close($con);
         }

         ?></div></div></div>



        </div></div>
            </div>
</body>
<script>
  
function ha(ele){
    document.querySelector('#right').style.display='block';
    var b=document.getElementById(ele.id);
    var d=document.getElementById('r1');
    var a=d.querySelectorAll('.p');
    var img=b.querySelector('img').src;
    d.querySelector('#stu_img').src=img;
    var c=b.querySelectorAll('p');
    for (var i=0;i<c.length;i++){
        a[i].innerHTML=c[i].innerHTML;
    }  
} 
      function up(){
        var v1=document.querySelectorAll('.log');
        var v2=document.querySelectorAll('.p');
          for(var j=0;j<v2.length;j++){
            if(j==2){v1[j].value=v2[j].innerHTML;}
            else{v1[j].value=v2[j].innerHTML;}
          }



      }  

    


</script>

<style>
    #update{
        display:none;
        background:transparent;
        width:50%;
        position:relative;
        left:400px;
        bottom:600px;
       
        
        
    }
    
    a{
        font-size:x-large;
    }
    h1{
        margin:0;
        margin-bottom: 5px;;
        text-align:center;
        color:white;
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
        height:550px;
        display:flex;
        flex-direction: column;
        box-shadow:2px 2px 3px 2px grey ;
        gap:5%;

    }
    #x{
        position:relative;
        left:72%;
        top:3px;
        font-size:xx-large;
        color:white;
        cursor:pointer;
    }
   

    
    .log,#log,#log1{
        margin: 10px;
        height:28px;
        width:80%;
        border:none;
        border-bottom: 1px solid;
        outline-style: none;

    }
    #f2>.log,#log,#log1{
        border-bottom:2px solid green;
    }
    
    #f2> .log:focus{
        caret-color: green;
        border-bottom: 3.5px solid green;

    }
    .login_sign{
        margin-top:30px;
        margin-left: 20px;
    }
    

       

 
    #issue_form{
       width:100%;
    }
    #issue_form >input{
        width:100%;
        margin:2px;
        

    }
  
    #i2{
        background:red;
        width:50%;
    }
   
   
.card {
  width:200px;
  border-radius: 8%;
  border:solid gray;
  background-color:white;
  padding:1%;
  height:30%;
}


.infos {
  display: flex;
  flex-direction: row;
  line
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
  font-size:100%;
  line-height:90%;
  font-weight:300px;
  color:black;
  margin:0;
}

.function {
  font-size:100%;
  line-height:90%;
  color: rgba(156, 163, 175, 1);
  margin:5px
}


.request {

  max-width: 100%;
  
  border-radius: 0.5rem;
  text-align:center;
  font-size:150%;
  color:green;
}



    h1{
        margin: 0;
    }
    .top{ position:relative;
        background-color:transparent;
        width:100%;          
        height:auto;
        padding: 20px;
    }
    .btn{position:relative;
        width:80px;
    }
    form{
        position:relative;
        
    }
    #srch,#all_pwd{
        padding-left: 10px;
        font-size:large;
        caret-color:blue;
        height: 25px;
        width:400px;
        border:solid gray 1px;
        outline-style: none;
        border-radius: 20px 20px;
        background-color:whitesmoke;
    }
    .button,#ask{
        padding:3px 3% 3px 3%;
        color:gray;
        background-color:white;
        border-color:gray;
        border-radius: 50px ;
        height:auto;
    }
    .button:active{
        background-color:gray;
        border-color:white;
        color:white;
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

#stu_img{
     
    width:60%;
    height:200px;
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


#br{
     
    height:inherit;
    width:100%;
    
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
#r3{
    height:auto;
}
#r1,#r2,#r3{
    border:solid white;
    
}

.stu_ctrl:nth-child(1){
    background:orangered;
}
.stu_ctrl:nth-child(2){
    background-color: red;
}
.stu_ctrl:nth-child(3){
    background-color: green;
}

.stu_ctrl{
    color:white;
    
}

#right{
    resize:horizontal;
    overflow:auto;
    direction: rtl;
}
#right>*{
    direction: ltr;   
}
#return_table{
    display:none;
}





#stu_del{

    background:white;
    border:1px solid black;
    width:50%;
    top:55%;
    left:25%;
    aspect-ratio: 3/0.5;
    justify-content: center;
    align-items: center;
    position: absolute;
    animation:slide  1s 1;
    display: none;
    z-index: 1;

    
}
     
   
    body{
        background: -webkit-linear-gradient(bottom, black,green);
    background: linear-gradient(to bottom, black,green,lightgreen);
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
   
    
    
    </style>
</body>
</html>