<?php 

include "includes\connection.php";
          include "includes/home.php";
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>$(document).ready(function(){
        $('#issue_').click(function(){
        $("#issue_books").fadeToggle();
        $("#issue_id").val($("#bid").text());
        });

    
  $("#visible").click(function(){
    $("#del_book").fadeToggle();

    $("#del_id").val($("#bid").text());
  });
  $('#update_book').click(function(){
    $('#update').show();
    
  });
  $('#x').click(function(){
    $('#update').hide();
});
    });
</script>
    <title>Document</title>
</head>
<body>
   
       <div class="top">
       <form id="form1" method="post">
            <input type="text" placeholder="Search_Books" name="book" id="srch">
            <input class="button" type="submit" name="search" value="search">
            <a href="addpage.php"><input class="button" type="button" value="Insert"></a>
        </form>
       </div>
       
       </div>
       <div id="view">
       <div class="left">
      
        
        <?php
        if(isset($_POST['search'])){
            $search=$_POST['book'];
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
                </div>
                <style>
                .hidden{
                    display:none;
                }
               
                .image{
            
                background-size:100% 100%;
                border-style:ridge;
                object-fit:cover;
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
       </div> <div  id="r2"><input class="book_ctrl" type="button" onclick="up()" id="update_book"value="Update">
       <input class="book_ctrl" type="button" id="visible" value="Delete"><input id="issue_" class="book_ctrl" type="button" value="Issue"><input class="book_ctrl" type="button" value="XXX"></div>
    <div id="r3"><center>  <form method="post" id="del_book">
        <p> do you want to delete the book ?</p>
        <input type="text" value=" " name="del_name" id="del_id">
        <input type="submit" id="ask" name="delete" value="submit">
        
    </form></center>
        <?php
         if(isset($_POST['delete'])){
            $isbn=$_POST['del_name'];
           $deq ="DELETE from books where isbn='$isbn'";
           $del= mysqli_query($con,$deq);
           if($del){
            echo"<script>alert('book deleted sucessfully');</script>";
           }
           mysqli_close($con);
         }

         ?></div></div></div>

    <form id="issue_books" method="post"><center>
        <h3>Book_Id:</h3><input type="text" name="bd"  id="issue_id" class="issue_book">
        <h3>Std_Id:</h3><input type="text" name="sd" required  class="issue_book"><br>
        <input  class="issue_book" name="issue_sub" type="submit" value="Issue"></center>
         </form>
         <?php
         date_default_timezone_set('Asia/Kolkata');

         if(isset($_POST['issue_sub'])){
            $bid=$_POST['bd'];
            $sid=$_POST['sd'];                                             
            $st1="SELECT * from books where isbn='$bid'";
            $r1=mysqli_query($con,$st1);
            $st2="SELECT * from students where Stu_id='$sid'";
            $r2=mysqli_query($con,$st2);
            if(mysqli_num_rows($r1)>0 && mysqli_num_rows($r2)>0 ){
            $book=mysqli_fetch_assoc($r1);
            $stud=mysqli_fetch_assoc($r2);
            $bname=$book['Name'];
            $currentDateTime = date('Y-m-d H:i:s');
            $bookid=$book['isbn'];
            $count=$book['Volumes'];
            $sname=$stud['stu_name'];
            $stuid=$stud['Stu_id'];
            $scount=$stud['total'];
            $status='pending';
            $min = 1; 
            $max = 1000000; 
            $randomNumber = mt_rand($min, $max);



            if($count>0 && $scount<=3){
                $count--;
                $scount++;
                $st3="update books SET Volumes='$count' where isbn='$bookid'";
                $r3=mysqli_query($con,$st3);
                $st5="update students SET total='$scount' where Stu_id='$stuid'";
                $r5=mysqli_query($con,$st5);
                $st4="insert into history values('$randomNumber','$bname','$bookid','$sname','$stuid','$currentDateTime','','$status')";
                $r4=mysqli_query($con,$st4);
                if($r4){
                    echo"<script>alert('issued sucessful')</script>";
                }
            }
        }
            else{
                echo"not available";
            }
            mysqli_close($con);
                }

            ?>

            <div id="update"><p id="x">Close</p><form method="post" id="form" enctype="multipart/form-data">
                    <h1 id="h1">UPDATE_BOOK</h1>
                    <input placeholder="Coverpage"   id="pic"  type="file" name="cover" ><br>
                    <input placeholder="Name"        id="i1" efw onkeyup="tx(this)"  class="ip" type="text" Name="Name"><br>
                    <input placeholder="ISBN"        id="i2" required type="text" oninput="tx(this)" class="ip" name="ISBN"><br>
                    <input placeholder="Author"      id="i3" oninput="tx(this)" type="text" oninput="tx()" class="ip" name="Written_By"><br>
                    <input placeholder="Publication" id="i4" oninput="tx(this)" type="text" class="ip" name="Publications"><br>
                    <input placeholder="Genre"       id="i5" oninput="tx(this)" type="text" name="Genre" class="ip"><br>
                    <input placeholder="Volumes"     id="i6" oninput="tx(this)" type="text" name="Volumes" class="ip"><br>
                    <input placeholder="Location"    type="text" id="i7" oninput="tx(this)" name="location" class="ip"><br>
                    <input type="file" id='fil' name='dnld' class="ip"><br>
                    <input name="add" type="submit" id="log1" class="btn" value="submit">
                   
                </form></div>

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

    

    $Q = "update books SET Cover='$folder', isbn='$I', Name='$n', Author='$aut', Publication='$pub', Genre='$gen', Volumes='$vol', Location='$loc',source='$lc' where isbn='$I' ";
    try{
    $r = mysqli_query($con, $Q);
    if($r) {
        echo "<script>alert('Book Updated Sucessfully')</script>";
    } else {
        echo "<script>alert('Update Failed')</script>";
    }
}
    catch(Exception $e){
        echo"<script>window.location.load();</script>";
    }
    mysqli_close($con);
}

?>

</body>
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

}
function up(){
        var v1=document.querySelectorAll('.ip');
        var v2=document.querySelectorAll('.p');
          for(var j=0;j<v2.length;j++){
           v1[j].value=v2[j].innerHTML;
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
  height:30%;
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

  max-width: 100%;
  border: 1px solid transparent;
  border-radius: 0.5rem;
  text-align:center;
  font-size:150%;
  color:green;
}



    h1{
        margin: 0;
    }
    .top{ position:relative;
        background:transparent; 
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
        border:solid green 1px;
        outline-style: none;
        border-radius: 20px 20px;
        background-color:whitesmoke;
    }
    .button,#ask{
        padding:3px 3% 3px 3%;
        color:green;
        background-color:white;
        border-color:green;
        border-radius: 50px ;
        height:auto;
    }
    .button:active{
        background-color:green;
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

#book_cover{
     
    width:60%;
    aspect-ratio:1/1;
    box-shadow: 2px 2px 5px ;
    padding:3px;
    padding: 10px;
    border:solid;
    margin-right: 20px;
    object-fit:contain;
    
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

.book_ctrl:nth-child(1){
    background:orangered;
}
.book_ctrl:nth-child(2){
    background-color: red;
}
.book_ctrl:nth-child(3){
    background-color: green;
}

.book_ctrl{
    color:white;
    
}

    #book_cover{
        height:150px
    }
