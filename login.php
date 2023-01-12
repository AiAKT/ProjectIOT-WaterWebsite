<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="style.css">
    <title>เข้าสู่ระบบ</title>
  
</head>
<style>
    body {
        background: #D3D3D3;
    }
</style>
<body>
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die($this->wpdb->last_error);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        }  else {
            echo "<div class='form'>
            <h3>Incorrect Username or Password</h3><br/>
            <center>
            <p class='link'>Click here to try login again</p><br/>
            <a href='login.php' class='login_btn'>Login</a>
            </center>
            </div>";
           
        }
    } else {
?>
    <form class="form" method="post" name="login">
    <h1 class="login-title">เข้าสู่ระบบ</h1>
            <center>
                <input type="text" name="username" class="form-control" required placeholder="Username" autofocus="true" />
                <!--<input type="text" class="login-input" name="username" placeholder="Username" autofocus="true" />-->
                <!--<input type="password" class="login-input" name="password" placeholder="Password" />-->
                <br />
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                <br />
                <button type="submit"  name="submit" class="btn btn-success">ยืนยัน</button>
                <button type="back"  class="btn btn-danger" onClick="back()">ย้อนกลับ</button>

                <script>
                    function back() {
                        window.location.href = "index.php";
                    }
                </script>

            </center>
            <br />
            <center>
                <p class="link">ยังไม่มีบัญชีผู้ใช้ ? <a href="registration.php">สมัครสมาชิก</a></p>
            </center>
  </form>
<?php
    }
?>
</body>
</html>