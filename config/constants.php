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

    'project_features' => [
                            'Prayer Area', 
                            'Park',
                            'Commerical Area', 
                            'Hospital',                            
                            'Educational Area',                            
                        ],
    'compare_project_limit' => 4,
    'admin_email' => env('ADMIN_EMAIL', 'khalique.ahmed3@gmail.com'),
];