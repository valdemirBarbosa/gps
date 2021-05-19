<div="base-home">
	<h1 class="titulo"><span class="cor">Lista de</span> denunciantes</h1>
<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($denunciante) ?></b> denunciante(s) cadastrado(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denunciante/novo" ?>" >INCLUIR </a></div>
	<div class="tabela">	
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <thead>
			   <tr>
				<th width="5%" align="left">codigo</th>
				<th width="22%" align="left">denunciante</th>
				<th width="10%" align="left">observação</th>
				<th width="10%" colspan="2" align="center">Ação</th>
			  </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($denunciante as $dnc){   ?>
				<tr class="cor1">
				<td align="center"><?php echo $dnc->id_denunciante  ?></td>
				<td><?php echo $dnc->nome_denunciante  ?></td>
				<td><?php echo $dnc->observacao  ?></td>

				<td align="center">
				<a href="<?php echo URL_BASE ."denunciante/Editar/".$dnc->id_denunciante ?>" class="btn">Editar</a>
				</td>
				<td align="center">
					<a href="<?php echo URL_BASE."denunciante/Excluir/".$dnc->id_denunciante ?>" class="btn excluir">Excluir</a>
				</td>
			 </tr>	
			 <?php } ?>									  

		  </tbody>
		</table>
</div>					
</div>
</div>

</body>
</html>