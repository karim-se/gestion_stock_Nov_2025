<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detailcommandevente
 * 
 * @property int $DetailVenteID
 * @property int $CommandeVenteID
 * @property int $ArticleID
 * @property int $PrixUnitaire
 * @property int $Quantite
 * 
 * @property Article $article
 * @property Commandevente $commandevente
 *
 * @package App\Models
 */
class Detailcommandevente extends Model
{
	protected $table = 'detailcommandeventes';
	protected $primaryKey = 'DetailVenteID';
	public $timestamps = false;

	protected $casts = [
		'CommandeVenteID' => 'int',
		'ArticleID' => 'int',
		'PrixUnitaire' => 'int',
		'Quantite' => 'int'
	];

	protected $fillable = [
		'CommandeVenteID',
		'ArticleID',
		'PrixUnitaire',
		'Quantite'
	];

	public function article()
	{
		return $this->belongsTo(Article::class, 'ArticleID');
	}

	public function commandevente()
	{
		return $this->belongsTo(Commandevente::class, 'CommandeVenteID');
	}
}
