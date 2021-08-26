var myLineChart;
function getLineChartData (type) {
    var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
    var idCategory = $('#id_category').val();
	var idDistrict = $('#id_district').val();
	var idParticipant =	$('#id_participant').val();
    var idRegency = $('#id_regency').val();

    var data = {
        startDates: startDates,
        endDates: endDates,
        idCategory: idCategory,
        idDistrict: idDistrict,
        idParticipant: idParticipant,
        idRegency: idRegency,
        type: type
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "GET",
        url: "getLineChartData",
        data: data,
        success: function (data) {
            if (myLineChart) {
                myLineChart.destroy();
            }
            var o = $("#line-chart");
            myLineChart = new Chart(o, {
                type: "line",
                options: {
                    responsive: !0,
                    maintainAspectRatio: !1,
                    legend: { position: "none" },
                    hover: { mode: "label" },
                    scales: {
                        xAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "Interval", padding: 10, },ticks: {
                            padding: 10
                        } }],
                        yAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "UBC (Kg)", padding: 10 },ticks: { padding: 10,beginAtZero: true}}],
                    },
                    title: { display: !0, text: "" },
                },
                data: {
                    labels: data.data.label,
                    datasets: [
                        {
                            label: "Collection",
                            data: data.data.qty,
                            fill: !1,
                            borderWidth: 5,
                            borderColor: "#7dcdf3",
                            pointBorderColor: "#2e53a1",
                            pointBackgroundColor: "#FFF",
                            pointBorderWidth: 2,
                            pointHoverBorderWidth: 2,
                            pointRadius: 4,
                        },
                    ],
                },
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

};
