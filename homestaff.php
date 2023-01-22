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
} else {
    $type1 = $_SESSION["type"];
    $username1 = $_SESSION["username"];
    $sql = "select * from " . $type1 . " where mail='{$username1}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $dbmail, $dbpw, $dbusn;
        while ($row = mysqli_fetch_array($res)) {
            $dbmail = $row['mail'];
            $dbname = $row['name'];
            $dbusn = $row['staffid'];
            $dbphno = $row['phno'];
            $dbgender = $row['gender'];
            $dbdob = $row['DOB'];
            $dbdept = $row['dept'];
        }
    }
    if (isset($_POST['submit'])) {
        $qname = strtolower($_POST['quizname']);
        $_SESSION["qname"]=$qname;
        $sql1 = "insert into quiz(quizname,mail) values('$qname','$username1')";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            $sql = "select quizid from quiz where quizname='" . $qname . "';";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                header("location: addqs.php");
            } else {
                echo "<script>alert(\"some error occured\");</script>";
            }
        } else {
            echo "<script>alert(\"Already name exists\");</script>";
        }
    }
    if (isset($_POST['submit1'])) {
        $qid1 = strtolower($_POST['quizid']);
        $sql1 = "delete from quiz where quizid='{$qid1}'";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            echo "<script>alert(\"Quiz successfully deleted\");</script>";
        } else {
            echo "<script>alert(\"Unknown error occured during deletion of quiz\");</script>";

        }
    }
    if (isset($_POST['submit2'])) {
        $qid1 =$_POST['quizid'];
        $sql1 = "select quizid from quiz where quizid='{$qid1}'";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            echo "<script>window.location.replace(\"viewq.php?qid=".$qid1."\");</script>";
        } else {
            echo "<script>alert(\"Unknown error occured during viweing of quiz\");</script>";

        }
    }
}
?>
<style>
    #main{
        min-height: 100% !important;
    }
    table{
        border: 1px solid black;
        width: 100% !important;
        font-weight: bolder;
        font-size: 2vw;
        color: #042A38;
    }
    td{
        border: 1px solid black;
        width: 20%;
        font-weight: bolder;
        font-size: 2vw;

    }
    li {
        margin: 1.5vw;
        font-size: 1rem !important;
    }

    ul {
        list-style: none;
        width: auto !important;
    }

    .navbar {
        background-color: #fff!important;
        font-size: 1.5vw;
        position: fixed;
        cursor: default;
        cursor: pointer;
    }

    .navbar>ul>li:hover {
        color: black;
        text-decoration: underline;
        font-weight: bold;

    }

    .navbar>ul>li>a:hover {
        color: black;
        text-decoration: underline;
        font-weight: bold !important;
    }

    a {
        text-decoration: none;
        color: #042A38;
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



    #score {
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

    button {
        height: 5vh;
        width: 10vw;
        background-color: lightgoldenrodyellow;
        color: black;
        outline: none;
        border: none;
        border-radius: 10px;
        margin: 1vw;
    }

    input {
        width: 30vw;
        height: 3vw;
        border-radius: 10px;
        border: 2px solid black;
        padding-left: 2vw;
        font-weight: bolder;
        outline: none;
    }

    ::placeholder {
        font-weight: bold;
        font-family: 'Roboto', sans-serif;
    }

    label {
        font-weight: bolder;
    }

    button:hover {
        background-color: blueviolet !important;
    }

    .bg {
        background-size: 100%;
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

        p {
            color: #042A38 !important;
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
    }
    #sc{
        width: 100% !important;
        margin: 0%;
        color: #042A38;
            }
            #le{
                width: 90vw;
                margin: 0;
                color: #fff;
            }
    #delq,#addq{
        width: 90vw;
        margin-left: 5vw;
        margin-right: 5vw;
        justify-content: center;
    }
    form{
        display: contents;
    }
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
<body style="margin: 0 !important;font-weight: bolder !important;font-family:'Roboto', sans-serif;height:auto;color:#fff">
    <div id="main" style="background-color: #042A38;height: auto;color:#fff !important">
    <div class="navbar" style="display: grid;width: 85%;height:3rem;color:#042A38;position:fixed;border-radius:10rem;margin-top:1.5rem;margin-left:6.5rem;">
    <section style="margin-left: 3rem;height:3rem;display:grid;padding-top: 8px;padding-bottom: 3px; font-size: 1.5rem;font-family: 'Libre Baskerville', serif;">Quizzy</section>
            <ul  style="display: inline-flex;padding: 0 !important;margin-top: 0;float: right;right: 10rem;top:0.8rem;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">profile</li>
                <li onclick="score()">Quiz's</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div><br><br> 
        <center><section style="width:100vw;margin:0vw;margin-top:4vw;font-size:2vw;">Welcome to Quizzy&nbsp;<?php echo $dbname ?></section></center>
        <section class="dash" style="margin: 5vw;width: 90vw;">
            <center><h1 style="font-weight:bolder;font-size:3vw">Dashbord</h1></center>
           <center> <button onclick="addquiz()">Add Quiz</button>            <button onclick="delquiz()">Delete Quiz</button>         <button onclick="viewq()">View Quiz</button></center>
           <center>
            <section id="addq" style="display:none;">
                <form style="width: 30vw" method="post">
                  
                        <h1>Add quiz</h1>
                        <label for="quizname">Quiz name</label>
                        <input type="text" name="quizname" placeholder="enter quiz name" required><br><br>
                        <input type="submit" name="submit" value="submit" style="height: 3vw;width: 10vw;font-family: 'Roboto', sans-serif;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue;">
                  
                </form>
            </section>  </center><center>
            <section id="delq" style="display:none;">
                <form style="margin: 1vw;width: 30vw" method="post">
                    
                        <h1>Delete Quiz</h1>
                        <label for="quizid">Quiz Id</label>
                        <input type="number" name="quizid" placeholder="enter quiz id" required><h7 onclick="score()" style="padding:0;color: #fff;font-size:1vw;text-decoration:underline">get Quiz ID</h7><br><br>
                        <input type="submit" name="submit1" value="submit" style="height: 3vw;width: 10vw;font-family: 'Roboto', sans-serif;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue;">
                    
                </form>
            </section></center>
            <center>
            <section id="viewq" style="display:none;">
                <form style="margin: 1vw;width: 30vw" method="post">
                    
                        <h1>View Quiz</h1>
                        <label for="quizid">Quiz Id</label>
                        <input type="number" name="quizid" placeholder="enter quiz id" required><h7 onclick="score()" style="padding:0;color: #fff;font-size:1vw;text-decoration:underline">get Quiz ID</h7><br><br>
                        <input type="submit" name="submit2" value="submit" style="height: 3vw;width: 10vw;font-family: 'Roboto', sans-serif;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue;">
                    
                </form>
            </section></center>

            <!-- <section id="ans" style="display: none;">
            <form style="margin: 5vw;width: 30vw" method="post">
                    <center>
                        <label for="quizname">Questions</label><br><br>
                        <div id="QS">
                        <input type="text" name="qs" placeholder="enter question " required><br><br>
                        <input type="text" name="op1" placeholder="option1" required><br><br>
                        <input type="text" name="op2" placeholder="option2" required><br><br>
                        <input type="text" name="op3" placeholder="option3" required><br><br>
                        <input type="text" name="ans" placeholder="answer" required><br><br>
                        </div>
                        <input type="submit" name="submit" value="submit" style="height: 3vw;width: 10vw;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue;">
                    </center>
                </form>
            </section> -->
        </section>
        <section class="prof" id="prof" style="display: none;color:#042A38;">
        <div class="container1">
            <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
            <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
            <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
            <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
            <p><b>STAFF ID.&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
            <p><b>GENDER&nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
            <p><b>DOB&nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
            <p><b>Dept.&nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </div>
        <div class="container2">
            <img src=" images/user.png">
        </div>
        </section>
        <section id="score" style="display:none;">
            <?php 
            $sql ="select * from quiz where mail='{$username1}'";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<h1>List of Quiz added by U</h1>";
                echo "<table id=\"sc\"><thead><tr><td>Quiz id</td>&nbsp;<td>Quiz Title</td><td>Created on</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizid"]."</td><td>".$row["quizname"]."</td><td>".$row["date_created"]."</td></tr>"; 
                }
                echo "</table>";
            }
            ?>
        </section>
        <section style="color:#fff !important">
            <?php
            $sql="select quizname,s.name,score,totalscore from student s,staff st,score sc,quiz q where q.quizid=sc.quizid and s.mail=sc.mail and q.mail=st.mail and q.mail='{$username1}' ORDER BY score DESC";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<center><h1 style=\"font-size: 3vw\">Leaderboard</h1></center>";
                echo "<table id=\"le\"><thead><tr><td>Quiz Title</td>&nbsp;<td>Student name</td><td>score obtained</td><td>Max Score</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["name"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td></tr>"; 
                }
                echo "</table><br><br>";
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
echo '<script>' .
    "function prof(){" .
    "document.getElementById(\"prof\").style=\"display: grid !important;\";" .
    "document.getElementById(\"score\").style=\"display: none !important;\";" .
    "}" .
    "function score(){" .
    "document.getElementById(\"prof\").style=\"display: none !important;\";" .
    "document.getElementById(\"score\").style=\"display: grid!important;\";" .
    "}" .
    "function dash(){" .
    "document.getElementById(\"prof\").style=\"display: none !important;\";" .
    "document.getElementById(\"score\").style=\"display: none !important;\";" .
    "}" .
    "function lo(){" .
    "alert(\"Thank You for Using our Quizzy\");";
    //session_unset();
//session_destroy();
echo "window.location.replace(\"index.php\");" .
    "}" .
    "function addquiz(){" .
    "document.getElementById(\"addq\").style=\"display: initial;\";" .
    "document.getElementById(\"delq\").style=\"display: none;\";" .
    "document.getElementById(\"viewq\").style=\"display: none;\";" .

    "}" .
    "function delquiz(){" .
        "document.getElementById(\"delq\").style=\"display: initial;\";" .
        "document.getElementById(\"addq\").style=\"display: none;\";" .
        "document.getElementById(\"viewq\").style=\"display: none;\";" .
        "}" .
        "function viewq(){" .
            "document.getElementById(\"viewq\").style=\"display: initial;\";" .
            "document.getElementById(\"delq\").style=\"display: none;\";" .
            "document.getElementById(\"addq\").style=\"display: none;\";" .
            "}" .

    "</script>";
?>
</html>