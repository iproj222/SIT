<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple Sidebar - Start Bootstrap Template</title>

  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

  

</head>

<body>

  <div class="d-flex" id="wrapper">

    
    <div class="bg-light border-right" id="sidebar-wrapper">
      <a href="/"><div class="sidebar-heading" >GPBL 2020 </div></a>
      <div class="list-group list-group-flush">
      <a href="reasonType" class="list-group-item list-group-item-action bg-light">Reason Type</a>
      <a href="lastPosition" class="list-group-item list-group-item-action bg-light">Last Position</a>
      <a href="OverWorkingTime" class="list-group-item list-group-item-action bg-light">OverWorkingTime</a>
      <a href="age" class="list-group-item list-group-item-action bg-light">Age</a>
      </div>
    </div>
    
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      </nav>

<div class="container-fluid">
<h1 class="mt-4">Reason Type</h1>
    <style>
      .chart{
          width : 600px !important;
          height : 600px !important;
      }
      .mt-4{ color : #555; }
    </style>

<div class="container">

    <canvas id="reasonTypeChart" class="chart"></canvas>

</div>

<ol>
    


</ol>

<?php

    $chart = array( "Personal Issues" => 0,
                    "Working Environment" => 0,
                    "CareerPath" => 0,
                    "Expired Contract" => 0,
                    "Continue Studying" => 0,
                    "Fired"=> 0,
                    "Better Salary" => 0);

    foreach($leaves as $key => $value){
        if($leaves[$key]->reason_type == "Personal Issues"){
            $chart["Personal Issues"]++;
        }
        else if($leaves[$key]->reason_type == "Working Environment"){
            $chart["Working Environment"]++;
        }
        else if($leaves[$key]->reason_type =="Continue Studying"){
            $chart["Continue Studying"]++;
        }
        else if($leaves[$key]->reason_type == "CareerPath"){
            $chart["CareerPath"]++;
        }
        else if($leaves[$key]->reason_type == "Expired Contract"){
            $chart["Expired Contract"]++;
        }
        else if($leaves[$key]->reason_type == "Better Salary"){
            $chart["Better Salary"]++;
        }
        else if($leaves[$key]->reason_type == "Fired"){
            $chart["Fired"]++;
        }
    }


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
    
    for (var i=0 ; i < 100 ; i++) 
        coloR.push(dynamicColors());


    var ctx = document.getElementById("reasonTypeChart");
    var reasonTypeChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                <?php 
                    foreach($chart as $key=>$value){
                        echo "'".$key."', ";
                }?>
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        <?php 
                            foreach($chart as $key=>$value){
                                echo "'".$value."', ";
                        }?>
                    ],
                    backgroundColor: coloR,
                    borderColor: coloR,
                    borderWidth: 1,
                    fontSize : 20
                }]
        },
        options: {
            title: {
                display: true,
                text: 'Reason Type',
                fontSize : 25
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
              },
        }
    } );
</script>
      </div>
    </div>

  </div>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  

  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>