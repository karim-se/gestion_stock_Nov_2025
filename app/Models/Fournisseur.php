<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fournisseur
 * 
 * @property int $FournisseurID
 * @property string $NomFournisseur
 * @property string $Adresse
 * @property string $Telephone
 * @property string $Email
 * @property string $Role
 * 
 * @property Collection|Commandeachat[] $commandeachats
 *
 * @package App\Models
 */
class Fournisseur extends Model
{
	protected $table = 'fournisseurs';
	protected $primaryKey = 'FournisseurID';
	public $timestamps = false;

	protected $fillable = [
		'NomFournisseur',
		'Adresse',
		'Telephone',
		'Email',
		'Role'
	];

	public function commandeachats()
	{
		return $this->hasMany(Commandeachat::class, 'FournisseurID');
	}
}
