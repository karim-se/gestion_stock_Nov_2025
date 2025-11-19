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
    <form action ="{{ route('achats.update_commande', [$commandeAchat->CommandeAchatID]) }}" method="POST">
         @csrf
        <input type="hidden" asp-for="articleID" />

       
       
        

        <diV>
           
            <label for ="Nom Fournisseur">Nom Fournisseur</label>  
            <select id="Nom Fournisseur" name="FournisseurID">
                    @foreach($fournisseurs as $fournisseur)
                <option value= "{{ $fournisseur->FournisseurID }}" 
                {{ old('FournisseurID', $commandeAchat->FournisseurID)
                 ==  $fournisseur->FournisseurID ? 'selected' : '' }}>{{$fournisseur->NomFournisseur}}</option>
                    @endforeach
            </select>
        </diV>


            <diV>
           
            <label for ="Statut Commande">Statut Commande</label>  
            <select id="Statut Commande" name="Statut_ID">
                    @foreach($statuts as $statut)
                <option value= "{{ $statut->Statut_ID}}" 
                {{ old('Statut_ID', $commandeAchat->Statut_ID)
                 ==  $statut->Statut_ID ? 'selected' : '' }}>{{$statut->Statut}}</option>
                    @endforeach
            </select>
        </diV>




       

       

      

  

        <div>
            <button type="submit"> Enregistrer</button>
        </div>
    </form>
</body>
</html>