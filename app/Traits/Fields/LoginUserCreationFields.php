<?php

namespace App\Traits\Fields;

trait LoginUserCreationFields {

    public $formFields = [
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'phone_number' => null,
        'password' => null,
        'role' => 0,
        'roles' => [
            [
                'value' => 0,
                'label' => 'Staff'
            ],
            [
                'value' => 1,
                'label' => 'Parent'
            ]
        ]
    ];
    
    protected $rules = [
        'formFields.first_name' => 'required',
        'formFields.last_name' => 'required',
        'formFields.email' => 'required',
        'formFields.password' => 'required',
    ];

    protected $messages = [
        'formFields.first_name.required' => 'This field is required.',
        'formFields.last_name.required' => 'This field is required.',
        'formFields.email.required' => 'This field is required.',
        'formFields.password.required' => 'This field is required.',
    ];
}