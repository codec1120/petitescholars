<?php

namespace App\Http\Livewire\Children\Notes;

use Livewire\{
    Component,
    WithFileUploads
};

use Illuminate\Support\Facades\{
    Storage,
    Auth
};

class Notes extends Component
{
    use WithFileUploads;

    public $directory = '';
    protected $disk = 'spaces';

    public $file;
    public $uploadDocx = [];
    public $headerTitle = 'Notes';
    public $user;
    public $redirect = '';
    public $isUploading = false;
    public $default_files = [];

    public $child_id;
    public $query_string_child_id;

    protected $queryString = [
        'directory',
        'child_id'
    ];

    protected $listeners = [
        'delete',
        'resetFile'
    ];
    
    public function mount()
    {
        $this->directory = "child_parent_notes/{$this->child_id}";
        $this->user = Auth()->user();
        $this->redirect = "{$this->child_id}/child-edit/notes";
    }

    public function upload()
    {
        foreach ($this->uploadDocx as $upload) {
            $filename = $upload->getClientOriginalName();
            $upload->storeAs($this->directory, $filename, 'spaces');
        }

        $uploadCount = count($this->uploadDocx);

        $this->alert('success', "Successfully uploaded {$uploadCount} files");

        $this->reset('uploadDocx');
    }

    public function downloadFile($file)
    {
        return Storage::disk($this->disk)->download($file);
    }

    public function onDelete($file)
    {
        $this->file = $file;
        
        Storage::disk($this->disk)->delete($this->file);

        $this->alert('success', "Deletion successful!");

        $this->resetFile();
    }

    public function resetFile()
    {
        $this->reset('file');
    }
    
    /**
     * Selected directories only
     */
    public function getDirectoriesProperty()
    {
        return [
            'child_parent_notes'
        ];
    }

    public function getFilesProperty()
    {
        return Storage::disk($this->disk)->allFiles($this->directory);
    }

    public function render()
    {
        return view('livewire.children.notes.notes',[
            'files' => $this->files,
            'directories' => $this->directories
        ]);
    }
}
