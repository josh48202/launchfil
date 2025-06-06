<?php

namespace App\Auth\Socialite;

use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use Laravel\Socialite\Contracts\User as SocialiteUserContract;

class AzureTenantAuthorizer
{
    public static function checkTenantAllowList(FilamentSocialitePlugin $plugin, SocialiteUserContract $oauthUser): bool
    {
        $jwtPayload = json_decode(base64_decode(strtr(explode('.', $oauthUser->token)[1], '-_', '+/')));
        $tid = $jwtPayload->tid ?? null;

        return $tid && in_array($tid, explode(',', config('services.azure.allowed_tenants')));
    }
}
