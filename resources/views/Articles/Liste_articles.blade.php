<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
table, th, td {
  border: 1px solid black;
}

a {
  margin-bottom: 50px;
}


</style>

<body>

 
<a href="Ajouter"
style="display:inline-block; padding:8px 15px; background-color:#006400; color:white; border:none; border-radius:6px; text-decoration:none;">
Ajouter un Article</a>


 <table>
     <tr>
     <th> Nom article</th>
     <th> Desription</th>
     <th> Prix Achat</th>
     <th> Prix Vente</th>
     <th>Stock Actuel</th>
     <th>Stock minimum</th>
     <th> Nom Categotie</th>
    <th> Modifier</th>
    <th>Supprimer</th>
    </tr>

      @foreach($articles as $article)
                        <tr>
                  
                            <td>{{ $article->NomArticle }}</td>
                            <td>{{$article-> Description }}</td>
                            <td>{{$article-> PrixAchatStandard	 }}</td>
                            <td>{{  $article->PrixVenteStandard}}</td>
                            <td>{{$article->  StockActuel}}</td>
                            <td>{{ $article-> StockMinimum }}</td>
                            <td>{{ $article->categorie->NomCategorie ?? 'Non Specifie' }}</td>
                           <td> <a href="{{ route('articles.edit', $article->articleID ) }}" class="button">Modifier_Article</a> </td>
                             <td> <a href="{{ route('articles.Supprimer', $article->articleID ) }}" class="button">Supprimer_Article</a> </td>
                           

                        </tr>

      @endforeach                  
 </table>
   


</body>
</html>