var myBarChart;
function drawActualTargetBar() {
    var startDates=  $("#dateRangeCollection").data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDates=  $("#dateRangeCollection").data('daterangepicker').endDate.format('YYYY-MM-DD');
    var data = {
        startDates: startDates,
        endDates: endDates,
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var options = {
        title: { display: !1, text: "Actual vs Target" },
        tooltips: { mode: "label" },
        responsive: !0,
        maintainAspectRatio: !1,
        responsiveAnimationDuration: 500,
        scales: {
            xAxes: [{
                stacked: true,
                id: "bar-x-axis1",
                barThickness: 70,
            }, {
                display: false,
                stacked: true,
                id: "bar-x-axis2",
                barThickness: 70,
                type: 'category',
                categoryPercentage: 0.8,
                barPercentage: 0.9,
                gridLines: {
                    offsetGridLines: true
                },
                offset: true
            }],
            yAxes: [{
                stacked: false,
                ticks: {
                    beginAtZero: true
                },
            }]

        }
    };

    $.ajax({
        type: "GET",
        url: "getActualTargetBar",
        data: data,
        success: function (data) {

            if (myBarChart) {
                myBarChart.destroy();
            }
            var dataChart = {
                labels: data.data.label,
                datasets: [{
                    label: "Actual",
                    backgroundColor: '#99B898',
                    // backgroundColor: 'rgba(22,211,154,.8)',
                    borderWidth: 1,
                    data: data.data.actual,
                    xAxisID: "bar-x-axis1",
                }, {
                    label: "Target",
                    backgroundColor: '#FECEA8',
                    // backgroundColor: 'rgba(81,117,224,.8)',
                    borderWidth: 1,
                    data: data.data.target,
                    xAxisID: "bar-x-axis2",
                }]
            };



            var a = $("#actual-target");
            myBarChart = new Chart(a , {
                type: 'bar',
                data: dataChart,
                options: options
            });

        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}
