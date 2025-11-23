<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

    label, input, button , select{
  margin-bottom: 10px; /* Adds 10px of space below each element */
}
</style>


<body>
    <form action ="{{ route('ventes.update_detail', [$detailescommandevents->	CommandeVenteID,$detailescommandevents->DetailVenteID ] ) }}" method="POST">
         @csrf
        <input type="hidden" asp-for="articleID" />

       
       
        

        




         <diV>
           
            <label for ="Nom Article">Nom Article</label>  
            <select id="Nom Article" name="ArticleID">
                    @foreach($articles as $article)
                <option value= "{{ $article->articleID}}" 
                {{ old('ArticleID', $detailescommandevents->ArticleID)
                 ==  $article->articleID  ? 'selected' : '' }}>{{$article->NomArticle}}</option>
                    @endforeach
            </select>
        </diV>

        <div>
            <label for="Prix Unitaire">Prix Unitaire</label>
            <input type="number" id="Prix Unitaire" name="PrixUnitaire" value="{{ $detailescommandevents->PrixUnitaire}}" > 
        </div>


        <div>
            <label for="Quantite">Quantite</label>
            <input type="number" id="Quantite" name="Quantite" value="{{ $detailescommandevents->Quantite}}" > 
        </div>


  

        <div>
            <button type="submit"> Enregistrer</button>
        </div>
    </form>
</body>
</html>