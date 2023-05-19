<?php

namespace App\Http\Livewire\Children\Contacts;

use Livewire\Component;

use App\Models\{
    User,
    ChildInformation,
    ChildrensFather,
    ChildrensMother,
    ChildrenEmergencyContact,
    ChildrenMedicalInformation,
    Role
};

use Illuminate\Support\Facades\{
    Mail,
    Validator
};

use App\Traits\Fields\ChilldrenFields;

use Illuminate\Support\Str;

class Contacts extends Component
{
    public $user;
    public $query_string_child_id;
    public $child_id;
    public $childName;
    public $edit = false;
    public $displayForm = false;
    public $fathersInfo = false;
    public $mothersInfo = false;
    public $selectedId = '';
    public $displayEmailSender = false;
    public $contactFields = [];
    public $parentEmails;
    public $token;
    public $userDetails;
    public $userDetailsOnTrash;

    protected $queryString = [
        'child_id',
    ];

    use ChilldrenFields;

    public function mount()
    {
        $childInfo = ChildInformation::with([
                                'getChildEmergencyContact',
                                'getFathersInfo',
                                'getMothersInfo'
                                ])
                                ->where('id', $this->child_id)
                                ->first();

        $this->childName = $childInfo->first_name.' '.$childInfo->last_name;
        // Fill Emergency Contacts
        if (count($childInfo->getChildEmergencyContact) > 0) {
            foreach ($childInfo->getChildEmergencyContact as $key => $contact) {
                array_push($this->childContactsFields['lists'], [
                    'first_name' => $contact['first_name'] ?? null,
                    'last_name' => $contact['last_name'] ?? null,
                    'phone_number' => $contact['phone'] ?? $contact['phone_number'],
                    'email' => $contact['email'] ?? null,
                    'id' => $contact['id'] ?? null,
                    'fathers_info' => false,
                    'mothers_info' => false,
                ]);
            }
        }

        if ($childInfo->getFathersInfo && $childInfo->getFathersInfo['primary_guardian']) {
            array_push($this->childContactsFields['lists'], [
                'first_name' => $childInfo->getFathersInfo['first_name'] ?? null,
                'last_name' => $childInfo->getFathersInfo['last_name'] ?? null,
                'phone_number' => $childInfo->getFathersInfo['phone'] ?? null,
                'email' => $childInfo->getFathersInfo['email'] ?? null,
                'id' => $childInfo->getFathersInfo['id'] ?? null,
                'fathers_info' => true
            ]);
        } else if ($childInfo->getMothersInfo && $childInfo->getMothersInfo['primary_guardian']) {
            array_push($this->childContactsFields['lists'], [
                'first_name' => $childInfo->getMothersInfo['first_name'] ?? null,
                'last_name' => $childInfo->getMothersInfo['last_name'] ?? null,
                'phone_number' => $childInfo->getMothersInfo['phone'] ?? null,
                'email' => $childInfo->getMothersInfo['email'] ?? null,
                'id' => $childInfo->getMothersInfo['id'] ?? null,
                'mothers_info' => true
            ]);
        }

        $this->generateToken();
    }

    public function sendEmailToContact()
    {
        $user_id;
        // Check Contact has user access alreadyExists
        $userAccess = User::where([
            'first_name' => $this->childContactsFields['first_name'],
            'last_name' => $this->childContactsFields['last_name'],
            'email' => $this->childContactsFields['email'],
        ])->first();

        if (!$userAccess) {
            $user_id = $this->createUser();
        } else {
            $user_id = $userAccess->id;

            User::where('id', $user_id)->update(['password_token' =>  $this->token ?? $this->generateToken()]);
        }

        $emailData =  [
            'template'   => 'vendor.mail.html.contact',
            'subject'   => 'Petite Scholars Create User.',
            'to'        => explode(',',$this->parentEmails)
        ];

        $data = [
            'link' =>  env('APP_URL').'/update-password/'.($this->token ?? $this->generateToken()).'?email='.$this->childContactsFields['email'].'&id='.$user_id,
            'email_content' => $this->contactFields['parent_notification_email_content']
        ];

        Mail::send( $emailData['template'], $data ,function ( $message ) use ( $emailData ) {
            $message->to( $emailData['to'],  $emailData['subject'] )
                    ->subject( $emailData['subject'] );
        });

        $this->displayEmailSender = false;

        return $this->alert('success', "Your message has been sent.");
    }

