function drawBar() {
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
            idRegency: idRegency
        }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "GET",
        url: "getBarContribution",
        data: data,
        success: function (data) {
            var e = google.visualization.arrayToDataTable(data.data);
            new google.visualization.BarChart(document.getElementById("bar-chart")).draw(e, {
                height: 450,
                fontSize: 12,
                chartArea: { left: "20%", width: "70%", height: "85%" },
                hAxis: { gridlines: { color: "#e9e9e9" },title: "UBC (Kg)" },
                vAxis: { gridlines: { count: 10 }, minValue: 0},
                legend: { position: "none" },
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
