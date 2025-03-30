<?php
function getSoilData($soilType, $soilPh, $irrigation) {
    $soilData = [
        'type' => $soilType,
        'ph' => $soilPh,
        'irrigation' => $irrigation,
        'water_holding' => 'Medium',
        'fertility' => 'Medium',
        'drainage' => 'Medium',
        'yield_modifier' => 1.0
    ];

    switch ($soilType) {
        case 'alluvial':
            $soilData['water_holding'] = 'High';
            $soilData['fertility'] = 'High';
            $soilData['drainage'] = 'Good';
            $soilData['suitable_crops'] = ['Rice', 'Wheat', 'Sugarcane', 'Maize', 'Cotton'];
            $soilData['yield_modifier'] = 1.2;
            break;
        // ... (Add other cases as in your original code)
        case 'peaty':
            $soilData['water_holding'] = 'Very High';
            $soilData['fertility'] = 'Medium';
            $soilData['drainage'] = 'Very Poor';
            $soilData['suitable_crops'] = ['Rice'];
            $soilData['yield_modifier'] = 0.95;
            break;
    }

    if (!empty($soilPh)) {
        $soilData['ph_value'] = $soilPh === 'acidic' ? '4.5-6.0' : ($soilPh === 'neutral' ? '6.0-7.0' : '7.0-8.5');
    }

    return $soilData;
}
?>