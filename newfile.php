<?php
session_start();
function open(){
    session_unset();
    session_destroy();
}
error_reporting(0);
?>
<html>

<?php
//function to create new files..with various fallbacks ..
function create(){
    if(isset($_POST['sbmt'])){
        open();
        $fname=$_POST['filen'];
        $fpath="files/".$fname.".txt";
        if(file_exists($fpath)){
            echo "This file-name already exist.";
        }
        else{
            $handle=fopen($fpath,"x+");
            if($handle){
                fwrite($handle," ");
                $_SESSION['filen']=$fname;
                header("location:notepad.php");
            }
            else{
                echo "Error creating file.!";
            }
            fclose($handle);
        }

    }
    }

//function to read data into the textbox for better understanding of what content is in notepad
function reading($a){
    $path="./files/$a.txt";
    if(file_exists($path)){
    
        $handle=fopen($path,"r");
        
        if($handle){
            $data=fread($handle,filesize($path));
            fclose($handle);
            return $data;
        }
    }
}

//function to open the existing file in the new tab..

//this too
if(isset($_POST['open'])){
    open();
    session_start();
    $value=$_POST['open'];
    $_SESSION['filen']=$value;
    header("location:notepad.php");   
    exit();
}
?>
<head>
<style>
        *{
            font-family:lucida sans;
        }
       body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }
        .main {
            display: flex;
            height: 100vh;
        }
        .part {
            width: 50%;
            padding: 20px;
            border-left:0.3vw solid rgb(255, 255, 255);
        }
        .title{
            font-size:5vw;
            font-family:lucida calligraphy;
            color:rgb(255, 209, 129);
        }
        u{
            position:relative;
            bottom:5vw;
            color:burlywood;
            
        }
        .left{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            background:#333;
            /* background-image:url(https://i.pinimg.com/736x/99/a2/e5/99a2e57542638103b0d2258f19bb25fd.jpg);
            background-size:cover;
            background-position: bottom; */
            
        }
        
        .left .create{
            position:relative;
            height:20vw;
            width:60%;
            transform:scale(1.08);

            display:flex;
            flex-direction:column;
            gap:1vw;
            justify-content: center;
            align-items:center;

            border-radius:0vw 1.3vw 0vw 1.3vw;
            background:rgb(255, 255, 255);
            transition:ease-in-out 0.3s;
        }

        .left .create:hover{
            box-shadow:0vw 0vw 0.3vw 0.1vw #ccc;
            
        }
        .left .heading{
            position:absolute;
            top:3vw;
            font-size:1.8vw;
            color:rgb(255, 212, 132);

            /* text-decoration: underline #c6c6c6 0.002vw; */
            text-shadow:0.07vw 0.03vw rgb(121, 121, 121);
                        
                        
            font-family:lucida calligraphy;
        }
        .left .inside{
            background:rgba(225,225,225,0.5);
            font-size:1.1vw;
            border:none;  
            border-radius:0.3vw;  
            outline:none;
        }
        .left .text{
            position:absolute;
            top:8.5vw;
            width:84%;
            height:2vw;
            text-align:center;
            font-size:1.1vw;
            transition:ease-in 0.3s;
        }
        .left .inside:focus{
            border:0.1vw solid #7d7d7d;
            border-radius:0.1vw;  
            box-shadow: 0vw 0vw 0.2vw 0.04vw #9a9a9a;
        }
        .left .filety{

        }
        .left .submit{
            position:absolute;
            top:12.5vw;
            width:50%;
            height:2.5vw;
            border:none;
            border-radius:0.3vw;  
            background:rgb(255, 212, 132);
            transition:ease-in-out 0.3s;
        }
        .left .submit:hover{
            position:absolute;
            top:12.7vw;
            color:white;
            background:rgb(255, 212, 132);

            /* box-shadow:0vw 0vw 0.1vw 0.04vw black; */
            outline:none;
            border:none;
        }
        .left .create font{
            position:relative;
            top:7.5vw;
            color:#9d9d9d;
            font-family:lucida sans;
            font-size:1.2vw;
        }

        .right button {
            position:absolute;
        }
        .prev{
            position:absolute;;
            bottom:3vw;
            width:100%;
            text-align:center;
            font-family:lucida calligraphy;
            font-size:3vw;
            color:white;

        }
        .right{
            position:relative;
            background:rgb(255, 219, 152);
            border-right:0.3vw solid white;
            /* background-image: url('https://i.pinimg.com/736x/c3/0f/34/c30f34337563cdc7a61874bbfd8b057f.jpg'); */
            display:flex;
            flex-wrap:wrap;
            gap:2vw;
            justify-content: start;
            align-items: flex-start;
            overflow:scroll;
        }
        .right::-webkit-scrollbar{
            display:none;
        }
        .choose{
            height:10vw;
            position:relative;
            display:flex;
            flex-wrap:wrap;
            width:21.75vw;
            border:0.3vw solid rgb(137, 137, 137);
            border-radius:0.5vw;
            background:rgb(255, 251, 251);


            overflow:hidden;
            padding:0vw;
            transition:ease-in-out 0.25s;
        }
        .choose:hover{
            box-shadow:0vw 0vw 0.7vw 0.3vw #ffffff;

        }
        .show{
            background:rgb(255, 251, 251);
            color:#333;
            padding:0.6vw;
            width:100%; 
            
            resize:none;
            outline:none;
            border:none;
            overflow:hidden;
        }
        .btn{
            width:100%;
            height:2.1vw;
            position:absolute;
            left:0;
            bottom:0; 
            color:white; 
            font-size:1.05vw;
            font-family:lucida sans;
            background:#515151;
            border:none;
            border-radius:0vw 0vw 0.2vw 0.2vw;
            outline:none;
            transition:ease-in-out 0.2s;
        }
        .btn:hover{
            background:#333;
            outline:none;
            color:white;
            
        }
    </style>
    </head>
    <body>
    


<div class="main">
        
        <div class="part left">
            
            <u s><font class="title">My Notepad</font></u>
            <form  method="post" class="create">
            <div class="heading">Create New File</div>
            <input class="inside text" type="text" name="filen" placeholder="Enter File Name" pattern="[A-Za-z0-9 ]+" title="Only alphabets and numbers allowed." required>
            <!-- <select name="filetype" id=""required>
                <option value=".txt">Text</option>
                <option value="">All Files</option>  
            </select> -->
            <input class="inside submit" type="submit" name="sbmt" value="Create">
            <font class="msgpop"><?php create()?></font>
            </form>
            <div class="prev">Saved Files -></div>

        </div>
        <?php
        $adjacentDir = __DIR__.'/files';
            // Check if the adjacent directory exists
            if (is_dir($adjacentDir)) {
                // Scan the directory and get an array of filenames
                $files = scandir($adjacentDir);

                // Filter out '.' and '..' which are current and parent directory entries
                $files = array_diff($files, array('.', '..'));

                echo "<div class='part right'>";
                
                foreach ($files as $file) {
                    $file=pathinfo($file,PATHINFO_FILENAME);
                    echo "<div class='choose'>";
                    echo"<form  method='post' >";
                    $content=reading($file);
                    echo "<textarea class='show'  id='' cols='40' rows='8'disabled>".$content."</textarea>";
                    echo"<button type='submit'name='open' class='btn' value='$file'>".$file."</button><br>";
                    echo"</form>";
                    echo"</div>";

                }

                echo "</div>";


            } else {
                echo "The directory $adjacentDir does not exist.";
            }

            
            ?>
</div> 
</body>
</html>
