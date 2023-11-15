<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Passport\Client as PassportClient;

/**
 * App\Models\Clients
 *
 * @mixin IdeHelperClients
 */
class Clients extends PassportClient
{
    protected $hidden = ['pivot'];

    /**
     * The clientScopes that belong to the client.
     */
    public function scopes(): BelongsToMany
    {
        return $this->belongsToMany(Scope::class, 'oauth_client_scopes', 'client_id', 'scope_id')
            ->select(['scope_id as id']);
    }
}
