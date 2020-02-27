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
        <h1 class="mt-4">Age</h1>
        <style>
          .chart{
              width : 550px !important;
              height : 550px !important;
              float : left;
          }
          .container{
              width : 1300px !important;
          }
        </style>

<div class="container">

    <canvas id="allAgeChart" class="chart"></canvas>

    <canvas id="leftAgeChart" class="chart"></canvas>

    <canvas id="u20Chart" class="chart"></canvas>

    <canvas id="tttChart" class="chart"></canvas>

    <canvas id="ttfChart" class="chart"></canvas>

    <canvas id="o40Chart" class="chart"></canvas>

</div>

<<?php
    //                   <20  20-30 30-40  <40 
    //  all employee age   5 , 504 , 302 , 14
    // left employee age   0 , 156 , 120 , 3
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

    
    var actx = document.getElementById("allAgeChart");
    var allAgeChart = new Chart(actx, {
        type: 'pie',
        data: {
            labels: [
                      "<20" , "20-30" , "30-40" , "<40"
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        "5" , "504" , "302" , "14"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: 'All Age',
                fontSize : 40
            }
        }
    } );

    var lctx = document.getElementById("leftAgeChart");
    var leftAgeChart = new Chart(lctx, {
        type: 'pie',
        data: {
            labels: [
                      "<20" , "20-30" , "30-40" , "<40"
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        "0" , "156" , "120" , "3"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: 'Left Age',
                fontSize : 40
            }
        }
    } );

    var uctx = document.getElementById("u20Chart");
    var u20Chart = new Chart(uctx, {
        type: 'doughnut',
        data: {
            labels: [
                      "left" , "others" 
                  ],
            datasets: [{
                    label: 'doughnut',
                    data: [
                        "0" , "100"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: 'under 20',
                fontSize : 40
            }
        }
    } );

    //two to three
    var tttctx = document.getElementById("tttChart");
    var tttChart = new Chart(tttctx, {
        type: 'doughnut',
        data: {
            labels: [
                    "left" , "others" 
                  ],
            datasets: [{
                    label: 'doughnut',
                    data: [
                        "30.95" ,"69.05"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: '20-30',
                fontSize : 40
            }
        }
    } );

    var ttfctx = document.getElementById("ttfChart");
    var ttfChart = new Chart(ttfctx, {
        type: 'doughnut',
        data: {
            labels: [
                    "left" , "others" 
                  ],
            datasets: [{
                    label: 'doughnut',
                    data: [
                        "39.73" ,"61.27"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: '30-40',
                fontSize : 40
            }
        }
    } );

    var options = {
          tooltips: {
              enabled: false
          },
          plugins: {
              datalabels: {
                  formatter: (value, o40ctx) => {
                      let sum = 0;
                      let dataArr = o40ctx.chart.data.datasets[0].data;
                      dataArr.map(data => {
                          sum += data;
                      });
                      let percentage = (value*100 / sum).toFixed(2)+"%";
                      return percentage;
                  },
                  color: '#fff',
              }
          },
          title: {
                display: true,
                text: 'Over 40',
                fontSize : 40
            }
      };

    var o40ctx = document.getElementById("o40Chart");
    var o40Chart = new Chart(o40ctx, {
        type: 'doughnut',
        data: {
            labels: [
                    "left" , "others" 
                  ],
            datasets: [{
                    label: 'doughnut',
                    data: [
                        "21.42" ,"79.58"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: options
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




