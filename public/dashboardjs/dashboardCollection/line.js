function getLineChartData (type) {
    var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
    var idCategory = $('#id_category').val();
	var idDistrict = $('#id_district').val();
	var idParticipant =	$('#id_participant').val();
    var data = {
            startDates: startDates,
            endDates: endDates,
            idCategory: idCategory,
            idDistrict: idDistrict,
            idParticipant: idParticipant,
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
            var o = $("#line-chart");
            new Chart(o, {
                type: "line",
                options: {
                    responsive: !0,
                    maintainAspectRatio: !1,
                    legend: { position: "bottom" },
                    hover: { mode: "label" },
                    scales: {
                        xAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "Month", padding: 10, },ticks: {
                            padding: 10
                        } }],
                        yAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "Value", padding: 10 },ticks: { padding: 10}}],
                    },
                    title: { display: !0, text: "Chart.js Line Chart - Legend" },
                },
                data: {
                    labels: data.weekRanges,
                    datasets: [
                        {
                            label: "Collection",
                            data: data.weekCollections,
                            lineTension: 0,
                            fill: !1,
                            borderColor: "#FF7D4D",
                            pointBorderColor: "#FF7D4D",
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