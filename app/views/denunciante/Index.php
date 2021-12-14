<?php
	if(!isset($_SESSION)){
	session_start();
	}

	$tabela = 'denunciante';
	$view = 'denunciante/index';
?>


<div class="base-home">
	<h1 class="titulo-pagina">Lista de Denunciantes</h1>
</div>

<div class="base-lista">
			<!--Botões !-->
     		<div class="btn-inc">
				<script> //Link para voltar à página anterior
					document.write('<a href="' + document.referrer + '">Voltar</a>');
				</script>
			</div>			
			
			<div class="btn-inc">
				<a href="<?php echo URL_BASE . "denunciante/novo" ?>" >INCLUIR </a>
			</div>

	 <div>	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			   <tr>
				<th width="5%" align="left">codigo</th>
				<th width="60%" align="left">denunciante</th>
				<th width="25%" align="left">observação</th>
				<th colspan="2" align="center">Ação</th>
			  </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($denunciante as $dnc){   ?>
				<tr class="cor1">
				<td align="center"><?php echo $dnc->id_denunciante  ?></td>
				<td><?php echo $dnc->nome_denunciante  ?></td>
				<td><?php echo $dnc->observacaoDenunciante  ?></td>

				<td align="center">
					<div class="btn-editar">
						<a href="<?php echo URL_BASE ."denunciante/Editar/".$dnc->id_denunciante ?>" >Editar</a>
					</div>
				</td>
				<td align="center"><div class="btn-excluir">
					<a href="<?php echo URL_BASE."denunciante/Excluir/".$dnc->id_denunciante ?>" >Excluir</a>
					</div></td>
			 </tr>	
			 <?php } ?>									  

		  </tbody>
		  
		</table>
</div>					
</div>
</body>
</html>