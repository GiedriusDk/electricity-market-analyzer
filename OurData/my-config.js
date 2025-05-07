var ctx = document.getElementById('myChart').getContext('2d');

async function fetchData() {
    try {
        var response = await fetch('OurData/data.php');
        var data = await response.json();
        //console.log(data);
        var dates = data.map(item => item.date);
        var payedWithSolar = data.map(item => item.payed_with_solar);
        var wouldPayWithoutSolar = data.map(item => item.would_pay_without_solar);
        var enefit = data.map(item => item.enefit);
        var elektrum = data.map(item => item.elektrum);
        var ignitis = data.map(item => item.ignitis);

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [
                    {
                        label: 'Paid (with solar panels)',
                        data: payedWithSolar,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: false,
                    },
                    {
                        label: 'Would Pay (without solar panels)',
                        data: wouldPayWithoutSolar,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: false,
                    },
                    {
                        // Configuration for 'Benefit'
                        label: 'enefit',
                        data: enefit, // Replace with the actual data for 'Benefit'
                        borderColor: 'rgb(66, 62, 255)', // Choose a different color for 'Benefit'
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: false,
                    },
                    {
                        // Configuration for 'Elektrum'
                        label: 'elektrum',
                        data: elektrum, // Replace with the actual data for 'Elektrum'
                        borderColor: 'rgba(255, 206, 86, 1)', // Choose a different color for 'elektrum'
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: false,
                    },
                    {
                        // Configuration for 'Ignitis'
                        label: 'ignitis',
                        data: ignitis, // Replace with the actual data for 'Ignitis'
                        borderColor: 'rgb(66, 140, 18)', // Choose a different color for 'Ignitis'
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: false,
                    },
                ],
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        min: dates[0],
                        max: dates[dates.length - 1],
                        ticks: {
                            maxRotation: 90, // Rotate x-axis labels
                            minRotation: 0,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        },
                    },
                    y: {
                        scaleLabel: {
                            display: true,
                            labelString: 'Price'
                        },
                    }
                },
                plugins: {
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'x', // Enable horizontal panning
                        },
                    },
                    tooltip: {
                        position: 'average',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y.toFixed(2);

                                return label;
                            },
                            afterLabel: function(context) {
                                var link = data[context.dataIndex].link;
                                if (link) {
                                    return 'Information: ' + data[context.dataIndex].link;
                                } else {
                                    return 'No information';
                                }
                            },
                        },
                    },
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    interaction: {
                        mode: 'x',
                    },
                },
            },
        });
    } catch (error) {
        console.error('Error fetching data GD:', error);
    }
}

fetchData();
