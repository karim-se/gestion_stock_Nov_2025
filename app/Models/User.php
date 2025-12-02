<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class User extends Authenticatable
{

	use HasFactory, Notifiable, HasRoles;
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		  'password' => 'hashed',
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'Mdp_NonHashe'
	];

	 public function articlesCreated()
    {
        return $this->hasMany(article_staging::class, 'user_id');
    }

    // Relation avec les articles validés
    public function articlesValidated()
    {
        return $this->hasMany(article_staging::class, 'validated_by');
    }
}
