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
        <h1 class="mt-4">OverWorkingTime</h1>
        <style>
            .chart{
                width : 550px !important;
                height : 550px !important;
                float : left;
            }
            .donutChart{
                width : 180px !important;
                height : 180px !important;
                float : left;
            }
            .dChart{
                width : 340px !important;
                height : 340px !important;
                float : left;
            }
            .container{
              width : 1300px !important;
            }
            .div1{
              width : 550px !important;
              float : left;
            }
        </style>

<div class="container">
   
    <div class="div1">
      <canvas id="timeChart" class="chart"></canvas>

      <canvas id="time8Chart" class="donutChart"></canvas>

      <canvas id="time9Chart" class="donutChart"></canvas>

      <canvas id="time10Chart" class="donutChart"></canvas>
    </div>

    <div class="div1">
      <canvas id="allTimeChart" class="chart"></canvas>

      <canvas id="allTime8Chart" class="donutChart"></canvas>

      <canvas id="allTime9Chart" class="donutChart"></canvas>

      <canvas id="allTime10Chart" class="donutChart"></canvas>
    </div>

    <canvas id="bTime8Chart" class="dChart"></canvas>

    <canvas id="bTime9Chart" class="dChart"></canvas>

    <canvas id="bTime10Chart" class="dChart"></canvas>


</div>

