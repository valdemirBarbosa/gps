<div="base-home">
	<h1 class="titulo"><span class="cor">Lista de</span> Processo Preliminar</h1>
<div class="base-home">
<!-- 
	<script type="text/javascript" src="<?php //echo URL_BASE.'assets\js\script.js' ?>"> </script> 
!-->
	<span class="qtde">Há <b><?php echo count($pad) ?></b> processo preliminares e sindicâncias</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "Pad/Novo" ?>" >INCLUIR </a></div>

<!-- Incluindo um formulário de pesquisa de denuncia !-->
	<form class="form-pesquisa" method="post" action="<?php echo URL_BASE ."Pad/Pesquisar/"?>">
	   <table>
		<tr>
		   <td width="10%">
			<label>Pesquisar por ID</label>
			<input name="id_denuncia" type="number">
               </td>
		 
		   <td width="20%">
			<label>Pesquisar por numero do processo</label>
			<input name="numero_processo" type="text">
               </td>

		   <td width="20%">
			<label>Pesquisar por denunciante</label>
			<input name="nome_denunciante" type="text">
               </td>
	     </tr>

		  <tr><td colspan="5"> 
		  		<input type="submit" value="Pesquisar" class="btn-dark">
			</td>
		  </tr>
        </table>
      </form>

	
	<div>	

		<table class="table-responsive-lg">
			<tr>
				<th width="5%">Id_pad</th>
				<th width="30%">Id_denuncia</th>
				<th width="30%">id_pp_sindicancia</th>
				<th width="15%">Numero do Processo</td>
				<th width="10%">Data Instauração </th>
				<th width="25%">Observação</th>
				<th width="25%">Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
	<?php 
	  foreach($pad as $pd){
	?>
			<tr>
				<td><?php echo $pd->id_pad ?> </td>
				<td><?php echo $pd->id_denuncia ?> </td>
				<td><?php echo $pd->id_pp_sindicancia  ?> </td>
				<td><?php echo $pd->numero_processo ?> </td>
				<td><?php echo date('d/m/Y', strtotime($pd->data_instauracao)) ?> </td> 
				<td><?php echo $pd->observacao  ?> </td>
				<td><?php echo $pd->anexo ?> </td>
			
				<td> 
					<a href="<?php echo URL_BASE ."Pad/Edit/".$pd->id_pad ?>" class="btn">Editar</a>

				</td>
			
				<td> 
					<a href="<?php echo URL_BASE ."Pad/Excluir/".$pd->id_pad ?>" class="btn">Excluir</a>

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