    public function editContact($id, $fathersInfo)
    {
        $this->displayForm = true;
        $this->edit = true;
        $contactData;
        if ($fathersInfo == 1) {
            $contactData = ChildrensFather::where('id', $id)->first();
            $this->fathersInfo = true;
            $this->mothersInfo = false;
        } elseif($fathersInfo == 2) {
            $contactData = ChildrensMother::where('id', $id)->first();
            $this->mothersInfo = true;
            $this->fathersInfo = false;
        } else {
            $contactData = ChildrenEmergencyContact::where('id', $id)->first();
            $this->mothersInfo = false;
            $this->fathersInfo = false;
        }

        $this->userDetails = User::where([
                    'first_name' => $contactData->first_name,
                    'last_name' => $contactData->last_name,
                    'email' => $contactData->email
                ])->first();

        $this->userDetailsOnTrash = User::withTrashed()->where([
                    'first_name' => $contactData->first_name,
                    'last_name' => $contactData->last_name,
                    'email' => $contactData->email
                ])->first();

        $this->childContactsFields['first_name'] = $contactData->first_name;
        $this->childContactsFields['last_name'] = $contactData->last_name;
        $this->childContactsFields['phone_number'] = $contactData->phone_number ?? ($contactData->phone ?? null);
        $this->childContactsFields['email'] = $contactData->email;
        $this->selectedId = $contactData['id'];
    }

    public function saveContact()
    {
        $this->validateData();

        if (!$this->edit) {
            Validator::make(
                [
                    'email' => $this->childContactsFields['email']
                ],
                [
                    'email' => 'unique:users|unique:childrens_father|unique:childrens_mother'
                ],
                [
                    'email.unique' => 'Email already exists.'
                ]
            )->validate();
        }

        if ($this->fathersInfo) {
            if (!$this->edit) {
               if (ChildrensFather::where([
                    'first_name' => $this->childContactsFields['first_name'],
                    'last_name' => $this->childContactsFields['last_name'],
               ])->first()) {
                return $this->alert('warning', 'Parent already exist.');
               }
            }
            $this->edit ?
                ChildrensFather::where('id', $this->selectedId)->update([
                    'first_name' => $this->childContactsFields['first_name'],
                    'last_name' => $this->childContactsFields['last_name'],
                    'email' => $this->childContactsFields['email'],
                    'phone' => $this->childContactsFields['phone_number'],
                ]):
                ChildrensFather::create([
                    'first_name' => $this->childContactsFields['first_name'],
                    'last_name' => $this->childContactsFields['last_name'],
                    'email' => $this->childContactsFields['email'],
                    'phone' => $this->childContactsFields['phone_number'],
                ]);
        } elseif($this->mothersInfo) {
            if (!$this->edit) {
                if (ChildrensMother::where([
                     'first_name' => $this->childContactsFields['first_name'],
                     'last_name' => $this->childContactsFields['last_name'],
                ])->first()) {
                 return $this->alert('warning', 'Parent already exist.');
                }
             }
            $this->edit ?
                ChildrensMother::where('id', $this->selectedId)->update([
                    'first_name' => $this->childContactsFields['first_name'],
                    'last_name' => $this->childContactsFields['last_name'],
                    'email' => $this->childContactsFields['email'],
                    'phone' => $this->childContactsFields['phone_number'],
                ]):
                ChildrensMother::create([
                    'first_name' => $this->childContactsFields['first_name'],
                    'last_name' => $this->childContactsFields['last_name'],
                    'email' => $this->childContactsFields['email'],
                    'phone' => $this->childContactsFields['phone_number'],
                ]);
        } else {
            if (!$this->edit) {
                if (ChildrenEmergencyContact::where([
                     'first_name' => $this->childContactsFields['first_name'],
                     'last_name' => $this->childContactsFields['last_name'],
                ])->first()) {
                 return $this->alert('warning', 'Parent already exist.');
                }
             }
            $this->edit ?
                ChildrenEmergencyContact::where('id', $this->selectedId)->update([
                    'first_name' => $this->childContactsFields['first_name'],
                    'last_name' => $this->childContactsFields['last_name'],
                    'email' => $this->childContactsFields['email'],
                    'phone_number' => $this->childContactsFields['phone_number'],
                    'child_id' => $this->child_id
                ]):
                ChildrenEmergencyContact::create([
                    'first_name' => $this->childContactsFields['first_name'],
                    'last_name' => $this->childContactsFields['last_name'],
                    'email' => $this->childContactsFields['email'],
                    'phone_number' => $this->childContactsFields['phone_number'],
                    'child_id' => $this->child_id
                ]);
        }

        if ($this->userDetailsOnTrash) {
            $this->userDetailsOnTrash->restore();
        } else if ($this->userDetails && !$this->userDetailsOnTrash) {
            User::where('id', $this->userDetails->id)->update([
                'first_name' => $this->childContactsFields['first_name'],
                'last_name' => $this->childContactsFields['last_name'],
                'email' => $this->childContactsFields['email'],
                'phone_number' => $this->childContactsFields['phone_number'],
            ]);
        } else {
            $this->createUser();
        }

        session()->flash('success', $this->edit ? "Successfully Updated Contact.": "Successfully Added New Contact.");
        $this->displayForm = false;
        $this->edit = false;


        return redirect()->route('children.contacts.contacts', [
            'user' => Auth()->user()->id,
            'first_name' => $this->childrenFields['first_name'],
            'last_name' => $this->childrenFields['last_name'],
            'child_id' => $this->child_id
        ]);
    }

