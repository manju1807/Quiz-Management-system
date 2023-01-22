<html>
<head>
    <title>
        Quizzy
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
session_start();
require_once 'sql.php';
                $conn = mysqli_connect($servername, $username, $password, $dbname);if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
}
?>
<style>
    li {
        margin: 1.5vw;
        font-size: 1rem !important;

    }

    ul {
        list-style: none;
        width: auto !important;
        font-weight: 2vw !important;
    }

    .navbar {
        background-color: white !important;
        font-size: 1.5vw !important;
        position: fixed;
        
    }
   

    .navbar>ul>li:hover {
        color: #042A38;
        text-decoration: underline;
        font-weight: bold;
        cursor: default;
        cursor: pointer;

    }

    .navbar>ul>li>a:hover {
        color: #042A38;
        text-decoration: underline;
        font-weight: bold !important;
        
    }

        a {
            text-decoration: none;
            color: #fff;
        }

        .prof{
            top: 5vw;
            position: fixed;
            width: 35vw !important;
            height:15vw !important;
            margin-left: 34vw !important;
            margin-right: 20vw !important;
            background-color: #fff !important;
            border-radius: 10px;
            margin-top: 0.5rem;
            z-index: 1;
            padding: 1vw;
            padding-left: 1vw;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        img{
            width: 100%;
            display:block;
            object-fit: cover;
        }

        .container1{

            color: #042A38;
            font-size:15px;
            line-height: 0.3rem;
            grid-column:1;
        }
        .container2{
            width:6rem;
            height:6rem;
            border-radius: 50%;
            overflow: hidden;
            margin-left: 3rem;  
            margin-top: 3.5rem;
            border: 0.1rem solid black;
            grid-column: 2;
        }

        #score{
            top: 3vw;
            position: fixed;
            width: 50vw !important;
            margin-left: 25vw !important;
            margin-right: 25vw !important;
            background-color: #fff!important;
            display: none !important;
            border-radius: 10px;
            margin-top: 2vw;
            z-index: 1;
            padding: 1vw;
            padding-left: 2vw;
            color: #042A38;
        }
   
    @media screen and (max-width: 450px) {
        .navbar {
            display: initial !important;

        }

        .navbar>ul {
            display: initial !important;
            left: 25vw !important;
            text-align: center;
            right: 25vw !important;
        }

        .navbar>ul>li {
            background-color: orange !important;
        }

    section {
            text-align: center;
            margin-top: 0 !important;
            background-color: orange !important;
            width: 100vw;
            margin: 0 !important;
            }
    p{
            color:#042A38 !important;
     }
        
    }
    table{
        width: 90vw;
        margin-left: 5vw;
        margin-right: 5vw;
        align-content: center;
        border: 1px solid black;
    }
    thead{
        font-weight:900;
        font-size: 1.5vw;
    }
    td{
        width: auto;
        border: 1px solid black;
        text-align: center;
        height: 4vw;
        font-weight: bold;
   }
    #tq{
        text-decoration: underline;
        border: 3px solid #fff;
        padding: 0.5vw;
        border-radius: 10px;
    }
    #sc{
        width: 100% !important;
        margin: 0%;
        color: #042A38;
            }
    #le{
         margin-bottom: 2vw;
        }
    .scoreboard{
        justify-content: center;
        font-size:  1.5rem;
        color: #042A38;
        padding-left: 35%;
    }
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
<body style="color: #fff !important;font-weight:bolder;margin: 0 !important;font-weight: bolder !important;font-family: 'Roboto', sans-serif;">
    <div style="background-color: #042A38;height:auto;">
        <div class="navbar" style="display: grid;width: 85%;height:3rem;color:#042A38;position:fixed;border-radius:10rem;margin-top:1.5rem;margin-left:6.5rem;">
        <section style="margin-left: 3rem;height:3rem;display:grid;padding-top: 8px;padding-bottom: 3px; font-size: 1.5rem;font-family: 'Libre Baskerville', serif;">Quizzy</section>
            <ul style="display: inline-flex;padding: 0 !important;margin-top: 0;float: right;right: 10rem;top:0.8rem;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">Profile</li>
                <li onclick="score()">Score</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div><br><br>
        <?php
        $type1 = $_SESSION["type"];
        $username1 = $_SESSION["username"];
        $sql = "select * from " . $type1 . " where mail='{$username1}'";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            global $dbmail, $dbpw;
            while ($row = mysqli_fetch_array($res)) {
                $dbmail = $row['mail'];
                $dbname = $row['name'];
                $dbusn = $row['usn'];
                $dbphno = $row['phno'];
                $dbgender = $row['gender'];
                $dbdob = $row['DOB'];
                $dbdept = $row['dept'];
            }
        }
        ?>
        <center><section style="width:100vw;height:20rem;margin:0vw;margin-top:23rem;font-size:3vw;">Welcome to Quizzy&nbsp;<?php echo $dbname ?></section></center>
        <section style="color:#fff !important"><br><br><br><br><br>
        <?php 
            $sql ="select * from quiz";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<center><h1 style=\"font-size:2vw;\">Take any Quiz</h1></center>";
                echo "<center><table><thead><tr><td>Quiz Title</td><td>Created on</td><td>Created By</td><td>  </td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["date_created"]."</td><td>".$row["mail"]."</td><td><a id=\"tq\" href='takeq.php?qid=".$row['quizid']."'>Take Quiz</button></tr>"; 
                }
                echo "</table></center>";
            }
            ?>
        </section>
        <section class="prof" id="prof" style="display: grid;color:#042A38;">
        <div class="container1">
                <p><b>Type of user&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
                <p><b>Name &nbsp;:&nbsp;<?php echo $dbname ?></b></p>
                <p><b>Email &nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
                <p><b>Ph no &nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
                <p><b>USN &nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
                <p><b>Gender &nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
                <p><b>DOB &nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
                <p><b>Dept &nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </div>  
        <div class="container2">
            <img src=" images/user.png">
        </div>    
        </section>
        <section id="score" style="display:block;">
        <?php 
            $sql ="select * from score,quiz where score.mail='{$username1}' and score.quizid=quiz.quizid";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<small class=\"scoreboard\">Scoreboard</small>";
                echo "<table id=\"sc\"><thead><tr><td>Quiz Title</td><td>Score Obtained</td><td>Total Score</td><td>Remarks</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td><td>".$row["remark"]."</tr>"; 
                }
                echo "</table>";
            }
            else{
                echo " ".mysqli_error($conn);
            }
            ?><br><br><br>
            </section>
            <section style="color:#fff !important">
            <?php
            $sql="call leaderboard;";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<center><h1 style=\"font-size: 2vw\">Leaderboard</h1></center>";
                echo "<table id=\"le\"><thead><tr><td>Quiz Title</td><td>Score</td><td>Total Score</td><td>Student name</td><td>Student Mail ID</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td><td>".$row["name"]."</td><td>".$row["mail"]."</td></tr>"; 
                }
                echo "</table><br><br><br>";
            }
            else{
                echo mysqli_error($conn);
            }
            ?>
        </section>
    </div>
    <footer class="footer" style= "background: black; opacity: 0.9;  font-size: 1rem; height: 3.5rem;display:flex;">
        <div class="footer_copyright" style=" text-align: center;position:absolute; margin-left:42rem; color:white;" >
             <p style="padding-top: 0.01rem;">Copyright &copy; Quizzy 23</p>
        </div>
    </footer>
</body>
<?php
echo '<script>'.
"function prof(){".
"document.getElementById(\"prof\").style=\"display: grid !important;\";".
"document.getElementById(\"score\").style=\"display: none !important;\";".
"}".
"function score(){".
"document.getElementById(\"prof\").style=\"display: none !important;\";".
"document.getElementById(\"score\").style=\"display: grid !important;\";".
"}".
"function dash(){".
    "document.getElementById(\"prof\").style=\"display: none !important;\";".
    "document.getElementById(\"score\").style=\"display: none !important;\";".
    "}".
"function lo(){".
"alert(\"Thank You for Using our Quizzy\");";
//session_unset();
//session_destroy();
echo "window.location.replace(\"index.php\");".
"}</script>";
?>
</html>