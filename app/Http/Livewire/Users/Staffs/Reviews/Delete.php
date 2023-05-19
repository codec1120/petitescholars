<?php

namespace App\Http\Livewire\Users\Staffs\Reviews;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

use App\Models\{User, StaffReview};

class Delete extends Component
{
    use AuthorizesRequests;

    public $confirmingFileDeletion = false;
    public User $user;
    public StaffReview $review;

    public function confirmDelete()
    {
        $this->authorize('viewStaffProfile', $this->user);

        $this->review->delete();

        session()->flash('success', 'Deletion successful!');

        return redirect()->route('staffs.profile.reviews', $this->user);
    }

    public function render()
    {
        return view('livewire.users.staffs.reviews.delete');
    }
}
