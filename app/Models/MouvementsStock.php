<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MouvementsStock
 * 
 * @property int $id
 * @property int $ArticleId
 * @property string $Type
 * @property string $Source
 * @property int $Quantite
 * @property int $Stock_Avant
 * @property int $Stock_Apres
 * @property int $DetailCommandeAchat_ID
 * @property int $DetailCommandevente_ID
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Article $article
 *
 * @package App\Models
 */
class MouvementsStock extends Model
{
	protected $table = 'mouvements_stock';

	protected $casts = [
		'ArticleId' => 'int',
		'Quantite' => 'int',
		'Stock_Avant' => 'int',
		'Stock_Apres' => 'int',
		'DetailCommandeAchat_ID' => 'int',
		'DetailCommandevente_ID' => 'int'
	];

	protected $fillable = [
		'ArticleId',
		'Type',
		'Source',
		'Quantite',
		'Stock_Avant',
		'Stock_Apres',
		'DetailCommandeAchat_ID',
		'DetailCommandevente_ID'
	];

	public function article()
	{
		return $this->belongsTo(Article::class, 'ArticleId');
	}
}
