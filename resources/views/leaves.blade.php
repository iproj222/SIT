<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
</head>
<body>
<style>
    /* .chart{
        width : 600px !important;
        height : 600px !important;
    } */

</style>

<h1> Pie Chart</h1>

<div class="container">

    <canvas id="genderChart" class="chart"></canvas>

    <canvas id="noteChart" class="chart"></canvas>

    <canvas id="positionChart" class="chart"></canvas>

</div>

<script>
getLeaves()
getNumberLeaves()
function getLeaves() {
    $.ajax({
        method: "GET",
        url: "http://localhost:8000/api/leaves",
        async: true,
    }).done(function(res) {
        labelsLeaves(res)
    }).fail(function(res) {
        return [];
    })
}
function getNumberLeaves() {
    $.ajax({
        method: "GET",
        url: "http://localhost:8000/api/leaves",
        async: true,
    }).done(function(res) {
        dataLeaves(res)
    }).fail(function(res) {
        return [];
    })
}

function labelsLeaves(res) {
    let labels = [];
    let data = [];
    res.map(reason => {
        if(!labels.includes(reason.reason_type)) {
            labels.push(reason.reason_type)
            console.log(reason.reason_type)

            var count = res.filter(x => x.reason_type == reason.reason_type).length
            data.push(count)
            console.log(count)

        }
    })
    labels[0] = "null"
    console.log(labels)
    console.log(data)
    return labels;
}

function dataLeaves(res) {
    let labels = [];
    let data = [];
    res.map(reason => {
        if(!labels.includes(reason.reason_type)) {
            labels.push(reason.reason_type)
            console.log(reason.reason_type)

            var count = res.filter(x => x.reason_type == reason.reason_type).length
            data.push(count)
            console.log(count)

        }
    })
    labels[0] = "null"
    return data;
}

var label = getLeaves()
var dat = getNumberLeaves()

var gctx = document.getElementById("genderChart");
    var genderChart = new Chart(gctx, {
        type: 'pie',
        data: {
            labels: label,
            datasets: [{
                    label: 'pie chart',
                    data: dat,
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
                text: 'Gender'
            }
        }
    } );
</script>
</body>
</html>