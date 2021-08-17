var weightReduction;
var mcc;
function drawDonutPie(data) {
    google.load("visualization", "1.0", { packages: ["corechart"] });
    if (weightReduction || mcc) {
        weightReduction.destroy();
        mcc.destroy();
    }

    var dataweightReduction = google.visualization.arrayToDataTable(data.data.weightReduction);
    weightReduction = new google.visualization.PieChart(document.getElementById("pie_weight_reduction")).draw(dataweightReduction, {
        title: "",
        legend:'bottom',
        height: 400,
        fontSize: 12,
        colors: ["#7dcdf3", "#2e53a1", "#FF847C", "#E84A5F", "#474747"],
        pieHole: 0.55,
        chartArea: { left: "5%", width: "90%", height: 350 },
    });
    $('#weight_reduction_susut').html(data.data.weightReduction[1][1].toLocaleString());
    $('#weight_reduction_tidak_susut').html(data.data.weightReduction[2][1].toLocaleString());


    var datamcc = google.visualization.arrayToDataTable(data.data.mcc);
    mcc = new google.visualization.PieChart(document.getElementById("donut_mcc")).draw(datamcc, {
        title: "",
        legend:'bottom',
        height: 400,
        fontSize: 12,
        colors: ["#7dcdf3", "#2e53a1", "#FF847C", "#E84A5F", "#474747"],
        chartArea: { left: "5%", width: "90%", height: 350 },
    });
    $('#text_mcc').html(data.data.mcc[1][1].toLocaleString());
    $('#text_ubc').html(data.data.mcc[2][1].toLocaleString());
}

