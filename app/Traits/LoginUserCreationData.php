<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Traits\Fields\LoginUserCreationFields;
use App\Models\{ User, ParentFormData, Role};
use Illuminate\Support\Facades\DB;

trait LoginUserCreationData { 
    public function createUser () {
        if ( $this->formFields['role'] == 0  ) {
            return self::createStaffUser();
        } else {
            return self::createParentUser();
        }
    }

    public function createStaffUser () {
        $userExistence = User::where('first_name', $this->formFields['first_name'])
                            ->where('last_name', $this->formFields['last_name'])
                            ->first();
                           
        if ( $userExistence ) {
           $this->alert('warning', "User Name already exist.");
           return false;
        }

        // Check Email already Exists
        $parentFormEmailExistence = ParentFormData::where('email_address', $this->formFields['email'])->first();
        $UserEmailExistence =  DB::table('users')->where('email', $this->formFields['email'])->first();

        if (  $parentFormEmailExistence || $UserEmailExistence  ) {
            $this->alert('warning', "There is already an account associated with this email.");
            return false;
        }

        // Create User Access
        $userAccessDetails = [
            'first_name' => $this->formFields['first_name'],
            'last_name' => $this->formFields['last_name'],
            'email' => $this->formFields['email'],
            'password' =>  $this->formFields['password'],
            'email_verified_at' => now(),
            'role' => Role::STAFF
        ];

        $user_id = User::create( $userAccessDetails )->id;

        $this->alert('success', "Successfully created new user");

         // Send Welcome email Email

         // Push Email important keys
         $emailTemplateData = [
            'subject' => 'Welcome Email',
            'template' => 'vendor.mail.html.parentwelcometemplate',
            'link'  => env('APP_URL').'login',
            'email' => $this->formFields['email']
         ];

        $this->sendEmail( $emailTemplateData, $user_id );

        return true;
    }

    public function createParentUser () {
         // Duplicate Checker
        $parentExist = ParentFormData::where('first_name', $this->formFields['first_name'])
                                        ->where('last_name', $this->formFields['last_name'])
                                        ->first();
        $userExistence = User::where('first_name', $this->formFields['first_name'])
                            ->where('last_name', $this->formFields['last_name'])
                            ->first();
                            
        if ( $userExistence || $parentExist ) {
            $this->alert('warning', "User Name already exist.");
            return false;
        }

        // Check Email already Exists
        $email = $this->formFields['email'];
        $parentFormEmailExistence = ParentFormData::where('email_address', $email)->first();
        $UserEmailsExistence = DB::table('users')->where('email', $email)->first();

        if (  $parentFormEmailExistence || $UserEmailsExistence  ) {
            $this->alert('warning', "There is already an account associated with this email.");
            return false;
        }

         // Create User Access
         $userAccessDetails = [
            'first_name' => $this->formFields['first_name'],
            'last_name' => $this->formFields['last_name'],
            'email' => $this->formFields['email'],
            'password' => $this->formFields['password'],
            'email_verified_at' => now(),
            'role' => Role::PARENT
        ];
        
        $user_id = User::create( $userAccessDetails )->id;
        
        // Create Parent Details
        $parentData = [
            'first_name' => $this->formFields['first_name'],
            'last_name' => $this->formFields['last_name'],
            'phone_number' => $this->formFields['phone_number'], 
            'password' => $this->formFields['password'],
            'email_address' => $this->formFields['email'],
            'user_id'       => $user_id
        ];

        ParentFormData::create( $parentData )->id;

        $this->alert('success', "Successfully created new user");

        // Send Welcome email Email

         // Push Email important keys
         $emailTemplateData = [
            'subject' => 'Welcome Email',
            'template' => 'vendor.mail.html.parentwelcometemplate',
            'link'  => env('APP_URL').'login',
            'email' => $this->formFields['email']
         ];

        $this->sendEmail( $emailTemplateData, $user_id );

        return true;
    }

    public function sendEmail( $emailTemplateData, $id ) {

        $emailData =  [
            'content'   => $emailTemplateData['template'],
            'subject'   => $emailTemplateData['subject'],
            'to'        => $emailTemplateData['email']
        ];

        $emailTemplateData['link'] = env('APP_URL').'/login';

        Mail::send( $emailData['content'], $emailTemplateData ,function ( $message ) use ( $emailData ) {
            $message->to( $emailData['to'],  $emailData['subject'] )
                    ->subject( $emailData['subject'] );
        });
    }
}