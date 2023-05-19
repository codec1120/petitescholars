<?php

namespace App\Http\Livewire;

use Livewire\{Component, WithFileUploads};
use Illuminate\Support\Facades\Storage;
use MediaUploader;
use Plank\Mediable\Media;

use App\Models\{StaffProfileMenu, StaffUploadField};

class FileUploader extends Component
{
    use WithFileUploads;

    public $hasFile = false;
    public $showUploader = false;
    public $showFilesModal = false;
    public $downloadable = null;
    public $user;
    public $category;
    public $properties = [
        'icon' => 'upload',
        'class' => 'w-full sm:w-auto',
        'button_text' => 'Upload file',
        'disk' => 'spaces',
        'directory' => 'spaces',
        'filename' => '',
        'redirect' => '',
        'file_settings' => '',
        'tag' => '',
        'label' => '',
        'uploaded_label' => ''
    ];
    public $extension =  'pdf';
    public $redirect;

    public $file;
    public $files = [];
    public $viewModal = false;
    public $view_modal_title;
    public $view_modal_description;
    public $view_modal_tempURL;
    public $disk = 'spaces';

    protected $queryString = ['category'];

    protected $rules = [
        'files.*' => 'mimes:jpeg,png,pdf|max:20000',
    ];

    public function upload()
    {
        $this->validate();

        foreach ($this->files as $file) {
            $filename = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );

            if (
                Media::where('directory', $this->getDirectory())
                ->where('filename', $filename)
                ->first()
            ) {
                $uuid = \Str::before(uuid(), '-');
                $filename = "{$filename}-{$uuid}";
            }

            $file->storeAs(
                $this->getDirectory(),
                "{$filename}.{$file->extension()}",
                'spaces',
            );

            $media = MediaUploader::import(
                'spaces',
                $this->getDirectory(),
                $filename,
                $file->extension()
            );

            $this->user->attachMedia($media, $this->properties['tag']);
        }

        session()->flash('success', 'Successfully added new file!');

        return redirect()->to($this->redirect);
    }

    protected function getFilename(): string
    {
        $this->extension = $this->file->extension();

        return "{$this->properties['filename']}.{$this->extension}";
    }

    protected function getDirectory(): string
    {
        return "{$this->user->storagePath()}/{$this->properties['directory']}/{$this->properties['tag']}";
    }

    public function decide()
    {
        if (!$this->user->hasMedia($this->properties['tag'])) {
            $this->showUploader = true;
            return;
        }

        // return $this->downloadFile();
    }

    public function downloadFile($media)
    {
        $path = "{$media['directory']}/{$media['filename']}.{$media['extension']}";

        return Storage::disk('spaces')->download($path);
    }

    public function getFilesCountProperty(): string
    {
        $count = $this->user->getMedia($this->properties['tag'])->count();
        $text = !isset($this->properties['label']) && !isset($this->properties['uploaded_label']) ?
                str_plural('File', $count) :
                ($count > 0 ? str_plural(strval($this->properties['uploaded_label']), $count): $this->properties['label']);

        return  isset($this->properties['label']) && $count <= 0 ? "{$text}": "{$count} {$text}";
    }

    public function setEmpDataSheetModal($media)
    {
        $this->viewModal = true;
        $this->view_modal_title = $media['filename'];
        $url = "{$media['directory']}/{$media['filename']}.{$media['extension']}";
        $this->view_modal_tempURL = Storage::disk($this->disk)->temporaryUrl($url, now()->addMinutes(30));
    }

    public function render()
    {
        return view('livewire.file-uploader', [
            'mediaFiles' => $this->user->getMedia(
                $this->properties['tag']
            ),
            'categories' => StaffProfileMenu::whereNotIn('name', ['general-information', 'media', 'reviews'])
                ->get()
                ->transform(fn ($category) => [
                    'label' => $category->label,
                    'value' => $category->name
                ])
                ->toArray(),
            'fields' => StaffUploadField::where('category', $this->category)
                ->get()
                ->transform(fn ($field) => [
                    'label' => $field->label,
                    'value' => $field->label
                ])
        ]);
    }
}
