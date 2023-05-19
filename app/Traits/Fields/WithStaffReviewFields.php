<?php

namespace App\Traits\Fields;

trait WithStaffReviewFields
{
    public $co_teacher_review_sections = [
        [
            'label' => 'Interaction with Children',
            'name' => 'interaction_with_children',
            'labels' => [
                'co_teacher_surveys.interaction_with_children.q1' => 'Provides caring/nurturing interaction with the children, empathetic, demonstrates patience, takes advantage of teachable moments, and provides comfort for children in distress.',
                'co_teacher_surveys.interaction_with_children.q2' => 'Attends to the physical needs of the children (i.e. diapering, feeding, toileting, resting, etc.)',
                'co_teacher_surveys.interaction_with_children.q3' => 'Helps children to develop self-help skills.',
                'co_teacher_surveys.interaction_with_children.q4' => 'Actively involved in the learning environment. This includes participating in child centered activities, demonstrating child tasks, playing games with the children (indoor and outdoor), actively communicating with the children throughout all learning opportunities.',
                'co_teacher_surveys.interaction_with_children.q5' => 'Uses approved child guidance and caregiving techniques that support overall program objectives.',
            ]
        ],
        [
            'label' => 'Classroom Management',
            'name' => 'classroom_management',
            'labels' => [
                'co_teacher_surveys.classroom_management.q1' => 'Supports in Implementing lesson plans. Assists in planning and conducting an effective child development program to meet the physical, social, emotional and intellectual needs of each child, based upon state goals and a curriculum plan provided by the supervisor.',
                'co_teacher_surveys.classroom_management.q2' => 'Able to manage children, follow the classroom schedule, manage transitions and expand learning',
                'co_teacher_surveys.classroom_management.q3' => 'Helps prepare materials for planned activities and themes'
            ]
        ],
        [
            'label' => 'Initiative and Creativity',
            'name' => 'initiative_and_creativity',
            'labels' => [
                'co_teacher_surveys.initiative_and_creativity.q1' => 'Goes above and beyond required duties and responsibilities to accomplish tasks or to solve problems',
                'co_teacher_surveys.initiative_and_creativity.q2' => 'Asks questions when he/she does not fully understand an assignment.',
                'co_teacher_surveys.initiative_and_creativity.q3' => 'Develops new and creative opportunities for children to learn, thinking outside the box when developing activities.',
                'co_teacher_surveys.initiative_and_creativity.q4' => 'Develops new and creative opportunities for children to learn, thinking outside the box when developing activities.'
            ]
        ],
        [
            'label' => 'Assessment',
            'name' => 'assessment',
            'labels' => [
                'co_teacher_surveys.assessment.q1' => 'Keeps adequate, appropriate and effective track of child growth and development',
                'co_teacher_surveys.assessment.q2' => 'Supports Lead Teacher in completing and submitting required reports in an accurate and in a timely manner',
                'co_teacher_surveys.assessment.q3' => 'Communicates child growth, successes and challenges with parents.',
                'co_teacher_surveys.assessment.q4' => 'Helps provides daily feedback on children’s activities.',
                'co_teacher_surveys.assessment.q5' => 'Is aware of developmental levels',
                'co_teacher_surveys.assessment.q6' => 'Uses discretion/judgment when discussing behavioral challenges and participates in conferences with parents and the Lead Teacher'
            ]
        ],
        [
            'label' => 'Learning Environment',
            'name' => 'learning_environment',
            'labels' => [
                'co_teacher_surveys.learning_environment.q1' => 'Supports in coordinating, by age, the appropriate play and learning activities to foster individual and group activity development including plan do and review.',
                'co_teacher_surveys.learning_environment.q2' => 'Leads children in songs, games, finger plays, and other activities.',
                'co_teacher_surveys.learning_environment.q3' => 'Shows a real enjoyment of working with children. Accepts each child as he/she is.',
                'co_teacher_surveys.learning_environment.q4' => "Shows awareness of progress or lack of it in a child's behavior. ",
                'co_teacher_surveys.learning_environment.q5' => 'Uses different, though consistent, methods of dealing with different children.',
                'co_teacher_surveys.learning_environment.q6' => 'Uses a positive approach'
            ]
        ],
        [
            'label' => 'Health and Safety',
            'name' => 'health_and_safety',
            'labels' => [
                'co_teacher_surveys.health_and_safety.q1' => 'Ensures the safety and sanitation of children through constant supervision, effective arrangement of space, proper maintenance of equipment, etc.',
                'co_teacher_surveys.learning_environment.q2' => 'Creates a pleasant, inviting atmosphere for children.',
                'co_teacher_surveys.learning_environment.q3' => 'Documents diaper change and toilet training on diaper log sheet.',
                'co_teacher_surveys.learning_environment.q4' => "Sanitize toys weekly and move the furniture around."
            ]
        ],
        [
            'label' => 'Organizational Abilities',
            'name' => 'organization_abilities',
            'labels' => [
                'co_teacher_surveys.organization_abilities.q1' => 'Plans ahead with Lead Teacher and structures work to avoid crises waiting for children and to deliver work on.',
                'co_teacher_surveys.organization_abilities.q2' => 'Review and implement daily schedules and activity plans.',
                'co_teacher_surveys.organization_abilities.q3' => 'Assists in arranging the room and play materials to accommodate the daily schedule.',
                'co_teacher_surveys.organization_abilities.q4' => "Assist in set up displays and bulletin boards."
            ]
        ],
        [
            'label' => 'Professional',
            'name' => 'professional',
            'labels' => [
                'co_teacher_surveys.professional.q1' => 'Conducts respectful conversation with staff, parents and children. Uses an appropriate voice and tone.',
                'co_teacher_surveys.professional.q2' => 'Has a positive attitude and demeanor.',
                'co_teacher_surveys.professional.q3' => 'Appearance is appropriate for interacting with children. Wears company uniforms or dresses appropriately according to the policy in the staff handbook.',
                'co_teacher_surveys.professional.q4' => "Completes the required annual training hours. Applies all professional development and skill development to enhance the learning environment.",
                'co_teacher_surveys.professional.q5' => "Remains calm in tense situations."
            ]
        ],
        [
            'label' => 'Communication Skills',
            'name' => 'communication_skills',
            'labels' => [
                'co_teacher_surveys.communication_skills.q1' => 'Reports, letters and newsletters are well written, easy to understand, and free of grammatical errors.',
                'co_teacher_surveys.communication_skills.q2' => 'Listens well and is able to communicate in a positive manner with staff, our families, and others.',
                'co_teacher_surveys.communication_skills.q3' => 'Handles challenging situations with tact.',
                'co_teacher_surveys.communication_skills.q4' => "Concerned with the needs of children, parents, and other staff.",
                'co_teacher_surveys.communication_skills.q5' => "Regularly shares information about the child's progress with parents or guardians.",
                'co_teacher_surveys.communication_skills.q6' => "Communicates directly with other staff and avoids gossip.",
                'co_teacher_surveys.communication_skills.q7' => "Discuss with other staff information needed to care for the children."
            ]
        ],
        [
            'label' => 'Teamwork',
            'name' => 'teamwork',
            'labels' => [
                'co_teacher_surveys.teamwork.q1' => 'Cooperates with other staff. Treats all staff with respect and dignity and fosters mutual respect and trust.',
                'co_teacher_surveys.teamwork.q2' => 'Participates in team and staff meetings and is willing to share ideas as well as listen respectfully to other staff.',
                'co_teacher_surveys.teamwork.q3' => "Willing to help other staff when needed."
            ]
        ],
        [
            'label' => 'Dependability, Adaptability and Flexibility',
            'name' => 'dependability_adaptability_flexibility',
            'labels' => [
                'co_teacher_surveys.dependability_adaptability_flexibility.q1' => 'Can be counted on to complete work in a timely manner.',
                'co_teacher_surveys.dependability_adaptability_flexibility.q2' => 'Does not have excessive absences.',
                'co_teacher_surveys.dependability_adaptability_flexibility.q3' => 'Takes responsibility for mistakes and seeks to continually improve performance.',
                'co_teacher_surveys.dependability_adaptability_flexibility.q4' => "Adjusts easily to new conditions and circumstances.",
                'co_teacher_surveys.dependability_adaptability_flexibility.q5' => "Flexible with assignments and schedule."
            ]
        ],
    ];

