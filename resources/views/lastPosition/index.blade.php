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
      <a href="lastPosition" class="list-group-item list-group-item-action bg-light">Last Position</a>
      <a href="OverWorkingTime" class="list-group-item list-group-item-action bg-light">OverWorkingTime</a>
      <a href="age" class="list-group-item list-group-item-action bg-light">Age</a>
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

      </nav>

      <div class="container-fluid">
        <h1 class="mt-4">Last Position</h1>
        <style>
            .chart{
                width : 550px !important;
                height : 550px !important;
                float : left;
            }
            .container{
              width : 1300px !important;
              text-align : center;
            }
            .chart2{
                width : 200px !important;
                height : 200px !important;
                float : left;
            }
            .mt-4{ color : #555; }
            h2{
                width : 1050px;
                color : #555;
            }
        </style>



<div class="container">

    <canvas id="oneYearChart" class="chart"></canvas>

    <canvas id="allChart" class="chart"></canvas>

    <h2> Top 5 Departments of Retirement Rate </h2>

    <canvas id="DEV2Chart" class="chart2"></canvas>

    <canvas id="DEV4Chart" class="chart2"></canvas>

    <canvas id="DEV3Chart" class="chart2"></canvas>

    <canvas id="QA2Chart" class="chart2"></canvas>

    <canvas id="DEV1Chart" class="chart2"></canvas>

</div>


<?php
    $connect = mysqli_connect("127.0.0.1", "root", "whd26235", "gpbl2019");
    $select_one = mysqli_query($connect," SELECT last_position , count(last_position)
                                          from leaves as l
                                          join employees as e
                                          on l.employee_number = e.employee_number
                                          where e.join_date is not null 
                                          group by (last_position);");
    
    $select_all = mysqli_query($connect,"SELECT lastPosition , count(lastPosition)
                                        from allLastPosition
                                        group by lastPosition;");
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

    for (var i=0 ; i < 100 ; i++) 
        coloR.push(dynamicColors());

    var octx = document.getElementById("oneYearChart");
    var oneChart = new Chart(octx, {
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
                text: "Left Employee's Last Position",
                fontSize : 35
            },
            legend: {
                labels: {
                    fontSize : 25
                }
            },
            tooltips: {
                  bodyFontSize : 35,
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
              }
        }
    } );

    

    var actx = document.getElementById("allChart");
    var allChart = new Chart(actx, {
        type: 'pie',
        data: {
            labels: [
                <?php while ($p = mysqli_fetch_array($select_all)){
                        echo "'".$p['lastPosition']."', ";
                  }?>
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        <?php 
                        $select_all = mysqli_query($connect, "SELECT lastPosition , count(lastPosition)
                                                            from allLastPosition
                                                            group by lastPosition;");
                        while ($p = mysqli_fetch_array($select_all)){
                            echo "'".$p['count(lastPosition)']."', ";
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
                text: "All Employee's Last Position",
                fontSize : 35
            },
            legend: {
                labels: {
                    fontSize : 25
                }
            },
            tooltips: {
                  bodyFontSize : 35,
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
              }
        }
    } );

    var ctxd2 = document.getElementById("DEV2Chart");
    var DEV2Chart = new Chart(ctxd2, {
        type: 'doughnut',
        data: {
            labels: ["DEV2","Others"],
            datasets: [{
                    label: 'doughnut chart',
                    data: ["20","59"],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Resignation rate of DEV2",
                fontSize : 65
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
                    text: '33.89%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    });

    var ctxd4 = document.getElementById("DEV4Chart");
    var DEV4Chart = new Chart(ctxd4, {
        type: 'doughnut',
        data: {
            labels: ["DEV4","Others"],
            datasets: [{
                    label: 'doughnut chart',
                    data: ["11","35"],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Resignation rate of DEV4",
                fontSize : 65
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
                    text: '31.42%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    });

    var ctxd3 = document.getElementById("DEV3Chart");
    var DEV3Chart = new Chart(ctxd3, {
        type: 'doughnut',
        data: {
            labels: ["DEV3","Others"],
            datasets: [{
                    label: 'doughnut chart',
                    data: ["14","45"],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Resignation rate of DEV3",
                fontSize : 65
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
                    text: '31.11%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    });

    var ctxqa2 = document.getElementById("QA2Chart");
    var QA2Chart = new Chart(ctxqa2, {
        type: 'doughnut',
        data: {
            labels: ["DEV3","Others"],
            datasets: [{
                    label: 'doughnut chart',
                    data: ["11","42"],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Resignation rate of QA2",
                fontSize : 65
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
                    text: '26.19%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    });

    var ctxd1 = document.getElementById("DEV1Chart");
    var DEV1Chart = new Chart(ctxd1, {
        type: 'doughnut',
        data: {
            labels: ["DEV1","Others"],
            datasets: [{
                    label: 'doughnut chart',
                    data: ["11","42"],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: "Resignation rate of DEV1",
                fontSize : 65
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
                    text: '24.19%',
                    color: 'rgba(54, 162, 235, 1)',
                    fontStyle: 'Arial', 
                    sidePadding: 20 
                        }
            }
        }
    });
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




