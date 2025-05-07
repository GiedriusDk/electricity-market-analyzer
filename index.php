<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
    <style>
    #toggleButton {
        cursor: pointer;
        font-size: 20px;
        
        transition: transform 0.3s ease-in-out;
    }

    #hiddenContent {
        display: none;
        text-align: left; 
        font-size: 18px;
        
    }

    .expanded {
        transform: rotate(90deg) translateY(1px);
        margin-left: 10px;
    }

    .table-like {
    display: flex;
    justify-content: flex-start;
    text-align: left;
    align-items: flex-start;
    font-size: 20px;
    margin-left: 5px;
    }

    .left-align {
    margin-left: 10px;
    }

    .content-container > .table-like + .table-like {
        border-top: 1px solid #ccc; /* Change color as needed */
        margin-top: 20px; /* Adjust spacing as needed */
        padding-top: 20px; /* Adjust spacing as needed */
    }
    </style>
</head>
<body>
    <?php include 'header.php'; 
    require_once 'scrape_data.php';
    require_once 'scrape_data2.php'; ?>
    
    <div class="content-container">
        <h2>Home Page</h2>
        <p>This is the main (home) page. Probably will delete this text later</p>
    </div>

    <!-- these are for our data chart -->
    <div class="content-container">
        <h2>Electricity Price Chart (example)</h2>
        <canvas id="myChart"></canvas>
        <script src="OurData/data.php"></script>
        <script src="OurData/my-config.js"></script> 
    </div>
    
    <!-- these are for hourly data -->
    <div class="content-container">
        <h2>2022 hourly cost</h2>
        <canvas id="hourlyChart"></canvas>
        <script src="Hourly/hourlydata.php"></script>
        <script src="Hourly/hourly-config.js"></script>
    </div>

