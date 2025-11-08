<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * 
 * @property int $ClientID
 * @property string $NomClient
 * @property string $Adresse
 * @property string $Telephone
 * @property string $Email
 * 
 * @property Collection|Commandevente[] $commandeventes
 *
 * @package App\Models
 */
class Client extends Model
{
	protected $table = 'clients';
	protected $primaryKey = 'ClientID';
	public $timestamps = false;

	protected $fillable = [
		'NomClient',
		'Adresse',
		'Telephone',
		'Email'
	];

	public function commandeventes()
	{
		return $this->hasMany(Commandevente::class, 'ClientID');
	}
}
