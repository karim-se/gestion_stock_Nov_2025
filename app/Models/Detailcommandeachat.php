<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detailcommandeachat
 * 
 * @property int $DetailAchatID
 * @property int $Quantite
 * @property int $PrixUnitaire
 * @property int $CommandeAchatID
 * @property int $ArticleID
 * 
 * @property Article $article
 * @property Commandeachat $commandeachat
 *
 * @package App\Models
 */
class Detailcommandeachat extends Model
{
	protected $table = 'detailcommandeachats';
	protected $primaryKey = 'DetailAchatID';
	public $timestamps = false;

	protected $casts = [
		'Quantite' => 'int',
		'PrixUnitaire' => 'int',
		'CommandeAchatID' => 'int',
		'ArticleID' => 'int'
	];

	protected $fillable = [
		'Quantite',
		'PrixUnitaire',
		'CommandeAchatID',
		'ArticleID'
	];

	public function article()
	{
		return $this->belongsTo(Article::class, 'ArticleID');
	}

	public function commandeachat()
	{
		return $this->belongsTo(Commandeachat::class, 'CommandeAchatID');
	}
}
