function drawPie3dExploded() {
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
        url: "getContribution",
        data: data,
        success: function (data) {
            var e = google.visualization.arrayToDataTable(data.data);
            new google.visualization.PieChart(document.getElementById("pie-3d-exploded")).draw(e, {
                title: "Contribution",
                is3D: !0,
                height: 400,
                fontSize: 12,
                colors: ["#99B898", "#FECEA8", "#FF847C", "#E84A5F", "#474747"],
                chartArea: { left: "5%", width: "90%", height: 350 },
                slices: { 1: { offset: 0.2 }, 2: { offset: 0.15 }, 3: { offset: 0.16 }, 4: { offset: 0.12 } },
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
