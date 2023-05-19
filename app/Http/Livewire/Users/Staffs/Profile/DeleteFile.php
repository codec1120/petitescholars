<?php

namespace App\Http\Livewire\Users\Staffs\Profile;

use Livewire\Component;
use Plank\Mediable\Media;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class DeleteFile extends Component
{
    public $confirmingFileDeletion = false;
    public User $user;
    public Media $media;
    public $redirect;

    protected $listeners = [
        'confirmDelete'
    ];

    public function ask()
    {
        return $this->confirm("Delete {$this->media->filename}?", [
            'text' => 'Are you sure you want to delete file? Once the file is deleted, the file will actually permanently deleted.',
            'onConfirmed' => 'confirmDelete'
        ]);
    }

    public function confirmDelete()
    {  

        Storage::disk('spaces')->delete( $this->getFilename() );

        $this->media->delete();

        $this->flash('success','Successfully deleted file.');

        return redirect()->to($this->redirect);
    }

    protected function getFilename(): string
    {
        return "{$this->media->directory}/{$this->media->filename}.{$this->media->extension}";
    }

    public function render()
    {
        return view('livewire.users.staffs.profile.delete-file');
    }
}
