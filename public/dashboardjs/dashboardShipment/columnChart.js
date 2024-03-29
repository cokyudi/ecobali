var sentVsReceived;
var dynamicMCC;
function drawSentVsReceived(data) {
    google.load('visualization', '1.0', {'packages':['corechart']});


    var dataSentVsReceived = google.visualization.arrayToDataTable(data.data.salesSentVsRecieved);
    var dataDynamicMcc = google.visualization.arrayToDataTable(data.data.dynamicsMcc);

    // Set chart options
    var options_column = {
        height: 400,
        fontSize: 12,
        colors:['#2e53a1','#7dcdf3'],
        chartArea: {
            left: '5%',
            width: '90%',
            height: 350,
            bottom: 60
        },
        vAxis: {
            gridlines:{
                color: '#e9e9e9',
                count: 10
            },
            minValue: 0,
            title: "UBC (Kg)"
        },
        hAxis: {
            title: "Interval"
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        }
    };

    // Set chart options
    var options_column_mcc = {
        height: 400,
        fontSize: 12,
        colors:['#2e53a1','#7dcdf3'],
        chartArea: {
            left: '5%',
            width: '90%',
            height: 350,
            bottom: 60
        },
        vAxis: {
            gridlines:{
                color: '#e9e9e9',
                count: 10
            },
            minValue: 0,
            title: "MCC (%)"
        },
        hAxis: {
            title: "Interval"
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        }
    };

    sentVsReceived = new google.visualization.ColumnChart(document.getElementById('sentVsReceivedBar'));
    sentVsReceived.draw(dataSentVsReceived, options_column);

    dynamicMCC = new google.visualization.ColumnChart(document.getElementById('dynamicMcc'));
    dynamicMCC.draw(dataDynamicMcc, options_column_mcc);

}

