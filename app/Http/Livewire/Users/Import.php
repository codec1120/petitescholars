<?php

namespace App\Http\Livewire\Users;

use Livewire\{Component, WithFileUploads};
use Illuminate\Support\{Arr, Str};
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Models\{User, Role};
use App\Imports\UserImport;
use App\Actions\User\UserImportProcessor;

class Import extends Component
{
    use WithFileUploads;

    public $showImportUserModal = false;
    protected $sheetValidationRule = [
        'sheet' => 'required|mimes:csv,txt|max:1024' // 1MB Max
    ];

    protected $sheetValidationMessages = [
        'sheet.required' => 'Please select CSV file to import',
        'sheet.mimes' => 'File type should be CSV'
    ];
    public $canImport = false;
    public $sheet;
    public $users;
    public $role;

    public function updatedSheet()
    {
        $this->validate(
            $this->sheetValidationRule,
            $this->sheetValidationMessages
        );

        $importer = new UserImport;
        $importer->import($this->sheet);

        $this->users = $importer->users->toArray();
    }

    protected function checkCanImport(): bool
    {
        return $this->sheet && collect($this->users)->isNotEmpty() ? true : false;
    }

    protected function validationRules(): array
    {
        return [
            '*.first_name' => Rule::requiredIf($this->role !== Role::STAFF),
            '*.last_name' => Rule::requiredIf($this->role !== Role::STAFF),
            // '*.email' => [function ($attribute, $value, $fail) use ($dots) {
            //     $id = $dots[Str::before($attribute, '.') . '.id'] ?? null;

            //     if (User::uniqueEmail($value, $id)->first()) {
            //         $fail('Email: ' . $value . ' already exist!');
            //     }

            //     if (User::withTrashed()->uniqueEmail($value, $id)
            //         ->where('deleted_at', '!=', null)
            //         ->first()
            //     ) {
            //         $fail('Email: ' . $value . ' already exist, but the user is on the trash');
            //     }
            // }],
            '*.email' => [
                'required',
                'email',
                'max:255'
            ],
            '*.role' => [
                Rule::requiredIf($this->role !== Role::STAFF),
                Rule::in(Role::pluck('role_name'))
            ]
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            '*.first_name' => 'First Name',
            '*.last_name' => 'Last Name',
            '*.email' => 'Email'
        ];
    }

    public function import()
    {
        $users = $this->users;

        if (collect($users)->isEmpty()) {
            $this->alert('error', 'You uploaded an empty CSV file');

            return;
        }

        $validator = Validator::make(
            $users,
            $this->validationRules($users),
            $this->validationAttributes()
        );

        if ($validator->fails()) {
            $this->alert('error', 'Whoops!', [
                'text' => implode(', ', Arr::flatten($validator->messages()->toArray())),
                'toast' => false,
                'timer' => null,
                'position' => 'center',
                'showCancelButton' => true
            ]);
            return;
        }

        $importer = new UserImportProcessor(collect($users));

        switch ($this->role) {
            case Role::STAFF:
                $importer->importStaffProfile();
                break;
            case Role::PARENT:
                // No op yet
                break;
            default:
                $importer->execute();
                break;
        }

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.import');
    }
}