<<?php
    $connect = mysqli_connect("127.0.0.1", "root", "whd26235", "gpbl2019");
    $select240 = mysqli_query($connect, " SELECT count(id)
                                          from avg_view
                                          where avg < 240;");
    // CREATE VIEW avg_view as
    // select leaves.employee_number as "id",avg(TIMESTAMPDIFF(MINUTE,checkin,checkout)) as "avg"
    // from checkin_outs
    // join leaves
    // on leaves.employee_number = checkin_outs.employee_number
    // where checkin is not null 
    // and checkout is not null 
    // and checkin > 0
    // and checkout > 0
    // group by leaves.employee_number;
?>

<script>

    Chart.pluginService.register({
        beforeDraw: function (chart) {
            if (chart.config.options.elements.center) {
            //Get ctx from string
            var ctx = chart.chart.ctx;

            //Get options from the center object in options
            var centerConfig = chart.config.options.elements.center;
            var fontStyle = centerConfig.fontStyle || 'Arial';
            var txt = centerConfig.text;
            var color = centerConfig.color || '#000';
            var sidePadding = centerConfig.sidePadding || 20;
            var sidePaddingCalculated = (sidePadding/100) * (chart.innerRadius * 2)
            //Start with a base font of 30px
            ctx.font = "30px " + fontStyle;

            //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
            var stringWidth = ctx.measureText(txt).width;
            var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

            // Find out how much the font can grow in width.
            var widthRatio = elementWidth / stringWidth;
            var newFontSize = Math.floor(30 * widthRatio);
            var elementHeight = (chart.innerRadius * 2);

            // Pick a new font size so it will not be larger than the height of label.
            var fontSizeToUse = Math.min(newFontSize, elementHeight);

            //Set font settings to draw it correctly.
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
            var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
            ctx.font = fontSizeToUse+"px " + fontStyle;
            ctx.fillStyle = color;

            //Draw text in center
            ctx.fillText(txt, centerX, centerY);
            }
        }
    });
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
    for (var i=0 ; i < 200 ; i++) 
        coloR.push(dynamicColors());

    var ctx = document.getElementById("timeChart");
    var timeChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                "Less Than 4Hours", "4Hours to 8Hours","More Than 8Hours"
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        "7","40","296"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Left employees's WorkingTime",
                fontSize : 35
            },
            tooltips: {
                  bodyFontSize : 20,
                  callbacks: {
                      label: function(tooltipItem, data) {
                          var allData = data.datasets[tooltipItem.datasetIndex].data;
                          var tooltipLabel = data.labels[tooltipItem.index];
                          var tooltipData = allData[tooltipItem.index];
                          var total = 0;
                          for (var i in allData) {
                              total += parseFloat(allData[i]);
                          }
                          var tooltipPercentage = Math.round((tooltipData / total)*10000)/100.0;
                          return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                      }
                  }
              },
              legend: { labels: { fontSize : 12 } }
        }
    } );

    var actx = document.getElementById("allTimeChart");
    var allTimeChart = new Chart(actx, {
        type: 'pie',
        data: {
            labels: [
                "Less Than 4Hours", "4Hours to 8Hours","More Than 8Hours"
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        "134","315","1049"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "All employees's WorkingTime",
                fontSize : 35
            },
            tooltips: {
                  bodyFontSize : 20,
                  callbacks: {
                      label: function(tooltipItem, data) {
                          var allData = data.datasets[tooltipItem.datasetIndex].data;
                          var tooltipLabel = data.labels[tooltipItem.index];
                          var tooltipData = allData[tooltipItem.index];
                          var total = 0;
                          for (var i in allData) {
                              total += parseFloat(allData[i]);
                          }
                          var tooltipPercentage = Math.round((tooltipData / total)*10000)/100.0;
                          return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                      }
                  }
              },
              legend: { labels: { fontSize : 12 } }
        }
    } );

    var ctx8 = document.getElementById("time8Chart");
    var Time8Chart = new Chart(ctx8, {
        type: 'doughnut',
        data: {
            labels: ["Over 8 hours for Left Employees","Others"],
            datasets: [{
                    label: 'doughnut chart',
                    data: [
                        "296","47"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Over 8 hours",
                fontSize : 35
            },
            cutoutPercentage: 64,
            animation: {
                animationRotate: true,
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            elements: {
				center: {
                    text: '86.29%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    });

    var ctx9 = document.getElementById("time9Chart");
    var Time9Chart = new Chart(ctx9, {
        type: 'doughnut',
        data: {
            labels: ["Over 9 hours for Left Employees","Others"],
            datasets: [{
                    label: 'doughnut chart',
                    data: ["265","78"],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Over 9 hours",
                fontSize : 35
            },
            cutoutPercentage: 64,
            animation: {
                animationRotate: true,
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            elements: {
				center: {
                    text: '77.25%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    });

    

    var ctx10 = document.getElementById("time10Chart");
    var Time10Chart = new Chart(ctx10, {
        type: 'doughnut',
        data: {
            labels: ["Over10","Others"],
            datasets: [{
                    label: 'doughnut chart',
                    data: ["84","259"],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Over 10 hours",
                fontSize : 35
            },
            cutoutPercentage: 64,
            animation: {
                animationRotate: true,
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            elements: {
				center: {
                    text: '24.48%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    });

    var actx8 = document.getElementById("allTime8Chart");
    var aTime8Chart = new Chart(actx8, {
        type: 'doughnut',
        data: {
            labels: [
                "70.02%","29.98%"
                  ],
            datasets: [{
                    label: 'doughnut chart',
                    data: [
                        "1049","449"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Over 8 hours",
                fontSize : 35
            },
            cutoutPercentage: 64,
            animation: {
                animationRotate: true,
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            elements: {
				center: {
                    text: '70.02%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    } );

    var actx9 = document.getElementById("allTime9Chart");
    var aTime9Chart = new Chart(actx9, {
        type: 'doughnut',
        data: {
            labels: ["59.87%","40.13%"],
            datasets: [{
                    label: 'doughnut chart',
                    data: [
                        "897","601"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Over 9 hours",
                fontSize : 35
            },
            cutoutPercentage: 64,
            animation: {
                animationRotate: true,
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            elements: {
				center: {
                    text: '59.87%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    } );

    var actx10 = document.getElementById("allTime10Chart");
    var aTime10Chart = new Chart(actx10, {
        type: 'doughnut',
        data: {
            labels: ["18.09%","81.91%"],
            datasets: [{
                    label: 'doughnut chart',
                    data: [
                        "271","1227"
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Over 10 hours",
                fontSize : 35
            },
            cutoutPercentage: 64,
            animation: {
                animationRotate: true,
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            elements: {
				center: {
                    text: '18.09%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                }
            }
        }
    } );
    
    var bctx8 = document.getElementById("bTime8Chart");
    var bTime8Chart = new Chart(bctx8, {
        type: 'doughnut',
        data: {
            labels: [
                "28.21%","71.79%"
                  ],
            datasets: [{
                    label: 'doughnut chart',
                    data: [
                        "296","1049" // 296 , 1049
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Resignation rate of More Than 8 Hours ",
                fontSize : 45
            },
            cutoutPercentage: 64,
            animation: {
                animationRotate: true,
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            elements: {
				center: {
                    text: '28.21%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                }
            }
        }
    } );

    var bctx9 = document.getElementById("bTime9Chart");
    var bTime9Chart = new Chart(bctx9, {
        type: 'doughnut',
        data: {
            labels: [
                "29.54%","70.46%"
                  ],
            datasets: [{
                    label: 'doughnut chart',
                    data: [
                        "265","897" // 265 , 897
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Resignation rate of More Than 9 Hours",
                fontSize : 45
            },
            cutoutPercentage: 64,
            animation: {
                animationRotate: true,
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            elements: {
				center: {
                    text: '29.54%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                }
            }
        }
    } );

    var bctx10 = document.getElementById("bTime10Chart");
    var bTime10Chart = new Chart(bctx10, {
        type: 'doughnut',
        data: {
            labels: [
                "30.99%","69.01%"
                  ],
            datasets: [{
                    label: 'doughnut chart',
                    data: [
                        "84","271" // 84 , 271
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Resignation rate of More Than 10 Hours",
                fontSize : 45
            },
            cutoutPercentage: 64,
            animation: {
                animationRotate: true,
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            elements: {
				center: {
                    text: '30.99%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                }
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




