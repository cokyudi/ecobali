var myBarChartByMonth;
var pieChart;
var pieChartExplode;
function drawActualTargetBarByMonth(type) {
    google.load("visualization", "1.0", { packages: ["corechart"] });
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

            $('#annualTon').html(parseFloat((data.annualTarget/1000).toFixed(1)).toLocaleString());
            $('#annualKg').html(parseFloat(data.annualTarget.toFixed(1)).toLocaleString());

            $('#monthlyTon').html(parseFloat((data.monthlyTarget/1000).toFixed(1)).toLocaleString());
            $('#monthlyKg').html(parseFloat(data.monthlyTarget.toFixed(1)).toLocaleString());

            $('#eco_monthly_diff').html(data.dateDiff); //month different


            const months = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];

            for (var i = 0; i < months.length; i++) {
                $('#'+months[i]).removeClass("btn-secondary").removeClass("btn-success");
            }

            for (var i = 0; i < months.length; i++) {
                if(data.activeMonth.includes(months[i])) {
                    $('#'+months[i]).addClass("btn-success");
                } else {
                    $('#'+months[i]).addClass("btn-secondary");
                }
            }

            var e = google.visualization.arrayToDataTable(data.dataByMonth);
            myBarChartByMonth = new google.visualization.ComboChart(document.getElementById("combo-chart")).draw(e, {
                title: "",
                seriesType: "bars",
                series: { 1: { type: "line" } },
                colors: ["#7dcdf3", "#2e53a1", "#FF847C", "#E84A5F", "#474747"],
                height: 400,
                fontSize: 12,
                lineWidth: 5,
                chartArea: { left: "5%", width: "90%", height: 300 },
                vAxis: { title: "Target - Collection (UBC (Kg)", gridlines: { color: "#e9e9e9", count: 5 }, minValue: 0 },
                hAxis: { title: "Interval", gridlines: { color: "#e9e9e9", count: 5 }, minValue: 0 },
                legend: { position: "top", alignment: "center", textStyle: { fontSize: 12 } },
            });

            var dataPieChart = google.visualization.arrayToDataTable(data.dataPie);
            pieChart = new google.visualization.PieChart(document.getElementById("pie-3d")).draw(dataPieChart, {
                title: "",
                legend:'bottom',
                height: 250,
                fontSize: 12,
                colors: ["#7dcdf3", "#2e53a1", "#FF847C", "#E84A5F", "#474747"],
                pieHole: 0.55,
                chartArea: { left: "5%", width: "90%", height: 200 },
            });

            // $('#monthly_eco_target').html(data.targetByRange.toFixed(1).toLocaleString()); //Monthly Target Achievement (ecoBali) TARGET
            $('#monthly_eco_target').html(parseFloat((data.targetByRange).toFixed(1)).toLocaleString()); //Monthly Target Achievement (ecoBali) TARGET
            $('#monthly_eco_terkumpul').html(data.dataPie[2][1].toLocaleString());

            var dataPieExplode = google.visualization.arrayToDataTable(data.dataPieExplode);
            pieChartExplode = new google.visualization.PieChart(document.getElementById("pie-3d-exploded")).draw(dataPieExplode, {
                title: "",
                legend:'bottom',
                height: 250,
                fontSize: 12,
                colors: ["#7dcdf3", "#2e53a1", "#FF847C", "#E84A5F", "#474747"],
                pieHole: 0.55,
                chartArea: { left: "5%", width: "90%", height: 200 },
                // slices: { 1: { offset: 0.2 }, 2: { offset: 0.15 }, 3: { offset: 0.16 }, 4: { offset: 0.12 } },
            });

            $('#annual_eco_target').html(parseFloat((data.dataPieExplode[2][1]+data.dataPieExplode[1][1]).toFixed(1)).toLocaleString());
            $('#annual_eco_terkumpul').html(data.dataPieExplode[2][1].toLocaleString());
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}

