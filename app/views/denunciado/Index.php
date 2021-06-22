<div class="base-home">
	<h1 class="titulo-pagina">Lista de denunciados</h1>
</div>
<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($denunciados) ?></b> denunciado(s) cadastrado(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denunciado/novo" ?>" >INCLUIR </a></div>

	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			   <tr>
				<th width="5%" align="center">Id_denunciado</th>
				<th width="5%" align="center">Id do servidor</th>
				<th width="25%" align="left">Nome do servidor</th>
				<th width="10%" align="left">Vinculo</th>
				<th width="15%" align="left">Secretaria</th>
				<th width="15%" align="left">Unidade</th>
				<th width="15%" align="left">Observacao</th>
				<th width="10%" colspan="2" align="center">Ação</th>
			  </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($denunciados as $denunciado){   ?>
				<tr class="cor1">
				<td align="center"><?php echo $denunciado->id_denunciado  ?></td>
				<td align="center"><?php echo $denunciado->id_servidor  ?></td>
				<td><?php echo $denunciado->nome_servidor  ?></td>
				<td><?php echo $denunciado->vinculo  ?></td>
				<td><?php echo $denunciado->secretaria  ?></td>
				<td><?php echo $denunciado->unidade  ?></td>	
				<td><?php echo $denunciado->observacao  ?></td>	
				<td align="center">
					<div class="btn-editar"
					<a href="<?php echo URL_BASE ."denunciado/Editar/".$denunciado->id_denunciado ?>" class="btn">Editar</a>
			  	</div>
				</td>
				<td align="center">
					<div class="btn-excluir">
					<a href="<?php echo URL_BASE ."denunciado/Excluir/".$denunciado->id_denunciado ?>" class="btn excluir">excluir</a>
			  	</dvi>	
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