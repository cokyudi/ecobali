var donutMonthly;
var donutAnnual;
function drawTargetPapermillDonut() {
    google.load("visualization", "1.0", { packages: ["corechart"] });
    var startDates=  $("#dateRangeSales").data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDates=  $("#dateRangeSales").data('daterangepicker').endDate.format('YYYY-MM-DD');
    var data = {
        startDates: startDates,
        endDates: endDates,
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "GET",
        url: "getTargetPapermillDonut",
        data: data,
        success: function (data) {
            if (donutMonthly || donutAnnual) {
                donutMonthly.destroy();
                donutAnnual.destroy();
            }

            var dataMonthly = google.visualization.arrayToDataTable(data.dataDonutMonthly);
            donutMonthly = new google.visualization.PieChart(document.getElementById("donut_monthly_papermill")).draw(dataMonthly, {
                title: "",
                legend:'bottom',
                height: 250,
                fontSize: 12,
                colors: ["#7dcdf3", "#2e53a1", "#FF847C", "#E84A5F", "#474747"],
                pieHole: 0.55,
                chartArea: { left: "5%", width: "90%", height: 250 },
            });
            // $('#monthly_papermill_target').html(parseFloat((data.dataDonutMonthly[2][1]+data.dataDonutMonthly[1][1]).toFixed(1)).toLocaleString());
            $('#monthly_papermill_target').html(parseFloat((data.targetByRange).toFixed(1)).toLocaleString());
            $('#monthly_papermill_terkumpul').html(data.dataDonutMonthly[2][1].toLocaleString());
            $('#papermill_monthly_diff').html(data.diffPapermill);



            var dataAnnual = google.visualization.arrayToDataTable(data.dataDonutYearly);
            donutAnnual = new google.visualization.PieChart(document.getElementById("donut_annual_papermill")).draw(dataAnnual, {
                title: "",
                legend:'bottom',
                height: 250,
                fontSize: 12,
                colors: ["#7dcdf3", "#2e53a1", "#FF847C", "#E84A5F", "#474747"],
                pieHole: 0.55,
                chartArea: { left: "5%", width: "90%", height: 250 },
            });
            $('#annual_papermill_target').html(parseFloat((data.dataDonutYearly[2][1]+data.dataDonutYearly[1][1]).toFixed(1)).toLocaleString());
            $('#annual_papermill_terkumpul').html(data.dataDonutYearly[2][1].toLocaleString());

        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}


