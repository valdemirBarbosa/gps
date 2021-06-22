<div class="base-home">
	<h1 class="titulo">Lista de ocorrencias/andamentos</h1>
</div>

<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($ocorrencia) ?></b> ocorrencias</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "Ocorrencia/Novo" ?>" >INCLUIR </a></div>

	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
				<th align="center" width="10%">Id ocorrencia</th>
				<th align="center" width="25%">fase</th>
				<th align="center" width="15%">Numero do Processo</th>
				<th align="center" width="13%">Data ocorrência </th>
				<th align="center" width="25%">ocorrência </th>
				<th width="25%">Observação</th>
				<th width="5%">Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
	<?php 
	  foreach($ocorrencia as $oco){
	?>
			<tr>
				<td align="center"><?php echo $oco->id ?> </td>
				<td align="center"><?php echo $oco->fase ?> </td>
				<td align="center"><?php echo $oco->numero_processo ?> </td>
				<td><?php echo date('d/m/Y', strtotime($oco->data_ocorrencia)) ?> </td> 
				<td><?php echo $oco->ocorrencia ?> </td>
				<td><?php echo $oco->observacao  ?> </td>
				<td align="center"><?php echo $oco->anexo ?> </td>
			
				<td>
					<div class="btn-editar"> 
						<a href="<?php echo URL_BASE ."Ocorrencia/Edit/".$oco->id ?>" class="btn">Editar</a>
	  				</div>
				</td>
				<td>
					<div class="btn-excluir"> 
						<a href="<?php echo URL_BASE ."Ocorrencia/Excluir/".$oco->id ?>" class="btn">Excluir</a>
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