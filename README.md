# ⚡ Electricity Market Analyzer

Welcome to the **Electricity Market Analyzer** – a web-based application developed as a university Software Engineering project. It provides interactive visualizations and analysis of Lithuania's electricity market, helping users understand price fluctuations, compare providers, and get practical tips to optimize electricity consumption.

---

## 📊 Project Overview

This platform allows visitors to:

- View electricity price trends across different months
- Instantly compare **Ignitis** and **Elektrum** prices
- Understand how prices changed throughout **2022**
- Get energy-saving tips via the **Solutions** tab
- Contact the team via the **Contact** section

Users don’t need to register — they can explore all features freely via a clean UI with real data visualizations.

---

## 🌐 Main Features

- 🔍 Compare electricity providers over time
- 📊 View interactive charts of monthly price variations (2022)
- 🧠 Understand why and when electricity prices rise or fall
- 💡 Browse smart energy-saving recommendations
- 📡 Real-time weather forecast display
- 📈 Graphs: total prices, price differences, and monthly trends
- 🧪 Automated testing:
  - CSV file structure validation
  - Port availability check
  - File existence checks

---

## 🧑‍💻 Team Members

- **Giedrius Dauknys** – Team Leader, Designer  
- **Airidas Gabinaitis** – Programmer, Data Analyst  
- **Олександр Ротаєнко** – Tester, Programmer  
- **Evelina Matelytė** – Designer  

---

## 🧰 Technologies Used

### Server-side:
- [PHP](https://en.wikipedia.org/wiki/PHP)
- [Node.js](https://nodejs.org/)

### Client-side:
- [HTML](https://en.wikipedia.org/wiki/HTML)
- [JavaScript](https://en.wikipedia.org/wiki/JavaScript)
- [Chart.js](https://www.chartjs.org/)
- [Fetch API](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API)

### Development & Testing:
- [XAMPP](https://www.apachefriends.org/index.html)
- [Gulp](https://gulpjs.com)
- [Composer](https://getcomposer.org/)
- [PHPUnit](https://phpunit.de)

### Libraries / Packages:
- `DeepCopy`, `PHP Parser`, `phpunit/php-code-coverage`, `phpunit/php-timer`, `Text_Template`, `Manifest`, `Instantiator`, and others

### Data Format:
- **CSV** – used to store and load electricity pricing datasets

---

## 🏗️ Infrastructure

- Project hosted on [OpenNebula](https://en.wikipedia.org/wiki/OpenNebula)
- Development and deployment run via virtual machines (VM)
- Apache server with PHP used for local hosting
- Frontend served from local file system or AVD

---

## 💻 Project Structure

 - index.html # Homepage
 - about.html / contact.html / solutions.html
 - scripts/ # JavaScript logic
 - data/ # CSV datasets
 - style/ # CSS styles
 - tests/ # Automated test scripts
 - main.sh # Server setup script

## 📄 Project Documentation

 - Full PDF report (in Lithuanian):
 - Electricity-Market-Analyzer-Doc.pdf
