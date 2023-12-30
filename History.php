<?php

include "includes/connection.php";
include "includes/home.php";
?>
<!DOCTYPE html>
<html lang="en">
<head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
   
    
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
</head>
<body>
    <div id="hist_bar"><form method="post">
<input placeholder="Search" name="search_hist" type="text">
<input type="submit" name="hist" class="button" value="View"></form></div>

<?php
echo "
       <table id='tb' cellpadding='0' cellspacing='0' border='0'>
           <thead class='tbl-header'>
               <tr><th>T_ID</th>
                   <th>Book_Id</th>
                   <th>Book_Name</th>
                   <th>Student_Id</th>
                   <th>Student_Name</th>
                   <th>Issued_Date</th>
                   <th>Returned_Date</th>
                   <th>Status</th>
                   <th>Return</th>
               </tr>
           </thead>";
  if (!empty($_POST['hist'])) {
    $history = $_POST['search_hist'];
    $history ='%'.$history .'%';
    $statement = "select * from history where book_id LIKE '$history' or student_id LIKE '$history' or student_name LIKE '$history'";
    $result = mysqli_query($con, $statement);

    if(mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)){
            echo "<tbody class='tbl-content'><tr>
                <td>".$data['T_Id']."</td>
                <td>" . $data['book_id'] . "</td>
                <td>" . $data['book_name'] . "</td>
                <td>" . $data['student_id'] . "</td>
                <td>" . $data['student_name'] . "</td>
                <td>" . $data['issued_date'] . "</td>
                <td>" . $data['returned_date'] . "</td>";
                if($data['status']=='pending'){echo"
                <td>" . $data['status'] . "</td>
                <td>
    <form method='post'><input id='retval' name='retval' value='".$data['T_Id']."' type='text'><input name='ret' id='ret' type='submit'value='Return'></form>
</td>
            </tr>";}
            else{
                echo"
                <td>" . $data['status'] . "</td>
            </tr>";
            }
        }

        echo "</tbody>
            </table>
        ";
    }
     else {
        echo "No records found.";
    }
}
?><?php
if(isset($_POST['ret'])){
    $val=$_POST['retval'];
 $q="select * from history where T_Id='$val'";
        $result=mysqli_query($con,$q);
        $info=mysqli_fetch_assoc($result);
        $bid=$info['book_id'];
        $sid=$info['student_id'];
        $st1="SELECT * from books where isbn='$bid'";
        $r1=mysqli_query($con,$st1);
        $st2="SELECT * from students where Stu_id='$sid'";
        $r2=mysqli_query($con,$st2);
        if(mysqli_num_rows($r1)>0 && mysqli_num_rows($r2)>0 ){
            $book=mysqli_fetch_assoc($r1);
            $stud=mysqli_fetch_assoc($r2);
            $currentDateTime = date('Y-m-d H:i:s');
            $count=$book['Volumes'];
            $scount=$stud['total'];
            $status='Returned';
                if($count>=0 && $scount>0){
                    $count++;
                    $scount--;
                    $st3="update books SET Volumes='$count' where isbn='$bid'";
                    $r3=mysqli_query($con,$st3);
                    $st5="update students SET total='$scount' where Stu_id='$sid'";
                    $r5=mysqli_query($con,$st5);
                    
                    $st4 = "UPDATE history SET returned_date='$currentDateTime', status='$status' WHERE T_Id='$val'";
                    $r4 = mysqli_query($con, $st4);
                    if ($r4) {
                        echo "<script>alert('Returned successful')</script>";
                    } else {
                        echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
                    }
                    
                    
                }
                mysqli_close($con);
            }
    
    


       


}

?>

</body>
<style>
     
     .button{
        color:black;
        background-color:white;
        border-color:green;
        border-radius: 50px ;
        height:auto;
        width:100px;
    }
    .button:active{
        background-color:black;
        border-color:white;
        color:white;
    }
   
    input{
        padding-left: 10px;
        font-size:large;
        caret-color:blue;
        height: 25px;
        width:400px;
        border:solid black 1px;
        outline-style: none;
        border-radius: 20px 20px;
        background-color:whitesmoke;
    }
   
    #hist_bar
        { 
        position:relative;
        background:transparent; 
         width:100%;          
        height:auto;
        padding: 20px;
        }
   
    
  h1{
    font-size: 30px;
    color: #fff;
    text-transform: uppercase;
    font-weight: 300;
    text-align: center;
    margin-bottom: 15px;
  }
  table{
    width:100%;
    table-layout: fixed;
  }
  .tbl-header{
    background-color: rgba(255,255,255,0.3);
   }
  .tbl-content{
    height:30px;
    overflow-x:auto;
    margin-top: 0px;
    border: 1px solid rgba(255,255,255,0.3);
  }
  th{
    padding: 20px 15px;
    text-align: left;
    font-weight: 500;
    font-size: 12px;
    color: #fff;
    text-transform: uppercase;
  }
  td{
    padding: 15px;
    text-align: left;
    vertical-align:middle;
    font-weight: 300;
    font-size: 12px;
    color: #fff;
    border-bottom: solid 1px rgba(255,255,255,0.1);
  }
  
  
  /* demo styles */
  
  @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
  body{
    background: -webkit-linear-gradient(bottom, black,green);
    background: linear-gradient(to bottom, black,green);
    background-size:100% 1000px;
    width:100%;
    
    font-family: 'Roboto', sans-serif;
  }
  
  
 
  
  /* for custom scrollbar for webkit browser*/
  
  ::-webkit-scrollbar {
      width: 6px;
  }
  ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }
  ::-webkit-scrollbar-thumb {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }
  #retval{
    display:none;
  }
  #ret,#retval{
    width:50%;
    margin:0;
  }
 
</style>

</html>