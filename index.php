<?php session_start(); ?>
<html>

<head>
    <title>QUIZZY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
</head><?php
        if (isset($_POST['login'])) {
            if (isset($_POST['usertype']) && isset($_POST['username']) && isset($_POST['pass'])) {        require_once 'sql.php';
                $conn = mysqli_connect($servername, $username, $password, $dbname);if (!$conn) {
                    echo "<script>alert(\"Database error retry after some time !\")</script>";
                }
                $type = mysqli_real_escape_string($conn, $_POST['usertype']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['pass']);
                $password = crypt($password, 'rakeshmariyaplarrakesh');
                $sql = "select * from " . $type . " where mail='{$username}'";
                $res =   mysqli_query($conn, $sql);
                if ($res == true) {
                    global $dbmail, $dbpw;
                    while ($row = mysqli_fetch_array($res)) {
                        $dbpw = $row['pw'];
                        $dbmail = $row['mail'];
                        $_SESSION["name"] = $row['name'];
                        $_SESSION["type"] = $type;
                        $_SESSION["username"] = $dbmail;
                    }
                    if ($dbpw === $password) {
                        if ($type === 'student') {
                            header("location:homestud.php");
                        } elseif ($type === 'staff') {
                            header("Location: homestaff.php");
                        }
                    } elseif ($dbpw !== $password && $dbmail === $username) {
                        echo "<script>alert('password is wrong');</script>";
                    } elseif ($dbpw !== $password && $dbmail !== $username) {
                        echo "<script>alert('username name not found sing up');</script>";
                    }
                }
            }
        }
        ?>
<style>
    @media screen and (max-width: 620px) {
        input {
            height: 6vw !important;
        }

        .seluser {
            display: grid;
        }

        .sub {
            width: 20vw !important;
        }
    }

    .inp {
        box-sizing: content-box !important;
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
        font-size: 1.5vw;
    }

    form {
        font-size: 1.2vw;
        margin: 0;
    }

    button:hover {
        background-color: #fff !important;
    }

    .bg {
        background-size: 100%;
    }

    a {
        color: #042A38;
    }
		.login{
			max-height: 70vh;
		}
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">

<body style="margin:0;height: 100%;outline:none;color: #042A38 !important;padding-bottom:5vw;">
    <div class="bg" style="font-weight: bolder;background-image: url(./images/image.png);background-repeat: no-repeat;padding: 0;margin: 0;background-size: cover;font-family:  'Roboto', sans-serif;opacity: 0.9;height: 110%;">
        <center>
            <h1 class="w3-container" style=" margin:0;color:#fff;height: 4rem;width: auto;background-color:#000;border: 2px solid black;opacity: 0.7;padding-top:0%;font-family: 'Libre Baskerville', serif;">Quizzy</h1>
        </center>
        <center>
            <div class="w3-card" class="login" style="color: #042A38;width: 40vw;background-color: #ffffffab;border: 2px solid black;padding: 2vw;font-weight: bolder;margin-top: 10vh;border-radius: 10px;">
                <form method="POST">
                    <div class="seluser">
                        <input type="radio" name="usertype" value="student" required>STUDENT
                        <input type="radio" name="usertype" value="staff" required>STAFF
                    </div><br><br>
                    <div class="signin">

                        <label for="username" style="text-transform: uppercase;">Username</label><br><br>
                        <input type="email" name="username" placeholder=" Email" class="inp" required>
                        <br><br>
                        <label for="password" style="text-transform: uppercase;">Password</label><br><br>
                        <input type="password" name="pass" placeholder="******" class="inp" required>
                        <br><br>
                        <input name="login" class="sub" type="submit" value="Login" style="height: 3vw;width: 10vw;font-family:'Roboto', sans-serif ;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color:lightblue"><br>

                </form><br>
                 &nbsp; New user! <a href="signup.php">SIGN UP</a>
            </div>
    </div>
    </center>
    </div>
    <footer class="footer" style= "background: black; opacity: 0.9;  font-size: 1rem; height: 3.5rem;display:flex;">
        <div class="footer_copyright" style=" text-align: center;position:absolute; margin-left:45rem; color:white;" >
             <p style="padding-top: 0.01rem;">Copyright &copy; Quizzy 23</p>
        </div>
    </footer>
</body>
</html>