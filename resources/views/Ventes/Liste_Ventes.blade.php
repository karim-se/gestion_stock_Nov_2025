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

<a href="Ajouter"
style="display:inline-block; padding:8px 15px; background-color:#006400; color:white; border:none; border-radius:6px; text-decoration:none;">
    
Ajouter Commande Vente</a>

<table>
     <tr>
        <th>Nom Article</th>
        <th>Prix Vente</th>
        <th>Quantite</th>
        <th>Nom Client</th>
        <th>Statut Commande</th>
        <th>Modifier Commande</th>
        <th>Supprimer Vente</th>
     </tr>

     
   
@foreach ($detailecommandesventes as $detailecommandevente )
    <tr>
          <td>{{ $detailecommandevente->article->NomArticle }}</td>
          <td>{{ $detailecommandevente->PrixUnitaire }}</td>
          <td>{{ $detailecommandevente->Quantite }}</td>
          <td>{{ $detailecommandevente->commandevente->client->NomClient}}</td>
          <td>{{ $detailecommandevente->commandevente->statut_commande->Statut}}</td>
          <td><a href="{{ route("ventes.edit", $detailecommandevente->	DetailVenteID) }}">Modifier Vente</a></td>
          <td> <a href="{{ route('ventes.Supprimer', $detailecommandevente->	DetailVenteID ) }}" class="button">Supprimer Vente</a> </td>

  </tr>
@endforeach
     
    

</table>
    
</body>
</html>