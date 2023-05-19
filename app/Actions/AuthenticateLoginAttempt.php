<?php

namespace App\Actions;

use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\{User,ChildInformation, ChildGuardian};
use Carbon\Carbon;

class AuthenticateLoginAttempt
{

   public function __invoke(Request $request)
   {
      $user = User::where('email', $request->email)->first();
    
      if ( $user && Hash::check( $request->password, $user->password ) ) {
            User::where('id', $user->id)->update(['login_at' => Carbon::now()->format('Y-m-d H:i:s') ]);
            return $user;
      }

     
   }
}
