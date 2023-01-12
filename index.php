<!DOCTYPE html>
<html>

<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <title>KU SRC|สภาพอวดล้อมของแหล่งน้ำ</title>

<!--script type="text/javascript">
     $(document).ready(function() 
     {
	setInterval(function() {
        $("#autodata").load("index.php");
	refresh();
        }, 10000);
    });
</script-->

	<!--1800-->
<?php
    header("refresh: 10;");
?>

</head>
<style>
    body {
        margin: 0;
        font-family: Arial
    }

    * {
        margin: 0;
        padding: 0
    }

    html {
        position: relative;
        min-height: 100%;
    }

    body {
        margin: 0 0 100px;
    }

    table {
        width: 750px;
        border-collapse: collapse;
        margin: 50px auto;
    }

    /* Zebra striping */


    th {
        background: #F0F8FF;
        color: black;
    }



    td,
    th {
        padding: 10px;
        border: 1px solid #9C9C9C;
        text-align: left;
        font-size: 18px;
        font-weight: normal;
        width: 37%;

    }

    /* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        table {
            width: 100%;
        }

        /* Force table to not be like tables anymore */
        table,
        thead,
        tbody,
        th,
        td,
        tr {

            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;

        }

        td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 40%;
            padding-right: 10px;
            white-space: nowrap;
            /* Label the data */
            content: attr(data-column);

            color: #000;

        }

    }

    .position {
        text-align: center;
    }

    .status_red {
        background-color: #FF0000;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        font-size: 15px;
        text-decoration: none;
        display: inline-block;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 16px;
    }

    .status_green {
        background-color: #228B22;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        font-size: 15px;
        text-decoration: none;
        display: inline-block;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 16px;
    }
</style>

