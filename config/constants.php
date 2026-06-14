<?php

return [
   
    'area_types' => [

					
                    'Sq. Ft.',
                    'Sq. M.',
                    'Sq. Yd.',
                    'Marla',
                    'Kanal'                        					
						
					],

    'property_types' => [
                            'home', 
                            'plot', 
                            'commercial'
                        ],

    'offering' => [
                            'Flats', 
                            'Plots',
                            'Shops', 
                            'Offices',                            
                            'Villas',                            
                        ],
    'purpose' => [
                            'sell' => 'Sell', 
                            'rent' => 'Rent', 
                        ],
    'furnishing' => [
                        'furnished' => 'Furnished',
                        'semi-furnished' => 'Semi-Furnished',
                        'unfurnished' => 'Unfurnished',
                    ],
    'listing_types' => [
                        'owner' => 'Owner',
                        'agent' => 'Agent',
                        'builder' => 'Builder/Developer',
                    ],
    'progress' => [
                            'under_construction' => 'Under Construction ', 
                            'new_launch' => 'New Launch ', 
                            'ready' => 'Ready/Close to Possession '
                        ],

	'user_types' => [
    					'vendor' => env('VENDOR', 'vendor'),
    					'admin' => env('ADMIN', 'admin'),
    					'member' => env('Member', 'member'),   					
						
						],
    'price_types' => [
                            
                            'Lakh', 
                            'Crore',
                            'Thousand',  
                        ],
    
    'date_format' => env('DATE_FROMAT', 'd-M-Y'),

    'bedrooms' => ['Studio',1,2,3,4,5,6,7,8,9,10,'10+'],
    
    'bathrooms' => [1,2,3,4,5,6,'6+'],

    'project_text_limit' => 200,
    
    'property_text_limit' => 200,

    'project_features' => [
                            'Prayer Area', 
                            'Park',
                            'Commerical Area', 
                            'Hospital',                            
                            'Educational Area',                            
                        ],
    'compare_project_limit' => 2,
    'admin_email' => env('ADMIN_EMAIL', 'khalique.ahmed3@gmail.com'),
    'payment_plan_duration' => [
                                1 => '3 Months',
                                2 => '6 Months',
                                3 => '1 Year',
                                4 => '2 Years',
                                5 => '3 Years',
                                6 => '4 Years',
                                7 => '5 Years',
                                8 => '6 Years',
                                9 => '7 Years',
                                10 => '8 Years',
                                11 => '9 Years',
                                12 => '10 Years+',

    ],
    'bitrix24' => [
        'api_url' => env('BITRIX_API_URL','https://cmax.bitrix24.com/rest/21/7bxe2yjijxc5hcw0/'), 
        ]
];