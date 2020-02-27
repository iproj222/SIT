<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

  

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <a href="/"><div class="sidebar-heading" >GPBL 2020 </div></a>
      <div class="list-group list-group-flush">
      <a href="reasonType" class="list-group-item list-group-item-action bg-light">Reason Type</a>
        <a href="reasonNote" class="list-group-item list-group-item-action bg-light">Reason Note</a>
        <a href="lastPosition" class="list-group-item list-group-item-action bg-light">Last Position</a>
        <a href="period" class="list-group-item list-group-item-action bg-light">Period</a>
        <a href="maritalStatus" class="list-group-item list-group-item-action bg-light">Marital Status</a>
        <a href="gender" class="list-group-item list-group-item-action bg-light">Gender</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <h1 class="mt-4">Gender</h1>
        <style>
    .chart{
        width : 600px !important;
        height : 600px !important;
    }
</style>

<div class="container">

    <canvas id="GenderChart" class="chart"></canvas>

</div>

<<?php
    $connect = mysqli_connect("127.0.0.1", "root", "whd26235", "gpbl2019");
    $select = mysqli_query($connect, "SELECT gender,count(gender) from leaves group by gender;");
    // while ($p = mysqli_fetch_array($select)){
    //     print_r($p);
    //     echo "<br/>";
    // }
?>

<script>

    var coloR = [];
    var points = new Array(100);

    var dynamicColors = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        var a = Math.floor(Math.random() * 100);
        return "rgba(" + r + "," + g + "," + b + ","+ a +")";
    };
    

    coloR.push("rgba(54, 162, 235, 1)");
    coloR.push("rgba(255,99,132,1)");
    coloR.push("rgba(255, 206, 86, 1)");
    coloR.push("rgba(75, 192, 192, 1)");
    coloR.push("rgba(153, 102, 255, 1)");
    coloR.push("rgba(255, 159, 64, 1)");
    coloR.push("rgba(255, 99, 132, 0.2)");
    coloR.push("rgba(54, 162, 235, 0.2)");
    coloR.push("rgba(255, 206, 86, 0.2)");
    coloR.push("rgba(75, 192, 192, 0.2)");
    coloR.push("rgba(153, 102, 255, 0.2)");
    coloR.push("rgba(255, 159, 64, 0.2)");
    coloR.push("rgba(54, 162, 235, 1)");
    coloR.push("rgba(255,99,132,1)");
    for (var i=0 ; i < 100 ; i++) 
        coloR.push(dynamicColors());


    var ctx = document.getElementById("GenderChart");
    var reasonTypeChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                <?php while ($p = mysqli_fetch_array($select)){
                    
                        echo "'".$p['gender']."', ";

                  }?>
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        <?php 
                        $select = mysqli_query($connect, "SELECT gender,count(gender) from leaves group by gender;");
                        while ($p = mysqli_fetch_array($select)){
                            echo "'".$p['count(gender)']."', ";
                        }?>
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: 'Gender'
            }
        }
    } );
</script>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>




