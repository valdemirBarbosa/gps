<?php
	if(!isset($_SESSION)){
		session_start();
	}
?>
<div class="base-home">
			<h1 class="titulo"><span class="cor">Novo</span> cadastro</h1>
		<div>	
		
				<table>
					<tr>
						<th>id</th>
						<th>Número do documento</th>
						<th>tipo documento</th>
						<th>Narração da denúncia</th>
						<th>Data de entrada</th>
					</tr>

					<?php 
					if(isset($denuncia)){
					 foreach($denuncia as $d){

						?>
					<tr>
						<td size="5%"><?php echo $d->id_denuncia ?> </td>
						<?php $_SESSION['id_denuncia'] = isset($d->id_denuncia) ? $d->id_denuncia : 0 ?>
						<td size="5%"><?php echo $d->numero_documento ?> </td>
						<td size="5%"><?php echo $d->tipo_documento ?> </td>
						<td size="55%"><?php echo $d->denuncia_fato ?> </td>
						<td size="5%"><?php echo $d->data_entrada ?> </td>
					</tr>
					 </table>

					<table> 
					<tr>
						<th>denunciados</th>
						<th>denunciante</th>
						<th>observacao</th>
					</tr>
						<td><?php echo $d->denunciados ?> </td>
						<td><?php echo $d->id_denunciante ?> </td>
						<td><?php echo $d->observacao ?> </td>
					<tr>

					</tr>
					<?php } ?>
				</table>	
			<?php } ?>
	

	<div class="DenunciadoServidorFormulario">
	<!-- CONSULTA SERVIDOR PARA INCLUSÃO !-->
	<?php //paramentros para pesquisa dos formulários de denuncia e processo
 			$tabela = 'servidor';
			$campo = 'nome_servidor';
			$_SESSION['view'] = 'processo/processarServidor';
			$retorno = 'processo';
 	?>

	<fieldset>
		<legend>Consulta servidor para inclusão na denuncia</legend>
				<form class="consulta" method="POST" action="<?php echo URL_BASE . 'Denunciar/ConsultaServidor' ?>" >
						<label>Campo de pesquisa</label>
							<select name="pesquisa">
								<option value="3">Nome</option>
									<option value="4">CPF</option>
							</select>
							<input type="text" autofocus name="valorPreenchidoUsuario" required class="pesquisa">
							<input type="hidden" name="campo" value="<?php echo $campo ?>">
							<input type="hidden" name="view" value="<?php echo $view ?>">
							<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
							<input type="hidden" name="tabela" value="<?php echo 'servidor' ?>">
							<input type="submit" value="pesquisar">
	</fieldset>	
	</form>
</div> <!-- "DenunciadoServidorFormulario -->
</div> <!-- fim da div home -->

<div class="div3">
	<form method="POST" action="<?php echo URL_BASE . 'Denunciados/incluir' ?>" >
				<table class="tabServidor">
				<?php
					if(isset($servidor)){ ?>
					<tr>
						<th width="5%" align="center">Id_servidor</th>
						<th width="25%" align="center">Nome do servidor</th>
						<th width="5%" align="center">Cpf</th>
						<th width="5%" align="center">Matricula</th>
						<th width="10%" align="center">Ação</th>
					</tr>
					<?php
						foreach($servidor as $servidor){ ?>  
					<tr>

						<td align="center"><?php echo $servidor->id_servidor  ?></td>
						<?php $_SESSION['id_servidor'] = $servidor->id_servidor ?>
						<td><?php echo $servidor->nome_servidor;  ?></td>
						<td align="center"><?php echo $servidor->cpf;  ?></td>
						<td><?php echo $servidor->matricula;  ?></td>
						<td>
			<div class="">

			<!-- 	 		<input type="submit" value="Incluir" >
	-->			 <a href="<?php echo URL_BASE ."Denunciar/incluir/?id_servidor=".$servidor->id_servidor?>" >Incluir</a>
				<a href="<?php echo URL_BASE ."Denunciado/Novo/".$_SESSION['id_denuncia'] ?>" >Fechar</a>
			</td>
			</tr>
			</div>

			<?php 
			}
			} ?>

				</table>
		</form>
	</div> <!-- fim da div 3 -->

