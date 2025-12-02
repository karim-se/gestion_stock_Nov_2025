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

 
<a href="{{ Route("articles.articles-staging.create") }}"
style="display:inline-block; padding:8px 15px; background-color:#006400; color:white; border:none; border-radius:6px; text-decoration:none;">
Ajouter un Article</a>





<!-- Formulaire de logout -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="position: fixed; top: 10px; right: 330px;">
    @csrf
    <button type="submit" 
            style="background-color: #FF0000; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
        Logout
    </button>
</form>


 <table>
     <tr>
     <th> Nom article</th>
     <th> Desription</th>
     <th> Nom Categotie</th>
     <th>Statut</th>
    </tr>

      @foreach($articleStaging as $article)
                        <tr>
                  
                            <td>{{ $article->NomArticle }}</td>
                            <td>{{$article-> Description }}</td>
                            <td>{{ $article->categorie->NomCategorie ?? 'Non Specifie' }}</td>
                            <td>{{ $article->statut_commande->Statut }}</td>
                            

                        </tr>

      @endforeach                  
 </table>
   


</body>
</html>