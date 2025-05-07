let processingHourly = true; // Default to hourly chart view
let myChart = null;

function fetchData() {
  fetch('Hourly/scrapedHourlydata.php')
    .then((response) => response.json())
    .then((data) => {
      const processedData = processingHourly ? processDataHourly(data) : processDataDaily(data);
      //createChart(processedData.labels, processedData.prices);
      fetch('Hourly/scrapedHourlydata2.php')
      .then((response) => response.json())
      .then((data2) => {
        const processedData2 = processingHourly ? processDataHourly2(data2) : processDataDaily(data2);
        createChart(processedData.labels, processedData.prices, processedData2.labels2, processedData2.prices2);
      })
      .catch((error) => {
        console.error('Error fetching data:', error);
      });
    })
    .catch((error) => {
      console.error('Error fetching data:', error);
    });


}

function processDataHourly(data) {
    if (data && data.hours && data.todayPrice && data.date) {
      const hours = data.hours;
      const todayPrice = data.todayPrice;
      const todayDate = new Date(data.date);
  
      const matchingHours = [];
      const matchingPrices = [];
  
      for (let i = 0; i < hours.length; i++) {
        // Correctly parse the date from the CSV data
        const hourDate = new Date(todayDate);
        hourDate.setHours(Number(hours[i].split(' - ')[0]));
  
        if (!isNaN(hourDate)) {
          matchingHours.push(hours[i]);
          matchingPrices.push(todayPrice[i]);
        }
        console.log(hours[i]);
        console.log(todayPrice[i]);
        console.log(hourDate);
        console.log(data.Date);
      }
      console.log('matchingHours: ', matchingHours, '\n');
      console.log('matchingPrices: ', matchingPrices, '\n');

      return { labels: matchingHours, prices: matchingPrices };
    } else {
      console.error('Data is missing or in an unexpected format.');
      return { labels: [], prices: [] };
    }
  }

  function processDataHourly2(data) {
    if (data && data.date2 && data.numericPricePerKWh) {
      const dates = data.date2;
      const todayPrice = data.numericPricePerKWh;
      const todayDate = new Date(data.date2);
      let hours = [];

      const matchingDates = [];
      const matchingPrices = [];
      let matchingHours = [];


      for (let i = 0; i < dates.length; i++) {
        // Correctly parse the date from the CSV data
        
        //const hourDate = new Date(todayDate);
        //hourDate.setHours(Number(dates[i].split(' - ')[0]));
        //console.log('hourDate: ', hourDate, '\n');
        //if (!isNaN(hourDate)) 
        todayPrice[i] = todayPrice[i] * 100;

        if (dates.length - 1 == i) {
          for (j = 0; j < 24; j++) {
            if (j < 10) {
              hours[j] = '0' + j.toString();
            }
            else if (j < 20) {
              hours[j] = j.toString();
            }
            else if (j < 24) {
              hours[j] = j.toString();
            }

            //console.log(hours[j]);
            matchingHours.push(hours[j]);
            matchingPrices.push(todayPrice[i]);

            if (j == 23) {
              matchingDates.push(dates[i]);
            }
          }
        }

        //matchingDates.push(dates[i]);
        //matchingPrices.push(todayPrice[i]);

        console.log(dates[i]);
        console.log(todayPrice[i]);
        //console.log(hourDate);
        //console.log(data.Date);
      }
      console.log('matchingDates: ', matchingDates, '\n');
      console.log('matchingPrices: ', matchingPrices, '\n');
      console.log('matchingHours: ', matchingHours, '\n');
  
      return { labels2: matchingHours, prices2: matchingPrices };
    } else {
      console.error('Data is missing or in an unexpected format.');
      return { labels2: [], prices2: [] };
    }
  }
  
  
  
  

