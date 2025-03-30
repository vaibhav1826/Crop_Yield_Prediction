<?php
function displayResults($location, $weatherData, $soilData, $recommendations, $topCrop, $topCropDetails, $historicalData, $trendAnalysis, $state) {
    $outputData = [
        'location' => $location,
        'weather_data' => $weatherData,
        'soil_data' => $soilData,
        'recommendations' => $recommendations,
        'top_crop' => $topCrop,
        'top_crop_details' => $topCropDetails,
        'historical_data' => $historicalData,
        'trend_analysis' => $trendAnalysis,
        'state' => $state
    ];

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            const resultData = " . json_encode($outputData) . ";
            displayResultsInUI(resultData);
        });
    </script>";
}

function showError($message) {
    echo "<script>
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('error-message').classList.remove('hidden');
        document.getElementById('error-text').textContent = '$message';
    </script>";
}
?>