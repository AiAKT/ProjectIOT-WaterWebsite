<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  <title>Dashboard - Admin</title>

</head>
<style>
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
button {
            text-align: center;
        }

        .table {

            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 0.5px solid #A9A9A9;
            text-align: center;
            padding: 8px;
            font-weight: 200;
        }


        tr:nth-child(odd) {
            background: #F8F8FF;
        }

        tr:nth-child(even) {
            background-color: #FFFFFF;
        }
</style>

<body>

  <header>


    <div id="header-image-menu">
      <img src="http://www.polsci.soc.ku.ac.th/wp-content/uploads/2020/02/KU4.png" width="Auto" height="45">

      <position>
        <div class="bodyfrom">
          <div class="email" onclick="this.classList.add('expand')">
            <div class="from">
              <div class="from-contents">
                <div class="avatar me"></div>
                <div class="name"> <?php echo $_SESSION['username']; ?> </div>
              </div>
            </div>
            <div class="to">
              <div class="to-contents">
                <div class="top">
                  <div class="avatar-large me"></div>
                  <div class="name-large">Username : <?php echo $_SESSION['username']; ?></div>
                  <!----X to close---->
                  <div class="x-touch" onclick="document.querySelector('.email').classList.remove('expand');event.stopPropagation();">
                    <div class="x">
                      <div class="line1"></div>
                      <div class="line2"></div>
                    </div>
                  </div>
                </div>
                <!----button logout---->
                <div class="bottom">
                  <div class="row">
                    <br />
                    <center>
                      <a href="logout.php" class="logout_btn" style="text-decoration:none">Logout</a>
                    </center>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </position>

    <!-- <script language="JavaScript">
        function fncOpenPopup() {
          window.open('popup2.html', 'popup-name', 'width=500,height=200,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
        }
      </script>
     
      <form name="frmMain" action="" method="post" class=" btn btn-outline-light ">
        <input type="button" name="btnOpen" value="OpenPopup" OnClick="fncOpenPopup();">
      </form>-->

      
    



        <!--<button type="button" class=" btn btn-outline-success btn-sm">
                    <p><?php echo $_SESSION['username']; ?>!</p>
            <input class="input-field" type="text" value= <?php echo $_SESSION['username']; ?>! readonly>-->
      </button>

    </div>


  </header>
<br/>

    <center>
        <br/>
        <br/>
    <div class="page-content page-container" id="page-content">
        <div class="col-lg-10 grid-margin stretch-card">
                <h5 class="title">ข้อมูลการติดตามสภาพแวดล้อมของแหล่งน้ำย้อนหลัง</h5>
                <hr width=50% size=3 color=ff0088> <br />
                <table id="table_source" class=" table table-responsive-sm table-hover">
                    <thead>
                        <tr>
                            <th>วันที่และเวลา</th>
                            <th>ค่า PH ของน้ำ</th>
                            <th>ค่าอุณหภูมิของน้ำ</th>
                            <th>ค่าความขุ่นของน้ำ</th>
                            <th>ปริมาณของน้ำ</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
<?php
    require('db.php');
    

$sql = "SELECT record_datetime, PH, temp,cloudy,level FROM water_quality";
$result = $con->query($sql);

foreach( $result as $value ) {
  echo "<tr>";
    echo "<td>" .$value["record_datetime"] .  "</td> ";
    echo "<td>" .$value["PH"] .  "</td> ";
    echo "<td>" .$value["temp"] .  "</td> ";
    echo "<td>" .$value["cloudy"] .  "</td> ";
    echo "<td>" .$value["level"] .  "</td> ";
  echo "</tr>";
  }
?>
                            
                    </tbody>
                </table>
            
        </div>
    </div>
    </center>
    <br/>
    <center>
        <button onclick="ExportToExcel('xlsx')" class="btn btn-info">พิมพ์ตารางเป็นไฟล์ Excle</button>
        <br /> <br /> <br />
        <div class="text-center">
           

    </center>
    
    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('table_source');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('ข้อมูลสภาพแวดล้อมของแหล่งน้ำย้อนหลัง.' + (type || 'xlsx')));
        }
    </script>
<br/>
<br/>
<br/>
<br/>
 
  <div class="header">
    <div class="content">
      <div class="footer-dash">
        <div class ="link">
        <br/>
       <center>
 <button class="visitor_btn">จำนวนผู้เข้าชมเว็บไซต์<br/><br/><script type="text/javascript" src="https://www.counters-free.net/count/9gv1"></script></button><br/>
             © 2021 Copyright:
                 <a  href="https://environmentwatersource.000webhostapp.com/">environmentwatersource.com</a>
        </center>
        </div>
      </div>
    </div>
  </div>

</body>

</html>