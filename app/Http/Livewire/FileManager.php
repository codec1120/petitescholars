<?php

namespace App\Http\Livewire;

use Livewire\{Component, WithFileUploads};

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class FileManager extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $directory = 'pdf_files';
    protected $disk = 'spaces';

    public $file;
    public $uploads = [];

    protected $queryString = [
        'directory'
    ];

    protected $listeners = [
        'delete',
        'resetFile'
    ];

    public function mount()
    {
        $this->authorize('viewAny', Auth::user());
    }

    public function getFilesProperty()
    {
        return Storage::disk($this->disk)->allFiles($this->directory);
    }

    public function upload()
    {
        foreach ($this->uploads as $upload) {
            $filename = $upload->getClientOriginalName();
            $upload->storeAs($this->directory, $filename, 'spaces');
        }

        $uploadCount = count($this->uploads);

        $this->alert('success', "Successfully uploaded {$uploadCount} files");

        $this->reset('uploads');
    }

    public function downloadFile($file)
    {
        return Storage::disk($this->disk)->download($file);
    }

    public function onDelete($file)
    {
        $this->file = $file;
        $fileOnly = \Str::after($file, '/');

        $this->confirm("Delete file?", [
            'text' => "Are you sure do you want to delete {$fileOnly}?",
            'onConfirmed' => 'delete',
            'onCancelled' => 'resetFile'
        ]);

        return;
    }

    public function resetFile()
    {
        $this->reset('file');
    }

    public function delete()
    {
        Storage::disk($this->disk)->delete($this->file);

        $this->alert('success', "Deletion successful!");

        $this->resetFile();
    }

    /**
     * Selected directories only
     */
    public function getDirectoriesProperty()
    {
        return [
            'pdf_files',
            'handbook'
        ];
    }

    public function render()
    {
        return view('livewire.file-manager', [
            'files' => $this->files,
            'directories' => $this->directories
        ]);
    }
}
