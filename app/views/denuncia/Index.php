<div="base-home">
	<h1 class="titulo"><span class="cor">Lista de</span> denuncia</h1>
<div class="base-home">
<!-- 
	<script type="text/javascript" src="<?php //echo URL_BASE.'assets\js\script.js' ?>"> </script> 
!-->
	<span class="qtde">Há <b><?php echo count($denuncia) ?></b> denuncia(s) cadastrada(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denuncia/Novo" ?>" >INCLUIR </a></div>

<!-- Incluindo um formulário de pesquisa de denuncia !-->
	<form class="form-pesquisa" method="post" action="<?php echo URL_BASE ."denuncia/Pesquisar/"?>">
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
				<th width="5%"> id</th>
				<th width="30%">fato da denúncia</th>
				<th width="15%">tipo documento</th>
				<th width="15%">número</td>
				<th width="10%">data de entrada</th>
				<th width="25%">observação</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
	<?php 
	  foreach($denuncia as $den){
	?>
			<tr>
				<td><?php echo $den->id_denuncia  ?> </td>
				<td><?php echo $den->denuncia_fato  ?> </td>
				<td><?php echo $den->tipo_documento  ?> </td>
				<td><?php echo $den->numero_documento  ?> </td>
				<td><?php echo date('d/m/Y', strtotime($den->data_entrada))  ?> </td> 
				<td><?php echo $den->observacao  ?> </td>
			
				<td> 
					<a href="<?php echo URL_BASE ."denuncia/Edit/".$den->id_denuncia ?>" class="btn">Editar</a>

				</td>
			
				<td> 
					<a href="<?php echo URL_BASE ."denuncia/Excluir/".$den->id_denuncia ?>" class="btn">Excluir</a>

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