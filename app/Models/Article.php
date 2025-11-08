<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * 
 * @property int $articleID
 * @property string $NomArticle
 * @property string $CodeArticle
 * @property string $Description
 * @property float $PrixAchatStandard
 * @property float $PrixVenteStandard
 * @property int $StockActuel
 * @property int $StockMinimum
 * @property int $CategorieID
 * 
 * @property Categorie $categorie
 * @property Collection|Detailcommandeachat[] $detailcommandeachats
 * @property Collection|Detailcommandevente[] $detailcommandeventes
 *
 * @package App\Models
 */
class Article extends Model
{
	protected $table = 'articles';
	protected $primaryKey = 'articleID';
	public $timestamps = false;

	protected $casts = [
		'PrixAchatStandard' => 'float',
		'PrixVenteStandard' => 'float',
		'StockActuel' => 'int',
		'StockMinimum' => 'int',
		'CategorieID' => 'int'
	];

	protected $fillable = [
		'NomArticle',
		'CodeArticle',
		'Description',
		'PrixAchatStandard',
		'PrixVenteStandard',
		'StockActuel',
		'StockMinimum',
		'CategorieID'
	];

	public function categorie()
	{
		return $this->belongsTo(Categorie::class, 'CategorieID');
	}

	public function detailcommandeachats()
	{
		return $this->hasMany(Detailcommandeachat::class, 'ArticleID');
	}

	public function detailcommandeventes()
	{
		return $this->hasMany(Detailcommandevente::class, 'ArticleID');
	}
}