    public $co_teacher_surveys = [
        'interaction_with_children' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1,
            'q4' => 1,
            'q5' => 1,
        ],
        'classroom_management' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1
        ],
        'initiative_and_creativity' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1,
            'q4' => 1
        ],
        'assessment' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1,
            'q4' => 1,
            'q5' => 1,
            'q6' => 1
        ],
        'learning_environment' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1,
            'q4' => 1,
            'q5' => 1,
            'q6' => 1
        ],
        'health_and_safety' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1,
            'q4' => 1
        ],
        'organization_abilities' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1,
            'q4' => 1
        ],
        'professional' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1,
            'q4' => 1,
            'q5' => 1
        ],
        'communication_skills' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1,
            'q4' => 1,
            'q5' => 1,
            'q6' => 1,
            'q7' => 1,
        ],
        'teamwork' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1
        ],
        'dependability_adaptability_flexibility' => [
            'q1' => 1,
            'q2' => 1,
            'q3' => 1,
            'q4' => 1,
            'q5' => 1
        ],
        'strengths_and_accomplishments' => [
            'q1' => "",
            'q2' => "",
            'q3' => ""
        ],
        'development_needs' => [
            'q1' => "",
            'q2' => "",
            'q3' => ""
        ],
        'professional_development_goals' => [
            'q1' => "",
            'q2' => "",
            'q3' => ""
        ],
        'overall_score' => 0
    ];
}
