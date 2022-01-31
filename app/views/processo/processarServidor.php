	<div class="base-home">
		<h1 class="titulo-pagina">Processar servidor</h1>
	</div>
	<?php
			if(isset($_SESSION['id_processo']) == false){
				session_start(); 
			}
	?>

<div class="div1">
<form action="<?php echo URL_BASE ."Processo/Salvar" ?>" method="POST">
	<?php
		if(isset($processo)){
		foreach($processo as $pd){ 
			}  
			?>
			<fieldset>
			<legend><h4>Códigos</h4></legend>	
				<label>Id do Processo</label>
					<input id="txt_id" readonly name="txt_id_processo" enable="false" value="<?php echo $pd->id_processo ?>" >
				<label>Id da denuncia</label>
				<input readonly name="txt_id_denuncia" type="number" enable="false" value="<?php echo $pd->id_denuncia ?>" >

				<label>fase</label>
					<select name="txt_id_fase">
						<option value="<?php if(isset($pd->id_fase)){ echo $pd->id_fase; } ?>"><?php if(isset($pd->id_fase)){ echo $pd->fase; } ?></option>
	<?php } 
						
		if(isset($fase)){
			foreach($fase as $f){ ?>
							<option readonly value="<?php echo $f->id_fase ?>"><?php echo $f->fase ?> </option>
	<?php }
		} ?>
					</select>

					<label>Número do Processo</label>
				<input class="txt_numero_processo" name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php echo $pd->numero_processo ?>">
		</fieldset>		

		<fieldset>
		<legend>informações do processo</legend>
				
			<label>Data de Instauração</label>
				<input name="txt_data_instauracao" type="date" value="<?php echo $pd->data_instauracao ?>">
				<input class="" name="observacao" type="text" placeholder="Insira o número do processo" value="<?php echo $pd->observacao ?>">
		
				<label>Data de Encerramento</label>
					<input name="txt_data_encerramento" type="date" readonly value="<?php echo $pd->data_encerramento ?>">
			<input type="hidden" name="id_processo" value="<?php echo $pd->id_processo ?>">
		</fieldset>
	</form>
</div> <!-- fim da div 1 -->

<div class="div2">
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
				<form method="POST" action="<?php echo URL_BASE . 'Processar/porParametro' ?>" >
						<label>Campo de pesquisa</label>
							<select name="pesquisa">
								<option value="3">Nome</option>
									<option value="4">CPF</option>
							</select>
							<input type="text" autofocus name="valorPreenchidoUsuario" class="pesquisa">
							<input type="hidden" name="campo" value="<?php echo $campo ?>">
							<input type="hidden" name="view" value="<?php echo $view ?>">
							<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
							<input type="hidden" name="tabela" value="<?php echo 'servidor' ?>">
							<input type="submit" value="pesquisar">
	</fieldset>	
	</form>
</div>

</div> <!-- fim da div 2 -->

<div class="div3">

	<form method="POST" action="<?php echo URL_BASE . 'Processar/incluir' ?>" >
			<table class="tabServidor">
			<?php
				if(isset($processando)){ ?>
				<tr>
					<th width="5%" align="center">Id_servidor</th>
					<th width="25%" align="center">Nome do servidor</th>
					<th width="5%" align="center">Cpf</th>
					<th width="5%" align="center">Matricula</th>
					<th width="10%" align="center">Ação</th>
				</tr>
				<?php
					foreach($processando as $servidor){ ?>  
				<tr>

					<td align="center"><?php echo $servidor->id_servidor  ?></td>
					<?php $_SESSION['id_servidor'] = $servidor->id_servidor ?>
					<td><?php echo $servidor->nome_servidor;  ?></td>
					<td align="center"><?php echo $servidor->cpf;  ?></td>
					<td><?php echo $servidor->matricula;  ?></td>
					<td>
		<div class="">
	 		<input type="submit" value="Incluir" >
			 <a href="<?php echo URL_BASE ."processo/RetProcessar/" ?>" >Fechar</a>
		</td>
		</tr>
		</div>

		<?php 
		}
		} ?>

			</table>
		</form>
	</div> <!-- fim da div 3 -->

<div class="div4">
<?php
		  if(isset($processado)){	 ?>

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
 <?php }
 }
  ?>									  
		  </tbody>
	</table>

</div> <!-- fim da div 4 -->