<?php
session_start();
if(isset($_SESSION['filen'])){

}
else{
    header("location:newfile.php");
}

$filename=$_SESSION['filen'];
$GLOBALS['FILEN']=$filename;
?>

<?php
function read(){
    $path="./files/".$GLOBALS['FILEN'].".txt";
    if(file_exists($path)){
    
        $handle=fopen($path,"r");
        
        if($handle){
            $data=fread($handle,filesize($path));
            
            echo $data;
        }

        else{
            echo "File couldn't open.";
        }
    }
    else{
        echo"File does not exist.";
        header("location:newfile.php");
    }
    }


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notepad using file handling</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        form {
            margin-top:1vw;
            display: flex;
            border-radius: 0.8vw;
            box-shadow: 0 0 1vw rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
            width: 90vw; /* Adjust the form width as needed */
            height: 44vw; /* Adjust the form height as needed */
        }

        .option {
            position:relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap:2vw;
            background-color: #333;
            padding: 2vw;
            width: 20vw; /* Width of the button column */
            box-sizing: border-box;
        }

        .heading{
            position:absolute;
            top:0.2vw;
            left:2.7vw;
            color:rgb(255, 209, 129);
            font-size:2.4vw;
            font-family:lucida handwriting;
        }
        .btn {
            position:relative;
            top:1.5vw;
            
            background-color: rgb(255, 209, 129) ;
            border: none;
            color: rgb(0, 0, 0);
            padding: 1.5vw;
            text-align: center;
            text-decoration: none;
            display: block;
            margin: 0.5vw 0;
            border-radius: 0.5vw;
            cursor: pointer;
            font-size: 1.6vw;
            font-family:lucida calligraphy;

            transition:ease-in-out 0.2s;
        }

        .btn:hover {
            color:white;
            font-size:1.5vw;
            background-color: rgb(255, 197, 121);
            box-shadow: 0vw 0vw 0.1vw 0.13vw white;
        }

        .btn:active {
            background-color: #6d6d6d;
            color:black;
        }
        .up{
            position:absolute;
            top:29.5vw;
            left:3.5vw;
            color:white;    
            font-size:1vw;
            font-family:lucida handwriting;
        }

        textarea {
            border: 0.2vw solid #ddd;
            border-radius: 0.5vw;
            padding: 1vw;
            margin: 2vw;
            resize: none; /* Prevents resizing */
            flex: 1;
            font-size: 1.3svw;
            font-family:lucida sans;
            box-sizing: border-box;
            transition:ease-in-out 0.2s;
        }

        textarea:focus {
            border-color: rgb(255, 227, 190);
            outline: none;
            box-shadow: 0 0 0.2vw 0.1vw rgb(255, 225, 186);
        }
    </style>
</head>
<body>
    <form action="" method="post">
    <div class="option">
    <h3 class="heading">Notepad ...</h3>
    <input type="submit" class="btn" value="Home" name="action">

    <input type="submit" class="btn" value="Save" name="action">
    
    <input type="submit" class="btn" value="Update" name="action">
        <p class="up">Double click to update</p>

    <input type="submit" class="btn" value="Delete" name="action">
    </div>
    <textarea name="FILE" id="" rows="30" cols="100"><?php read(); ?></textarea>
    </form>
</body>
</html>

<?php


if($_SERVER["REQUEST_METHOD"]==="POST"){
    $data=$_POST['FILE'];
    $path="./files/".$GLOBALS['FILEN'].".txt";
    $handle=fopen($path,"w+");
    if($handle){
        $action=$_POST['action'];
        switch($action){
            case 'Save':
                if(!empty($data)){
                fwrite($handle,$data);
                header("location:newfile.php");   
                }
                else{
                fwrite($handle," ");
                header("location:newfile.php");
                }
                break;
            case 'Update':
                if(!empty($data)){
                    fwrite($handle,$data);
                    fread($handle,filesize($path));
                    }
                    else{
                    fwrite($handle," ");    
                    }
                
                break;
            case 'Delete':
                unlink($path);
                header("location:newfile.php");
                break;
            case 'Home':
                if(!empty($data)){
                    fwrite($handle,$data);
                    header("location:newfile.php");
                    }
                    else{
                    fwrite($handle," ");    
                    header("location:newfile.php");
                        
                    }
                break;
            default :
                echo "INVALID OPERATION SELECTED.!!";
        }    
    }

}


?> 