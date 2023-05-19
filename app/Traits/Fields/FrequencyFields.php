<?php

namespace App\Traits\Fields;

trait FrequencyFields { 
    public $frequencyChildProfileFields = [];

    public $frequencyFormFields = [
        'id' => null,
        'activity' => false,
        'frequency_type' => null,
        'frequency' => null,
        'frequency_string' => null,
        'activity' => null,
        'frequency_type_options' => [
            [
                'value' => 'Acknowledgments',
                'label' => 'Acknowledgments'
            ],
            [
                'value' => 'Revision',
                'label' => 'Revision'
            ]
        ],
        'frequency_date_type_options' => [
            [
                'value' => 'Month',
                'label' => 'Month'
            ],
            [
                'value' => 'Year',
                'label' => 'Year'
            ]
        ],
        'frequency_date_type_options_plural' => [
            [
                'value' => 'Months',
                'label' => 'Months'
            ],
            [
                'value' => 'Years',
                'label' => 'Years'
            ]
        ],
        'frequency_date_type' => null
    ];
}