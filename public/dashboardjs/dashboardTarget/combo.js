
var myBarChartByMonth;
var pieChart;
var pieChartExplode;
function drawActualTargetBarByMonth(type) {
    var startDates=  $("#dateRangeCollection").data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDates=  $("#dateRangeCollection").data('daterangepicker').endDate.format('YYYY-MM-DD');
    var data = {
        startDates: startDates,
        endDates: endDates,
        type:type,
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "GET",
        url: "getActualTargetBarByMonth",
        data: data,
        success: function (data) {

            if (myBarChartByMonth || pieChart) {
                myBarChartByMonth.destroy();
                pieChart.destroy();
                pieChartExplode.destroy();
            }
            var e = google.visualization.arrayToDataTable(data.dataByMonth);

            myBarChartByMonth = new google.visualization.ComboChart(document.getElementById("combo-chart")).draw(e, {
                title: "",
                seriesType: "bars",
                series: { 1: { type: "line" } },
                colors: ["#99B898", "#FECEA8", "#FF847C", "#E84A5F", "#474747"],
                height: 450,
                fontSize: 12,
                chartArea: { left: "5%", width: "90%", height: 350 },
                vAxis: { title: "Target", gridlines: { color: "#e9e9e9", count: 5 }, minValue: 0 },
                hAxis: { title: "Month", gridlines: { color: "#e9e9e9", count: 5 }, minValue: 0 },
                legend: { position: "top", alignment: "center", textStyle: { fontSize: 12 } },
            });

            var dataPieChart = google.visualization.arrayToDataTable(data.dataPie);
            pieChart = new google.visualization.PieChart(document.getElementById("pie-3d")).draw(dataPieChart, {
                title: "",
                is3D: !0,
                height: 400,
                fontSize: 12,
                colors: ["#E84A5F", "#99B898", "#FF847C", "#E84A5F", "#474747"],
                chartArea: { left: "5%", width: "90%", height: 350 },
            });

            var dataPieExplode = google.visualization.arrayToDataTable(data.dataPieExplode);
            pieChartExplode = new google.visualization.PieChart(document.getElementById("pie-3d-exploded")).draw(dataPieExplode, {
                is3D: !0,
                height: 400,
                fontSize: 12,
                colors: ["#E84A5F", "#99B898", "#FF847C", "#E84A5F", "#474747"],
                chartArea: { left: "5%", width: "90%", height: 350 },
                slices: { 1: { offset: 0.2 }, 2: { offset: 0.15 }, 3: { offset: 0.16 }, 4: { offset: 0.12 } },
            });





        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}

