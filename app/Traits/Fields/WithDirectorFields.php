<?php

namespace App\Traits\Fields;

trait WithDirectorFields
{
    public $director_sections = [
        [
            'label' => 'The Director Establishes a Healthy Organizational Culture',
            'name' => 'established_healthy_organization_culture',
            'labels' => [
                'established_healthy_organization_culture.q1' => '1. Creates working conditions that are conducive to providing quality care for young children',
                'established_healthy_organization_culture.q2' => '2. Understands, follows and can articulate the center’s philosophy and mission',
                'established_healthy_organization_culture.q3' => '3. Ensures that school policies, procedures and systems are available, clear and current for staff and families',
                'established_healthy_organization_culture.q4' => '4. Is consistent with developmentally appropriate practices, as defined by the Pennsylvania office of child development and early learning.',
                'established_healthy_organization_culture.q5' => '5. Treats problems as challenges and opportunities for creativity',
                'established_healthy_organization_culture.q6' => '6. Creates collegiality and the desire for collaboration among staff and families, and recognizes family participation and staff accomplishments',
                'established_healthy_organization_culture.q7' => '7. Models and emphasizes reflection and empathy as much as rules when issues arise',
                'established_healthy_organization_culture.q8' => '8. Can articulate expectations, norms and professional ethics to staff and families as information is needed',
                'established_healthy_organization_culture.q9' => '9. Encourages vision building and innovation from staff and families throughout the entire program, involving staff and families in decision making when possible'
            ],
        ],
        [
            'label' => 'The Director is Available and Supportive',
            'name' => 'available_and_supportive',
            'labels' => [
                'available_and_supportive.q1' => '1. Keeps everyone informed of whereabouts when not in the office',
                'available_and_supportive.q2' => '2. Offers assistance in addressing needs of individual children and families',
                'available_and_supportive.q3' => '3. Is available to staff for help in curriculum planning, task management and team building',
                'available_and_supportive.q4' => '4. Provides support to staff for documentation and record keeping.',
                'available_and_supportive.q5' => '5. Supports staff and families to develop healthy working relationships.',
                'available_and_supportive.q6' => '6. Offers thoughtful listening and problem solving',
                'available_and_supportive.q7' => '7. Advocates for staff and families, encourages them to advocate for self'
            ],
        ],
        [
            'label' => 'The Director Communicates Well and Demonstrates Community Building',
            'name' => 'communicates_well_and_demonstrates_community_building',
            'labels' => [
                'communicates_well_and_demonstrates_community_building.q1' => '1. Actively seeks feedback and makes use of suggestions',
                'communicates_well_and_demonstrates_community_building.q2' => '2. Creates safety and ease for everyone to express themselves and their ideas',
                'communicates_well_and_demonstrates_community_building.q3' => '3. Maintains balance in meeting individual and group needs',
                'communicates_well_and_demonstrates_community_building.q4' => '4. Responds to others and makes all shared information available in a timely manner',
                'communicates_well_and_demonstrates_community_building.q5' => '5. Models and encourages respect for differences while negotiating conflicts.',
                'communicates_well_and_demonstrates_community_building.q6' => '6. Develops and maintains an inclusive school culture and community',
                'communicates_well_and_demonstrates_community_building.q7' => '7. Routinely creates meaningful celebrations and events for children, staff and families'
            ],
        ],
        [
            'label' => 'The Director Demonstrates Coaching and Mentoring',
            'name' => 'demonstrates_coaching_and_mentoring',
            'labels' => [
                'demonstrates_coaching_and_mentoring.q1' => '1. Actively develops and fosters leadership in others',
                'demonstrates_coaching_and_mentoring.q2' => '2. Involves each staff member in a professional development plan',
                'demonstrates_coaching_and_mentoring.q3' => '3. Acts as and provides needed resources for staff and families',
                'demonstrates_coaching_and_mentoring.q4' => '4. Creates systems for reflection and peer collaboration',
                'demonstrates_coaching_and_mentoring.q5' => '5. Promotes and provides opportunities for teachers to mentor families and each other'
            ],
        ]
    ];

    public $established_healthy_organization_culture = [
        'q1' => null,
        'q2' => null,
        'q3' => null,
        'q4' => null,
        'q5' => null,
        'q6' => null,
        'q7' => null,
        'q8' => null,
        'q9' => null,
    ];

    public $available_and_supportive = [
        'q1' => null,
        'q2' => null,
        'q3' => null,
        'q4' => null,
        'q5' => null,
        'q6' => null,
        'q7' => null
    ];

    public $communicates_well_and_demonstrates_community_building = [
        'q1' => null,
        'q2' => null,
        'q3' => null,
        'q4' => null,
        'q5' => null,
        'q6' => null,
        'q7' => null
    ];

    public $demonstrates_coaching_and_mentoring = [
        'q1' => null,
        'q2' => null,
        'q3' => null,
        'q4' => null,
        'q5' => null
    ];

    public $director_comments = [
        [
            'label' => 'Establishing a Healthy Organizational Culture',
            'name' => 'director_comments_fields.establishing_a_healthy_organizational_culture',
        ],
        [
            'label' => 'Communication and Community Building',
            'name' => 'director_comments_fields.communication_and_community_building',
        ],
        [
            'label' => 'Coaching and Mentoring',
            'name' => 'director_comments_fields.coaching_and_mentoring',
        ]
    ];

    public $director_comments_fields = [
        'establishing_a_healthy_organizational_culture' => null,
        'communication_and_community_building' => null,
        'coaching_and_mentoring' => null
    ];
}
