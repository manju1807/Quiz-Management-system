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
    $qname = $_SESSION['qname'];
    $sql = "select quizid from quiz where quizname='{$qname}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $qid;
        while ($row = mysqli_fetch_array($res)) {
            $qid = $row['quizid'];
        }
    }
    if (isset($_POST['submit'])) {
        $qs = $_POST["qs"];
        $op1 = $_POST["op1"];
        $op2 = $_POST["op2"];
        $op3 = $_POST["op3"];
        $ans = $_POST["ans"];
        $sql = "insert into questions(qs,op1,op2,op3,answer,quizid) values('$qs','$op1','$op2','$op3','$ans','$qid');";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            echo '<script>history.pushState({}, "", "");</script>';
        } elseif ($res != true) {
            echo '<script>alert("Question already exsits");</script>';
        }
    }
    if (isset($_POST['submit1'])) {
        $qs = $_POST["qs"];
        $op1 = $_POST["op1"];
        $op2 = $_POST["op2"];
        $op3 = $_POST["op3"];
        $ans = $_POST["ans"];
        $sql = "insert into questions(qs,op1,op2,op3,answer,quizid) values('$qs','$op1','$op2','$op3','$ans','$qid');";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            header("Location: homestaff.php");
        } elseif ($res != true) {
            echo '<script>alert("Question already exsits");</script>';
        }
    }
}
?>
<style>
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
        font-weight: 2vw !important;
    }

    .navbar {
        background-color: #fff!important;
        font-size: 1.5vw;
        position: fixed;
    }

    .navbar>ul>li:hover {
        color: black;
        text-decoration: underline;
        font-weight: bold;
        cursor: default;
        cursor: pointer;

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
        margin: 5vw;
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
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<body style="margin: 0 !important;font-weight: bolder !important;font-family: 'Roboto', sans-serif;color:#fff !important">
    <div style="background-color: #042A38;height: 100%;">
    <div class="navbar" style="display: grid;width: 85%;height:3rem;color:#042A38;position:fixed;border-radius:10rem;margin-top:1.5rem;margin-left:6.5rem;">
        <section style="margin-left: 3rem;display:grid;padding-top: 8px;padding-bottom: 3px; font-size: 1.5rem;">Quizzy</section>
            <ul style="display: inline-flex;padding: 0 !important;margin-top: 0;float: right;right: 10rem;top:0.8rem;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">profile</li>
                <li onclick="score()">Quiz's</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div><br><br>
        <section class="dash" style="margin-top:3vw">
            <section id="ans">
                <center>
                    <form style="margin: 0vw;width: 100vw" method="post">

                        <label for="quizname">Add Questions</label><br><br>
                        <div id="QS">
                            <label for="qs">Question</label>
                            <input type="text" name="qs" placeholder="enter question " required><br><br>
                            <label for="op1">Option 1</label>
                            <input type="text" name="op1" placeholder="option1" required><br><br>
                            <label for="op2">Option 2</label>
                            <input type="text" name="op2" placeholder="option2" required><br><br>
                            <label for="op3">Option 3</label>
                            <input type="text" name="op3" placeholder="option3" required><br><br>
                            <label for="ans">Answer &nbsp;</label>
                            <input type="text" name="ans" placeholder="answer" required><br><br>
                        </div>
                        <input type="submit" name="submit" value="add 1 more question" style="height: 3vw;width: auto;font-family: 'Roboto', sans-serif;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue;">
                        <input type="submit" name="submit1" value="Done" style="height: 3vw;width: auto;font-family: 'Roboto', sans-serif;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue;">
                    </form>
                </center>
            </section>
        </section>
        <section class="prof" id="prof" style="display: none;color:#042A38;">
        <div class="container1">
            <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
            <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
            <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
            <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
            <p><b>USN&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
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
    </div>
    <footer class="footer" style= "background: black; opacity: 0.9;  font-size: 1rem; height: 3.5rem;display:flex;">
        <div class="footer_copyright" style=" text-align: center;position:absolute; margin-left:45rem; color:white;" >
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
    "document.getElementById(\"score\").style=\"display: grid !important;\";" .
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
    "}" .

    "</script>";
?>

</html>