<div class="base-home">
	<h1 class="titulo-pagina">Lista de ocorrências/andamentos</h1>
</div>

<div class="base-lista">
			<!--Botões !-->
     		<div class="btn-inc">
				<script> //Link para voltar à página anterior
					document.write('<a href="' + document.referrer + '">Voltar</a>');
				</script>
			</div>			
			
			<div class="btn-inc">
				<a href="<?php echo URL_BASE . "ocorrencia/novo" ?>" >INCLUIR </a>
			</div>
	<div>	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
				<th align="center" width="10%">Id ocorrencia</th>
				<th align="center" width="10%">Id processo</th>
				<th align="center" width="15%">Numero do Processo</th>
				<th align="center" width="13%">Data ocorrência </th>
				<th align="center" width="25%">ocorrência </th>
				<th width="5%">Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
	<?php 
	if(isset($procOcorr)){
	  foreach($procOcorr as $oco){
	?>
			<tr>
				<td align="center"><?php echo $oco->id_ocorrencia ?> </td>
				<td align="center"><?php echo $oco->id_processo ?> </td>
				<td align="center"><?php echo $oco->numero_processo ?> </td>
				<td><?php echo date('d/m/Y', strtotime($oco->data_ocorrencia)) ?> </td> 
				<td><?php echo $oco->ocorrencia ?> </td>
				<td align="center"><?php echo $oco->anexo ?> </td>
			
				<td>
					<div class="btn-editar"> 
						<a href="<?php echo URL_BASE ."Ocorrencia/Edit/".$oco->id_ocorrencia ?>">Editar</a>
	  				</div>
				</td>
				<td>
					<div class="btn-excluir"> 
						<a href="<?php echo URL_BASE ."Ocorrencia/Excluir/".$oco->id_ocorrencia ?>" >Excluir</a>
					  </div>
				</td>
			</tr> 
	<?php }
} ?>

			<hr/><hr/>
		</table>
	</div>				
		<p>...</P>
</div>					


</body>
</html>