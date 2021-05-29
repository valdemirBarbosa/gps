<div="base-home">
	<h1 class="titulo"><span class="cor">Lista de</span> servidores</h1>
<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($servidores) ?></b> servidor(es) cadastrado(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "servidor/novo" ?>" >INCLUIR </a></div>

	<div class="minhaTabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			   <tr>
				<th width="5%" align="center">Id_servidor</th>
				<th width="25%" align="left">Nome do servidor</th>
				<th width="5%" align="center">Cpf</th>
				<th width="5%" align="center">Matricula</th>
				<th width="10%" align="left">Vinculo</th>
				<th width="15%" align="left">Secretaria</th>
				<th width="15%" align="left">Unidade</th>
				<th align="left">Observação</th>
				<th width="10%" colspan="2" align="center">Ação</th>
			  </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($servidores as $servidor){   ?>
				<tr class="cor1">
				<td align="center"><?php echo $servidor->id_servidor  ?></td>
				<td align="center"><?php echo $servidor->nome_servidor  ?></td>
				<td align="center"><?php echo $servidor->cpf  ?></td>
				<td><?php echo $servidor->matricula  ?></td>
				<td><?php echo $servidor->vinculo  ?></td>
				<td><?php echo $servidor->secretaria  ?></td>
				<td><?php echo $servidor->unidade  ?></td>	
				<td><?php echo $servidor->observacao  ?></td>	
				<td align="center">
					<a href="<?php echo URL_BASE ."servidor/Editar/".$servidor->id_servidor ?>" class="btn">Editar</a>
				</td>
				<td align="center">
					<a href="<?php echo URL_BASE ."servidor/Excluir/".$servidor->id_servidor ?>" class="btn excluir">excluir</a>
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