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

 
<a href="Articles/Ajouter_Article"
style="display:inline-block; padding:8px 15px; background-color:#006400; color:white; border:none; border-radius:6px; text-decoration:none;">
Ajouter un Article</a>


 <table>
     <tr>
     <th> Nom article</th>
     <th> Nom Categotie</th>
    <th> Modifier</th>
    <th>Supprimer</th>
    </tr>

      @foreach($articles as $article)
                        <tr>
                  
                            <td>{{ $article->NomArticle }}</td>
                            <td>{{ $article->categorie->NomCategorie ?? 'Non Specifie' }}</td>
                           <td> <a href="{{ route('articles.edit', $article->articleID ) }}" class="button">Modifier_Article</a> </td>
                             <td> <a href="{{ route('Supp_Article', $article->articleID ) }}" class="button">Supprimer_Article</a> </td>
                           

                        </tr>

      @endforeach                  
 </table>
   


</body>
</html>