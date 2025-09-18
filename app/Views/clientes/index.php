
<?php if ( count($clientes) == 0): ?>
<h1>NO HAY CLIENTES </h1>
<?php else: ?>

<h1> clientes </h1>
<table class="tabla">
<tr>
	<th>Rut</th>
	<th>Nombre</th>
	<th>Apellido</th>
	<th>Email</th>
	<th>Localidad</th>
	<th>Numero_Puerta</th>
        <th>Calle</th>
        <th>Telefonos</th>
        <th>Preferencias</th>
</tr>
<?php foreach( $clientes as $indice => $valor): ?>
<tr>
	<td><?= $valor["rutCliente"]?></td>
	<td><?= $valor["nombre"]?></td>
	<td><?= $valor["apellido"]?></td>
	<td><?= $valor["email"]?></td>
	<td><?= $valor["localidad"]?></td>
	<td><?= $valor["numero_puerta"]?></td>
        <td><?= $valor["calle"]?></td>
        <td><?= $valor["numeroTelefonico"]?></td>
        <td><?= $valor["preferencia"]?></td>
</tr>

<?php endforeach?>
</table>
<?php endif ?>

</p>


