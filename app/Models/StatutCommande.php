<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StatutCommande
 * 
 * @property int $Statut_ID
 * @property string $Statut
 * 
 * @property Collection|Commandeachat[] $commandeachats
 * @property Collection|Commandevente[] $commandeventes
 *
 * @package App\Models
 */
class StatutCommande extends Model
{
	protected $table = 'statut_commande';
	protected $primaryKey = 'Statut_ID';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Statut_ID' => 'int'
	];

	protected $fillable = [
		'Statut'
	];

	public function commandeachats()
	{
		return $this->hasMany(Commandeachat::class, 'Statut_ID');
	}

	public function commandeventes()
	{
		return $this->hasMany(Commandevente::class, 'Statut_ID');
	}
}
