<div class="base-home">
	<h1 class="titulo-pagina">Alterar dados do Processo</h1>
</div>

<form action="<?php echo URL_BASE ."Processo/Salvar" ?>" method="POST">
	<!--Botões !-->
	<div class="btn-inc">
		<script> //Link para voltar à página anterior
			document.write('<a href="' + document.referrer + '">Voltar</a>');
		</script>
	</div>	

		<input type="submit" value="Salvar" class="btn-inc">

<?php foreach($processo as $pd){ ?>
	<fieldset>
		<legend><h4>Códigos</h4></legend>	
			<label>Id do Processo</label>
				<input id="txt_id" readonly name="txt_id_processo" enable="false" value="<?php echo $pd->id_processo ?>" >
			<label>Id da denuncia</label>
			<input readonly name="txt_id_denuncia" enable="false" value="<?php echo $pd->id_denuncia ?>" >

			<label>fase</label>
				<select name="txt_id_fase">
					<option value="<?php echo $pd->id_fase ?>"><?php echo $pd->fase ?></option>
<?php } ?>					

<?php foreach($fase as $f){ ?>
						<option readonly value="<?php echo $f->id_fase ?>"><?php echo $f->fase ?> </option>
<?php } ?>
				</select>
	</fieldset>		

	<fieldset>
	<legend>informações do processo</legend>
		<label>Número do Processo</label>
			<input class="txt_numero_processo" name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php echo $pd->numero_processo ?>">
			
		<label>Data de Instauração</label>
			<input name="txt_data_instauracao" type="date" value="<?php echo $pd->data_instauracao ?>">
			<input class="" name="observacao" type="text" placeholder="Insira o número do processo" value="<?php echo $pd->observacao ?>">
			<label>Data de Encerramento</label>
				<input name="txt_data_encerramento" type="date" readonly value="<?php echo $pd->data_encerramento ?>">
	</fieldset>
		<input type="hidden" name="id_processo" value="<?php echo $pd->id_processo ?>">	
		<br/><br/>
<!-- CONSULTA SERVIDOR PARA INCLUSÃO !-->
<?php //paramentros para pesquisa dos formulários de denuncia e processo
 		$tabela = 'servidor';
 		$view = 'processo/Editar';
		$retorno = 'processoRet';
?>

<fieldset>
	<legend>Consulta servidor para inclusão no processo</legend>
<table class="minhaTabela"> 		
		<tr>
			<td>
			<form method="GET" action="<?php echo URL_BASE . 'Pesquisa/porParametro'; ?>" >
		<table>
			<tr>
				<td>
					<label>Campo de pesquisa</label>
						<select name="pesquisa">
<!-- 							<option value="1">Número do documento</option>
								<option value="2">Número do Processo</option>
 -->							<option value="3">Nome</option>
								<option value="4">CPF</option>
						</select>
				</td>

				<td>
						<input type="submit" value="pesquisar">
						<input type="text" autofocus name="valorPreenchidoUsuario">
						<input type="hidden" name="view" value="<?php echo $view ?>">
						<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
						<input type="hidden" name="tabela" value="<?php echo $tabela ?>">
				</td>
			</tr>
	<table>
		<tr>
			<th width="5%" align="center">Id_servidor</th>
			<th width="25%" align="left">Nome do servidor</th>
			<th width="5%" align="center">Cpf</th>
			<th width="5%" align="center">Matricula</th>
		</tr>

		<tr>
		<?php foreach($dados as $servidor){   ?>
			<td align="center"><?php echo $servidor->id_servidor  ?></td>
			<td align="center"><?php echo $servidor->nome_servidor  ?></td>
			<td align="center"><?php echo $servidor->cpf  ?></td>
			<td><?php echo $servidor->matricula  ?></td>
		</tr>
<?php } ?>
	</table>
	
	<table>
		<thead>
			<tr>
				<th width="5%" align="center">Id_servidor</th>
				<th width="25%" align="left">Nome do servidor</th>
				<th width="5%" align="center">Cpf</th>
				<th width="5%" align="center">Matricula</th>
				<th width="10%" align="left">Vinculo</th>
				<th width="15%" align="left">Secretaria</th>
				<th width="15%" align="left">Unidade</th>
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
</form>
