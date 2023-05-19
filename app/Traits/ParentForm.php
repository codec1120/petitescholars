<?php

namespace App\Traits;

use App\Traits\Fields\ParentFormFields;
use App\Models\{ParentFormData, Role, User};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


trait ParentForm { 

    public function populateData (  ) {
        // validate and Check the Required Fields
        $this->validate();

        // Duplicate Checker
        $parentExist = ParentFormData::where('first_name', $this->parentFields['first_name'])
                                        ->where('last_name', $this->parentFields['last_name'])
                                        ->first();
        $userExistence = User::where('first_name', $this->parentFields['first_name'])
                            ->where('last_name', $this->parentFields['last_name'])
                            ->first();
                            
        if ( $userExistence || $parentExist ) {
            session()->flash('warning', "Parent Name already exist.");
            return false;
        }

        // Check Email already Exists
        $parentFormEmailExistence = ParentFormData::where('email_address', $this->parentFields['email_address'])->first();
        $UserEmailExistence = User::where('email', $this->parentFields['email_address'])->first();

        if (  $parentFormEmailExistence || $UserEmailExistence  ) {
            session()->flash('warning', "There is already an account associated with this email.");
            return false;
        }

        // If required fields were all validated; Save to the DB

        // Create User Access
        $userAccessDetails = [
            'first_name' => $this->parentFields['first_name'],
            'last_name' => $this->parentFields['last_name'],
            'email' => $this->parentFields['email_address'],
            'email_verified_at' => now(),
            'role' => Role::PARENT
        ];

        $user_id = User::create( $userAccessDetails )->id;
        
        // Create Parent Details
        $parentData = [
            'first_name' => $this->parentFields['first_name'],
            'last_name' => $this->parentFields['last_name'],
            'phone_number_1' => $this->parentFields['phone_number_1'],
            'phone_type_1' => $this->parentFields['phone_type_1'],
            'phone_number_2' => $this->parentFields['phone_number_2'],
            'phone_type_2' => $this->parentFields['phone_type_2'],
            'email_address' => $this->parentFields['email_address'],
            'profile_type' => $this->parentFields['profile_type'], 
            'user_id'       => $user_id
        ];

        $this->parentFields['id'] =  ParentFormData::create( $parentData )->id;

        // Send Email
        
        // Push Email important keys
        $parentData['subject'] = 'Password Creation';
        $parentData['template'] = 'vendor.mail.html.parentcreatepasswordtemplate';

        $this->sendEmail( $parentData, $user_id );
        
        return true;
    }

    public function sendEmail( $emailTemplateData, $id ) {

        $emailData =  [
            'content'   => $emailTemplateData['template'],
            'subject'   => $emailTemplateData['subject'],
            'to'        => $emailTemplateData['email_address']
        ];

        $emailTemplateData['link'] = env('APP_URL').env('APP_PARENT_CREATEPASSWORD_SLUG'). $id.'/parent-password';

        Mail::send( $emailData['content'], $emailTemplateData ,function ( $message ) use ( $emailData ) {
            $message->to( $emailData['to'],  $emailData['subject'] )
                    ->subject( $emailData['subject'] );
        });
    }
    
    public function createParentUserAccessibility () {

        // Update Parent Details
        ParentFormData::where( 'user_id' , '=', $this->parentFields['user_id'] )->update( 
                                ['password' => Hash::make($this->parentFields['password']), 
                                'status' => 1 ] 
                            );
        
        // Update User Password upon account confirmation
        User::where( 'id' , '=', $this->parentFields['user_id'] )
            ->update( [
                'password' => $this->parentFields['password'], 
                'email_verified_at' => date("Y-m-d")
                ] );
        

        // Reset Password field
        $this->parentFields['password'] = null;

        // Send Welcome email Email

         // Push Email important keys
         $emailTemplateData = [
            'subject' => 'Welcome Email',
            'template' => 'vendor.mail.html.parentwelcometemplate',
            'link'  => env('APP_URL').'/login',
            'email_address'  => $this->parentFields['email_address']
         ];

        $this->sendEmail( $emailTemplateData,  $this->parentFields['user_id'] );
        
    }

    public function verifyParentId ( $parentId ) {
        return ParentFormData::where( 'user_id', $parentId )->first();
    }

    public function getParentData ( $parentId ) {

        $parentDetails =  ParentFormData::where( 'user_id', $parentId )->first();
       
            return $this->parentFields = $parentDetails ? 
                    array_merge( $this->parentFields,  $parentDetails->toArray() ) : 
                    $this->parentFields;
    }

    public function updateParent ( $input ) {
       
        if ( isset( $input['password'] ) ) {
            
            $parentInfo = [
                'password' => Hash::make(  $input['password'] )
            ];
            
        } else {
            $parentInfo = [
                'first_name'        => $input['first_name'],
                'last_name'         => $input['last_name'],
                'email_address'     => isset( $input['email_address'] ) ? $input['email_address']: $input['email'],
                'phone_number_1'    => isset( $input['phone_number_1'] ) ? $input['phone_number_1']: $input['phone_number'],
                'phone_type_1'      => $input['phone_type_1'] ?? null,
                'zip'               => $input['zip'] ?? null,
                'address'           => $input['address'] ?? null,
                'state'             => $input['state'] ?? null,
                'city'              => $input['city'] ?? null,
            ];
        }
        

        ParentFormData::where( 'user_id' , '=', isset( $input['user_id'] ) ? $input['user_id']: $input['id'])
                        ->update( $parentInfo );
    }
}