    public function validateData()
    {
        return Validator::make(
                        [
                            'first_name'    => $this->childContactsFields['first_name'],
                            'last_name'     => $this->childContactsFields['last_name'],
                            'email'           => $this->childContactsFields['email'],
                            'phone_number'           => $this->childContactsFields['phone_number'],
                        ],
                        [
                            'first_name'    => 'required',
                            'last_name'     => 'required',
                            'phone_number'  => 'required',
                            'email'         => 'required',
                        ],
                        [
                            'required' => 'The :attribute field is required',
                            'required' => 'The :attribute field is required',
                            'required' => 'The :attribute field is required',
                            'required' => 'The :attribute field is required'
                        ],
                )->validate();
    }

    public function clearForm()
    {
        $this->childContactsFields['first_name'] = null;
        $this->childContactsFields['last_name'] = null;
        $this->childContactsFields['phone_number'] = null;
        $this->childContactsFields['email'] = null;
        $this->selectedId = null;
        $this->edit = false;
        $this->displayForm = false;
    }

    public function openEmailEditor($email, $id, $fathersInfo)
    {
        $contactData;
        if ($fathersInfo == 1) {
            $contactData = ChildrensFather::where('id', $id)->first();
            $this->fathersInfo = true;
            $this->mothersInfo = false;
        } elseif($fathersInfo == 2) {
            $contactData = ChildrensMother::where('id', $id)->first();
            $this->mothersInfo = true;
            $this->fathersInfo = false;
        } else {
            $contactData = ChildrenEmergencyContact::where('id', $id)->first();
            $this->mothersInfo = false;
            $this->fathersInfo = false;
        }

            $primaryGuardian = $contactData->first_name.' '.$contactData->last_name;

            $this->contactFields['parent_notification_email_content'] = "Hello {$primaryGuardian},
            We have added you as a primary contact to {$this->childName} in our Petite Scholars portal. To set your password, click on the link below.";

            $this->childContactsFields['first_name'] = $contactData->first_name;
            $this->childContactsFields['last_name'] = $contactData->last_name;
            $this->childContactsFields['phone_number'] = $contactData->phone_number ?? ($contactData->phone ?? null);
            $this->childContactsFields['email'] = $contactData->email;
            $this->selectedId = $contactData['id'];
            $this->parentEmails = $contactData->email;
            return $this->displayEmailSender = true;
    }

    public function createUser()
    {
        if (!$this->edit) {
            Validator::make(
                [
                    'email' => $this->childContactsFields['email'],
                ],
                [
                    'email' => 'unique:users',
                ],
                [
                    'unique' => 'Email already exists.',
                ]
            )->validate();
        }


        // Create User
        $userAccessDetails = [
            'first_name' =>  $this->childContactsFields['first_name'],
            'last_name' =>  $this->childContactsFields['last_name'],
            'email' =>  $this->childContactsFields['email'],
            'email_verified_at' => now(),
            'role' => Role::PARENT,
            'password_token' => $this->token ?? $this->generateToken(),
            'created_from_child_contacts' => 1
        ];

        $userAccess = User::where([
            'first_name' => $this->childContactsFields['first_name'],
            'last_name' => $this->childContactsFields['last_name'],
            'email' => $this->childContactsFields['email'],
        ])->first();

        $userId = $userAccess ? User::where('id', $userAccess->id)->update($userAccessDetails):
                            User::create($userAccessDetails)->id;

        return $userId;
    }

    public function generateToken()
    {
        return $this->token = Str::random(40);
    }

    public function render()
    {
        return view('livewire.children.contacts.contacts');
    }
}
