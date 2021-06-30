<div class="base-home">
	<h1 class="titulo-pagina">Lista de Portarias</h1>
</div>

<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($portaria) ?></b> Portarias</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "Portaria/Novo" ?>" >INCLUIR </a></div>

	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead class="thead">
				<th width="10%">id_portaria</th>
				<th width="10%">id_fase</th>
				<th width="10%">numero processo</th>
				<th width="15%">tipo</td>
				<th width="15%">data elaboracao </th>
				<th width="25%">data publicacao</th>
				<th width="25%">veiculo</th>
				<th width="25%">prazo</th>
				<th width="25%">data realizada</th>
				<th width="25%">observacao</th>
				<th width="5%">Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
		</thead>
	<?php 
	  foreach($portaria as $port){
	?>
			<tr>
				<td><?php echo $port->id_portaria ?></td>
				<td><?php echo $port->id_fase ?></td>
				<td><?php echo $port->numero_processo ?></td>
				<td><?php echo $port->tipo ?></td>
				<td><input class="data" type="date" readonly value="<?php  echo $port->data_elaboracao  ?>" ></td>
				<td><input class="data" type="date" readonly value="<?php echo $port->data_publicacao  ?>"> </td>
				<td><?php echo $port->veiculo ?></td>
				<td><?php echo $port->prazo ?></td>
				<td><input class="data" type="date" readonly value="<?php echo $port->data_realizada ?>"> </td>
				<td><?php echo $port->observacao ?></td>
				<td><?php echo $port->anexo ?></td>
			<td>
				<div class="btn-editar"> 
					<a href="<?php echo URL_BASE ."Portaria/Edit/".$port->id_portaria ?>" >Editar</a>
	  			</div>
				</td>
			
				<td> 
				<div class="btn-excluir">
					<a href="<?php echo URL_BASE ."Portaria/Excluir/".$port->id_portaria ?>" >Excluir</a>
	  			</div>

				</td>
			</tr> 
	<?php } ?>

			<hr/><hr/>
		</table>
	</div>				
		<p>...</P>
</div>

</body>
</html>