<?php

namespace App\Http\Livewire\FileManager;

use Livewire\Component;

use App\Traits\Fields\FileManagerFields;

use App\Traits\FileManagerData;

class Index extends Component
{
    use FileManagerFields, FileManagerData;

    public function render()
    {
        return view('livewire.file-manager.index', $this->getAllFiles());
    }
}
