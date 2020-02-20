<html>
<body>
<style>
    .chart{
        width : 600px !important;
        height : 600px !important;
    }

</style>
<h1>JongHun</h1>
<ol>

<!--     
    @foreach ($leaves as $lev)
        <li>
            {{$lev->reason_note}}<br> 
            {{$lev->gender}}
        </li>
    @endforeach -->


</ol>

<div class="container">
    <canvas id="genderChart" class="chart"></canvas>

    <canvas id="noteChart" class="chart"></canvas>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

<?php
    $connect = mysqli_connect("127.0.0.1", "root", "whd26235", "gpbl2019");
    $selectG = mysqli_query($connect, "SELECT gender , count(gender) from leaves group by gender;");
    $selectN = mysqli_query($connect, "SELECT reason_note , count(reason_note) from leaves group by reason_note;");
    
?>

<?php 
    //print_r(mysqli_fetch_array($selectM)['count(gender)']);
    
    // while ($p = mysqli_fetch_array($selectG)){
    //     echo "'".$p['gender']."', ";
    // }

    // $male_count = mysqli_fetch_array($selectM)['count(gender)'];
    // $female_count = mysqli_fetch_array($selectF)['count(gender)'];

?>

<script>
    var gctx = document.getElementById("genderChart");
    
    var genderChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                <?php while ($p = mysqli_fetch_array($selectG)){
                        echo "'".$p['gender']."', ";
                  }?>
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        <?php 
                        $selectG = mysqli_query($connect, "SELECT gender , count(gender) from leaves group by gender;");
                        while ($p = mysqli_fetch_array($selectG)){
                            echo "'".$p['count(gender)']."', ";
                        }?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: 'gender'
            }
        }
    } );

    var nctx = document.getElementById("noteChart");
    
    var noteChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                <?php while ($p = mysqli_fetch_array($selectN)){
                        echo "'".$p['reason_note']."', ";
                  }?>
                  ],
            datasets: [{
                    label: 'pie chart',
                    data: [
                        <?php 
                        $selectN = mysqli_query($connect, "SELECT reason_note , count(reason_note) from leaves group by reason_note;");
                        while ($p = mysqli_fetch_array($selectN)){
                            echo "'".$p['count(reason_note)']."', ";
                        }?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            title: {
                display: true,
                text: 'gender'
            }
        }
    } );
</script>
</html>
