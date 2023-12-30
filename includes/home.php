
<?php
 session_start();
 
 if(isset($_SESSION["username"])) {}
 
 else{
   header("location:index.php");
 
 }
   
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <div class="cont">
        <header class="head"><div id="title"><p>BOC_HORD</p></div>
            <p id="uname">Welcome-&nbsp;<?php echo $_SESSION["name"];?><p></p>
            </p>
            <nav><a class="options" href="search.php">books</a>
                <a class="options" href="students.php">Students</a>
                <a class="options"href="History.php">History</a>
                <a class="options" href="Dashboard.php">Dashboard</a>
                <a class="options" href="logout.php">logout</a>
            
            </nav>
        </header>
       </div>
    </body>
<style>
    .cont{
        width:100%;
    }
    header{
        background:100%;
        z-index: 5;
        width:100%;
        

    }

    nav{
        display:flex;
        justify-content: center;
    }
    .options{
        text-decoration:none;
        color:white;
        background-color: rgba(255,255,255,0.3);
        width:30%;
        text-align: center;
        height:30px;
    }
    
   
    #uname{
        margin: 0;
        font-size:xx-large;
        color:white
        
    }
     
    #title{
        margin: 0;
        display:flex;
        justify-content: center;
    }
    #title>p{
        margin: 0;
        font-size:4rem;
        font-family: 'Orbitron', sans-serif;
        color:aliceblue;
        text-decoration: underline;
    }
    .head{
        background:transparent;
    }
    a{
        font-size:x-large;
    }
   .options:focus{
    background:black;
   }
    
</style>

</html>