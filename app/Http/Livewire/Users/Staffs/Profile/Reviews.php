<?php

namespace App\Http\Livewire\Users\Staffs\Profile;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

use App\Models\{User, StaffReview};
use App\Traits\Fields\WithStaffFields;

class Reviews extends Component
{
    use AuthorizesRequests, WithStaffFields;

    public $editing = false;
    public $showFilesModal = false;
    public $files = [];
    public $directory = 'review';
    protected $disk = 'spaces';

    public function mount(User $user)
    {
        $this->authorize('viewStaffProfile', $user);

        $this->user = $user;
    }

    public function create()
    {
        return redirect()->route('staffs.profile.reviews.create', $this->user);
    }

    public function edit(StaffReview $staffReview)
    {
        return redirect()->route('staffs.profile.reviews.edit', [
            'user' => $this->user,
            'review' => $staffReview
        ]);
    }

    public function render()
    {
        return view('livewire.users.staffs.profile.reviews', [
            'reviews' => StaffReview::with('staff')
                ->staff($this->user)
                ->orderBy('created_at', 'DESC')
                ->paginate(),
            'reviewsDocs' => $this->user->getMedia(  slug('review_documents', '_') )
        ]);
    }
}
