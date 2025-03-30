<?php
function getCropData($state = '') {
    $crops = [
        'Wheat' => [
            'temp_min' => 10, 'temp_max' => 25, 'temp_optimal' => 18,
            'humidity_min' => 40, 'humidity_max' => 80, 'humidity_optimal' => 60,
            'precipitation_min' => 2, 'precipitation_max' => 25, 'precipitation_optimal' => 15,
            'season' => 'Rabi (Oct-Mar)', 'reason' => 'Cool temperatures and moderate rainfall',
            'base_yield' => 3.5, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'black', 'forest'], 'ph_preference' => ['neutral', 'alkaline'],
            'water_requirement' => 'Medium', 'type' => 'cereals'
        ],
        'Rice' => [
            'temp_min' => 20, 'temp_max' => 38, 'temp_optimal' => 28,
            'humidity_min' => 60, 'humidity_max' => 95, 'humidity_optimal' => 80,
            'precipitation_min' => 20, 'precipitation_max' => 70, 'precipitation_optimal' => 45,
            'season' => 'Kharif (Jun-Nov)', 'reason' => 'Warm humid conditions and substantial rainfall',
            'base_yield' => 4.0, 'yield_factors' => ['temp' => 0.3, 'humidity' => 0.3, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red', 'peaty'], 'ph_preference' => ['acidic', 'neutral'],
            'water_requirement' => 'Very High', 'type' => 'cereals'
        ],
        'Maize' => [
            'temp_min' => 15, 'temp_max' => 32, 'temp_optimal' => 24,
            'humidity_min' => 40, 'humidity_max' => 80, 'humidity_optimal' => 65,
            'precipitation_min' => 10, 'precipitation_max' => 30, 'precipitation_optimal' => 20,
            'season' => 'Kharif & Rabi', 'reason' => 'Adaptable to various conditions',
            'base_yield' => 3.8, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red', 'black'], 'ph_preference' => ['neutral'],
            'water_requirement' => 'Medium', 'type' => 'cereals'
        ],
        'Bajra (Pearl Millet)' => [
            'temp_min' => 25, 'temp_max' => 40, 'temp_optimal' => 30,
            'humidity_min' => 30, 'humidity_max' => 60, 'humidity_optimal' => 45,
            'precipitation_min' => 5, 'precipitation_max' => 20, 'precipitation_optimal' => 12,
            'season' => 'Kharif (Jun-Oct)', 'reason' => 'Drought-tolerant, thrives in arid conditions',
            'base_yield' => 2.0, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['arid', 'red', 'alluvial'], 'ph_preference' => ['neutral'],
            'water_requirement' => 'Low', 'type' => 'cereals'
        ],
        'Ragi (Finger Millet)' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 27,
            'humidity_min' => 40, 'humidity_max' => 80, 'humidity_optimal' => 60,
            'precipitation_min' => 10, 'precipitation_max' => 30, 'precipitation_optimal' => 20,
            'season' => 'Kharif (Jun-Oct)', 'reason' => 'Adaptable to warm climates',
            'base_yield' => 2.2, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['red', 'alluvial', 'laterite'], 'ph_preference' => ['neutral', 'acidic'],
            'water_requirement' => 'Medium', 'type' => 'cereals'
        ],
        'Sorghum (Jowar)' => [
            'temp_min' => 20, 'temp_max' => 40, 'temp_optimal' => 30,
            'humidity_min' => 30, 'humidity_max' => 70, 'humidity_optimal' => 50,
            'precipitation_min' => 5, 'precipitation_max' => 20, 'precipitation_optimal' => 15,
            'season' => 'Kharif & Rabi', 'reason' => 'Drought-tolerant, thrives in warm climates',
            'base_yield' => 2.8, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red', 'arid'], 'ph_preference' => ['neutral'],
            'water_requirement' => 'Low', 'type' => 'cereals'
        ],
        'Barley' => [
            'temp_min' => 10, 'temp_max' => 25, 'temp_optimal' => 15,
            'humidity_min' => 40, 'humidity_max' => 75, 'humidity_optimal' => 60,
            'precipitation_min' => 3, 'precipitation_max' => 20, 'precipitation_optimal' => 12,
            'season' => 'Rabi (Oct-Mar)', 'reason' => 'Cool and dry conditions',
            'base_yield' => 3.0, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'black', 'forest'], 'ph_preference' => ['neutral', 'alkaline'],
            'water_requirement' => 'Low', 'type' => 'cereals'
        ],
        'Potato' => [
            'temp_min' => 10, 'temp_max' => 25, 'temp_optimal' => 18,
            'humidity_min' => 50, 'humidity_max' => 85, 'humidity_optimal' => 70,
            'precipitation_min' => 5, 'precipitation_max' => 30, 'precipitation_optimal' => 15,
            'season' => 'Rabi (Oct-Mar)', 'reason' => 'Cool temperatures for tuber formation',
            'base_yield' => 20.0, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red', 'forest'], 'ph_preference' => ['acidic', 'neutral'],
            'water_requirement' => 'Medium', 'type' => 'vegetables'
        ],
        'Cotton' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 28,
            'humidity_min' => 40, 'humidity_max' => 70, 'humidity_optimal' => 55,
            'precipitation_min' => 10, 'precipitation_max' => 35, 'precipitation_optimal' => 25,
            'season' => 'Kharif (Apr-Oct)', 'reason' => 'Warm and moderately humid conditions',
            'base_yield' => 2.5, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['black', 'alluvial'], 'ph_preference' => ['neutral', 'alkaline'],
            'water_requirement' => 'Medium', 'type' => 'cash-crops'
        ],
        'Sugarcane' => [
            'temp_min' => 20, 'temp_max' => 38, 'temp_optimal' => 30,
            'humidity_min' => 50, 'humidity_max' => 85, 'humidity_optimal' => 70,
            'precipitation_min' => 15, 'precipitation_max' => 40, 'precipitation_optimal' => 25,
            'season' => 'Year-round (12-18 month crop)', 'reason' => 'Warm and humid conditions',
            'base_yield' => 70.0, 'yield_factors' => ['temp' => 0.3, 'humidity' => 0.3, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'black'], 'ph_preference' => ['neutral', 'alkaline'],
            'water_requirement' => 'High', 'type' => 'cash-crops'
        ],
        'Chickpea (Gram)' => [
            'temp_min' => 15, 'temp_max' => 30, 'temp_optimal' => 22,
            'humidity_min' => 35, 'humidity_max' => 70, 'humidity_optimal' => 50,
            'precipitation_min' => 4, 'precipitation_max' => 15, 'precipitation_optimal' => 8,
            'season' => 'Rabi (Oct-Mar)', 'reason' => 'Cool and relatively dry conditions',
            'base_yield' => 1.8, 'yield_factors' => ['temp' => 0.35, 'humidity' =>0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['black', 'alluvial'], 'ph_preference' => ['neutral', 'alkaline'],
            'water_requirement' => 'Low', 'type' => 'pulses'
        ],
        'Mustard' => [
            'temp_min' => 10, 'temp_max' => 25, 'temp_optimal' => 18,
            'humidity_min' => 40, 'humidity_max' => 70, 'humidity_optimal' => 55,
            'precipitation_min' => 4, 'precipitation_max' => 15, 'precipitation_optimal' => 8,
            'season' => 'Rabi (Oct-Mar)', 'reason' => 'Cool and dry conditions',
            'base_yield' => 1.2, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'black'], 'ph_preference' => ['neutral'],
            'water_requirement' => 'Low', 'type' => 'oilseeds'
        ],
        'Tomato' => [
            'temp_min' => 15, 'temp_max' => 32, 'temp_optimal' => 25,
            'humidity_min' => 50, 'humidity_max' => 80, 'humidity_optimal' => 65,
            'precipitation_min' => 5, 'precipitation_max' => 25, 'precipitation_optimal' => 15,
            'season' => 'Year-round (regional variations)', 'reason' => 'Moderate temperature and even moisture',
            'base_yield' => 25.0, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['red', 'alluvial', 'black'], 'ph_preference' => ['acidic', 'neutral'],
            'water_requirement' => 'Medium', 'type' => 'vegetables'
        ],
        'Mango' => [
            'temp_min' => 20, 'temp_max' => 40, 'temp_optimal' => 30,
            'humidity_min' => 40, 'humidity_max' => 80, 'humidity_optimal' => 60,
            'precipitation_min' => 10, 'precipitation_max' => 35, 'precipitation_optimal' => 25,
            'season' => 'Perennial (Harvest: Apr-Jul)', 'reason' => 'Hot climate with distinct dry period',
            'base_yield' => 10.0, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red', 'black'], 'ph_preference' => ['neutral', 'acidic'],
            'water_requirement' => 'Low to Medium', 'type' => 'fruits'
        ],
        'Turmeric' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 28,
            'humidity_min' => 60, 'humidity_max' => 90, 'humidity_optimal' => 80,
            'precipitation_min' => 15, 'precipitation_max' => 40, 'precipitation_optimal' => 25,
            'season' => 'Kharif (Jun-Oct)', 'reason' => 'Warm and humid conditions',
            'base_yield' => 6.0, 'yield_factors' => ['temp' => 0.3, 'humidity' => 0.35, 'precipitation' => 0.25, 'water' => 0.1],
            'soil_preference' => ['red', 'alluvial', 'forest'], 'ph_preference' => ['neutral', 'acidic'],
            'water_requirement' => 'Medium', 'type' => 'spices'
        ],
        'Soybean' => [
            'temp_min' => 20, 'temp_max' => 30, 'temp_optimal' => 25,
            'humidity_min' => 50, 'humidity_max' => 85, 'humidity_optimal' => 70,
            'precipitation_min' => 10, 'precipitation_max' => 30, 'precipitation_optimal' => 20,
            'season' => 'Kharif (Jun-Oct)', 'reason' => 'Warm temperatures with moderate rainfall',
            'base_yield' => 2.5, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'black', 'red'], 'ph_preference' => ['neutral', 'acidic'],
            'water_requirement' => 'Medium', 'type' => 'oilseeds'
        ],
        'Groundnut' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 28,
            'humidity_min' => 40, 'humidity_max' => 70, 'humidity_optimal' => 55,
            'precipitation_min' => 10, 'precipitation_max' => 25, 'precipitation_optimal' => 15,
            'season' => 'Kharif (Jun-Oct)', 'reason' => 'Warm climate with moderate moisture',
            'base_yield' => 1.8, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['red', 'alluvial', 'arid'], 'ph_preference' => ['neutral', 'acidic'],
            'water_requirement' => 'Low to Medium', 'type' => 'oilseeds'
        ],
        'Lentil' => [
            'temp_min' => 15, 'temp_max' => 28, 'temp_optimal' => 20,
            'humidity_min' => 40, 'humidity_max' => 70, 'humidity_optimal' => 55,
            'precipitation_min' => 3, 'precipitation_max' => 15, 'precipitation_optimal' => 8,
            'season' => 'Rabi (Oct-Mar)', 'reason' => 'Cool and dry conditions',
            'base_yield' => 1.5, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'black'], 'ph_preference' => ['neutral', 'alkaline'],
            'water_requirement' => 'Low', 'type' => 'pulses'
        ],
        'Onion' => [
            'temp_min' => 13, 'temp_max' => 30, 'temp_optimal' => 22,
            'humidity_min' => 50, 'humidity_max' => 80, 'humidity_optimal' => 65,
            'precipitation_min' => 5, 'precipitation_max' => 20, 'precipitation_optimal' => 12,
            'season' => 'Rabi (Oct-Mar) or Kharif (Jun-Oct)', 'reason' => 'Moderate climate with consistent moisture',
            'base_yield' => 15.0, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red', 'black'], 'ph_preference' => ['neutral', 'acidic'],
            'water_requirement' => 'Medium', 'type' => 'vegetables'
        ],
        'Banana' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 28,
            'humidity_min' => 60, 'humidity_max' => 90, 'humidity_optimal' => 75,
            'precipitation_min' => 15, 'precipitation_max' => 40, 'precipitation_optimal' => 25,
            'season' => 'Year-round (Perennial)', 'reason' => 'Warm and humid tropical conditions',
            'base_yield' => 20.0, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.3, 'precipitation' => 0.25, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red'], 'ph_preference' => ['acidic', 'neutral'],
            'water_requirement' => 'High', 'type' => 'fruits'
        ],
        'Coffee' => [
            'temp_min' => 15, 'temp_max' => 28, 'temp_optimal' => 22,
            'humidity_min' => 50, 'humidity_max' => 85, 'humidity_optimal' => 70,
            'precipitation_min' => 20, 'precipitation_max' => 50, 'precipitation_optimal' => 35,
            'season' => 'Perennial (Harvest: Oct-Mar)', 'reason' => 'Warm, humid conditions with well-distributed rainfall',
            'base_yield' => 1.0, 'yield_factors' => ['temp' => 0.3, 'humidity' => 0.3, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['forest', 'red', 'laterite'], 'ph_preference' => ['acidic'],
            'water_requirement' => 'Medium to High', 'type' => 'cash-crops'
        ],
        'Tea' => [
            'temp_min' => 15, 'temp_max' => 30, 'temp_optimal' => 25,
            'humidity_min' => 60, 'humidity_max' => 90, 'humidity_optimal' => 80,
            'precipitation_min' => 20, 'precipitation_max' => 60, 'precipitation_optimal' => 40,
            'season' => 'Perennial (Harvest: Year-round)', 'reason' => 'Warm, humid conditions with high rainfall',
            'base_yield' => 1.5, 'yield_factors' => ['temp' => 0.3, 'humidity' => 0.35, 'precipitation' => 0.25, 'water' => 0.1],
            'soil_preference' => ['forest', 'red', 'laterite'], 'ph_preference' => ['acidic'],
            'water_requirement' => 'High', 'type' => 'cash-crops'
        ],
        'Chilli' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 27,
            'humidity_min' => 50, 'humidity_max' => 80, 'humidity_optimal' => 65,
            'precipitation_min' => 10, 'precipitation_max' => 25, 'precipitation_optimal' => 15,
            'season' => 'Kharif (Jun-Oct)', 'reason' => 'Warm climate with moderate moisture',
            'base_yield' => 2.0, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['red', 'black', 'alluvial'], 'ph_preference' => ['neutral', 'acidic'],
            'water_requirement' => 'Medium', 'type' => 'spices'
        ],
        'Pigeon Pea (Arhar)' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 28,
            'humidity_min' => 40, 'humidity_max' => 80, 'humidity_optimal' => 60,
            'precipitation_min' => 10, 'precipitation_max' => 30, 'precipitation_optimal' => 20,
            'season' => 'Kharif (Jun-Oct)', 'reason' => 'Warm and moderate rainfall',
            'base_yield' => 1.2, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red'], 'ph_preference' => ['neutral'],
            'water_requirement' => 'Low to Medium', 'type' => 'pulses'
        ],
        'Jute' => [
            'temp_min' => 24, 'temp_max' => 35, 'temp_optimal' => 30,
            'humidity_min' => 70, 'humidity_max' => 90, 'humidity_optimal' => 85,
            'precipitation_min' => 25, 'precipitation_max' => 50, 'precipitation_optimal' => 35,
            'season' => 'Kharif (Mar-Jul)', 'reason' => 'Hot and humid conditions',
            'base_yield' => 2.0, 'yield_factors' => ['temp' => 0.3, 'humidity' => 0.35, 'precipitation' => 0.25, 'water' => 0.1],
            'soil_preference' => ['alluvial'], 'ph_preference' => ['neutral'],
            'water_requirement' => 'High', 'type' => 'cash-crops'
        ],
        'Watermelon' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 28,
            'humidity_min' => 50, 'humidity_max' => 80, 'humidity_optimal' => 65,
            'precipitation_min' => 5, 'precipitation_max' => 20, 'precipitation_optimal' => 12,
            'season' => 'Zaid (Mar-Jun)', 'reason' => 'Warm and dry summer conditions',
            'base_yield' => 20.0, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red', 'sandy'], 'ph_preference' => ['neutral'],
            'water_requirement' => 'Medium', 'type' => 'fruits'
        ],
        'Cucumber' => [
            'temp_min' => 20, 'temp_max' => 32, 'temp_optimal' => 26,
            'humidity_min' => 60, 'humidity_max' => 90, 'humidity_optimal' => 75,
            'precipitation_min' => 5, 'precipitation_max' => 20, 'precipitation_optimal' => 15,
            'season' => 'Zaid (Mar-Jun)', 'reason' => 'Warm weather with adequate moisture',
            'base_yield' => 15.0, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.25, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red'], 'ph_preference' => ['neutral'],
            'water_requirement' => 'Medium', 'type' => 'vegetables'
        ],
        'Sunflower' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 25,
            'humidity_min' => 40, 'humidity_max' => 70, 'humidity_optimal' => 55,
            'precipitation_min' => 10, 'precipitation_max' => 25, 'precipitation_optimal' => 15,
            'season' => 'Kharif & Rabi', 'reason' => 'Warm and dry conditions',
            'base_yield' => 1.5, 'yield_factors' => ['temp' => 0.4, 'humidity' => 0.2, 'precipitation' => 0.3, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'black'], 'ph_preference' => ['neutral'],
            'water_requirement' => 'Medium', 'type' => 'oilseeds'
        ],
        'Cardamom' => [
            'temp_min' => 15, 'temp_max' => 30, 'temp_optimal' => 22,
            'humidity_min' => 70, 'humidity_max' => 90, 'humidity_optimal' => 80,
            'precipitation_min' => 20, 'precipitation_max' => 50, 'precipitation_optimal' => 35,
            'season' => 'Perennial (Harvest: Aug-Dec)', 'reason' => 'Warm, humid conditions with high rainfall',
            'base_yield' => 0.2, 'yield_factors' => ['temp' => 0.3, 'humidity' => 0.35, 'precipitation' => 0.25, 'water' => 0.1],
            'soil_preference' => ['forest', 'laterite'], 'ph_preference' => ['acidic'],
            'water_requirement' => 'High', 'type' => 'spices'
        ],
        'Coconut' => [
            'temp_min' => 20, 'temp_max' => 35, 'temp_optimal' => 28,
            'humidity_min' => 60, 'humidity_max' => 90, 'humidity_optimal' => 80,
            'precipitation_min' => 15, 'precipitation_max' => 40, 'precipitation_optimal' => 25,
            'season' => 'Perennial (Year-round)', 'reason' => 'Warm, humid tropical conditions',
            'base_yield' => 50.0, 'yield_factors' => ['temp' => 0.35, 'humidity' => 0.3, 'precipitation' => 0.25, 'water' => 0.1],
            'soil_preference' => ['alluvial', 'red', 'sandy'], 'ph_preference' => ['neutral', 'acidic'],
            'water_requirement' => 'Medium to High', 'type' => 'fruits'
        ]
    ];

    $stateCrops = [
        'andhra pradesh' => [
            'Rice', 'Sugarcane', 'Cotton', 'Groundnut', 'Turmeric', 'Chilli', 'Maize', 'Mango', 
            'Banana', 'Tomato', 'Sorghum', 'Pigeon Pea', 'Sunflower'
        ],
        'arunachal pradesh' => [
            'Rice', 'Maize', 'Mustard', 'Mango', 'Banana', 'Chilli', 'Turmeric', 'Cardamom'
        ],
        'assam' => [
            'Rice', 'Tea', 'Mustard', 'Chilli', 'Banana', 'Mango', 'Potato', 'Turmeric', 'Maize', 'Jute'
        ],
        'bihar' => [
            'Rice', 'Wheat', 'Maize', 'Sugarcane', 'Lentil', 'Mustard', 'Potato', 'Onion', 'Mango', 'Jute'
        ],
        'chhattisgarh' => [
            'Rice', 'Maize', 'Chickpea', 'Pigeon Pea', 'Soybean', 'Groundnut', 'Sugarcane'
        ],
        'goa' => [
            'Rice', 'Mango', 'Banana', 'Coconut', 'Chilli', 'Turmeric'
        ],
        'gujarat' => [
            'Cotton', 'Groundnut', 'Wheat', 'Bajra', 'Maize', 'Sugarcane', 'Chickpea', 'Mustard', 
            'Mango', 'Banana', 'Tomato'
        ],
        'haryana' => [
            'Wheat', 'Rice', 'Cotton', 'Sugarcane', 'Mustard', 'Barley', 'Maize', 'Chickpea', 'Bajra'
        ],
        'himachal pradesh' => [
            'Wheat', 'Barley', 'Maize', 'Potato', 'Tomato', 'Peas', 'Apple'
        ],
        'jharkhand' => [
            'Rice', 'Maize', 'Chickpea', 'Mustard', 'Potato', 'Mango', 'Tomato', 'Pigeon Pea'
        ],
        'karnataka' => [
            'Rice', 'Sugarcane', 'Cotton', 'Turmeric', 'Mango', 'Coffee', 'Chilli', 'Maize', 
            'Groundnut', 'Soybean', 'Banana', 'Tomato', 'Ragi', 'Sorghum', 'Sunflower'
        ],
        'kerala' => [
            'Rice', 'Banana', 'Coffee', 'Tea', 'Chilli', 'Turmeric', 'Mango', 'Sugarcane', 
            'Groundnut', 'Tomato', 'Coconut', 'Cardamom'
        ],
        'madhya pradesh' => [
            'Wheat', 'Soybean', 'Chickpea', 'Cotton', 'Maize', 'Sugarcane', 'Groundnut', 'Rice', 
            'Mustard', 'Pigeon Pea'
        ],
        'maharashtra' => [
            'Cotton', 'Sugarcane', 'Chickpea', 'Turmeric', 'Mango', 'Soybean', 'Groundnut', 
            'Wheat', 'Rice', 'Maize', 'Tomato', 'Onion', 'Banana', 'Bajra', 'Sorghum', 'Sunflower'
        ],
        'manipur' => [
            'Rice', 'Maize', 'Mustard', 'Potato', 'Chilli', 'Banana', 'Pineapple'
        ],
        'meghalaya' => [
            'Rice', 'Maize', 'Potato', 'Turmeric', 'Chilli', 'Banana', 'Pineapple'
        ],
        'mizoram' => [
            'Rice', 'Maize', 'Chilli', 'Turmeric', 'Banana', 'Mango'
        ],
        'nagaland' => [
            'Rice', 'Maize', 'Mustard', 'Chilli', 'Banana', 'Pineapple'
        ],
        'odisha' => [
            'Rice', 'Sugarcane', 'Groundnut', 'Mustard', 'Cotton', 'Maize', 'Mango', 'Tomato', 
            'Pigeon Pea', 'Jute'
        ],
        'punjab' => [
            'Wheat', 'Rice', 'Cotton', 'Sugarcane', 'Mustard', 'Barley', 'Chickpea', 'Maize', 
            'Potato', 'Lentil', 'Onion'
        ],
        'rajasthan' => [
            'Bajra', 'Wheat', 'Mustard', 'Chickpea', 'Cotton', 'Maize', 'Groundnut', 'Barley', 
            'Sorghum', 'Watermelon'
        ],
        'sikkim' => [
            'Rice', 'Maize', 'Potato', 'Chilli', 'Turmeric', 'Cardamom'
        ],
        'tamil nadu' => [
            'Rice', 'Sugarcane', 'Turmeric', 'Mango', 'Tomato', 'Banana', 'Coffee', 'Chilli', 
            'Groundnut', 'Cotton', 'Maize', 'Onion', 'Ragi', 'Coconut'
        ],
        'telangana' => [
            'Rice', 'Maize', 'Cotton', 'Sugarcane', 'Groundnut', 'Turmeric', 'Chilli', 'Mango', 
            'Soybean', 'Pigeon Pea'
        ],
        'tripura' => [
            'Rice', 'Potato', 'Jute', 'Mango', 'Banana', 'Chilli', 'Turmeric'
        ],
        'uttar pradesh' => [
            'Wheat', 'Sugarcane', 'Potato', 'Lentil', 'Mustard', 'Onion', 'Rice', 'Maize', 
            'Chickpea', 'Barley', 'Tomato', 'Mango', 'Bajra'
        ],
        'uttarakhand' => [
            'Wheat', 'Rice', 'Potato', 'Lentil', 'Mustard', 'Maize', 'Tomato', 'Barley'
        ],
        'west bengal' => [
            'Rice', 'Potato', 'Jute', 'Mustard', 'Sugarcane', 'Tomato', 'Mango', 'Banana', 'Tea'
        ]
    ];

    $state = strtolower($state);
    if (isset($stateCrops[$state])) {
        foreach ($crops as $cropName => &$cropData) {
            $cropData['state_suggested'] = in_array($cropName, $stateCrops[$state]);
        }
    }

    return $crops;
}
?>