<?php

namespace App\Http\Livewire\FileManager;

use Livewire\{Component, WithFileUploads};

use Illuminate\Support\Facades\{
    Storage,
    Auth
};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Traits\Fields\FileManagerFields;

use App\Traits\FileManagerData;

use App\Models\Documents;

class Settings extends Component
{
    use FileManagerFields, FileManagerData;
    use WithFileUploads;
    use AuthorizesRequests;

    public $directory = 'pdf_files';
    protected $disk = 'spaces';

    public $file;
    public $uploadDocx = [];
    public $headerTitle;
    public $user;
    public $redirect = '';
    public $isUploading = false;
    public $displayResetModalNotif = false;
    public $docx;
    public $environment;
    public $documents_folder_name;
    public $deleteConfirmModal = false;
    public $itemValue = [];

    protected $queryString = [
        'directory'
    ];

    protected $listeners = [
        'delete',
        'resetFile'
    ];

    public function mount(Documents $documents)
    {
        $this->headerTitle = "Settings - $documents->doc_type";
        $this->environment = strtoupper(env('APP_ENV'));
        $this->documents_folder_name = strtoupper($documents->doc_type);
        $this->directory = "FILE MANAGER/{$this->environment}/{$this->documents_folder_name}";
        $this->uploadFields['doc_id'] =  $documents->id;
        $this->user = Auth()->user();
        $this->redirect = '/file-manager-settings/'.$documents->id;
        $this->docx = $documents;
    }

    public function getFilesProperty()
    {
        return Storage::disk($this->disk)->allFiles($this->directory);
    }

    public function upload()
    {
        foreach ($this->uploadDocx as $upload) {
            $filename = $upload->getClientOriginalName();
            $upload->storeAs($this->directory, $filename, 'spaces');
            $this->uploadFields['doc_file_title'] =  $filename;
            $this->saveUploadedDocuments();
        }

        $uploadCount = count($this->uploadDocx);

        $this->alert('success', "Successfully uploaded {$uploadCount} files");

        $this->reset('uploadDocx');

        return redirect()->route('file-manager.settings', $this->docx);
    }

    public function downloadFile($file)
    {
        return Storage::disk($this->disk)->download($file);
    }

    public function onDelete($file)
    {
        $this->file = $file;
        
        $docFileTitle = \Str::after($this->file, "{$this->environment}/{$this->documents_folder_name}/");
        
        Storage::disk($this->disk)->delete($this->file);

        $this->uploadFields['doc_file_title'] = $docFileTitle;

        $this->deleteUploadedDocuments();

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
            'pdf_files',
            'handbook'
        ];
    }

    public function updatedUploadDocx()
    {
        $this->uploadDocx = $this->uploadDocx;
    }

    public function setAsDefault($filename, $value, $keyIndex)
    { 
        // Get Selected Value
        $defaultValueholder[$keyIndex] = $this->itemValue[$keyIndex];
        // Reset All array
        $this->itemValue = [];
        // Set Selected Value in Array
        $this->itemValue = $defaultValueholder;
        
        $this->uploadFields['doc_file_title'] = \Str::after($filename,  "{$this->environment}/{$this->documents_folder_name}/");
        
        if ($this->countFile() >= 2 && $this->verifyDocxDefaultFileExist($this->docx->id) == 1) {
            $this->displayResetModalNotif = $this->itemValue[$keyIndex]['isDefault'];
        }
        
        $this->setFileAsDefault($this->itemValue[$keyIndex]['isDefault']);
        
        return $this->alert('success', $this->itemValue[$keyIndex]['isDefault'] ? "Successfully Set as default.": "Successfully Set not default.");
    }
    
    public function transformFiles()
    {
        $transformedFiles = [];

        foreach ($this->files as $index => $file) {
            array_push($transformedFiles, [
                'filename' => $file,
                'default' => $this->checkFileIfDefault(\Str::after($file, "{$this->environment}/{$this->documents_folder_name}/"))
            ]);

            if ($this->checkFileIfDefault(\Str::after($file, "{$this->environment}/{$this->documents_folder_name}/"))) {
                $this->itemValue[$index]['isDefault'] = true;
            }
        }
        
        return [
            'files' => $transformedFiles,
            'directories' => $this->directories
        ];
    }

    public function resetStatus()
    {
        $this->uploadFields['reset_file'] = 1;

        $this->resetStatusData();

        $this->displayResetModalNotif = false;

        return $this->alert('success', "Successfully Reset File status to NOT COMPLETE.");
    }

    public function render()
    {
        return view('livewire.file-manager.settings', $this->transformFiles());
    }
}
