<div class="base-home">
	<h1 class="titulo-pagina">Lista de PAD</h1>
</div>

<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($pad) ?></b> PAD</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "Pad/Novo" ?>" >INCLUIR </a></div>

	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead class="thead">
				<th width="10%">Id_pad</th>
				<th width="10%">Id_denuncia</th>
				<th width="10%">id_pp_sindicancia</th>
				<th width="15%">Numero do Processo</td>
				<th width="15%">Data Instauração </th>
				<th width="25%">Observação</th>
				<th width="5%">Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
		</thead>
	<?php 
	  foreach($pad as $pd){
	?>
			<tr>
				<td align="center"><?php echo $pd->id_pad ?> </td>
				<td align="center"><?php echo $pd->id_denuncia ?> </td>
				<td align="center"><?php echo $pd->id_pp_sindicancia  ?> </td>
				<td align="center"><?php echo $pd->numero_processo ?> </td>
				<td align="center"><?php echo date('d/m/Y', strtotime($pd->data_instauracao)) ?> </td> 
				<td><?php echo $pd->observacao  ?> </td>
				<td align="center"><?php echo $pd->anexo ?> </td>
			
				<td>
				<div class="btn-editar"> 
					<a href="<?php echo URL_BASE ."Pad/Edit/".$pd->id_pad ?>" >Editar</a>
	  			</div>
				</td>
			
				<td> 
				<div class="btn-excluir">
					<a href="<?php echo URL_BASE ."Pad/Excluir/".$pd->id_pad ?>" >Excluir</a>
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