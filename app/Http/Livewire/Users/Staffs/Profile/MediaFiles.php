<?php

namespace App\Http\Livewire\Users\Staffs\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class MediaFiles extends Component
{
    public User $user;

    public function getMedia()
    {
        $this->user = User::withMedia()->find($this->user->id);

        $media = $this->user->getAllMediaByTag()->flatten();

        return $media;
    }

    public function downloadFile(string $path)
    {
        return Storage::disk('spaces')->download($path);
    }

    public function render()
    {
        return view('livewire.users.staffs.profile.media-files', [
            'files' => $this->getMedia()
        ]);
    }
}
