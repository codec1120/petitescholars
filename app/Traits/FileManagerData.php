<?php

namespace App\Traits;

use App\Models\{
    UploadedDocuments,
    Documents
};

use App\Traits\Fields\FileManagerFields;

use Illuminate\Support\Carbon;

trait FileManagerData {

    public function childFiles()
    {
        $docx = Documents::with(['uploadedDocuments' => fn($query) =>
                        $query->groupBy('doc_file_title', 'doc_id')
                    ])
                    ->where('doc_owner_ident', 2)
                    ->where('doc_status', 1)
                    ->get();
                    
        $docx->transform(fn($doc) => 
            [
                'id' => $doc->id,
                'doc_type' => $doc->doc_type,
                'count_files' => $doc->uploadedDocuments ? count($doc->uploadedDocuments) : 0
            ]
        );
        $this->childFiles = $docx->toArray();

        return $this->childFiles;
    }

    public function staffFiles()
    {
        $docx = Documents::with(['uploadedDocuments' => fn($query) =>
                        $query->groupBy('doc_file_title', 'doc_id')
                    ])
                    ->where('doc_owner_ident', 1)
                    ->where('doc_status', 1)
                    ->get();

        $docx->transform(fn($doc) => 
            [
                'id' => $doc->id,
                'doc_type' => $doc->doc_type,
                'count_files' => count($doc->uploadedDocuments)
            ]
        );
       
        $this->staffFiles = $docx->toArray(); 

        return $this->staffFiles;
    }
    

    public function getAllFiles(): array
    {
        return [
            'childFiles' => $this->childFiles(),
            'staffFiles' => $this->staffFiles()
        ];
    }

    public function saveUploadedDocuments()
    {   
        unset($this->uploadFields[0]);
        UploadedDocuments::create($this->uploadFields);
    }

    public function deleteUploadedDocuments()
    {
        UploadedDocuments::where([
            'doc_id' => $this->uploadFields['doc_id'],
            'doc_file_title' => $this->uploadFields['doc_file_title'],
        ])->delete();
    }

    public function setFileAsDefault($value)
    {
        // Undo other default file
        UploadedDocuments::where([
            'doc_id' => $this->uploadFields['doc_id']
        ])->update(['default_file' => 0]);
        // Set new default file
        UploadedDocuments::where([
            'doc_id' => $this->uploadFields['doc_id'],
            'doc_file_title' => $this->uploadFields['doc_file_title']
        ])->update(['default_file' => $value]);
    }

    public function checkFileIfDefault($filename)
    {
        $this->uploadFields['doc_file_title'] = $filename;

        $docx = UploadedDocuments::where([
                    'doc_id' => $this->uploadFields['doc_id'],
                    'doc_file_title' => $this->uploadFields['doc_file_title'],
                ])->first();

        return $docx ? $docx->default_file: 0;
    }

    public function getFilemanagerDefaultFile()
    {
        return  Documents::with(['uploadedDocuments' => fn($innerQuery) =>
                    $innerQuery->where('default_file', 1)
                ])
                 ->where([
                    'doc_owner_ident' => $this->uploadFields['doc_owner_ident'],
                    'doc_status' => 1,
                    'doc_type' => $this->uploadFields['doc_type'],
                ])
                ->first();
    }

    public function resetStatusData()
    {
        $defaultFile =  UploadedDocuments::where([
            'doc_id' => $this->uploadFields['doc_id'],
            'default_file' => 1
        ])->first();
        
        UploadedDocuments::where([
            'doc_id' => $this->uploadFields['doc_id'],
        ])->update(['reset_file' => 0 ]);

        return UploadedDocuments::where([
            'id' => $defaultFile->id
        ])->update([
            'reset_file' => $this->uploadFields['reset_file'],
            'updated_at' => Carbon::now()
        ]);
    }

    public function changeResetStatus($upload_id)
    {
        return UploadedDocuments::where([
            'id' => $upload_id
        ])->update(['reset_file' => 0 ]);
    }

    public function checkForResetFile()
    {
        return Documents::with(['uploadedDocuments' => fn($innerQuery) =>
                    $innerQuery->where('default_file', 1)
                            ->where('reset_file', 1)
                ])
                 ->where([
                    'doc_owner_ident' => $this->uploadFields['doc_owner_ident'],
                    'doc_status' => 1,
                    'doc_type' => $this->uploadFields['doc_type'],
                ])
                ->first();
    }

    public function countFile()
    {
        return  UploadedDocuments::where([
            'doc_id' => $this->uploadFields['doc_id']
        ])
        ->count();
    }

    public function verifyDocxDefaultFileExist($doc_id)
    {
        return UploadedDocuments::where([
                'doc_id' => $doc_id,
                'default_file' => 1
            ])->count();
    }
}
