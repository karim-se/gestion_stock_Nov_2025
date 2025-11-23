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


<div style="display: flex; justify-content: flex-end; position: relative; top: 50px;">
  <a href="{{ route('ventes.create_detail', [$commandeventes->CommandeVenteID]) }}"
     style="padding:8px 15px; background-color:#006400; color:white; border:none; border-radius:6px; text-decoration:none; margin-right: 400px;">
    Ajouter un article à cette commande
  </a>
</div>


<p><strong>Nom Client :</strong>{{ $commandeventes->client->NomClient }}</p>
<p><strong>Statut Commande :</strong>{{ $commandeventes->statut_commande->Statut }}</p>

<table>
     <tr>
        <th>Nom Article</th>
        <th>Prix Vente</th>
        <th>Quantite</th>
        <th>Modifier Commande</th>
        <th>Supprimer Vente</th>
     </tr>

     
   
@foreach ($detailecommandesventes as $detailecommandevente )
    <tr>
          <td>{{ $detailecommandevente->article->NomArticle }}</td>
          <td>{{ $detailecommandevente->PrixUnitaire }}</td>
          <td>{{ $detailecommandevente->Quantite }}</td>
          <td><a href="{{ route("ventes.edit_detail", $detailecommandevente->		DetailVenteID ) }}">Modifier Vente</a></td>
          <td> <a href="{{ route('ventes.Supprimer_detail', [$detailecommandevente->CommandeVenteID, $detailecommandevente->	DetailVenteID] ) }}" class="button">Supprimer Vente</a> </td>

  </tr>
@endforeach
     
    

</table>
    
</body>
</html>