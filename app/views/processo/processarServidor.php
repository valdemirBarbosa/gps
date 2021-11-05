<div class="base-home">
	<h1 class="titulo-pagina">Alterar dados do Processo</h1>
</div>
 <?php 

if(session_start() == false){
	session_start();
}?>

 <div class="processarServidor">
<form action="<?php //echo URL_BASE ."Processo/Salvar" ?>" method="POST">
	<!--Botões !-->
	<div class="btn-inc">
		<script> //Link para voltar à página anterior
			document.write('<a href="' + document.referrer + '">Voltar</a>');
		</script>
	</div>	

		<input type="submit" value="Salvar" class="btn-inc">
<?php
	if(isset($processo)){
	   foreach($processo as $pd){ 
		 $processoFormulario = array($processo); }  
		   ?>
		<fieldset>
		<legend><h4>Códigos</h4></legend>	
			<label>Id do Processo</label>
				<input id="txt_id" readonly name="txt_id_processo" enable="false" value="<?php echo $pd->id_processo ?>" >
			<label>Id da denuncia</label>
			<input readonly name="txt_id_denuncia" enable="false" value="<?php echo $pd->id_denuncia ?>" >

			<label>fase</label>
				<select name="txt_id_fase">
					<option value="<?php if(isset($pd->id_fase)){ echo $pd->id_fase; } ?>"><?php if(isset($pd->id_fase)){ echo $pd->fase; } ?></option>
<?php } ?>					

<?php foreach($fase as $f){ ?>
						<option readonly value="<?php echo $f->id_fase ?>"><?php echo $f->fase ?> </option>
<?php } ?>
				</select>

				<label>Número do Processo</label>
			<input class="txt_numero_processo" name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php echo $pd->numero_processo ?>">

	</fieldset>		

	<table><tr><td colspan="5"><td></td> <td></td> <td></td> <td></td>
    <fieldset>
    <legend>informações do processo</legend>
			
		<label>Data de Instauração</label>
            <input name="txt_data_instauracao" type="date" value="<?php echo $pd->data_instauracao ?>">
			<input class="" name="observacao" type="text" placeholder="Insira o número do processo" value="<?php echo $pd->observacao ?>">
    
            <label>Data de Encerramento</label>
				<input name="txt_data_encerramento" type="date" readonly value="<?php echo $pd->data_encerramento ?>">
		<input type="hidden" name="id_processo" value="<?php echo $pd->id_processo ?>">


	</fieldset>

	</td></tr>
	</table>

</form>
<br/><br/>

<div class="processarServidorFormulario">
<!-- CONSULTA SERVIDOR PARA INCLUSÃO !-->
<?php //paramentros para pesquisa dos formulários de denuncia e processo
 		$tabela = 'servidor';
		$campo = 'nome_servidor';
 		$_SESSION['view'] = 'processo/processarServidor';
		$retorno = 'processo';
?>

<fieldset>
	<legend>Consulta servidor para inclusão no processo</legend>
<table class=""> 		
		<tr>
			<td>
			<form method="POST" action="<?php echo URL_BASE . 'Processar/porParametro' ?>" >
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
						<input type="text" autofocus name="valorPreenchidoUsuario">
						<input type="hidden" name="campo" value="<?php echo $campo ?>">
						<input type="hidden" name="view" value="<?php echo $view ?>">
						<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
						<input type="hidden" name="tabela" value="<?php echo $tabela ?>">
<!-- 						<input type="hidden" name="processoFormulario" value="<?php //echo $processoFormulario ?>">
 -->						<input type="submit" value="pesquisar">

				</td>
			</tr>
</table>

<form method="POST" action="<?php echo URL_BASE . 'Processar/incluir' ?>" >
<?php 
isset($processo);
foreach($processo as $p){
	$id_processo = $p->id_processo; 
}
?>

	<table>
		<tr>
			<th width="5%" align="center">Id_servidor</th>
			<th width="25%" align="left">Nome do servidor</th>
			<th width="5%" align="center">Cpf</th>
			<th width="5%" align="center">Matricula</th>
			<th width="10%" align="center">Ação</th>
		</tr>

		<tr>

<?php
		if(isset($processando)){
		 foreach($processando as $servidor){ ?>  
			<td align="center"><?php echo $servidor->id_servidor  ?></td>
			<td><?php echo $servidor->nome_servidor;  ?></td>
			<td align="center"><?php echo $servidor->cpf;  ?></td>
			<td><?php echo $servidor->matricula;  ?></td>
			<td>
				<div class="btn-editar">

<!-- passar o parametro id_processo para fazer o update na tabela do servidor processá-lo !-->				

<?php 
	$_SESSION['id_servidor'] =  $servidor->id_servidor;  
?>

	<input type="hidden" name="id_servidor" value="<?php echo $id_servidor ?>">
	<!-- <input type="hidden" name="id_processo" value="<?php //echo $id_processo ?>">
 -->
<input type="submit" value="Incluir servidor">
<!-- <a href="<?php //echo URL_BASE ."Processar/incluir/".$id_servidor&$id_processo; ?>" >Incluir servidor</a>
 -->		</div>
			</td>
		</tr>
<?php }} ?>
	</table>
</form>

	<div class="processarServidorTabela">
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
  <?php
		  if(isset($processado)){	 
		   foreach($processado as $servidor){   ?>
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
 <?php }}
  ?>									  
		  </tbody>
	</table>
</div>				
</div>
</div>
