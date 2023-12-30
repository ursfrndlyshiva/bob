<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
<div class="alert"></div>
<div class="true"></div>
    <style>
        button{
            position: absolute;
            top:20px
        }
        .true,.alert{
            position:absolute;
            display:flex;
            width:100%;
            border:2px solid tomato;
            height:50px;
            border-radius: 5px;
            background:lightcoral;
            color:maroon;
            justify-content: center;
            align-items: center;
            font-size: larger;
            text-transform: capitalize;
            animation:show 0.1s 5;

        }
        .true{
            border:2px solid green;
            color:green;
            background:lightgreen;


        }
        @keyframes show {
            from{translate:-10px 0;}
            to {  translate:10px 0;}
        }

    </style>
    <script>
        function se(){
            document.querySelector('div').style.display='block';

        }
    </script>
</body>
</html>