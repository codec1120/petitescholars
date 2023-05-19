<?php

namespace App\Traits\Fields;

trait ChilldrenFields { 

    public $childrenFields = [
        'first_name'    => null,
        'last_name'     => null,
        'age'           => null,
        'sex'           => null,
        'home_address'  => null,
        'city'          => null,
        'state'         => null,
        'zip'           => null,
        'birthdate'     => null,
        'id'            => null,
        'user_id'       => null,
        'status'        => 0,
        'completed_registration_steps' => null,
        'completed' => false,
        'gender_option' => [
            [
                'value' => 0,
                'label' => 'Male'
            ],
            [
                'value' => 1,
                'label' => 'Female'
            ],
            [
                'value' => 2,
                'label' => 'Other'
            ]
        ]
    ];

    public $primaryGuardianFields = [
        'isPrimaryGuardian'  => "yes",
        "phone_type_1_option"   => [
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
        'first_name'    => null,
        'last_name'     => null,
        'email_address' => null,
        'home_address'  => null,
        'city'          => null,
        'state'         => null,
        'zip'           => null,
        'phone_number_1'=> null,
        'phone_type_1'  => null,
        'id'            => null,
        'primary_guardian'  => null,
        'sameAsChildAddress' => null
    ];

    public $secondaryGuardianFields = [
        'isSecondaryGuardian'  => "no",
        "phone_type_1_option"   => [
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
        'first_name'    => null,
        'last_name'     => null,
        'email_address' => null,
        'home_address'  => null,
        'city'          => null,
        'state'         => null,
        'zip'           => null,
        'phone_number_1'=> null,
        'phone_type_1'  => null,
        'id'            => null,
        'primary_guardian'  => null,
        'sameAsChildAddressSecondary' => null
    ];

    public $authAdultFields = [
        'addAuthAdults' => null,
        'childLiveInParentHome' => null,
        'infoSentToAbsenteeParent' => null,
        'first_name'    => null,
        'last_name'     => null,
        'phone_number'  => null,
        'absentee_first_name'    => null,
        'absentee_last_name'     => null,
        'absentee_phone_number'  => null,
        'absentee_address'  => null,
        'authAdults'    => [],
        'id'            => null
    ];

    public $emergencyContactFields = [
        'list_of_emergency_contact_registered' => [],
        'first_name' => null,
        'last_name'  => null,
        'phone_number' => null,
        'relationship' => null,
        'child_id'      => null,
        'id'            => null,
        'selected_option' => null,
        'emergencyEditId' => null,
        'status' => 'Incomplete',
        'created_at'       => null,
        'updated_at'        => null,
        'documentSigned' => null,
        'option'    => [
            [
                'value' => 1,
                'label' => 'Yes'
            ],
            [
                'value' => 0,
                'label' => 'No'
            ]
            ],
            
    ];

    public $medicalInformation = [
        'id'                                => null,
        'child_id'                          => null,
        'physician_name'                    => null,
        'physician_number'                  => null,
        'physician_address'                 => null,
        'physician_city'                    => null,
        'physician_state'                   => null,
        'physician_zip'                     => null,
        'child_held_insurance_provider'     => null,
        'insurance_policy_number'           => null,
        'allergies'                         => null,
        'prescribe_medication'              => null,
        'special_needs'                     => null,
        'suffer_from'                       => [],
        'selected_option_allergy'           => null,
        'selected_option_special_needs'     => null,
        'selected_option_suffer'            => null,
        'selected_option_prescribe_medication'=> null,
        'list_of_allergies'                 => [
            [
                'value' => 0,
                'label' => 'Nosebleeds'
            ],
            [
                'value' => 1,
                'label' => 'Headaches'
            ],
            [
                'value' => 2,
                'label' => 'Sore Throat'
            ],
            [
                'value' => 3,
                'label' => 'Stomach Aches'
            ],
            [
                'value' => 4,
                'label' => 'Runny Nose'
            ],
            [
                'value' => 5,
                'label' => 'Seasonal Allergies'
            ]
            
        ],
        'option'      => [
                [
                    'value' => 1,
                    'label' => 'Yes'
                ],
                [
                    'value' => 0,
                    'label' => 'No'
                ]
            
        ],
        'option1'                 => [
            [
                'value' => 1,
                'label' => 'Yes'
            ],
            [
                'value' => 0,
                'label' => 'No'
            ]

        ],
        'option2'                 => [
            [
                'value' => 1,
                'label' => 'Yes'
            ],
            [
                'value' => 0,
                'label' => 'No'
            ]

        ],
    ];

    public $familyQuestionaireFields = [
        'id' => null,
        'editedIid' => null,
        'nickname'  => null,
        'family_name' => null,
        'relationship' => null,
        'age' => null,
        'pet_species' => null,
        'cultural_bg' => null,
        'language' => null,
        'family_celebrate_occasions' => null,
        'family_list' => [],
        'daycare_bg' => null,
        'daycare_bg_name' => null,
        'daycare_bg_phone_number' => null,
        'daycare_bg_address' => null,
        'daycare_bg_start_date' => null,
        'daycare_bg_end_date' => null,
        'daycare_bg_reason_termination' => null,
        'daycare_bg_contact_reference' => null,
        'eating_habits' => null,
        'child_drink' => null,
        'special_diet' => null,
        'child_food_refrain' => null,
        'hours_of_sleep' => null,
        'bed_time' => null,
        'nap_days' => null,
        'options' => [
            [
                'value' => 0,
                'label' => 'No'
            ],
            [
                'value' => 1,
                'label' => 'Yes'
            ]
        ],
        'relationship_option' => [
            [
                'value' => 0,
                'label' => 'Parent'
            ],
            [
                'value' => 1,
                'label' => 'Sibling'
            ],
            [
                'value' => 2,
                'label' => 'Relative'
            ],
            [
                'value' => 3,
                'label' => 'Friend'
            ],
            [
                'value' => 4,
                'label' => 'Pet'
            ]
        ]
    ];

    public $permissionSlip = [
        'child_id'  => null,
        'id'        => null,
        'allow_put_sunscreen'   => null,
        'allow_use_hand_sanitizer'   => null,
        'allow_apply_diaper_cream'  => null
    ];

    public $feeAgreementFields = [
        'id' => null,
        'child_id' => null,
        'payee' => null,
        'other_payee_first_name' => null,
        'other_payee_last_name' => null,
        'other_payee_address' => null,
        'other_payee_city' => null,
        'other_payee_state' => null,
        'other_payee_zip' => null,
        'other_payee_phone_number' => null,
        'other_payee_phone_type' => null,
        'other_payee_email_address' => null,
        'payee_options' => [
            [
                'label' => 'CCIS',
                'value' => 2
            ],
            [
                'label' => 'Other',
                'value' => 3
            ]
        ],
        'payee_phone_type_options' => [
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
        'parent_notification_email_content' => ''    
    ];

    public $parentHandbook = [
        'signed_date' => null
    ];

    public $requiredDocuments = [
           [
            'label' => 'Health Assessment',
            'name'  => 'Health_Assessment',
            'value' => null,
            'date_uploaded' => null,
            'directory' => 'healthAssessmentFile'
           ]
    ];

    public $photographPermissionSlipQuestions = [
        'photograph_q_1' => null,
        'photograph_q_2' => null,
        'photograph_q_3' => null,
        'photograph_q_4' => null,
        'photograph_q_5' => null,
        'photograph_q_6' => null
    ];

    public $immunizationFields = [
        [
            'id' => 0,
            'label' => 'Hepatitis B (Hep B)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ],
        [
            'id' => 1,
            'label' => 'Diphteria, tetanus & ﻿pertussis (DTaP)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ],
        [
            'id' => 2,
            'label' => 'Heamophilus Influenza Type B (Hib)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ],
        [
            'id' => 3,
            'label' => 'Pheumococcal Conjugate (PCV13)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ],
        [
            'id' => 4,
            'label' => 'Inactivated Polio (IPV)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ],
        [
            'id' => 5,
            'label' => 'Rotavirus (RV)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ],
        [
            'id' => 6,
            'label' => 'Measles, Mumps & ﻿Rubella (MMR)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ],
        [
            'id' => 7,
            'label' => 'Varicella (Chickenpox)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ],
        [
            'id' => 8,
            'label' => 'Hepatitis A (Hep A)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ],
        [
            'id' => 9,
            'label' => 'Flu (Influenza)',
            'value' => null,
            'dosages' => [
                [
                    'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ],
                [
                     'dose_age_year' => null,
                    'dose_age_month' => null,
                    'date' => null
                ]
            ]
        ]
    ];

    public $selectedImmunizationFields = [
        'selected_immunization_dosage' => 1,
        'immunization_index' => null,
        'immunization_dosage_opt' => [
            [
                'label' => 0,
                'value' => 0
            ],
            [
                'label' => 1,
                'value' => 1
            ],
             [
                'label' => 2,
                'value' => 2
            ],
            [
                'label' => 3,
                'value' => 3
            ],
            [
                'label' => 4,
                'value' => 4
            ],
            [
                'label' => 5,
                'value' => 5
            ],
            [
                'label' => 6,
                'value' => 6
            ],
            [
                'label' => 7,
                'value' => 7
            ],
            [
                'label' => 8,
                'value' => 8
            ],
            [
                'label' => 9,
                'value' => 9
            ]

        ]
    ];

    public $childs_mother = [
        'id' => null,
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'phone' => null,
        'phone_type' => null,
        'phone_type_option' =>  [
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
        'home_address' => null,
        'home_city' => null,
        'home_state' => null,
        'home_zip' => null,
        'businesss_employer' => null,
        'work_phone' => null,
        'work_address' => null,
        'work_city' => null,
        'work_state' => null,
        'work_zip' => null,
        'primary_guardian' => null,
        'secondary_guardian' => null,
        'sameAsChildAddress' => null
    ];

    public $childs_father = [
        'id' => null,
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'phone' => null,
        'phone_type' => null,
        'phone_type_option' =>  [
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
        'home_address' => null,
        'home_city' => null,
        'home_state' => null,
        'home_zip' => null,
        'businesss_employer' => null,
        'work_phone' => null,
        'work_address' => null,
        'work_city' => null,
        'work_state' => null,
        'work_zip' => null,
        'primary_guardian' => null,
        'secondary_guardian' => null,
        'sameAsChildAddress' => null
    ];

    public $newEmergencyContactFields = [
        'list_of_emergency_contact_registered' => [
            [
                'selected_emergency_contact' => null,
                'first_name' => null,
                'last_name'  => null,
                'phone_number' => null,  
                'phone_number_type' => null,  
            ],
            [
                'selected_emergency_contact' => null,
                'first_name' => null,
                'last_name'  => null,
                'phone_number' => null,  
                'phone_number_type' => null,  
            ]
        ],
        'list_of_authorized' => [
            [
                'selected_emergency_contact' => null,
                'first_name' => null,
                'last_name'  => null,
                'phone_number' => null,  
                'phone_number_type' => null,  
            ],
            [
                'selected_emergency_contact' => null,
                'first_name' => null,
                'last_name'  => null,
                'phone_number' => null,  
                'phone_number_type' => null,  
            ]
        ],    
        'emergency_contact_opt' => [ ],
        'phone_type_opt'   => [
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
        'child_id' => null
    ];

    public $childContactsFields = [
        'lists' => [],
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'phone_number' => null,
        'id' => null,
    ];
}