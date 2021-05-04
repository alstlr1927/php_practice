google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

let data;

function drawChart() {
    data = google.visualization.arrayToDataTable([
        ['Year', 'Sales'],
        ['1994-05',  3],
        ['1994-06',  4],
        ['1995-02',  5],
        ['1995-11',  6],
        ['1998-05',  7],
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