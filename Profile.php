<?php
include "includes/session.php";
include "includes/connection.php";
?>

   
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'> 
    <meta name='viewport' content='width=device-width, initial-scale=1.0'> 
    <title>Student Profile Page Design Example</title> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap' rel='stylesheet'><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>

	    <link rel='stylesheet' href='style.css'>
      <script>$(document).ready(function(){
    $('#Edit').click(function(){

    $('#updateinfo').show();
           });








});</script>
</head>

<a href="logout.php">LOGOUT</a>
<section>
   
    <div class='rt-container'>
          <div class='col-rt-12'>
              <div class='Scriptcontent'>
                <?php echo"
<div class='student-profile py-4'>
  <div class='container'>
    <div class='row'>
   
      <div class='col-lg-4'>
        <div class='card shadow-sm'>
          <div class='card-header bg-transparent text-center'>
            <img class='profile_img' src='".$_SESSION["stu_img"]."' alt='student dp'>
            <h3>".$_SESSION["username"]."</h3>
          </div>
          <div class='card-body'>
            <p class='mb-0'><strong class='pr-1'>Student ID:</strong>".$_SESSION["id"]."</p> 
          </div>
        </div>
      </div>
      <div class='col-lg-8'>
        <div class='card shadow-sm'>
          <div class='card-header bg-transparent border-0'>
            <h3 class='mb-0'><i class='far fa-clone pr-1'></i>General Information <i id='Edit' class='fa-solid fa-pen-to-square' style='color:black; margin-left:450px;'></i></h3>
          </div>
          <div class='card-body pt-0'>
            <table class='table table-bordered'>
            <tr>
             <th width='30%'>Date-of-Birth</th>
                <td width='2%'>:</td>
                <td>".$_SESSION["dob"]."</td>
              </tr>
              <tr>
              <th width='30%'>Gender</th>
              <td width='2%'>:</td>
              <td>".$_SESSION["gen"]."</td>
            </tr>
              <tr>
              <th width='30%'>Course</th>
              <td width='2%'>:</td>
              <td>".$_SESSION["course"]."</td>
            </tr>
            <tr>
                <th width='30%'>Email</th>
                <td width='2%'>:</td>
                <td>".$_SESSION["email"]."</td>
              </tr>
            <tr>
            <th width='30%'>College</th>
            <td width='2%'>:</td>
            <td>".$_SESSION["college"]."</td>
          </tr>
            </table>
          </div>
        </div>
          <div style='height: 26px'></div>
        <div class='card shadow-sm'>
          <div class='card-header bg-transparent border-0'>
            <h3 class='mb-0'><i class='far fa-clone pr-1'></i>History<span onclick='prin()' >Print-<i class='fas fa-print'></i></span>
            </h3>
          </div>
          <div  class='card-body pt-0'><table id='getprint' class='table table-bordered'><thead><tr>
          <th>S_NO.</th>
          <th>BOOK_NAME</th>
          <th>BOOK_ID</th>
          <th>ISSUED_DATE</th>
          <th>RETURNED_DATE</th>
          <th>STATUS</th></tr></thead> <tbody> ";
          ?>
          <?php 
          $id=$_SESSION["id"];
           $history= mysqli_query($con,"select * from history where student_id='$id'");
            if(mysqli_num_rows($history)>0){
                $sn=0;
                while($data = mysqli_fetch_assoc($history) ){
                    $sn++;
                    echo"<tr>
                    <td>".$sn."</td>
                    <td>".$data['book_name']."</td>
                    <td>".$data['book_id']."</td>
                    <td>".$data['issued_date']."</td>
                    <td>".$data['returned_date']."</td>
                    <td>".$data['status']."</td></tr>";



                }
            }

            ?>
          
        </tbody>
          </table>
              
          </div>
          
        </div>
       
      </div>
      <div id="ha"class='col-lg-4'>
        <div class='card shadow-sm'>
          <div class='card-body'>
           <h3> <p><a href="myfeed.php">MyPosts</a></p>
           <p><a href="Book_search.php">search</a></p>
           <p><a href="feed.php">feed</a></p> </h3>
          </div>
        </div>
        <div  style='margin-top:8px;' class='col-lg-12'>
        <div class='card shadow-sm'>
        <div class='card-body'>
          
          <form method='post' enctype="multipart/form-data">
          <div class="form-group">
            <h3>share your Notes </h3><hr>
          <input name="notes" class="btn btn-light"  type="text"  id="nameInput" placeholder="Text-Here">
          <select class="btn btn-light" name="subj" id="sbj">
          <option>Physics</option>
          <option>mathematics</option>
          <option>chemistry</option>
          <option>computer science</option>
          <option>bio</option>
          <option>languages</option></select>
          <!-- Allowing all file types except video and audio files -->
        <input id='fileInput' class="btn btn-dark" required type="file" name="file_upload" >


          <label  style='margin-top:8px;' class="btn btn-light" for="fileInput">Upload-<i class="fas fa-book"></i></label>

          <input id='submit' style='margin-left:70%;' name='post' type="submit" value='post' class="btn btn-primary">

      </div>
          </form>
         
          <?php if(!empty($_POST['post'])){
             date_default_timezone_set('Asia/Kolkata');
           $pic= $_SESSION["stu_img"];
           $name=$_SESSION["username"];
           $st=$_SESSION["id"];
           $filename=$_FILES['file_upload']['name'];
           $temp=$_FILES['file_upload']['tmp_name'];
           $folder="uploads/".$filename;
           move_uploaded_file($temp,$folder);
           $notes=$_POST['notes'];
           $subj=$_POST['subj'];
           $currentDateTime =date('Y-m-d H:i:s');
           $q="insert into downloads values('$st','$pic','$name','$filename','$subj','$folder','$notes','$currentDateTime')";
           $execute=mysqli_query($con,$q);
           if($execute){
            echo"<style>
            #submit{
              background:green;
            
            
            }</style>";
           }

            mysqli_close($con);
          }
          ?>
          </div>
        </div>
      </div>
      </div>

    </div> 
  </div>
