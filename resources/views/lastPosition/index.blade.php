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
        <a href="OverWorkingTime" class="list-group-item list-group-item-action bg-light">OverWorkingTime</a>
        <a href="age" class="list-group-item list-group-item-action bg-light">Age</a>
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
        <h1 class="mt-4">Last Position</h1>
        <style>
            .chart{
                width : 600px !important;
                height : 600px !important;
                float : left;
                margin : 40px;
            }
            .container{
              width : 1100px;
            }
        </style>



<div class="container">

    <canvas id="oneYearChart" class="chart"></canvas>

    <canvas id="twoYearChart" class="chart"></canvas>

    <canvas id="extendChart" class="chart"></canvas>

</div>


<<?php
    $connect = mysqli_connect("127.0.0.1", "root", "whd26235", "gpbl2019");
    $select_one = mysqli_query($connect," SELECT last_position , count(last_position)
                                          from leaves as l
                                          join employees as e
                                          on l.employee_number = e.employee_number
                                          where e.join_date is not null 
                                          and DATEDIFF(l.period, e.join_date) <= 365
                                          and DATEDIFF(l.period, e.join_date) > 0
                                          group by (last_position);");
    $select_two = mysqli_query($connect," SELECT last_position , count(last_position)
                                          from leaves as l
                                          join employees as e
                                          on l.employee_number = e.employee_number
                                          where e.join_date is not null 
                                          and DATEDIFF(l.period, e.join_date) > 365
                                          and DATEDIFF(l.period, e.join_date) <= 730
                                          group by (last_position);");
    $select_ex = mysqli_query($connect,"SELECT last_position , count(last_position)
                                        from leaves as l
                                        join employees as e
                                        on l.employee_number = e.employee_number
                                        where e.join_date is not null 
                                        and DATEDIFF(l.period, e.join_date) > 730
                                        group by (last_position);");
    
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

    var octx = document.getElementById("oneYearChart");
    var reasonTypeChart = new Chart(octx, {
        type: 'pie',
        data: {
            labels: [
                <?php while ($p = mysqli_fetch_array($select_one)){
                    
                        echo "'".$p['last_position']."', ";

                  }?>
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        <?php 
                        $select_one = mysqli_query($connect, "SELECT last_position , count(last_position)
                                                              from leaves as l
                                                              join employees as e
                                                              on l.employee_number = e.employee_number
                                                              where e.join_date is not null 
                                                              and DATEDIFF(l.period, e.join_date) <= 365
                                                              and DATEDIFF(l.period, e.join_date) > 0
                                                              group by (last_position);");
                        while ($p = mysqli_fetch_array($select_one)){
                            echo "'".$p['count(last_position)']."', ";
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
                text: 'Zero to One year',
                fontSize : 35
            }
        }
    } );

    var octx = document.getElementById("twoYearChart");
    var reasonTypeChart = new Chart(octx, {
        type: 'pie',
        data: {
            labels: [
                <?php while ($p = mysqli_fetch_array($select_two)){
                        echo "'".$p['last_position']."', ";
                  }?>
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        <?php 
                        $select_two = mysqli_query($connect, "SELECT last_position , count(last_position)
                                                              from leaves as l
                                                              join employees as e
                                                              on l.employee_number = e.employee_number
                                                              where e.join_date is not null 
                                                              and DATEDIFF(l.period, e.join_date) <= 730
                                                              and DATEDIFF(l.period, e.join_date) > 365
                                                              group by (last_position);");
                        while ($p = mysqli_fetch_array($select_two)){
                            echo "'".$p['count(last_position)']."', ";
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
                text: 'One year to Two years',
                fontSize : 35
            }
        }
    } );

    var octx = document.getElementById("extendChart");
    var reasonTypeChart = new Chart(octx, {
        type: 'pie',
        data: {
            labels: [
                <?php while ($p = mysqli_fetch_array($select_ex)){
                        echo "'".$p['last_position']."', ";
                  }?>
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        <?php 
                        $select_ex = mysqli_query($connect, "SELECT last_position , count(last_position)
                                                              from leaves as l
                                                              join employees as e
                                                              on l.employee_number = e.employee_number
                                                              where e.join_date is not null 
                                                              and DATEDIFF(l.period, e.join_date) > 730
                                                              group by (last_position);");
                        while ($p = mysqli_fetch_array($select_ex)){
                            echo "'".$p['count(last_position)']."', ";
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
                text: 'More than Two years',
                fontSize : 35
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