function processDataDaily(data) {
  if (data && data.hours && data.todayPrice && data.date) {
    const hours = data.hoursAll;
    const todayPrice = data.todayPriceAll;
    const todayDate = data.dateAll;

    const matchingDates = [];
    const matchingPrices = [];

    let avgPrice = [];
    let tempPrice = 0;

    let counter = 0;

    for (let i = 0; i < todayDate.length; i++) {

      for (let j = 0; j < data.hours.length; j++) {
        tempPrice = tempPrice + todayPrice[counter];

        if (data.hours.length - 1 == j) {

          //average day price converted from hourly
          matchingPrices[i] = tempPrice / data.hours.length;

          //date of the average day price
          matchingDates[i] = todayDate[i];
          tempPrice = 0;
        }
        counter++;
      }
      console.log('counter in loop: ', counter);

      // Correctly parse the date from the CSV data
      /*
      const hourDate = new Date(todayDate);
      hourDate.setHours(Number(hours[i].split(' - ')[0]));
      dateMonth = hourDate.getUTCMonth() + 1;

      if (!isNaN(hourDate)) {
        matchingHours.push(hours[i]);
        matchingPrices.push(todayPrice[i]);
      }
      
      console.log(hours[i]);
      console.log(todayPrice[i]);
      console.log(data.Date);
      console.log(dateMonth);
      */


    }

    let avgMonthPrice = [];
    let tempDayPrice = 0;
    let lastMonth = 0;

    let lastMonth1 = 0;
    let lastMonth2 = 0;

    let lastMonth3 = 0;
    let lastMonth4 = 0;

    let avgCounter = 0;

    const matchingMonthDates = [];
    const matchingMonthPrices = [];

    for (let i = 0; i < matchingDates.length; i++) {
       matchingDatesMonth1 = matchingDates[i][5];
       matchingDatesMonth2 = matchingDates[i][6];
       console.log('month: ', matchingDatesMonth1, matchingDatesMonth2, '\n');

      for (let j = i; j < matchingDates.length; j++) {
        matchingDatesMonth3 = matchingDates[j][5];
        matchingDatesMonth4 = matchingDates[j][6];

        if (matchingDatesMonth1 == matchingDatesMonth3 && matchingDatesMonth2 == matchingDatesMonth4) {
          tempDayPrice = tempDayPrice + matchingPrices[i];
          console.log('month matched on loop i=', i, 'j=', j, '\n');

          lastMonth1 = matchingDatesMonth1;
          lastMonth2 = matchingDatesMonth2;
        }
        else {
          matchingMonthPrices[i] = tempDayPrice / j;
          matchingMonthDates[i] = matchingDates[i];
          tempDayPrice = 0;
          console.log('month DIDNT MATCH on loop i=', i, 'j=', j, '\n');
          i = j-1;

          lastMonth3 = matchingDatesMonth1;
          lastMonth4 = matchingDatesMonth2;

          break;
        }

      }



    }

    console.log('lastMonth12: ', lastMonth1, lastMonth2, '\n');
    console.log('lastMonth34: ', lastMonth3, lastMonth4, '\n');


    if (lastMonth == 0) {
      console.log('got to last month');
      tempDayPrice = 0;
      for (j = 0;  j < matchingDates.length; j++) {
        matchingDatesMonth3 = matchingDates[j][5];
        matchingDatesMonth4 = matchingDates[j][6];

        if (lastMonth1 != lastMonth3 || lastMonth2 != lastMonth4) {
          //tempDayPrice = tempDayPrice + matchingPrices[i];
          console.log('month matched 2nd on loop j=', j, '\n');
          console.log('date that matched: ', matchingDates[j], '\n');
          console.log('month for that date: ', matchingDatesMonth3, matchingDatesMonth4, '\n');

          if (lastMonth1 == matchingDatesMonth3 && lastMonth2 == matchingDatesMonth4) {
            console.log('matched date correctly\n'); // it works
            
            console.log('adding to tempDayPrice = ', tempDayPrice, '+', matchingPrices[j], '\n');
            tempDayPrice = tempDayPrice + matchingPrices[j];
            avgCounter++;
            //console.log('matchingMonthPrices after matched: ', matchingMonthPrices[j], '\n');
          }

          if (matchingDates.length - 1 == j) {
            console.log('last loop cycle reached');

            matchingMonthPrices[j] = tempDayPrice / avgCounter;
            matchingMonthDates[j] = matchingDates[j];

            console.log('last months monthly avg price: ', matchingMonthPrices[j], '\n');
            
            tempDayPrice = 0;
            avgCounter = 0;

            break;
          }
        }
      }

      lastMonth = 1;
    }

    matchingMonthPricesClean = matchingMonthPrices.filter(function (el) {
      return el != null;
    });

    matchingMonthDatesClean = matchingMonthDates.filter(function (el) {
      return el != null;
    });


    matchingMonthPricesClean = matchingMonthPricesClean.map(function(each_element){
      return Number(each_element.toFixed(2));
  });

  console.log('date char lenght check: ', matchingMonthDatesClean[0].length, '\n');
    for (let i = 0; i < matchingMonthDatesClean.length; i++) {
      for (let j = 5; j < matchingMonthDatesClean[i].length; j++)
      {
        console.log('element to remove: ', matchingMonthDatesClean[i][j], '\n');
        matchingMonthDatesClean[i] = matchingMonthDatesClean[i].slice(0, -1);
      }
    }
    


    console.log('matchingDates: ', matchingDates, '\n');
    console.log('matchingPrices: ', matchingPrices, '\n');
    console.log(data.dateAll);
    console.log(data.todayPriceAll);
    //console.log(data.hoursAll);
    //console.log(counter);
    console.log('matchingMonthDatesClean: ', matchingMonthDatesClean, '\n');
    console.log('matchingMonthPricesClean: ', matchingMonthPricesClean, '\n');
    //console.log(matchingMonthDates);

    return { labels: matchingMonthDatesClean, prices: matchingMonthPricesClean };
  } else {
    console.error('Data is missing or in an unexpected format.');
    return { labels: [], prices: [] };
  }
}