#del_book,#issue_books{
    background: -webkit-linear-gradient(bottom, white,green);
    background: linear-gradient(to bottom, white,green);;
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

.issue_book{
        margin: 10px;
        height:28px;
        width:80%;
        border:none;
        border-bottom: 1px solid blue;
        outline-style: none;

    }
   
    
    .issue_book:focus{
        caret-color: green;
        border-bottom: 3.5px solid blue;
    }

    
    body{
        background: -webkit-linear-gradient(bottom, black,green);
    background: linear-gradient(to bottom, black,green);
    }
    
    .ip,#pic,#log1{
        margin: 10px;
        height:28px;
        width:80%;
        border:none;
        border-bottom: 1px solid;
        outline-style: none;

    }
    .ip,#pic,#log1{
        border-bottom:2px solid green;
    }
    
     .ip:focus{
        caret-color: green;
        border-bottom: 3.5px solid green;
    }
    #x{
        position:relative;
        display:inline-block;
        background:green;
        left:72%;
        top:3px;
        font-size:xx-large;
        color:white;
        cursor:pointer;
    }
    #h1{
        margin:0;
        margin-bottom: 5px;;
        text-align:center;
        color:white;
        font-weight:bolder;
        font-size:50px;
        font-family: Georgia, 'Times New Roman', Times, serif;
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

</html>