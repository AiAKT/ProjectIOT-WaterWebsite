<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="style.css">
    <title>สมัครสมาชิก</title>

</head>
<style>
    body {
        background: #D3D3D3;
    }
</style>

<body>
    <?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>สมัครสมาชิกสำเร็จ</h3><br/>
                  <center>
                  <a href='login.php' class='login_btn'>เข้าสู่ระบบ</a>
                  <a href='indexlogin.php' class='back_btn'>ย้อนกลับ</a>
                  </center>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>login_btn
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <form class="form" action="" method="post">
            <h1 class="login-title">สมัครสมาชิก</h1>
            <center>
                <input type="text" name="username" class="form-control" required placeholder="Username" autofocus="true" />
                <!--<input type="text" class="login-input" name="username" placeholder="Username" required />-->
                <br>
                <input type="email" name="email" class="form-control" class="form-control" placeholder="Email address" required autofocus>
                <!--<input type="text" class="login-input" name="email" placeholder="Email Adress">-->
                <br>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                <!--<input type="password" class="login-input" name="password" placeholder="Password">-->
                <br>
                <button type="submit"  name="submit" class="btn btn-success">ยืนยัน</button>
                <button type="back"  class="btn btn-danger" onClick="back()">ย้อนกลับ</button>

                <script>
                    function back() {
                        window.location.href = "index.php";
                    }
                </script>
                <br/>
                <br/>
                <p class="link">มีบัญชีผู้ใช้แล้ว ? <a href="login.php">เข้าสู่ระบบ</a></p>
        </form>
    <?php
    }
    ?>
</body>

</html>