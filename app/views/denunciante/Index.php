<div class="base-home">
	<div class="titulo-pagina">Cadastro de Denunciantes</div>
</div>

<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($denunciante) ?></b> denunciante(s) cadastrado(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denunciante/novo" ?>" >INCLUIR </a></div>
	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			   <tr>
				<th width="10%" align="left">codigo</th>
				<th width="30%" align="left">denunciante</th>
				<th width="40%" align="left">observação</th>
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