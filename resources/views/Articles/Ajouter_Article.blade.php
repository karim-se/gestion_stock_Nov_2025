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
    <form action ="{{ route('articles.articles-staging.store') }}" method="POST">
         @csrf
        <div>
            <label for="Nom_Article">Nom Article</label>
            <input type="text" id="Nom_Article" name="NomArticle"> 
        </div>

        <div>
            <label for="Code_Article">Code Article</label>
            <input type="text" id="Code_Article" name="CodeArticle"> 
        </div>

        <div>
            <label for="Description">Description</label>
            <input type="text" id="Description" name="Description"> 
        </div>

         
        <diV>
           
            <label for ="Categorie">Categorie</label>  
            <select id="Categorie" name="categorieID">
                    @foreach($categories as $categorie)
                <option value= "{{ $categorie->CategorieID }}">{{$categorie->NomCategorie}}</option>
                    @endforeach
            </select>
        </diV>

        <div>
            <label for="PrixAchatStandard">PrixAchatStandard</label>
            <input type="number" id="PrixAchatStandard" name="PrixAchatStandard"> 
        </div>

         <div>
            <label for="PrixVenteStandard">PrixVenteStandard</label>
            <input type="number" id="PrixVenteStandard" name="PrixVenteStandard"> 
        </div>


        <div>
            <label for="StockActuel">StockActuel</label>
            <input type="number" id="StockActuel" name="StockActuel"> 
        </div>


         <div>
            <label for="StockMinimum">StockMinimum</label>
            <input type="number" id="StockMinimum" name="StockMinimum"> 
        </div>


         <div class="button-group">
            <button type="submit">✓ Enregistrer et Envoyer pour Validation</button>
            <a href="{{ route('articles.articles-staging.index') }}" class="btn-cancel">✕ Annuler</a>
        </div>



    </form>
</body>
</html>