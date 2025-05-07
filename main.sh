#!/bin/bash

sudo apt update
sudo apt upgrade -y
sudo apt install -y apache2 git
sudo rm /var/www/html/index.html
sudo git clone https://git.mif.vu.lt/aiga9280/electricity-market-analyzer.git /var/www/html/
sudo apt-get install -y php libapache2-mod-php php-mysql php-curl php-xml php-gd
sudo apt-get install -y nodejs npm
npm install
npm install chart.js chartjs-plugin-zoom
sudo systemctl restart apache2
sudo apt install phpunit