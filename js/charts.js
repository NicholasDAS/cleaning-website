//  line chat booking by date
const ctxLine = document.getElementById('lineChart');

if (ctxLine) {
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: chartDates,
            datasets: [{
                label: 'Bookings',
                data: chartCounts,
                borderColor: '#c79a00',
                backgroundColor: 'rgba(199, 154, 0, 0.3)',
                borderWidth: 3,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

//  bar chat bookings per service
const ctxBar = document.getElementById('barChart');

if (ctxBar) {
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: serviceNames,
            datasets: [{
                label: 'Bookings Count',
                data: serviceCounts,
                backgroundColor: [
                    '#c79a00', '#e63946', '#457b9d', '#2a9d8f', '#f4a261'
                ],
                borderColor: '#000',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}
