<?php
require_once 'crop_data.php'; // For getCropData() used in base_yield

function processHistoricalAnalysis($state, $crop, $yearRange) {
    $currentYear = date('Y');
    $startYear = $currentYear - $yearRange;
    $historicalData = [];
    $baseYield = getCropData()[$crop]['base_yield'] ?? 3.0;
    $trend = rand(-10, 20) / 100;
    $trendFactor = 1.0;

    for ($year = $startYear; $year <= $currentYear; $year++) {
        $trendFactor += $trend;
        $yearYield = $baseYield * $trendFactor * (1 + (rand(-10, 10) / 100));
        $historicalData[] = [
            'year' => $year,
            'yield' => round($yearYield, 2),
            'area' => round(rand(80, 120) / 100 * 10000),
            'production' => round($yearYield * (rand(80, 120) / 100 * 10000))
        ];
    }

    $projectedYield = $baseYield * ($trendFactor + $trend) * (1 + (rand(-5, 5) / 100));
    $firstYield = $historicalData[0]['yield'];
    $lastYield = $historicalData[count($historicalData) - 1]['yield'];
    $overallChange = (($lastYield - $firstYield) / $firstYield) * 100;

    $trendAnalysis = [
        'trend_direction' => $overallChange >= 0 ? 'Positive' : 'Negative',
        'overall_change_pct' => round($overallChange, 1),
        'projected_next_year' => round($projectedYield, 2)
    ];

    return [$historicalData, $trendAnalysis];
}
?>