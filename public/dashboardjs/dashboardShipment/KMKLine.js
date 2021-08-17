var kmkSent;
var kmkReceived;
var kmkAccepted;
function drawKMKLine(data) {
    if (kmkSent || kmkReceived || kmkAccepted) {
        kmkSent.destroy();
        kmkReceived.destroy();
        kmkAccepted.destroy();
    }

    kmkSentId = $("#kmkSent");
    kmkSent = new Chart(kmkSentId, {
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
                yAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "Value", padding: 10 },ticks: { padding: 10}}],
            },
            title: { display: !0, text: "" },
        },
        data: {
            labels: data.data.dynamicsKMKSentLabel,
            datasets: [{
                label: "",
                data: data.data.dynamicsKMKSentData,
                lineTension: 0,
                fill: !1,
                borderColor: "#2e53a1",
                borderWidth: 5,
                pointBorderColor: "#2e53a1",
                pointBackgroundColor: "#FFF",
                pointBorderWidth: 2,
                pointHoverBorderWidth: 2,
                pointRadius: 4
            }]
        }
    })

    kmkReceivedId = $("#kmkReceived");
    kmkReceived = new Chart(kmkReceivedId, {
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
                yAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "Value", padding: 10 },ticks: { padding: 10}}],
            },
            title: { display: !0, text: "" },
        },
        data: {
            labels: data.data.dynamicsKMKRecievedLabel,
            datasets: [{
                label: "",
                data: data.data.dynamicsKMKRecievedData,
                lineTension: 0,
                fill: !1,
                borderColor: "#2e53a1",
                borderWidth: 5,
                pointBorderColor: "#2e53a1",
                pointBackgroundColor: "#FFF",
                pointBorderWidth: 2,
                pointHoverBorderWidth: 2,
                pointRadius: 4
            }]
        }
    })

    kmkAcceptedId = $("#kmkAccepted");
    kmkAccepted = new Chart(kmkAcceptedId, {
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
                yAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "Value", padding: 10 },ticks: { padding: 10}}],
            },
            title: { display: !0, text: "" },
        },
        data: {
            labels: data.data.dynamicsKMKAcceptedLabel,
            datasets: [{
                label: "",
                data: data.data.dynamicsKMKAcceptedData,
                lineTension: 0,
                fill: !1,
                borderColor: "#2e53a1",
                borderWidth: 5,
                pointBorderColor: "#2e53a1",
                pointBackgroundColor: "#FFF",
                pointBorderWidth: 2,
                pointHoverBorderWidth: 2,
                pointRadius: 4
            }]
        }
    })
}
