<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\MainUsers
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MainUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
