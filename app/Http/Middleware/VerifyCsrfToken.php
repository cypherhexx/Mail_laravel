<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
       'admin/paypal/success/*',
       'user/paypal/success/*',
       'register/paypal/success/*',
       'user/upgrade/success/*',
        'user/paypalupgrade/paypalsuccess/*',
        'bitaps/paymentnotify',
        'purchasebitaps/paymentnotify',

        'paypal/ipnnotify',
        'username_validate',

    ];
}