function processDataDaily2(data2) {
  const days = data.days;
  const dailyPrice = data.dailyPrice;

  if (data && data.date2 && data.numericPricePerKWh) {
    const dates = data.date2;
    const todayPrice = data.numericPricePerKWh;
    const todayDate = new Date(data.date2);

    const matchingDates = [];
    const matchingPrices = [];

    for (let i = 0; i < dates.length; i++) {
      // Correctly parse the date from the CSV data
      const hourDate = new Date(todayDate);
      hourDate.setHours(Number(dates[i].split(' - ')[0]));
      //console.log('hourDate: ', hourDate, '\n');
      //if (!isNaN(hourDate)) 

      matchingDates.push(dates[i]);
      matchingPrices.push(todayPrice[i]);

      console.log(dates[i]);
      console.log(todayPrice[i]);
      //console.log(hourDate);
      //console.log(data.Date);
    }
    console.log('matchingDates: ', matchingDates, '\n');
    console.log('matchingPrices: ', matchingPrices, '\n');

    return { labels: matchingDates, prices: matchingPrices };
  } else {
    console.error('Data is missing or in an unexpected format.');
    return { labels: [], prices: [] };
  }
}

function toggleProcessing() {
  processingHourly = !processingHourly;
  fetchData();
}


function createChart(labels, prices, labels2, prices2) {
  const ctx = document.getElementById('scrapedHourlyChart').getContext('2d');

  if (myChart) {
    myChart.destroy();
  }

  myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: processingHourly ? 'Ignitis Daily Price, ct/kWh' : 'Ignitis Monthly Price, ct/kWh',
          data: prices,
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 2,
          fill: false,
        },
        {
          label: processingHourly ? 'Elektrum Daily Price, ct/kWh' : 'Elektrum Monthly Price, ct/kWh',
          data: prices2,
          borderColor: 'rgba(150, 50, 50, 1)',
          borderWidth: 2,
          fill: false,
        },
      ],
    },
    options: {
      scales: {
        x: [
          {
            grid: {
              display: false,
            },
            title: {
              display: true,
              text: processingHourly ? 'Hour' : 'Day',
            },
            scaleLabel: {
              display: true,
              labelString: 'Time', // Set the x-axis label
            },
          },
        ],
        y: [
          {
            title: {
              display: true,
              text: 'Price',
            },
            scaleLabel: {
              display: true,
              labelString: 'Time', // Set the x-axis label
            },
          },
        ],
      },
      title: {
        display: true,
        //text: date,
      },
    },
  });
}
fetchData();

document.getElementById('switchHourly').addEventListener('click', function () {
  processingHourly = true;
  fetchData();
});

document.getElementById('switchDaily').addEventListener('click', function () {
  processingHourly = false;
  fetchData();
});
