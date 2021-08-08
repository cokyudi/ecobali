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
        height: 300,
        fontSize: 12,
        colors: ["#E84A5F", "#99B898", "#FF847C", "#E84A5F", "#474747"],
        pieHole: 0.55,
        chartArea: { left: "5%", width: "90%", height: 350 },
    });

    var datamcc = google.visualization.arrayToDataTable(data.data.mcc);
    mcc = new google.visualization.PieChart(document.getElementById("donut_mcc")).draw(datamcc, {
        title: "",
        height: 300,
        fontSize: 12,
        colors: ["#E84A5F", "#99B898", "#FF847C", "#E84A5F", "#474747"],
        chartArea: { left: "5%", width: "90%", height: 350 },
    });
}

