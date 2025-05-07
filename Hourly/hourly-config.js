// Chart Configuration
var ctx2 = document.getElementById('hourlyChart').getContext('2d');
var existingChart2 = Chart.getChart(ctx2);
fetch('Hourly/hourlydata.php')
    .then(response => response.json())
    .then(data => {
        var labels = data.map(row => row.hours);
        var datasets = [];

        var monthData = {
            'January': data.map(row => row.Jan),
            'February': data.map(row => row.Feb),
            'March': data.map(row => row.Mar),
            'April': data.map(row => row.Apr),
            'May': data.map(row => row.May),
            'June': data.map(row => row.Jun),
            'July': data.map(row => row.Jul),
            'August': data.map(row => row.Aug),
            'September': data.map(row => row.Sep),
            'October': data.map(row => row.Oct),
            'November': data.map(row => row.Nov),
            'December': data.map(row => row.Dec),
        };

        // Define an array of unique colors
        var colors = [
            'rgba(75, 192, 192, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 205, 86, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 102, 0, 1)',
            'rgba(128, 128, 0, 1)',
            'rgba(0, 153, 0, 1)',
            'rgba(255, 0, 0, 1)',
            'rgba(0, 0, 0, 1)',
        ];

        // Loop through the months and create datasets with unique colors
        var colorIndex = 0;
        for (var month in monthData) {
            var color = colors[colorIndex];
            var monthFloatData = monthData[month].map(parseFloat); // Parse data as floats
            datasets.push({
                label: month,
                data: monthFloatData,
                borderColor: color,
                fill: false,
            });
            colorIndex++;
        }

        var chartConfig = {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets,
            },
            options: {
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Hours', // Set the x-axis label
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'EUR/MWh', // Set the y-axis label
                        }
                    }]
                },
            },
        };

        var hourlyChart = new Chart(ctx2, chartConfig);
    })
    .catch(error => console.error('Error fetching data:', error));
