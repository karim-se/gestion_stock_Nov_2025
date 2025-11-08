<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Commandeachat
 * 
 * @property int $CommandeAchatID
 * @property Carbon $DateCommande
 * @property int $FournisseurID
 * @property int $Statut_ID
 * 
 * @property Fournisseur $fournisseur
 * @property StatutCommande $statut_commande
 * @property Collection|Detailcommandeachat[] $detailcommandeachats
 *
 * @package App\Models
 */
class Commandeachat extends Model
{
	protected $table = 'commandeachats';
	protected $primaryKey = 'CommandeAchatID';
	public $timestamps = false;

	protected $casts = [
		'DateCommande' => 'datetime',
		'FournisseurID' => 'int',
		'Statut_ID' => 'int'
	];

	protected $fillable = [
		'DateCommande',
		'FournisseurID',
		'Statut_ID'
	];

	public function fournisseur()
	{
		return $this->belongsTo(Fournisseur::class, 'FournisseurID');
	}

	public function statut_commande()
	{
		return $this->belongsTo(StatutCommande::class, 'Statut_ID');
	}

	public function detailcommandeachats()
	{
		return $this->hasMany(Detailcommandeachat::class, 'CommandeAchatID');
	}
}
