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
    <form action ="{{ route('articles.update', $article->articleID) }}" method="POST">
         @csrf
        <input type="hidden" asp-for="articleID" />

        <div>
            <label for="Nom_Article">Nom Article</label>
            <input type="text" id="Nom_Article" name="NomArticle" value="{{ $article->NomArticle }}" > 
        </div>

        <div>
            <label for="Code_Article">Code Article</label>
            <input type="text" id="Code_Article" name="CodeArticle" value="{{ $article->CodeArticle }}" > 
        </div>

        <div>
            <label for="Description">Description</label>
            <input type="text" id="Description" name="Description" value="{{ $article->Description }}" > 
        </div>

        <div>
            <label for="Prix_Achat" >Prix Achat</label>
            <input type="number" id="Prix_Achat" name="PrixAchatStandard" value="{{ $article->PrixAchatStandard }}"> >
        </div>


         <div>
            <label for="Prix_Vente" >Prix Vente</label>
            <input type="number" id="Prix_Vente" name="PrixVenteStandard" value="{{ $article->PrixVenteStandard }}" >
        </div>
       
        

        <diV>
           
            <label for ="Categorie">Categorie</label>  
            <select id="Categorie" name="CategorieID">
                    @foreach($categories as $categorie)
                <option value= "{{ $categorie->CategorieID }}" 
                {{ old('CategorieID',$article->CategorieID) == $categorie->CategorieID ? 'selected' : '' }}>{{$categorie->NomCategorie}}</option>
                    @endforeach
            </select>
        </diV>


         <div>
            <label for="Stock_Actuel" >Stock Actuel</label>
            <input type="number" id="Stock_Actuel" name="StockActuel" value="{{ $article->StockActuel }}">
        </div>

        <div>
            <label for="Stock_Minimum" >Stock Minimum</label>
            <input type="number" id="Stock_Minimum" name="StockMinimum" value="{{ $article->StockMinimum }}" >
        </div>

        <div>
            <button type="submit"> Enregistrer</button>
        </div>
    </form>
</body>
</html>