<?php

namespace App\Http\Controllers\Auth;

use App\Models\Clients;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;

class OAuthController extends AccessTokenController
{
//    public function getToken(ServerRequestInterface $request): Response
//    {
//        $requestBody = $request->getParsedBody();
//
//        switch ($requestBody['grant_type']) {
//            case "password" : {}
//            case "authorization_code" : {}
//            case "client_credentials" : {}
//            case "refresh_token" : {}
//            default : {
//                // throw grant type invalid
//            }
//        }
//        return parent::issueToken($request->withParsedBody($data));
//    }
    public function getCodeToken() {
//        "grant_type" : "authorization_code",
//        "client_id": "{{client_id}}",
//        "client_secret" : "{{client_secret}}",
//        "redirect_uri" : "http://localhost:4200/auth/callback",
//        "code" : "place 'code' from response in step 1"
    }

    public function getPasswordToken() {
//        "grant_type" : "password",
//        "client_id": "{{password_client_id}}",
//        "client_secret" : "{{password_client_secret}}",
//        "username" : "admin@mail.com",
//        "password" : "12341234",
//        "scope" : "*"
    }
    public function refreshToken() {
//        "grant_type" : "refresh_token",
//        "client_id": "{{password_client_id}}",
//        "client_secret" : "{{password_client_secret}}",
//        "refresh_token" : "{{refresh_token}}",
//        "scope" : "*"
    }

}