</div>

          
    		</div>
            </div>
        </div>
      </section>
      <?php echo" <div id='updateinfo'>		
<form method='post' enctype='multipart/form-data'>
  <div class='container'>
    <div class='row'>
      <div class='col-lg-4'>
        <div class='card shadow-sm'>
          <div class='card-header bg-transparent text-center'>
            <input type='file' name='pic' value='' >
            <h3><input class='ip' name='uname' value='".$_SESSION["username"]."'</h3>
          </div>
          <div class='card-body'>
            <p class='mb-0'><strong class='pr-1'>Student ID:</strong><input type='text' class='ip' name='id' value='".$_SESSION["id"]."'</p>
          </div>
        </div>
      </div>
      <div class='col-lg-8'>
        <div class='card shadow-sm'>
          <div class='card-header bg-transparent border-0'>
            <h3 class='mb-0'><i class='far fa-clone pr-1'></i>Edit Information</h3>
          </div>
          <div class='card-body pt-0'>
            <table class='table table-bordered'>
              <tr>
                <th width='30%'>Date-of-Birth</th>
                <td width='2%'>:</td>
                <td><input class='ip' type='date' name='dob' value='".$_SESSION["dob"]."'></td>
              </tr>
              <tr>
                <th width='30%'>Gender</th>
                <td width='2%'>:</td>
                <td><input class='ip' type='text'name='gen' value='".$_SESSION["gen"]."'></td>
              </tr>
              <tr>
                <th width='30%'>course</th>
                <td width='2%'>:</td>
                <td><input class='ip' type='text' name='course' value='".$_SESSION["course"]."'></td>
              </tr>
              <tr>
                <th width='30%'>Email</th>
                <td width='2%'>:</td>
                <td><input class='ip' type='email' name='mail' value='".$_SESSION["email"]."'></td>
              </tr>
              <tr>
                <th width='30%'>college</th>
                <td width='2%'>:</td>
                <td><input class='ip' type='text' name='clg' value='".$_SESSION["college"]."'></td>
              </tr>
            </table>
            <input style='margin:0;margin-left:450px;'type='submit' name='subedit'>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- partial -->
           
    		</div>
		</div>
    </div>
</section>
</form</div>";
?>
<script>
  function prin(){
    document.getElementByID('getprint').print();
  }
</script>
        </body>
       
        


  <?php
  if(!empty($_POST['subedit'])){
    $filename=$_FILES['pic']['name'];
    $temp=$_FILES['pic']['tmp_name'];
    $folder="student_images/".$filename;
    move_uploaded_file($temp,$folder);
    $name=$_POST['uname'];
    $id=$_POST['id'];
    $db=$_POST['dob'];
    $gen=$_POST['gen'];
    $course=$_POST['course'];
    $email=$_POST['mail'];
    $college=$_POST['clg'];
    $Q = "Update students SET stu_img ='$folder',stu_name ='$name', Dob ='$db', Gender='$gen',course='$course', college ='$college' , email ='$email' where Stu_id='$id'";
                
    $run = mysqli_query($con, $Q);
    if ($run) {
        echo"<script>alert('Re-login to see the effect')</script>";
    } else {
        echo "<script>alert('Update Failed: " . mysqli_error($con) . "')</script>";
    }
    
            }
            
            ?>
    
  
    <style>   
body {
   
    background: linear-gradient(to bottom, black ,green);
    padding: 0;
    margin: 0;
    background-size:100% 1000px;
    font-family: 'Lato', sans-serif;
    color: #000;
}

.student-profile .card {
    border-radius: 10px;
}

.student-profile .card .card-header .profile_img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin: 10px auto;
    border: 10px solid #ccc;
    border-radius: 50%;
    
}

.student-profile .card h3 {
    font-size: 20px;
    font-weight: 700;
}

.student-profile .card p {
    font-size: 16px;
    color: #000;
}

.student-profile .table th,
.student-profile .table td {
    font-size: 14px;
    padding: 5px 10px;
    color: #000;
}
#ha{
  position:relative;
  bottom:7rem;
}
.ip{
  height:20px;
  border:none;
  border-bottom: 1px solid;
  margin:0;
  outline:none;
}
#updateinfo{
  display:none;
}
#updateinfo>*{
  position:absolute;
  top:6%;
  
  width:100%;
  aspect-ratio:2/1;
  background:linear-gradient(to bottom,black,green);
  
}
#fileInput{
  display:none;
}
#print{
  margin-left:75%;
}


</style>
</html>


















