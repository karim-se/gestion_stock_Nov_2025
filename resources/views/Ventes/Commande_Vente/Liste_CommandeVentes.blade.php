<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<style>
    table,td, th{
          border: 1px solid black;
    }

    a{
       margin-bottom: 20px;
    }
</style>

<a href="{{ route("ventes.create_commande") }}"
style="display:inline-block; padding:8px 15px; background-color:#006400; color:white; border:none; border-radius:6px; text-decoration:none;">
    
Ajouter Commande Vente</a>

<table>
     <tr>
       
        <th>Nom Client</th>
        <th>Statut Commande</th>
        <th>Date Commande</th>
        <th>Voir Detailles</th>
        <th>Modifier Commande</th>
        <th>Supprimer Vente</th>
     </tr>

     
   
@foreach ($commandesventes as $commandevente )
    <tr>
        
          <td>{{ $commandevente->client->NomClient}}</td>
          <td>{{ $commandevente->statut_commande->Statut}}</td>
          <td>{{ $commandevente->DateCommande }}</td>
          <td><a href="{{ route("ventes.liste_ventes", $commandevente->	CommandeVenteID ) }}">Voir Detailles</a></td>
          <td><a href="{{ route("ventes.edit_commande", $commandevente->	CommandeVenteID) }}">Modifier Vente</a></td>
          <td> <a href="{{ route('ventes.supprimer_commande', $commandevente->	CommandeVenteID ) }}" class="button">Supprimer Vente</a> </td>

  </tr>
@endforeach
     
    

</table>
    
</body>
</html>