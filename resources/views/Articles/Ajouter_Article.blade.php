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
    <form action ="{{ route('articles.store') }}" method="POST">
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

        <div>
            <label for="Prix_Achat" >Prix Achat</label>
            <input type="number" id="Prix_Achat" name="PrixAchatStandard">
        </div>


         <div>
            <label for="Prix_Vente" >Prix Vente</label>
            <input type="number" id="Prix_Vente" name="PrixVenteStandard">
        </div>
       
        

        <diV>
           
            <label for ="Categorie">Categorie</label>  
            <select id="Categorie" name="CategorieID">
                    @foreach($categories as $categorie)
                <option value= "{{ $categorie->CategorieID }}">{{$categorie->NomCategorie}}</option>
                    @endforeach
            </select>
        </diV>


         <div>
            <label for="Stock_Actuel" >Stock Actuel</label>
            <input type="number" id="Stock_Actuel" name="StockActuel">
        </div>

        <div>
            <label for="Stock_Minimum" >Stock Minimum</label>
            <input type="number" id="Stock_Minimum" name="StockMinimum">
        </div>

        <div>
            <button type="submit"> Enregistrer</button>
        </div>
    </form>
</body>
</html>