<div class="base-home">
	<h1 class="titulo-pagina">Lista de Portarias</h1>
</div>
<script type="text/javascript" src="<?php URL_BASE . "/assets/js/funcoes.js" ?>"> </script>

<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($portaria) ?></b> Portarias</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "Portaria/Novo" ?>" >INCLUIR </a></div>

	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead class="thead">
				<th width="10%">Id Portaria</th>
				<th width="10%">Id Fase</th>
				<th width="10%">Número Processo</th>
				<th width="10%">Tipo</td>
				<th width="10%">Data Elaboração </th>
				<th width="10%">Data Publicação</th>
				<th width="25%">Veículo</th>
				<th width="25%">Prazo</th>
				<th width="10%">Data Vencimento</th>
				<th width="10%">Status</th>
				<th width="25%">Dias a vencer</th>
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
				<td id="prazo"><?php echo $port->prazo ?></td>
				<td><input id="dataFinal" class="data" type="date" readonly value="<?php echo $port->data_final ?>"> </td>
				<td><?php echo $port->status ?></td>
				<td><?php echo $port->dias_a_vencer ?></td>

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