<div class="c">
<?php
		  if(isset($denunciado)){	 ?>

	<table border="1">
		<thead>
			<tr>
				<th width="5%" align="center">Id</th>
				<th width="5%" align="center">Id serv</th>
				<th width="25%" align="left">Nome do servidor</th>
				<th width="5%" align="center">Cpf</th>
				<th width="5%" align="center">Matricula</th>
				<th width="10%" align="left">Vinculo</th>
				<th width="15%" align="left">Secretaria</th>
				<th width="15%" align="left">Unidade</th>
				<th width="10%" colspan="5" align="center">Ação</th>
			  </tr>
		  </thead>

		  <tbody>
  <?php
		   foreach($denunciado as $servidor){   
			 $_SESSION['id_denunciado'] = $servidor->id_denunciado; 
			?>

			<tr class="cor1">
				<td align="center"><?php echo $servidor->id_denunciado  ?></td>
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
						<a href="<?php echo URL_BASE ."processar/DelProcessado/".$servidor->id_processado ?>" >excluir</a>
					</div>
				</td>


			<!-- botões de inclusão dos denunciados em uma das fases do processo  -->
				<td>
					<div class="btn-editar"> 
						<a href="<?php echo URL_BASE ."processo/novo/?f=1&id=".$d->id_denuncia?>">Preliminar</a>
					</div>	
				</td>

				<td>
					<div class="btn-editar"> 
						<a href="<?php echo URL_BASE ."processo/novo/?f=2&id=".$d->id_denuncia ?>" >Sindicância</a>
					</div>	
				</td>

				<td>
					<div class="btn-editar"> 
						<a href="<?php echo URL_BASE ."processo/novo/?f=3&id=".$d->id_denuncia ?>" >PAD</a>
					</div>	
				</td>

			</tr>	
 <?php }
 }
  ?>									  
		  </tbody>
	</table>

<div class="paginacao">
				<?php
					if(isset($totalPaginas)){

						if(isset($processo)){
							foreach($processo as $pd){ 
								}  
							for($q=1; $q<=$totalPaginas; $q++):  
								echo "<a href=".URL_BASE."processo/Processar/".$pd->id_processo."?p=".$q.">". $q ?> </a> 
	<!-- 							echo "<a href=".URL_BASE."processo/Processar/?p=".$q."&?id=".$pd->id_processo.">". $q ?> </a> 
	-->				<?php

						endfor;
					}
				}

				?>
	</div>
	</div> <!-- fim da div 4 -->


	<!-- 		<form action="<?php echo URL_BASE ."denunciado/Salvar" ?>" method="POST">
				<label>id_denuncia</label>
					<input name="txt_id_denuncia" type="number" 
					value="<?php echo "$denuncia->id_denuncia" ?>">
	
				<label>nome</label>
					<input name="txt_nome" required autofocus  type="text" 	placeholder="Insira o nome do denunciado">

				<label>cpf</label>
					<input name="txt_cpf" required type="text" placeholder="Insira o cpf">

				<div class="col">
					<label>matricula</label>
					<input name="txt_matricula" value="" type="number" placeholder="Insira a matrícula">
				</div>	
				
				<div class="col">
					<label>vinculo</label>
					<input name="txt_vinculo" value="" type="text" placeholder="Vínculo empregatício">
				</div>

				<div class="col">
					<label>secretaria</label>
					<input name="txt_secretaria" value="" type="text" placeholder="secretaria">
				</div>	
				
				<div class="col">
					<label>unidade</label>
					<input name="txt_unidade" value="" type="text" placeholder="Insira a unidade de lotação">
				</div>
				
				<input type="hidden" name="acao" value="Cadastrar">
				<input type="hidden" name="id" value="">
				<input type="submit" value="Cadastrar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
			</form>
 -->		</div>	
</div>	
	