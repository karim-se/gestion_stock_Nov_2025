<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Article</title>

    <style>
        body { font-family: Arial, sans-serif; padding: 10px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .section {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 15px;
        }

        .btn {
            border: 1px solid #000;
            padding: 5px 10px;
            background: #eee;
            cursor: pointer;
            text-decoration: none;
        }

        /* Modals */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.2);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #fff;
            border: 1px solid #000;
            padding: 15px;
            width: 300px;
        }

        textarea { width: 100%; height: 80px; }
    </style>
</head>

<body>

<a href="{{ route('articles.articles-staging.index') }}" class="btn">Retour</a>

<h2>Détail de l'article</h2>

<div class="section">
    <strong>Statut :</strong> {{ $articleStaging->statut }}
</div>

<table>
    <tr><th>Code</th><td>{{ $articleStaging->CodeArticle }}</td></tr>
    <tr><th>Nom</th><td>{{ $articleStaging->NomArticle }}</td></tr>
    <tr><th>Catégorie</th><td>{{ $articleStaging->categorie->NomCategorie }}</td></tr>
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
</table>

@if($articleStaging->description)
<div class="section">
    <strong>Description :</strong><br>
    {{ $articleStaging->description }}
</div>
@endif

<h3>Suivi</h3>
<table>
    <tr><th>Créé par</th><td>{{ $articleStaging->createur->name ?? 'N/A' }}</td></tr>
    <tr><th>Date création</th><td>{{ $articleStaging->created_at->format('d/m/Y H:i') }}</td></tr>

    @if($articleStaging->validated_at)
    <tr><th>Validé/Rejeté par</th><td>{{ $articleStaging->validateur->name ?? 'N/A' }}</td></tr>
    <tr><th>Date action</th><td>{{ $articleStaging->validated_at }}</td></tr>
    @endif
</table>

@if($articleStaging->statut === 'rejete' && $articleStaging->raison_rejet)
<div class="section">
    <strong>Raison du rejet :</strong><br>
    {{ $articleStaging->raison_rejet }}
</div>
@endif

@can('validate_article')
@if($articleStaging->statut === 'en_attente')
    <button class="btn" onclick="openModal('modalValider')">Valider</button>
    <button class="btn" onclick="openModal('modalRejeter')">Rejeter</button>
@endif
@endcan

<!-- Modal Valider -->
<div class="modal" id="modalValider">
    <div class="modal-content">
        <h4>Confirmer</h4>
        <form action="{{ route('articles.articles-staging.valider', $articleStaging->id) }}" method="POST">
            @csrf
            <button class="btn" type="submit">Valider</button>
            <button class="btn" type="button" onclick="closeModal('modalValider')">Annuler</button>
        </form>
    </div>
</div>

<!-- Modal Rejeter -->
<div class="modal" id="modalRejeter">
    <div class="modal-content">
        <h4>Raison du rejet</h4>
        <form action="{{ route('articles.articles-staging.rejeter', $articleStaging) }}" method="POST">
            @csrf
            <textarea name="raison_rejet" required></textarea>
            <br><br>
            <button class="btn" type="submit">Rejeter</button>
            <button class="btn" type="button" onclick="closeModal('modalRejeter')">Annuler</button>
        </form>
    </div>
</div>

<script>
function openModal(id) { document.getElementById(id).style.display = "flex"; }
function closeModal(id) { document.getElementById(id).style.display = "none"; }
</script>

</body>
</html>