<div class="content-container">
        <h2>Information about electricity prices in 2022</h2>
        <div class="table-like">
            <span id="toggleButton1" onclick="toggleHiddenContent('hiddenContent1')">></span>
            <div class="left-align">
                Expensive prices on July, August, and September 
                <div id="hiddenContent1" style="display: none;">
                    <p>Rising electricity and natural gas prices in July 2022 were largely determined by the geopolitical situation, that is, the situation in Ukraine due to Russian aggression. Last year was marked by particularly high electricity and gas prices, and their peak was recorded in August of last year. Due to the war in Ukraine, the indicators of electricity import have changed significantly. Imports with Sweden grew by 35.1 percent (5.029 TWh), with Poland by 28.6 percent (1.104 TWh), thus replacing electricity trade from Russia that was discontinued in Ukraine after the war. The dynamics of natural gas and electricity prices allow us to predict that the shock of natural gas and electricity prices will last longer than planned," the ministry said. Last year was marked by particularly high electricity and gas prices, and their peak was recorded in August of last year.</p>
                </div>
            </div>
    </div>
    
    <div class="table-like">
        <span id="toggleButton2" onclick="toggleHiddenContent('hiddenContent2')">></span>
        <div class="left-align">
            Lithuania-Sweden power link maintenance put off due to electricity market situation
            <div id="hiddenContent2" style="display: none;">
                <p>The Lithuanian Energy Ministry said that Litgrid, the country’s power transmission system operator, had made the decision on the ministry’s instructions. According to Energy Minister Dainius Kreivys, the NordBalt cable is currently crucial for importing Scandinavian electricity from Sweden, so temporarily disconnecting it would reduce import volumes and have a negative impact on already high market prices. “Given the situation on the Nord Pool exchange and the high electricity prices, we need to maintain maximum market integration and the possibility to import electricity from Scandinavia,” he said in a press release.</p>
            </div>
        </div>
    </div>
    
    <div class="table-like">
        <span id="toggleButton3" onclick="toggleHiddenContent('hiddenContent3')">></span>
        <div class="left-align">
            August record jump in electricity price
            <div id="hiddenContent3" style="display: none;">
                <p>Four euros per kWh will be a new record for electricity prices in Lithuania and will almost double the previous record. Lithuania buys around 70-80 percent of its electricity on the exchange and generates around 20-30 percent of its own electricity. According to experts, the price spike is due to the very high cost of gas used for electricity production, heatwaves that increase electricity consumption, as well as repair works. Algorithms on the Nord Pool exchange, which prevent the sale of cheaper electricity if the amount of electricity on offer does not match demand, may also be contributing to the price increase. The majority of household consumers in Lithuania have fixed electricity plans, so they should not worry about the price jump, said Artūras Ketlerius, spokesperson for Lithuania's state-owned energy group Ignitis. “Consumers with smart meters and electricity plans linked to hourly electricity use should be more worried. There are very few such customers. They follow the exchange prices and depending on what the exchange price is, they may decide to switch off their household equipment,” he said. Ketlerius advised that customers with smart meters should not charge their electric cars or run washing machines between 18:00 and 19:00 on August 17.</p>
            </div>
        </div>
    </div>
    
    <div class="table-like">
        <span id="toggleButton4" onclick="toggleHiddenContent('hiddenContent4')">></span>
        <div class="left-align">
            Lower prices on January, February, March and April
            <div id="hiddenContent4" style="display: none;">
                <p>With Russia having invaded Ukraine, some in Lithuania were worried about their security of energy supply, given that the country imports almost all of its electricity. owever, Energy Minister Dainius Kreivys, who presented the government's energy security plans, said Lithuania would have stable supply under all kinds of emergencies, including war. “Everyone's homes will stay warm and well-lit,” Kreivys said. “I can safely give you my assurances.” According to him, Lithuania's LNG terminal in Klaipėda will ensure secure gas supply, while the country buys most of its electricity in Western European markets. “We are importing electricity and have a whole range of interconnectors,” said Kreivys. “There are interconnectors with Finland, with Sweden, with Poland, this ensures stability.” The national electricity grid operator Litgrid concurs that Lithuania will not experience outages.</p>
            </div>
        </div>
    </div>

    <!-- these are for scraped hourly data -->
    <div class="content-container">
        <h2>Today's hourly cost (from Ignitis)</h2>
        <button id="switchHourly" class="switch-button">Daily</button>
        <button id="switchDaily" class="switch-button">Monthly</button>
        <canvas id="scrapedHourlyChart"></canvas>
        <script src="Hourly/scrapedHourlydata.php"></script>
        <script src="scraped-hourly-config.js"></script>
        <script src="interval-switch.js"></script>
    </div>
    
    <div class="content-container">
        <h2>General information about electricity in Lithuania</h2>
        <div class="table-like">
            <span id="toggleButton5" onclick="toggleHiddenContent('hiddenContent5')">></span>
            <div class="left-align">
                History of Lithuanian electricity market
                <div id="hiddenContent5" style="display: none;">
                    <p>Lithuania closed its only Ignalina nuclear power plant (NPP) in 2009. Ignalina NPP was able to produce about 70% of all electricity consumed in Lithuania. Lithuania was a net exporter of electricity, and was selling the surplus of electricity to Belarus at prices below its cost.  Lithuania had agreed to do close it when negotiating its membership in the European Union. Back in 2009, Lithuanian government had serious plans to build another Visaginas NPP but in 2012 referendum majority of population voted against this project, and the government cancelled its plans. After the closure of Ignalina NPP, the country suddenly became a net importer of electricity. Up until this day, Lithuania imports around two thirds of its needed electricity, and is the 6th country in the EU having highest dependency on electricity imports. Being so dependent on electricity imports, Lithuania has been working on good electricity links with its neighboring countries. In 2015 Lithuania was connected to Poland via LitPol Link and with Sweden via NordBalt cable which goes across the Baltic Sea. Since 2012 Lithuania has been participating in Nord Pool Spot power exchange.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="content-container">
        <h2>Weather Forecast</h2>
        <div id="weather" class="weather"></div>
    </div>

    <script>
        function toggleHiddenContent(contentId) {
            var hiddenContent = document.getElementById(contentId);
            var toggleButton = document.getElementById('toggleButton' + contentId.charAt(contentId.length - 1));

            if (hiddenContent.style.display === 'none') {
                hiddenContent.style.display = 'block';
                toggleButton.classList.add('expanded');
            } else {
                hiddenContent.style.display = 'none';
                toggleButton.classList.remove('expanded');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const weatherContainer = document.getElementById('weather');

            fetch('weather/weather.php') 
                .then(response => response.text())
                .then(data => {
                    weatherContainer.innerHTML = data;
                })
                .catch(error => console.error('Error fetching weather data:', error));
        });
    </script>
</body>
</html>
