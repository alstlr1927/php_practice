google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

let data;

function drawChart() {
    data = google.visualization.arrayToDataTable([
        ['Year', 'member_count'],
        ['2021.01.22',  2],
        ['2021.02.02',  3],
        ['2021.02.19',  4],
        ['2021.02.21',  6],
    ]);

    var options = {
        title: 'Company Performance',
        curveType: 'function',
        legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
}

function addArray(y) {
    let arr = ["", 10000];
    return arr;
}