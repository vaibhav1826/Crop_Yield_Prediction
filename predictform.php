<?php
session_start();

// Include all necessary function files
require_once 'includes\weather_functions.php';
require_once 'includes\soil_functions.php';
require_once 'includes\crop_functions.php';
require_once 'includes\historical_functions.php';
require_once 'includes\display_functions.php';

// Handle POST request
$predictionSuccess = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $openWeatherApiKey = "b2f6e283bb1f468467af310ceec9e289";
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $location = "$city, $state";
    $cropType = $_POST['crop-type'] ?? '';
    $soilType = $_POST['soil-type'] ?? '';
    $soilPh = $_POST['soil-ph'] ?? '';
    $irrigation = $_POST['irrigation'] ?? '';
    $historicalCrop = $_POST['historical-crop'] ?? '';
    $yearRange = intval($_POST['year-range'] ?? 5);

    $weatherData = fetchWeatherData($location, $openWeatherApiKey);
    if (!$weatherData) {
        echo json_encode(['error' => "No such city or state found. Please check your input and try again."]);
        exit;
    }

    $soilData = !empty($soilType) ? getSoilData($soilType, $soilPh, $irrigation) : [];
    $crops = getCropData($state);
    if (!empty($cropType)) {
        $crops = filterCropsByType($crops, $cropType);
    }

    try {
        $scoredCrops = calculateCropScores($crops, $weatherData, $soilData);
        $recommendations = getScoredRecommendations($scoredCrops);
        $topCrop = !empty($recommendations) ? array_key_first($recommendations) : null;
        $topCropDetails = $topCrop ? $recommendations[$topCrop] : null;
        if ($topCrop) {
            unset($recommendations[$topCrop]);
        }

        $historicalData = [];
        $trendAnalysis = [];
        if (!empty($historicalCrop)) {
            list($historicalData, $trendAnalysis) = processHistoricalAnalysis($state, $historicalCrop, $yearRange);
        }

        $predictionSuccess = true;
        displayResults($location, $weatherData, $soilData, $recommendations, $topCrop, $topCropDetails, $historicalData, $trendAnalysis, $state);
    } catch (Exception $e) {
        echo json_encode(['error' => "Prediction failed: " . $e->getMessage()]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrated Crop & Weather Prediction System</title>
    <?php include 'partials/head.php'; ?>
    <style>
    <?php include 'public\css\predictionformstyle.css';
    ?>
    </style>
</head>

<body>
    <?php include 'partials/nav.php'; ?>
    <div class="container">
        <h1 id="special">Integrated Crop & Weather Prediction System</h1>

        <div id="alert-container"></div>

        <div class="input-section">
            <form id="predictionForm" method="POST" action="">
                <div class="form-group">
                    <label for="state">State/Province:</label>
                    <select id="state" name="state" required>
                        <option value="" disabled selected>Select a State</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" required placeholder="Enter city name">
                </div>
                <div class="form-group">
                    <label for="crop-type">Crop Type (Optional):</label>
                    <select id="crop-type" name="crop-type">
                        <option value="">All Suitable Crops</option>
                        <option value="cereals">Cereals (Wheat, Rice, Maize, etc.)</option>
                        <option value="pulses">Pulses (Chickpea, Lentil, etc.)</option>
                        <option value="oilseeds">Oilseeds (Mustard, Groundnut, etc.)</option>
                        <option value="vegetables">Vegetables (Potato, Tomato, etc.)</option>
                        <option value="fruits">Fruits (Mango, Banana, etc.)</option>
                        <option value="spices">Spices (Turmeric, Chilli, etc.)</option>
                        <option value="cash-crops">Cash Crops (Cotton, Sugarcane, etc.)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="soil-type">Soil Type (Optional):</label>
                    <select id="soil-type" name="soil-type">
                        <option value="">Select Soil Type</option>
                        <option value="alluvial">Alluvial Soil</option>
                        <option value="black">Black Soil (Regur)</option>
                        <option value="red">Red Soil</option>
                        <option value="laterite">Laterite Soil</option>
                        <option value="arid">Arid/Desert Soil</option>
                        <option value="forest">Forest/Mountain Soil</option>
                        <option value="saline">Saline/Alkaline Soil</option>
                        <option value="peaty">Peaty/Marshy Soil</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="soil-ph">Soil pH (Optional):</label>
                    <select id="soil-ph" name="soil-ph">
                        <option value="">Select pH Range</option>
                        <option value="acidic">Acidic (Below 6.0)</option>
                        <option value="neutral">Neutral (6.0-7.0)</option>
                        <option value="alkaline">Alkaline (Above 7.0)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="irrigation">Irrigation Availability (Optional):</label>
                    <select id="irrigation" name="irrigation">
                        <option value="">Select Option</option>
                        <option value="full">Full Irrigation</option>
                        <option value="partial">Partial Irrigation</option>
                        <option value="rainfed">Rainfed Only</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="historical-crop">Historical Crop Analysis (Optional):</label>
                    <select id="historical-crop" name="historical-crop">
                        <option value="">No Historical Analysis</option>
                        <option value="Wheat">Wheat</option>
                        <option value="Rice">Rice</option>
                        <option value="Maize">Maize</option>
                        <option value="Potato">Potato</option>
                        <option value="Cotton">Cotton</option>
                        <option value="Sugarcane">Sugarcane</option>
                        <option value="Chickpea">Chickpea</option>
                        <option value="Mustard">Mustard</option>
                        <option value="Tomato">Tomato</option>
                        <option value="Mango">Mango</option>
                        <option value="Turmeric">Turmeric</option>
                        <option value="Soybean">Soybean</option>
                        <option value="Groundnut">Groundnut</option>
                        <option value="Barley">Barley</option>
                        <option value="Sorghum">Sorghum</option>
                        <option value="Lentil">Lentil</option>
                        <option value="Onion">Onion</option>
                        <option value="Banana">Banana</option>
                        <option value="Coffee">Coffee</option>
                        <option value="Tea">Tea</option>
                        <option value="Chilli">Chilli</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year-range">Historical Year Range (If Crop Selected):</label>
                    <select id="year-range" name="year-range">
                        <option value="5">Last 5 Years</option>
                        <option value="10">Last 10 Years</option>
                        <option value="20">Last 20 Years</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Get Predictions</button>
            </form>
        </div>

        <div id="loading" class="loading-section hidden">
            <div class="loader"></div>
            <p>Fetching data and calculating predictions...</p>
        </div>

        <div id="results" class="results-section hidden">
            <h2>Predictions for <span id="location-display"></span></h2>
            <div class="weather-summary">
                <h3>Weather Analysis</h3>
                <div id="weather-data"></div>
            </div>
            <div id="soil-summary" class="soil-summary hidden">
                <h3>Soil Analysis</h3>
                <div id="soil-data"></div>
            </div>
            <div class="chart-container">
                <canvas id="prediction-chart"></canvas>
            </div>
            <div class="top-recommendation" id="top-recommendation"></div>
            <div class="predictions">
                <h3>Crop Suitability</h3>
                <div id="prediction-results"></div>
            </div>
            <div id="state-crops" class="predictions hidden">
                <h3>Suggested Crops for State</h3>
                <div id="state-crop-list"></div>
            </div>
            <div id="historical-data" class="historical-data hidden">
                <h3>Historical Analysis</h3>
                <div class="chart-container">
                    <canvas id="historical-chart"></canvas>
                </div>
                <div id="historical-table"></div>
                <div id="trend-prediction"></div>
            </div>
        </div>

        <div id="error-message" class="error-section hidden">
            <p id="error-text">An error occurred. Please check your input and try again.</p>
        </div>
    </div>
    <?php include 'partials/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script>
    document.getElementById('predictionForm').addEventListener('submit', function(e) {
        document.getElementById('loading').classList.remove('hidden');
        document.getElementById('results').classList.add('hidden');
        document.getElementById('error-message').classList.add('hidden');
        document.getElementById('alert-container').innerHTML = '';
    });

    function displayResultsInUI(data) {
        document.getElementById('loading').classList.add('hidden');
        if (data.error) {
            showAlert('error', data.error);
            document.getElementById('error-message').classList.remove('hidden');
            document.getElementById('error-text').textContent = data.error;
            return;
        }
        showAlert('success', `Prediction for crops using weather information for ${data.location} is done!`);
        document.getElementById('location-display').textContent = data.location;
        document.getElementById('weather-data').innerHTML = `
            <div class='weather-item'><span>Current Temperature:</span><span>${data.weather_data.temp}°C</span></div>
            <div class='weather-item'><span>Forecast Avg Temp:</span><span>${data.weather_data.forecast_avg_temp}°C</span></div>
            <div class='weather-item'><span>Humidity:</span><span>${data.weather_data.humidity}%</span></div>
            <div class='weather-item'><span>5-Day Precipitation:</span><span>${data.weather_data.total_precipitation_5day} mm</span></div>
            <div class='weather-item'><span>Precipitation Frequency:</span><span>${(data.weather_data.precipitation_frequency * 100).toFixed(0)}%</span></div>
            <div class='weather-item'><span>Wind Speed:</span><span>${data.weather_data.wind_speed} m/s</span></div>
            <div class='weather-item'><span>Sunlight Hours:</span><span>${data.weather_data.sunlight_hours.toFixed(1)} hours</span></div>
            <div class='weather-item'><span>Condition:</span><span>${data.weather_data.weather}</span></div>
        `;
        if (data.soil_data && Object.keys(data.soil_data).length > 0) {
            document.getElementById('soil-summary').classList.remove('hidden');
            document.getElementById('soil-data').innerHTML = `
                <div class='soil-item'><span>Soil Type:</span><span>${capitalize(data.soil_data.type)} Soil</span></div>
                <div class='soil-item'><span>Water Holding:</span><span>${data.soil_data.water_holding}</span></div>
                <div class='soil-item'><span>Fertility:</span><span>${data.soil_data.fertility}</span></div>
                <div class='soil-item'><span>Drainage:</span><span>${data.soil_data.drainage}</span></div>
                ${data.soil_data.ph ? `<div class='soil-item'><span>pH:</span><span>${capitalize(data.soil_data.ph)}</span></div>` : ''}
                <div class='soil-item'><span>Irrigation:</span><span>${capitalize(data.soil_data.irrigation || 'N/A')}</span></div>
            `;
        } else {
            document.getElementById('soil-summary').classList.add('hidden');
        }
        if (data.top_crop && data.top_crop_details) {
            document.getElementById('top-recommendation').innerHTML = `
                <h3>Top Recommended Crop: ${data.top_crop}</h3>
                <p><strong>Expected Yield:</strong> ${data.top_crop_details.projected_yield} t/ha</p>
                <p><strong>Season:</strong> ${data.top_crop_details.season}</p>
                <p><strong>Reason:</strong> ${data.top_crop_details.reason}</p>
                <p><strong>Suitability Score:</strong> ${data.top_crop_details.overall_score}%</p>
            `;
        } else {
            document.getElementById('top-recommendation').innerHTML = '<p>No highly suitable crops found.</p>';
        }
        let predictionHtml = '';
        for (const [crop, details] of Object.entries(data.recommendations)) {
            const suitabilityClass = details.suitability;
            const stateSuggested = details.state_suggested ? ' <span style="color: #1976d2;">(State Suggested)</span>' :
                '';
            predictionHtml += `
                <div class='crop-card ${suitabilityClass}'>
                    <div class='crop-name'>${crop}${stateSuggested}</div>
                    <div class='crop-yield'>${details.projected_yield} t/ha (${details.overall_score}%)</div>
                </div>
            `;
        }
        document.getElementById('prediction-results').innerHTML = predictionHtml || '<p>No crops analyzed.</p>';
        const stateCrops = Object.entries(data.recommendations)
            .filter(([_, details]) => details.state_suggested)
            .map(([crop]) => crop);
        if (stateCrops.length > 0) {
            document.getElementById('state-crops').classList.remove('hidden');
            document.getElementById('state-crop-list').innerHTML = stateCrops.map(crop => `<p>${crop}</p>`).join('');
        } else {
            document.getElementById('state-crops').classList.add('hidden');
        }
        if (data.historical_data.length > 0) {
            document.getElementById('historical-data').classList.remove('hidden');
            let tableHtml =
                '<table><thead><tr><th>Year</th><th>Yield (t/ha)</th><th>Area (ha)</th><th>Production (t)</th></tr></thead><tbody>';
            data.historical_data.forEach(yearData => {
                tableHtml +=
                    `<tr><td>${yearData.year}</td><td>${yearData.yield}</td><td>${yearData.area.toLocaleString()}</td><td>${yearData.production.toLocaleString()}</td></tr>`;
            });
            tableHtml += '</tbody></table>';
            document.getElementById('historical-table').innerHTML = tableHtml;
            document.getElementById('trend-prediction').innerHTML = `
                <h4>Trend Prediction</h4>
                <p>Trend: ${data.trend_analysis.trend_direction}</p>
                <p>Change: ${data.trend_analysis.overall_change_pct}%</p>
                <p>Next Year Projection: ${data.trend_analysis.projected_next_year} t/ha</p>
            `;
            createHistoricalChart(data.historical_data, data.trend_analysis);
        } else {
            document.getElementById('historical-data').classList.add('hidden');
        }
        createYieldChart(data.recommendations);
        document.getElementById('results').classList.remove('hidden');
    }

    function showAlert(type, message) {
        const alertContainer = document.getElementById('alert-container');
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.innerHTML = `${message}<button class="alert-close">×</button>`;
        alertContainer.appendChild(alertDiv);
        alertDiv.querySelector('.alert-close').addEventListener('click', function() {
            alertDiv.remove();
        });
    }

    function createYieldChart(recommendations) {
        const ctx = document.getElementById('prediction-chart').getContext('2d');
        const labels = Object.keys(recommendations);
        const yields = labels.map(crop => recommendations[crop].projected_yield);
        const backgroundColors = labels.map(crop => {
            if (recommendations[crop].suitability === 'highly-suitable') return 'rgba(102, 187, 106, 0.7)';
            if (recommendations[crop].suitability === 'suitable') return 'rgba(255, 152, 0, 0.7)';
            return 'rgba(239, 83, 80, 0.7)';
        });
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Projected Yield (t/ha)',
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
                    borderWidth: 1,
                    data: yields
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Yield (t/ha)',
                            font: {
                                size: 14
                            }
                        },
                        grid: {
                            color: '#e0e7ff'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    }

    function createHistoricalChart(historicalData, trendAnalysis) {
        const ctx = document.getElementById('historical-chart').getContext('2d');
        const years = historicalData.map(item => item.year);
        const yields = historicalData.map(item => item.yield);
        years.push(years[years.length - 1] + 1);
        yields.push(trendAnalysis.projected_next_year);
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: years,
                datasets: [{
                    label: 'Yield (t/ha)',
                    borderColor: 'rgba(25, 118, 210, 1)',
                    backgroundColor: 'rgba(25, 118, 210, 0.2)',
                    data: yields,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Yield (t/ha)',
                            font: {
                                size: 14
                            }
                        },
                        grid: {
                            color: '#e0e7ff'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    }

    function capitalize(str) {
        return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
    }
    </script>
</body>

</html>

<?php
ob_flush();
?>