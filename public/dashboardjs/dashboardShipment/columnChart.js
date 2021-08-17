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
            bottom: 30
        },
        vAxis: {
            gridlines:{
                color: '#e9e9e9',
                count: 10
            },
            minValue: 0
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
    dynamicMCC.draw(dataDynamicMcc, options_column);

}

function drawSentVsReceivedCustom(type) {
    google.load('visualization', '1.0', {'packages':['corechart']});

    var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
    var idPapermill = $('#id_papermill').val();

    var data = {
        startDates: startDates,
        endDates: endDates,
        id_papermills : idPapermill,
        type : type,
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var options_column = {
        height: 400,
        fontSize: 12,
        colors:['#2e53a1','#7dcdf3'],
        chartArea: {
            left: '5%',
            width: '90%',
            height: 350,
            bottom: 30
        },
        vAxis: {
            gridlines:{
                color: '#e9e9e9',
                count: 10
            },
            minValue: 0
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        }
    };

    $.ajax({
        type: "GET",
        url: "getSentVsReceivedCustom",
        data: data,
        success: function (data) {
            var dataSentVsReceived = google.visualization.arrayToDataTable(data.data.salesSentVsRecieved);

            sentVsReceived = new google.visualization.ColumnChart(document.getElementById('sentVsReceivedBar'));
            sentVsReceived.draw(dataSentVsReceived, options_column);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}

function drawMCCCustom(type) {
    google.load('visualization', '1.0', {'packages':['corechart']});

    var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
    var idPapermill = $('#id_papermill').val();

    var data = {
        startDates: startDates,
        endDates: endDates,
        id_papermills : idPapermill,
        type : type,
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var options_column = {
        height: 400,
        fontSize: 12,
        colors:['#2e53a1','#7dcdf3'],
        chartArea: {
            left: '5%',
            width: '90%',
            height: 350,
            bottom: 30
        },
        vAxis: {
            gridlines:{
                color: '#e9e9e9',
                count: 10
            },
            minValue: 0
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        }
    };

    $.ajax({
        type: "GET",
        url: "getMCCCustom",
        data: data,
        success: function (data) {
            var dataDynamicMcc = google.visualization.arrayToDataTable(data.data.dynamicsMcc);
            dynamicMCC = new google.visualization.ColumnChart(document.getElementById('dynamicMcc'));
            dynamicMCC.draw(dataDynamicMcc, options_column);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
