<div class="base-home">
	<h1 class="titulo-pagina">Lista de servidores</h1>
</div>

<?php //paramentros para pesquisa dos formulários de denuncia e processo
 		$tabela = 'servidor';
 		$view = 'servidor/Index';
		$retorno = 'servidorRet';
?>

<div class="frmConsulta">  
	<form method="GET" action="<?php echo URL_BASE . 'Pesquisa/porParametro'; ?>" >
		<table>
			<tr>
				<td>
					<label>Pesquisa</label>
						<select name="pesquisa" class="select">
<!-- 								<option value="1">Número do documento</option>
								<option value="2">Número do Processo</option>
 -->								<option value="3">Nome</option>
								<option value="4">CPF</option>
						</select>
				</td>
				<td>
						<input type="text" autofocus name="valorPreenchidoUsuario">
						<input type="hidden" name="view" value="<?php echo $view ?>">
						<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
						<input type="hidden" name="tabela" value="<?php echo $tabela ?>">
						<input type="submit" value="pesquisar">
				</td>
			</tr>
			</table>

			</form>
		</div>

<div class="base-lista">
<!-- 	<span class="qtde">Há <b><?php echo count($dados) ?></b> servidor(es) cadastrado(s)</span>
 -->	<div class="btn-inc"><a href="<?php echo URL_BASE . "servidor/novo" ?>" >INCLUIR </a></div>

	<div class="tabela">	
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
		  	<?php foreach($dados as $servidor){   ?>
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
					<div class="btn-editar">
						<a href="<?php echo URL_BASE ."servidor/Editar/".$servidor->id_servidor ?>" >Editar</a>
					</div>
				</td>
				<td align="center">
					<div class="btn-excluir">
						<a href="<?php echo URL_BASE ."servidor/Excluir/".$servidor->id_servidor ?>" >excluir</a>
					</div>
				</td>
			 </tr>	
			 <?php } ?>									  

		  </tbody>
		</table>
</div>
</body>
</html>