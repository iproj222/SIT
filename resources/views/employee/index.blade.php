<html>
<body>
<h1>Hello, Global PBL Teams!</h1>
<ol>
    <!-- @foreach ($employees as $emp)
        <li>
            {{$emp->name}}<br> 
            birthday: {{ $emp->birthday }} <br>
            hometown: {{ $emp->hometown }} <br>
            address: {{ $emp->address }} <br>
            join date: {{ $emp->join_date }} <br>
            
        </li>
    @endforeach -->

</ol>

<div class="container">
    <canvas id="myChart" width="100" height="100"></canvas>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

<?php
    $connect = mysqli_connect("127.0.0.1", "root", "tung_abc123456", "gpbl2019");
    $selectB = mysqli_query($connect, "SELECT birthday FROM employees");
    $selectJ = mysqli_query($connect, "SELECT join_date FROM employees");
?>

<?php 
    // while($b = mysqli_fetch_array($selectB)){
    //     echo '"' . $b['birthday'] . '",';
    // }
?>

<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php while ($b = mysqli_fetch_array($selectB)) { echo '"' . $b['birthday'] . '",';}?>],
            datasets: [{
                    label: '# of Votes',
                    data: [<?php while ($p = mysqli_fetch_array($selectJ)) { echo '"' . $p['join_date'] . '",';}?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
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
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    } );
</script>

</body>
</html>
