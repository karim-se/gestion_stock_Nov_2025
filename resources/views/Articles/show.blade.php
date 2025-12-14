<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Article</title>
</head>
<body>

<a href="{{ route('articles.articles-staging.index') }}">Retour</a>

<h2>Détail de l'article</h2>

<table border="1">
    <tbody>
        <tr>
            <th>Statut</th>
            <td>{{ $articleStaging->statut }}</td>
        </tr>

        <tr>
            <th>Code</th>
            <td>{{ $articleStaging->CodeArticle }}</td>
        </tr>

        <tr>
            <th>Nom</th>
            <td>{{ $articleStaging->NomArticle }}</td>
        </tr>

        <tr>
            <th>Catégorie</th>
            <td>{{ $articleStaging->categorie->NomCategorie }}</td>
        </tr>

        <tr>
            <th>Prix</th>
            <td>
                @if($articleStaging->PrixAchatStandard)
                    {{ number_format($articleStaging->PrixAchatStandard,2) }} DA
                @else
                    Non spécifié
                @endif
            </td>
        </tr>

        @if($articleStaging->description)
        <tr>
            <th>Description</th>
            <td>{{ $articleStaging->description }}</td>
        </tr>
        @endif

        <tr>
            <th>Créé par</th>
            <td>{{ $articleStaging->createur->name ?? 'N/A' }}</td>
        </tr>

        <tr>
            <th>Date création</th>
            <td>{{ $articleStaging->created_at->format('d/m/Y H:i') }}</td>
        </tr>

        @if($articleStaging->validated_at)
        <tr>
            <th>Validé/Rejeté par</th>
            <td>{{ $articleStaging->validateur->name ?? 'N/A' }}</td>
        </tr>

        <tr>
            <th>Date action</th>
            <td>{{ $articleStaging->validated_at }}</td>
        </tr>
        @endif

        @if($articleStaging->statut === 'rejete' && $articleStaging->raison_rejet)
        <tr>
            <th>Raison du rejet</th>
            <td>{{ $articleStaging->raison_rejet }}</td>
        </tr>
        @endif
    </tbody>
</table>

@can('validate_article')
@if($articleStaging->statut === 'en_attente')

    <button onclick="Afficher('validerModal')">Valider</button>
    <button onclick="Afficher('rejeterModal')">Rejeter</button>

@endif
@endcan

<!-- Modal Valider -->
<div id="validerModal" style="display:none; border:1px solid #000; padding:10px; margin-top:15px;">
    <h4>Valider l'article</h4>
    <p>Voulez-vous valider cet article ?</p>

    <button onclick="Masquer('validerModal')">Annuler</button>

    <form action="{{ route('articles.articles-staging.valider', $articleStaging->id) }}" method="POST">
        @csrf
        <button type="submit">Confirmer</button>
    </form>
</div>

<!-- Modal Rejeter -->
<div id="rejeterModal" style="display:none; border:1px solid #000; padding:10px; margin-top:15px;">
    <h4>Rejeter l'article</h4>

    <form action="{{ route('articles.articles-staging.rejeter', $articleStaging) }}" method="POST">
        @csrf

        <p>Indiquez la raison du rejet :</p>
        <textarea name="raison_rejet" rows="3" required></textarea>

        <br><br>

        <button onclick="Masquer('rejeterModal')" type="button">Annuler</button>
        <button type="submit">Rejeter</button>
    </form>
</div>

<script>
function Afficher(id){ document.getElementById(id).style.display = 'block'; }
function Masquer(id){ document.getElementById(id).style.display = 'none'; }
</script>

</body>
</html>
