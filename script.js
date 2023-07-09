// Membuat diagram batang menggunakan Chart.js
var statistikStokChart = new Chart(document.getElementById('statistikStokChart'), {
    type: 'bar',
    data: {
        labels: bulanLabels,
        datasets: [{
            label: 'Total Stok',
            data: totalStokData,
            backgroundColor: 'black',
            borderColor: 'black',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                display: true,
                title: {
                    display: true,
                    text: 'Bulan'
                }
            },
            y: {
                display: true,
                title: {
                    display: true,
                    text: 'Total Stok'
                }
            }
        }
    }
});