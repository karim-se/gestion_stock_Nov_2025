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
    <form action ="{{ route('ventes.update_commande', $commandeventes->CommandeVenteID) }}" method="POST">
         @csrf
        <input type="hidden" asp-for="articleID" />

       
       
        

        <diV>
           
            <label for ="Nom Client">Nom Client</label>  
            <select id="Nom Client" name="ClientID">
                    @foreach($clients as $client)
                <option value= "{{ $client->ClientID }}" 
                {{ old('ClientID', $commandeventes->ClientID)
                 ==  $client->ClientID ? 'selected' : '' }}>{{$client->NomClient}}</option>
                    @endforeach
            </select>
        </diV>


            <diV>
           
            <label for ="Statut Commande">Statut Commande</label>  
            <select id="Statut Commande" name="Statut_ID">
                    @foreach($statuts as $statut)
                <option value= "{{ $statut->Statut_ID}}" 
                {{ old('Statut_ID', $commandeventes->Statut_ID)
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