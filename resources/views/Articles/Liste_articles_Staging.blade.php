<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles en Validation</title>
</head>
<body>

<h2>Articles en Validation</h2>

@can('create_article')
    <a href="{{ route('articles.articles-staging.create') }}">➕ Nouvel Article</a>
@endcan



<a href="{{ route('articles.articles-staging.index') }}">Tous</a>
<a href="{{ route('articles.articles-staging.index', ['statut' => 'en_attente']) }}">En attente</a>
<a href="{{ route('articles.articles-staging.index', ['statut' => 'valide']) }}">Validés</a>
<a href="{{ route('articles.articles-staging.index', ['statut' => 'rejete']) }}">Rejetés</a>

<table border="1">
    <thead>
        <tr>
            <th>Code</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Statut</th>
            <th>Créé par</th>
            <th>Date création</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($articles as $article)
            <tr>
                <td>{{ $article->CodeArticle }}</td>
                <td>{{ $article->NomArticle }}</td>
                <td>{{ $article->categorie->NomCategorie }}</td>
                <td>{{ $article->statut }}</td>
                <td>{{ $article->createur->name ?? 'N/A' }}</td>
                <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('articles.articles-staging.show', $article->id) }}">Voir</a>

                    @can('validate_article')
                        @if($article->statut === 'en_attente')
                            <button type="button" onclick="Afficher('validerModal{{ $article->id }}')">Valider</button>
                            <button type="button" onclick="Afficher('rejeterModal{{ $article->id }}')">Rejeter</button>
                        @endif
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Aucun article en staging</td>
            </tr>
        @endforelse
    </tbody>
</table>



@foreach($articles as $article)
  

        <div id="validerModal{{ $article->id }}" style="display:none;">
            <h5>Valider l'article</h5>
            <p>Êtes-vous sûr de vouloir valider l'article {{ $article->nom }} ?</p>
            <p>L'article sera ajouté au catalogue principal.</p>
            <button type="button" onclick="Masquer('validerModal{{ $article->id }}')">Annuler</button>

            <form action="{{ route('articles.articles-staging.valider', $article->id) }}" method="POST">
                @csrf
                <button type="submit">Confirmer</button>
            </form>
        </div>

        <div id="rejeterModal{{ $article->id }}" style="display:none;">
            <h5>Rejeter l'article</h5>

            <form action="{{ route('articles.articles-staging.rejeter', $article) }}" method="POST">
                @csrf
                <p>Pourquoi rejetez-vous l'article {{ $article->nom }} ?</p>
                <label>Raison du rejet *</label>
                <textarea name="raison_rejet" rows="3" required></textarea>

                <button type="button" onclick="Masquer('rejeterModal{{ $article->id }}')">Annuler</button>
                <button type="submit">Rejeter</button>
            </form>
        </div>

 
@endforeach

<script>
    function Afficher(id) {
        document.getElementById(id).style.display = 'block';
    }
    function Masquer(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>

</body>
</html>
