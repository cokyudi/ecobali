var myLineChart;
function getComparisonLineChartData (type) {
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
        url: "getComparisonLineChartData",
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
                    legend: { position: "bottom" },
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
                    labels: data.intervalss,
                    datasets: data.participantsCollections
                },
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

};
