<div="base-home">
	<h1 class="titulo"><span class="cor">Lista de</span> denuncia indexis</h1>
<div class="base-lista">
	<script type="text/javascript" src="<?php echo URL_BASE.'assets\js\script.js' ?>"> </script> 
	<span class="qtde">Há <b><?php echo count($denunciado) ?></b> denunciado(s) cadastrada(s) com denuncias</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denuncia/novo" ?>" >INCLUIR </a></div>

	<!-- TABELA FILHA	          !-->
		<table width="100%" border="3" cellspacing="0" cellpadding="0">

		<p>Tabela filha</p>
			 <tr>
				<th width="5%" align="left">+</th>
				<th width="5%" align="left">Cóodigo do denunciado</th>
				<th width="10%" align="left">Cóodigo da denuncia</th>
				<th width="10%" align="left">Código do servidor</th>
				<th width="10%" align="left">Matricula</th>
				<th width="25%" align="left">Nome do servidor</th>
				<th width="30%" align="left">Observação</th>
				<th width="20%" colspan="2" align="center">Ação</th>
			  </tr>

		  	<?php foreach($denunciado as $den){   ?>
				<tr class="cor1">
				<td align="center"><?php //  ?></td>
				<td align="center"><?php echo $den->id_denunciado  ?></td>
				<td align="center"><?php echo $den->id_denuncia  ?></td>
				<td align="center"><?php echo $den->id_servidor  ?></td>
				<td align="center"><?php echo $den->matricula  ?></td>
				<td align="center"><?php echo $den->nome_servidor  ?></td>
				<td align="center"><?php echo $den->observacao  ?></td>

				<td align="center">
					<a href="<?php echo URL_BASE ."denuncia/Edit/".$den->id_denunciado ?>" class="btn">Editar</a>
				</td>

				<td align="center">
					<a href="<?php echo URL_BASE ."denuncia/Excluir/".$den->id_denunciado ?>" class="btn excluir">excluir</a>
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