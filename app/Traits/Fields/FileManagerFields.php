<?php

namespace App\Traits\Fields;

trait FileManagerFields { 

    public $staffFiles = [];
    public $childFiles = [];
    public $uploadFields = [
        'doc_id' => null,
        'doc_file_title' => null,
        'default_file' => 0,
        'reset_file' => 0,
        'id'
    ];
}