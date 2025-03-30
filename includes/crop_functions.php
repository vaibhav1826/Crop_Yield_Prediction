<?php
require_once 'crop_data.php'; // Include crop data for getCropData()

function filterCropsByType($crops, $cropType) {
    $filtered = [];
    foreach ($crops as $cropName => $cropData) {
        if ($cropData['type'] === $cropType) {
            $filtered[$cropName] = $cropData;
        }
    }
    return !empty($filtered) ? $filtered : $crops; // Return all crops if no matches
}

function calculateCropScores($crops, $weatherData, $soilData, $currentDate = '2025-03-30') {
    $scoredCrops = [];
    $currentMonth = (int)date('n', strtotime($currentDate)); // Extract month dynamically (1-12)

    foreach ($crops as $cropName => $cropData) {
        // Temperature Scoring (More granular penalties)
        $temp = $weatherData['forecast_avg_temp'];
        $tempScore = 100;
        if ($temp < $cropData['temp_min']) {
            $tempScore -= min(100, ($cropData['temp_min'] - $temp) * 10); // Severe penalty below min
        } elseif ($temp > $cropData['temp_max']) {
            $tempScore -= min(100, ($temp - $cropData['temp_max']) * 10); // Severe penalty above max
        } else {
            $tempDiff = abs($temp - $cropData['temp_optimal']);
            $tempScore -= min(50, $tempDiff * 5); // Gradual penalty near optimal
        }

        // Humidity Scoring (Balanced penalties)
        $humidity = $weatherData['humidity'];
        $humidityScore = 100;
        if ($humidity < $cropData['humidity_min']) {
            $humidityScore -= min(100, ($cropData['humidity_min'] - $humidity) * 2.5);
        } elseif ($humidity > $cropData['humidity_max']) {
            $humidityScore -= min(100, ($humidity - $cropData['humidity_max']) * 2.5);
        } else {
            $humidityDiff = abs($humidity - $cropData['humidity_optimal']);
            $humidityScore -= min(40, $humidityDiff * 1.5); // Moderate penalty near optimal
        }

        // Precipitation Scoring (Adjusted for frequency and extremes)
        $precipitation = $weatherData['total_precipitation_5day'];
        $precipitationFreq = $weatherData['precipitation_frequency']; // 0 to 1 (0 = no rain, 1 = daily rain)
        $precipitationScore = 100;
        if ($precipitation < $cropData['precipitation_min']) {
            $precipitationScore -= min(100, ($cropData['precipitation_min'] - $precipitation) * 4);
        } elseif ($precipitation > $cropData['precipitation_max']) {
            $precipitationScore -= min(100, ($precipitation - $cropData['precipitation_max']) * 4);
        } else {
            $precipitationDiff = abs($precipitation - $cropData['precipitation_optimal']);
            $precipitationScore -= min(50, $precipitationDiff * 2);
        }
        // Adjust for precipitation frequency (favor evenly distributed rain)
        $idealFreq = ($cropData['water_requirement'] === 'Low' || $cropData['water_requirement'] === 'Low to Medium') ? 0.3 : 0.6;
        $precipitationScore *= (1 - abs($precipitationFreq - $idealFreq) * 0.3);

        // Water Availability Scoring (Improved logic)
        $waterScore = matchWaterRequirement($cropData['water_requirement'], $soilData['irrigation'] ?? 'rainfed', $precipitation);

        // Season Scoring (More precise with planting windows)
        $seasonScore = calculateSeasonScore($cropData['season'], $currentMonth);

        // Soil Compatibility (Enhanced weighting)
        $soilScore = 100;
        if (!empty($soilData)) {
            $soilTypeMatch = in_array($soilData['type'], $cropData['soil_preference']) ? 1.0 : 0.7; // Stricter penalty for mismatch
            $phMatch = !empty($soilData['ph']) && in_array($soilData['ph'], $cropData['ph_preference']) ? 1.0 : 0.8;
            $yieldModifier = $soilData['yield_modifier'] ?? 1.0; // Default to neutral if not provided
            $soilScore = ($soilTypeMatch * 50 + $phMatch * 30 + $yieldModifier * 20); // Weighted soil score
        }

        // Overall Score Calculation (Balanced contribution)
        $overallScore = (
            $tempScore * $cropData['yield_factors']['temp'] +
            $humidityScore * $cropData['yield_factors']['humidity'] +
            $precipitationScore * $cropData['yield_factors']['precipitation'] +
            $waterScore * $cropData['yield_factors']['water']
        ) * ($seasonScore / 100) * ($soilScore / 100);

        // Yield Projection (More realistic range)
        $yieldPercentage = min(1.3, max(0.4, $overallScore / 100)); // Allow slight overperformance, cap underperformance
        $projectedYield = round($cropData['base_yield'] * $yieldPercentage, 2);

        // Suitability Classification (Refined thresholds)
        $suitability = 'unsuitable';
        if ($overallScore >= 90) {
            $suitability = 'highly-suitable';
        } elseif ($overallScore >= 75) {
            $suitability = 'suitable';
        } elseif ($overallScore >= 50) {
            $suitability = 'marginally-suitable';
        }

        $scoredCrops[$cropName] = [
            'overall_score' => round($overallScore, 1),
            'temp_score' => round($tempScore, 1), // Added for debugging/insight
            'humidity_score' => round($humidityScore, 1),
            'precipitation_score' => round($precipitationScore, 1),
            'water_score' => round($waterScore, 1),
            'season_score' => round($seasonScore, 1),
            'soil_score' => round($soilScore, 1),
            'season' => $cropData['season'],
            'reason' => $cropData['reason'],
            'projected_yield' => $projectedYield,
            'base_yield' => $cropData['base_yield'],
            'state_suggested' => $cropData['state_suggested'] ?? false,
            'suitability' => $suitability
        ];
    }
    return $scoredCrops;
}

