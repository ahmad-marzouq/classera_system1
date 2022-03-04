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
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainUsers whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MainUsers extends Authenticatable
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
