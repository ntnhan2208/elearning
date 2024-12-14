<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class Google2FAAuthenticator extends Authenticator
{
    protected function canPassWithoutCheckingOTP()
    {
        if($this->getUser()->google2fa_enable === 0) {
            return true;
        }
        return
            !$this->getUser()->google2fa_enable ||
            !$this->isEnabled() ||
            $this->noUserIsAuthenticated() ||
            $this->twoFactorAuthStillValid();
    }

    protected function getGoogle2FASecretKey()
    {
        $secret = $this->getUser()->secret_code;
        if (is_null($secret) || empty($secret)) {
            throw new InvalidSecretKey('Secret key cannot be empty.');
        }
        return $secret;
    }
}