function matchWaterRequirement($requirement, $irrigation, $precipitation) {
    $waterScore = 100;
    switch ($requirement) {
        case 'Very High':
            if ($irrigation === 'full' && $precipitation >= 25) $waterScore = 100;
            elseif ($irrigation === 'partial' && $precipitation >= 20) $waterScore = 90;
            elseif ($precipitation >= 15) $waterScore = 75;
            else $waterScore = 50;
            break;
        case 'High':
            if ($irrigation === 'full' || $precipitation >= 20) $waterScore = 100;
            elseif ($irrigation === 'partial' || $precipitation >= 15) $waterScore = 90;
            elseif ($precipitation >= 10) $waterScore = 80;
            else $waterScore = 60;
            break;
        case 'Medium':
            if ($irrigation === 'full' || $precipitation >= 15) $waterScore = 100;
            elseif ($irrigation === 'partial' || $precipitation >= 10) $waterScore = 90;
            elseif ($precipitation >= 5) $waterScore = 80;
            else $waterScore = 70;
            break;
        case 'Low to Medium':
            if ($irrigation !== 'rainfed' || $precipitation >= 10) $waterScore = 100;
            elseif ($precipitation >= 5) $waterScore = 90;
            else $waterScore = 80;
            break;
        case 'Low':
            if ($precipitation >= 5 || $irrigation !== 'rainfed') $waterScore = 100;
            else $waterScore = 90;
            break;
    }
    return $waterScore;
}

function calculateSeasonScore($season, $currentMonth) {
    $seasonScore = 100; // Default neutral score

    // Define season windows more precisely
    if (strpos($season, 'Rabi') !== false) {
        $isRabiSeason = ($currentMonth >= 10 || $currentMonth <= 3); // Oct-Mar planting window
        $seasonScore = $isRabiSeason ? 110 : 70; // Boost in season, penalize out of season
    } elseif (strpos($season, 'Kharif') !== false) {
        $isKharifSeason = ($currentMonth >= 6 && $currentMonth <= 11); // Jun-Nov planting window
        $seasonScore = $isKharifSeason ? 110 : 70;
    } elseif (strpos($season, 'Zaid') !== false) {
        $isZaidSeason = ($currentMonth >= 3 && $currentMonth <= 6); // Mar-Jun planting window
        $seasonScore = $isZaidSeason ? 110 : 70;
    } elseif (strpos($season, 'Year-round') !== false || strpos($season, 'Perennial') !== false) {
        $seasonScore = 100; // No seasonal penalty/boost
    } else {
        $seasonScore = 80; // Default penalty for undefined seasons
    }

    return $seasonScore;
}

function getScoredRecommendations($scoredCrops) {
    uasort($scoredCrops, function($a, $b) {
        // Primary sort by overall score, secondary by projected yield
        if ($a['overall_score'] === $b['overall_score']) {
            return $b['projected_yield'] <=> $a['projected_yield'];
        }
        return $b['overall_score'] <=> $a['overall_score'];
    });
    return $scoredCrops;
}
?>