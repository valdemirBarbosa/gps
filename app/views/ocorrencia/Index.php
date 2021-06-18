<div="base-home">
	<h1 class="titulo"><span class="cor">Lista de</span> ocorrencias/andamentos</h1>
<div class="base-home">
<!-- 
	<script type="text/javascript" src="<?php //echo URL_BASE.'assets\js\script.js' ?>"> </script> 
!-->
	<span class="qtde">Há <b><?php echo count($ocorrencia) ?></b> processo preliminares e sindicâncias</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "Ocorrencia/Novo" ?>" >INCLUIR </a></div>

	<div>	

		<table class="table-responsive-lg">
			<tr>
				<th align="center" width="10%">Id ocorrencia</th>
				<th align="center" width="10%">fase</th>
				<th align="center" width="25%">Numero do PRocesso</th>
				<th align="center" width="10%">Data ocorrência </th>
				<th align="center" width="30%">ocorrência </th>
				<th width="25%">Observação</th>
				<th width="5%">Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
	<?php 
	  foreach($ocorrencia as $oco){
	?>
			<tr>
				<td><?php echo $oco->id ?> </td>
				<td align="center"><?php echo $oco->fase ?> </td>
				<td><?php echo $oco->numero_processo ?> </td>
				<td><?php echo date('d/m/Y', strtotime($oco->data_ocorrencia)) ?> </td> 
				<td><?php echo $oco->ocorrencia ?> </td>
				<td><?php echo $oco->observacao  ?> </td>
				<td><?php echo $oco->anexo ?> </td>
			
				<td> 
					<a href="<?php echo URL_BASE ."Ocorrencia/Edit/".$oco->id ?>" class="btn">Editar</a>

				</td>
			
				<td> 
					<a href="<?php echo URL_BASE ."Ocorrencia/Excluir/".$oco->id ?>" class="btn">Excluir</a>

				</td>
			</tr> 
	<?php } ?>

			<hr/><hr/>
		</table>
	</div>				
		<p>...</P>
</div>					
</div>
</div>

</body>
</html>