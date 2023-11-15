<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Scope
 *
 * @mixin IdeHelperScope
 */
class Scope extends Model
{
    use HasFactory;

    protected $table = "oauth_scopes";
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * The clientScopes that belong to the scope.
     */
    public function hasClients(): BelongsToMany
    {
        return $this->belongsToMany(Clients::class, 'oauth_client_scopes', 'scope_id', 'client_id');
    }
}
