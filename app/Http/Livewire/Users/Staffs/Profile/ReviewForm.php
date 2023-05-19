<?php

namespace App\Http\Livewire\Users\Staffs\Profile;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\{
    User,
    StaffReview,
    StaffReviewRatingScale,
    StaffTitle
};
use App\Traits\Fields\{
    WithStaffFields,
    WithDirectorFields,
    WithStaffReviewFields,
};

class ReviewForm extends Component
{
    use AuthorizesRequests;
    use WithStaffFields;
    use WithDirectorFields;
    use WithStaffReviewFields;

    public $type;
    public StaffReview $review;


    protected $queryString = ['type'];

    public $commons = [
        'name_of_employee' => '',
        'date_completed' => '',
        'completed_by' => '',
        'yearly_review' => '',
        'title' => ''
    ];

    public function mount(User $user, StaffReview $review)
    {
        $this->authorize('view', $user);

        $this->user = $user;
        $this->type = $user->title ?? null;
        $this->review = $review;

        if ($review->exists) {
            $this->sync();
            $this->co_teacher_surveys['overall_score'] = $this->calculate();
        }
    }

    public function updated()
    {
        $this->co_teacher_surveys['overall_score'] = $this->calculate();
    }

    protected function sync()
    {
        switch ($this->type) {
            case StaffTitle::CO_TEACHER:
                $this->syncCoTeacherReview();
                break;
            case StaffTitle::DIRECTOR:
                $this->syncDirectorReview();
                break;
            default:
                // Do nothing
                break;
        }
    }

    protected function syncCoTeacherReview()
    {
        $this->commons['yearly_review'] = $this->review->yearly_review;
        $this->co_teacher_surveys['interaction_with_children'] = $this->review->getMeta('interaction_with_children');
        $this->co_teacher_surveys['classroom_management'] = $this->review->getMeta('classroom_management');
        $this->co_teacher_surveys['initiative_and_creativity'] = $this->review->getMeta('initiative_and_creativity');
        $this->co_teacher_surveys['assessment'] = $this->review->getMeta('assessment');
        $this->co_teacher_surveys['learning_environment'] = $this->review->getMeta('learning_environment');
        $this->co_teacher_surveys['health_and_safety'] = $this->review->getMeta('health_and_safety');
        $this->co_teacher_surveys['organization_abilities'] = $this->review->getMeta('organization_abilities');
        $this->co_teacher_surveys['professional'] = $this->review->getMeta('professional');
        $this->co_teacher_surveys['communication_skills'] = $this->review->getMeta('communication_skills');
        $this->co_teacher_surveys['teamwork'] = $this->review->getMeta('teamwork');
        $this->co_teacher_surveys['dependability_adaptability_flexibility'] = $this->review->getMeta('dependability_adaptability_flexibility');
        $this->co_teacher_surveys['strengths_and_accomplishments'] = $this->review->getMeta('strengths_and_accomplishments');
        $this->co_teacher_surveys['development_needs'] = $this->review->getMeta('development_needs');
        $this->co_teacher_surveys['professional_development_goals'] = $this->review->getMeta('professional_development_goals');
    }

    protected function syncDirectorReview()
    {
    }

    protected function calculate(): int
    {
        $calc = [
            collect($this->co_teacher_surveys['interaction_with_children'])->sum(),
            collect($this->co_teacher_surveys['classroom_management'])->sum(),
            collect($this->co_teacher_surveys['initiative_and_creativity'])->sum(),
            collect($this->co_teacher_surveys['assessment'])->sum(),
            collect($this->co_teacher_surveys['learning_environment'])->sum(),
            collect($this->co_teacher_surveys['health_and_safety'])->sum(),
            collect($this->co_teacher_surveys['organization_abilities'])->sum(),
            collect($this->co_teacher_surveys['professional'])->sum(),
            collect($this->co_teacher_surveys['communication_skills'])->sum(),
            collect($this->co_teacher_surveys['teamwork'])->sum(),
            collect($this->co_teacher_surveys['dependability_adaptability_flexibility'])->sum()
        ];

        return collect($calc)->sum();
    }

    public function submit()
    { 
        $review = $this->user->reviews()->updateOrCreate(
            [
                'id' => $this->review->id ?? null
            ],
            [
                'date_completed' => $this->review->date_completed ?? now()->format('Y-m-d'),
                'completed_by' => auth()->user()->id,
                'yearly_review' => $this->commons['yearly_review'],
                'title' => $this->user->title,
                'overall_score' => $this->co_teacher_surveys['overall_score']
            ]
        );

        switch ($this->user->title) {
            case StaffTitle::CO_TEACHER:
                $review->setCoTeacherEvaluation($this->co_teacher_surveys);
                break;
            case StaffTitle::DIRECTOR:
                $evaluations = $this->extractDirectorEvaluations();
                $review->setDirectorEvaluation($evaluations);
                break;
            default:
                # code...
                break;
        }

        session()->flash(
            'success',
            $this->review->exist ? 'Changes saved!' : 'Successfully created new review'
        );

        return redirect()->route('staffs.profile.reviews', $this->user);
    }

    protected function extractDirectorEvaluations()
    {
        return [
            'established_healthy_organization_culture' =>
            $this->established_healthy_organization_culture,
            'available_and_supportive' =>
            $this->available_and_supportive,
            'communicates_well_and_demonstrates_community_building' =>
            $this->communicates_well_and_demonstrates_community_building,
            'demonstrates_coaching_and_mentoring' => $this->demonstrates_coaching_and_mentoring,
            'director_comments' => $this->director_comments_fields
        ];
    }

    public function render()
    {
        return view('livewire.users.staffs.profile.review-form', [
            'ratings' => StaffReviewRatingScale::where('title', $this->user->title)
                ->get()
        ]);
    }
}
