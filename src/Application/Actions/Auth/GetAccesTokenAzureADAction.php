<?php

declare(strict_types=1);

namespace App\Application\Actions\Auth;

use SecureEnvPHP\SecureEnvPHP;
use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Action;

class GetAccesTokenAzureADAction extends Action
{
    protected function action(): Response
    {
        (new SecureEnvPHP())->parse('.env.enc', '.env.key');

        $clientId = getenv('CLIENT_ID');
        $clientSecret = getenv('CLIENT_SECRET');
        $tenantId = getenv('TENANT_ID');
        $azUsername = getenv('AZ_USERNAME');
        $azPassword = getenv('AZ_PASSWORD');


        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => $clientId,
            'clientSecret'            => $clientSecret,
            'urlAuthorize'            => 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize',
            'urlAccessToken'          => 'https://login.windows.net/' . $tenantId . '/oauth2/token',
            'urlResourceOwnerDetails' => '',
            'scopes'                  => 'openid',
        ]);

        // Try to get an access token using the resource owner password credentials grant.
        $accessToken = $provider->getAccessToken('password', [
            'username' => $azUsername,
            'password' => $azPassword,
            'resource' => 'https://analysis.windows.net/powerbi/api'
        ]);

        $token = $accessToken->getToken();
        return $this->respondWithData($token);

    }
}
