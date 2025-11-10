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
    <form action ="{{ route('achats.edit', $detailsCommandeAchat->DetailAchatID) }}" method="POST">
         @csrf
        <input type="hidden" asp-for="articleID" />

       
       
        

        <diV>
           
            <label for ="Nom Fournisseur">Nom Fournisseur</label>  
            <select id="Nom Fournisseur" name="FournisseurID">
                    @foreach($fournisseurs as $fournisseur)
                <option value= "{{ $fournisseur->FournisseurID }}" 
                {{ old('FournisseurID', $detailsCommandeAchat->commandeachat->FournisseurID)
                 ==  $fournisseur->FournisseurID ? 'selected' : '' }}>{{$fournisseur->NomFournisseur}}</option>
                    @endforeach
            </select>
        </diV>


            <diV>
           
            <label for ="Statut Commande">Statut Commande</label>  
            <select id="Statut Commande" name="Statut_ID">
                    @foreach($statuts as $statut)
                <option value= "{{ $statut->Statut_ID}}" 
                {{ old('Statut_ID', $detailsCommandeAchat->commandeachat->Statut_ID)
                 ==  $statut->Statut_ID ? 'selected' : '' }}>{{$statut->Statut}}</option>
                    @endforeach
            </select>
        </diV>




         <diV>
           
            <label for ="Nom Article">Nom Article</label>  
            <select id="Nom Article" name="ArticleID">
                    @foreach($articles as $article)
                <option value= "{{ $article->articleID}}" 
                {{ old('ArticleID', $detailsCommandeAchat->ArticleID)
                 ==  $article->articleID  ? 'selected' : '' }}>{{$article->NomArticle}}</option>
                    @endforeach
            </select>
        </diV>

        <div>
            <label for="Prix Unitaire">Prix Unitaire</label>
            <input type="number" id="Prix Unitaire" name="PrixUnitaire" value="{{ $detailsCommandeAchat->PrixUnitaire}}" > 
        </div>


        <div>
            <label for="Quantite">Quantite</label>
            <input type="number" id="Quantite" name="Quantite" value="{{ $detailsCommandeAchat->Quantite}}" > 
        </div>


  

        <div>
            <button type="submit"> Enregistrer</button>
        </div>
    </form>
</body>
</html>