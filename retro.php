<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<!--Export-->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<!---->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />


<head>
    <title>การติดตามสภาพแวดล้อมของแหล่งน้ำ</title>
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
</head>

<body>
    <header>

        <img src="KU4.png" width="Auto" height="45">

    </header>
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
        
        <div class="text-center">
            <button type="back" class="btn btn-danger" onclick="back()">Back</button>

    </center>
    
   
    <script>
        function back() {
            window.location.href = "index.php";
        }
    </script>
    <div class="header">
        <div class="content">
            <div class="footer">
                <center>
                    © 2020 Copyright:
                    <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
                </center>
            </div>
        </div>
    </div>
    <script type="text/javascript">
          $(document).ready(function() {
             $('#table_source').DataTable();
             $('.dataTables_length').addClass('bs-select');
    });
    </script>
</body>

</html>