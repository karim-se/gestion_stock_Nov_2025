<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Commandevente
 * 
 * @property int $CommandeVenteID
 * @property Carbon $DateCommande
 * @property int $Statut_ID
 * @property int $ClientID
 * 
 * @property Client $client
 * @property StatutCommande $statut_commande
 * @property Collection|Detailcommandevente[] $detailcommandeventes
 *
 * @package App\Models
 */
class Commandevente extends Model
{
	protected $table = 'commandeventes';
	protected $primaryKey = 'CommandeVenteID';
	public $timestamps = false;

	protected $casts = [
		'DateCommande' => 'datetime',
		'Statut_ID' => 'int',
		'ClientID' => 'int'
	];

	protected $fillable = [
		'DateCommande',
		'Statut_ID',
		'ClientID'
	];

	public function client()
	{
		return $this->belongsTo(Client::class, 'ClientID');
	}

	public function statut_commande()
	{
		return $this->belongsTo(StatutCommande::class, 'Statut_ID');
	}

	public function detailcommandeventes()
	{
		return $this->hasMany(Detailcommandevente::class, 'CommandeVenteID');
	}
}
