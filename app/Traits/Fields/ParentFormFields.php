<?php

namespace App\Traits\Fields;

trait ParentFormFields {
    
    public $parentFields = [
        "phone_type_1_option" => [
            [
                'value' => 0,
                'label' => 'Primary Number'
            ],
            [
                'value' => 1,
                'label' => 'Business Number'
            ],
            [
                'value' => 2,
                'label' => 'Work Number'
            ],
            [
                'value' => 3,
                'label' => 'Other'
            ]
        ],
        "phone_type_2_option" => [
            [
                'value' => 0,
                'label' => 'Primary Number'
            ],
            [
                'value' => 1,
                'label' => 'Business Number'
            ],
            [
                'value' => 2,
                'label' => 'Work Number'
            ],
            [
                'value' => 3,
                'label' => 'Other'
            ]
        ],
        "profile_type_option" => [
            [
                'value' => 0,
                'label' => 'Primary Guardian'
            ],
            [
                'value' => 1,
                'label' => 'Secondary Guardian'
            ],
            [
                'value' => 2,
                'label' => 'Authorized Adult'
            ]
        ],
        'first_name'        => null,
        'last_name'         => null,
        'phone_number_1'    => null,
        'phone_type_1'      => null,
        'phone_number_2'    => null,
        'phone_type_2'      => null,
        'email_address'     => null,
        'profile_type'      => null,
        'id'                => null,
        'phone_type_1_text' => null,
        'phone_type_2_text' => null,
        'profile_type_text' => null,
        'password'          => null,
        'user_id'           => null,
        'address'           => null,
        'city'           => null,
        'state'           => null,
        'zip'           => null,
        
    ];


    protected $rules = [
        "parentFields.first_name"        => 'required',
        "parentFields.last_name"         => 'required',
        "parentFields.phone_number_1"    => 'required',
        "parentFields.phone_type_1"      => 'required',
        "parentFields.email_address"     => 'required|email',
    ];

    protected $messages = [
        "parentFields.first_name.required"          => 'This Fields required.',
        "parentFields.last_name.required"           => 'This Fields required.',
        "parentFields.phone_number_1.required"      => 'This Fields required.',
        "parentFields.phone_type_1.required"        => 'This Fields required.',
        "parentFields.email_address.required"       => 'This Fields required.',
        "parentFields.email_address.email"          => 'Invalid email.',
    ];
}