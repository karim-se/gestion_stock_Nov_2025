<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class article_staging extends Model
{
     protected $table = 'article_staging';

      const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_VALIDE = 'valide';
    const STATUT_REJETE = 'rejete';



     protected $fillable = [
        'NomArticle',
        'CodeArticle',
        'categorieID',
        'Description',
        'PrixAchatStandard',
        'PrixVenteStandard',
        'statut',
        'StockActuel',
        'StockMinimum',
        'created_by',
        'validated_by',
        'validated_at',
        'raison_rejet',
    ];


     public function categorie()
	{
		return $this->belongsTo(Categorie::class, 'categorieID');
	}

    /**
     * Employé qui a créé l'article
     */
    public function createur()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Responsable qui a validé/rejeté l'article
     */
    public function validateur()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }


     public function scopeEnAttente($query)
    {
        return $query->where('statut', self::STATUT_EN_ATTENTE);
    }

    /**
     * Scope pour articles validés
     */
    public function scopeValides($query)
    {
        return $query->where('statut', self::STATUT_VALIDE);
    }

    /**
     * Scope pour articles rejetés
     */
    public function scopeRejetes($query)
    {
        return $query->where('statut', self::STATUT_REJETE);
    }


}
