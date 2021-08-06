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
                height: 400,
                fontSize: 12,
                colors: ["#E84A5F", "#99B898", "#FF847C", "#E84A5F", "#474747"],
                pieHole: 0.55,
                chartArea: { left: "5%", width: "90%", height: 350 },
            });
            var dataAnnual = google.visualization.arrayToDataTable(data.dataDonutYearly);
            donutAnnual = new google.visualization.PieChart(document.getElementById("donut_annual_papermill")).draw(dataAnnual, {
                title: "",
                height: 400,
                fontSize: 12,
                colors: ["#E84A5F", "#99B898", "#FF847C", "#E84A5F", "#474747"],
                pieHole: 0.55,
                chartArea: { left: "5%", width: "90%", height: 350 },
            });

        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}


