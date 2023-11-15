<?php

namespace App\Http\Controllers\Auth;

use App\Models\Clients;
use Illuminate\Http\Response;
use Laravel\Passport\Exceptions\OAuthServerException as PassportOAuthServerException;
use Laravel\Passport\Http\Controllers\AccessTokenController as ATC;
use League\OAuth2\Server\Exception\OAuthServerException as LeagueOAuthServerException;
use Psr\Http\Message\ServerRequestInterface;

class AccessTokenController extends ATC
{
    /**
     * @throws PassportOAuthServerException
     */
    public function getToken(ServerRequestInterface $request): Response
    {

        $data = parent::withErrorHandling(function () use ($request) {
            return $this->checkClientScopes($request);
        });
        $tokenResponse = parent::issueToken($request->withParsedBody($data));

        //convert response to json string
        $content = $tokenResponse->getContent();
        //convert json to array
        $responseData = json_decode($content, true);
        $responseData['extra_data'] = "extra";

        $tokenResponse->setContent(json_encode($responseData));
        return $tokenResponse;
    }

    /**
     * @throws LeagueOAuthServerException
     */
    private function checkClientScopes(ServerRequestInterface $request): object|array
    {
        $requestBody = $request->getParsedBody();
        $data = $requestBody;
        $client = Clients::find($requestBody['client_id']);
        if (!$client) throw LeagueOAuthServerException::invalidClient($request);
        $client['scopes'] = array_column($client->scopes()->get()->toArray(), 'id');
        if(isset($requestBody['scope'])) {
            if ($requestBody['scope'] != "*") {
                $scopes = explode(' ', $requestBody['scope']);
                $scopes = array_intersect($scopes, $client['scopes']);
                $data['scope'] = implode(" ", $scopes);
            }
        }
        return $data;
    }
}
