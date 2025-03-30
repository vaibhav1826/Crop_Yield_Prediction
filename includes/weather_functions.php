<?php
function fetchWeatherData($location, $apiKey) {
    $openWeatherUrl = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($location) . "&appid=" . $apiKey . "&units=metric";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $openWeatherUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false || $httpCode !== 200) {
        showError('Unable to connect to weather service');
        return false;
    }

    $weatherData = json_decode($response, true);
    if (!$weatherData || $weatherData['cod'] != 200) {
        showError($weatherData['message'] ?? 'Location not found');
        return false;
    }

    $lat = $weatherData['coord']['lat'];
    $lon = $weatherData['coord']['lon'];

    $forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?lat=" . $lat . "&lon=" . $lon . "&appid=" . $apiKey . "&units=metric";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $forecastUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $forecastResponse = curl_exec($ch);
    curl_close($ch);
    $forecastData = json_decode($forecastResponse, true);

    return processWeatherData($weatherData, $forecastData);
}

function processWeatherData($currentWeather, $forecastData) {
    $weatherData = [
        'temp' => round($currentWeather['main']['temp'], 1),
        'humidity' => $currentWeather['main']['humidity'],
        'weather' => ucfirst($currentWeather['weather'][0]['description']),
        'wind_speed' => round($currentWeather['wind']['speed'], 1),
        'pressure' => $currentWeather['main']['pressure'],
        'timestamp' => date('Y-m-d H:i:s', $currentWeather['dt']),
        'sunrise' => $currentWeather['sys']['sunrise'],
        'sunset' => $currentWeather['sys']['sunset']
    ];

    $sunriseDate = new DateTime("@{$weatherData['sunrise']}");
    $sunsetDate = new DateTime("@{$weatherData['sunset']}");
    $interval = $sunriseDate->diff($sunsetDate);
    $weatherData['sunlight_hours'] = $interval->h + ($interval->i / 60);

    $totalPrecipitation = 0;
    $avgTemp = 0;
    $tempCount = 0;
    $precipitationDays = 0;
    if (isset($forecastData['list']) && is_array($forecastData['list'])) {
        foreach ($forecastData['list'] as $forecast) {
            $tempCount++;
            $avgTemp += $forecast['main']['temp'];
            if (isset($forecast['rain']) && isset($forecast['rain']['3h'])) {
                $totalPrecipitation += $forecast['rain']['3h'];
                $precipitationDays++;
            } elseif (isset($forecast['snow']) && isset($forecast['snow']['3h'])) {
                $totalPrecipitation += $forecast['snow']['3h'];
                $precipitationDays++;
            }
        }
    }
    $weatherData['total_precipitation_5day'] = round($totalPrecipitation, 1);
    $weatherData['forecast_avg_temp'] = $tempCount > 0 ? round($avgTemp / $tempCount, 1) : 0;
    $weatherData['precipitation_frequency'] = $tempCount > 0 ? round($precipitationDays / ($tempCount / 8), 2) : 0;

    return $weatherData;
}
?>