<body>

    <div class="topnav" id="myTopnav">
        <img src="KU4.png" width="Auto" height="45">

        <div class="dropdown">
            <button class="dropbtn">ผู้ดูและระบบ
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="registration.php">สมัครสมาชิก</a>
                <a href="login.php">เข้าสู่ระบบ</a>
            </div>
        </div>
        <a href="retro.php">ข้อมูลย้อนหลัง</a>
        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>


    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
    <script language="javascript">
        now = new Date();
        var thday = new Array("อาทิตย์", "จันทร์",
            "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์");
        var thmonth = new Array("มกราคม", "กุมภาพันธ์", "มีนาคม",
            "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน",
            "ตุลาคม", "พฤศจิกายน", "ธันวาคม");


        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            // add a zero in front of numbers<10
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt_time').innerHTML = "เวลา " + h + ":" + m + ":" + s + " น.";
            t = setTimeout(function() {
                startTime()
            }, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
    </script>

    <br />
    &nbsp;&nbsp; &nbsp;
    <a class="ct_btn">
        <script>
            document.write("วัน" + thday[now.getDay()] + "ที่ " + now.getDate() + " " + thmonth[now.getMonth()] + " " + (0 + now.getFullYear() + 543));
        </script>
    </a>

    </br>
    </br>
    <center>
        <h5 class="title">Wireless water source Environment Monitoring prototype</h5>
        <p class="title"> ชุดอุปกรณ์ต้นแบบตรวจติดตามสภาพแวดล้อมของแหล่งน้ำผ่านระบบสัญญานไร้สาย </p>
        <hr width=40% size=1 color=#DCDCDC> <br />
        <div id="autodata">
	<table>
            <tbody>
                <tr>
                    <th class="position">ค่าPHของน้ำ</th>
                    <td data-column="ค่าPHของน้ำ" class="position">
<?php
    require('db.php');
    

$sql = "SELECT PH FROM water_quality ORDER BY record_datetime DESC LIMIT 1";
$result = $con->query($sql);
foreach( $result as $value ) {
	$number = $value["PH"];
	echo $value["PH"];
}
?>		    
                    </td>
                    <td data-column="">
                        <script language="JavaScript">
                            function fncOpenPopupPh() {
                                window.open('ph.php', 'เกณฑ์การเตือนของเซ็นเซอร์Ph', 'width=400,height=200,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
                            }
                        </script>


                        <form name="frmMain" action="" method="post">
                            <a class="fa fa-question-circle" style="text-decoration:none; font-size:21px; color:#DCDCDC; float:right;" value="OpenPopup" OnClick="fncOpenPopupPh();" href="#"></a>

                            <?php
                            if ($number == 7) {
                                echo "<button class='status_green'>ค่าเป็นกลาง</button>";
                            } else if ($number <= 7) {
                                echo "<button class='status_red'>ค่าเป็นกรด";
                            } else if ($number >= 7) {
                                echo "<button class='status_yellow'>ค่าเป็นด่าง";
                            }
                            ?>

                    </td>
                </tr>

                <tr>
                    <th class="position">ค่าอุณหภูมิของน้ำ</th>

                    <td data-column="ค่าอุณหภูมิของน้ำ" class="position">
<?php
$sql = "SELECT temp FROM water_quality ORDER BY record_datetime DESC LIMIT 1";
$result = $con->query($sql);
foreach( $result as $value ) {
	$number = $value["temp"];
	echo $value["temp"];
}
?>
                    </td>

                    <td data-column="">
                        <script language="JavaScript">
                            function fncOpenPopuptem() {
                                window.open('temper.php', 'เกณฑ์การเตือนของเซ็นเซอร์ค่าอุณหภูมิของน้ำ', 'width=400,height=200,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
                            }
                        </script>


                        <form name="frmMain" action="" method="post">
                            <a class="fa fa-question-circle" style="text-decoration:none; font-size:21px; color:#DCDCDC; float:right;" value="OpenPopup" OnClick="fncOpenPopuptem();" href="#"></a>

                            <?php
                            if ($number >= 25 && $number <= 32) {
                                echo "<button class='status_green'>ค่าอุณหภูมิปกติ</button>";
                            } else if ($number > 32) {
                                echo "<button class='status_red'>ค่าอุณหภูมิสูง</button>";
                            } else if ($number < 25) {
                                echo "<button class='status_yellow'>ค่าอุณหภูมิต่ำ</button>";
                            } else {
                            }
                            ?>

                    </td>

                </tr>
                <tr>
                    <th class="position">ค่าความขุ่นของน้ำ</th>
                    <td data-column="ค่าความขุ่นของน้ำ" class="position">
<?php
$sql = "SELECT cloudy FROM water_quality ORDER BY record_datetime DESC LIMIT 1";
$result = $con->query($sql);
foreach( $result as $value ) {
	$number = $value["cloudy"];
	echo $value["cloudy"];
}
?>
                    </td>
                    <td data-column="">
                        <script language="JavaScript">
                            function fncOpenPopup() {
                                window.open('turbidity.php', 'เกณฑ์การเตือนของเซ็นเซอร์ค่าความขุ่นของน้ำ', 'width=400,height=200,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
                            }
                        </script>


                        <form name="frmMain" action="" method="post">
                            <a class="fa fa-question-circle" style="text-decoration:none; font-size:21px; color:#DCDCDC; float:right;" value="OpenPopup" OnClick="fncOpenPopup();" href="#"></a>

                            <?php
                            if ($number < 25) {
                                echo "<button class='status_green'>ค่าความขุ่นปกติ</button>";
                            } else if ($number >= 25 && $number <= 100) {
                                echo "<button class='status_yellow'>ค่าความขุ่นปานกลาง</button>";
                            } else if ($number > 100) {
                                echo "<button class='status_red'>ค่าความขุ่นสูง</button>";
                            } else {
                            }
                            ?>




                    </td>

                </tr>
                <tr>
                    <th class="position">ระดับน้ำ</th>
                    <td data-column="ระดับน้ำ" class="position">
<?php
$sql = "SELECT level FROM water_quality ORDER BY record_datetime DESC LIMIT 1";
$result = $con->query($sql);
foreach( $result as $value ) {
	$number = $value["level"];
	echo $value["level"];
}
?>
                    </td>
                    <td>
					<button class='status_green'>ระดับน้ำปกติ</button>
                    </td>
                </tr>


            </tbody>
        </table>
	</div>
    </center>
    <script type="text/javascript" src="https://www.counters-free.net/count/9gv1 hide()"></script>
    <br />
    <div class="header">
        <div class="content">
            <div class="footer">
                <br />
                <center>
                    © 2020 Copyright
                    <!--<a class="link" href="https://mdbootstrap.com/">MDBootstrap.com</a>-->
                </center>
            </div>
        </div>
    </div>
</body>

</html>