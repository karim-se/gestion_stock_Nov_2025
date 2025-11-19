<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<style>
table, td,th{
      border: 1px solid black;
}

table{
        margin-top: 20px;
        margin-left: 300px;
}

a{
        margin-bottom: 20px;
}

</style>

<a href="Ajouter"
style="display:inline-block; padding:8px 15px; background-color:#006400; color:white; border:none; border-radius:6px; text-decoration:none;">
Ajouter une Commande Achat</a>
    
<table>
     <tr>
         <th>Nom Fournisseur</th>
         <th> Etat Commande</th>
        <th>Date Commande</th>
        <th>Détailles</th>
        
     </tr>

     @foreach ($commandesachat as $commandeachat)
         
             
        <tr>
              <td>{{ $commandeachat->fournisseur->NomFournisseur}}</td>
              <td>{{ $commandeachat->statut_commande->Statut }}</td>
              <td>{{ $commandeachat->DateCommande }}</td>
           <td><a href ="{{ route("achats.liste_achats", $commandeachat->CommandeAchatID ) }}"> Voir Détailles</a></td>
           

        </tr>
     
     @endforeach
     

     

</table>

</body>
</html>