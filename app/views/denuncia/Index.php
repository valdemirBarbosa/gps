<?php
	if(!isset($_SESSION)){
	session_start();
	}
?>
<div class="base-home">
	<h1 class="titulo-pagina">Lista de denúncias</h1>
</div> <!-- FIM base-home -->


<?php //paramentros para pesquisa dos formulários de denuncia e processo
 		$tabela = 'denuncia';
 		$view = 'denuncia/index';
//		$retorno = 'denunciaRet';
?>

<div class="pai">
	<div class="filho1">
		<form method="POST" action="<?php echo URL_BASE . 'Pesquisa/ConsultaDenuncia'; ?>" >
		<input type="hidden" name="view" value="<?php echo $view ?>">
		<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
		<input type="hidden" name="tabela" value='<?php echo $tabela ?>'>

		<label>Pesquisa</label> 
			<select name="pesquisa">
				<option value="1">Número do documento</option>
				<option value="2">Número do Processo</option>
				<option value="3">Nome</option>
				<option hidden value="4">CPF</option> <!-- Ocultado pois na tabela denuncia não há cpf -->
			</select>

			<input type="text" autofocus name="valorPreenchidoUsuario"> 
			<input type="submit" value="pesquisar">
		</div>

		<div class="filho2">
			<a href="<?php echo URL_BASE . "denuncia/Novo" ?>" class="btn-inc">Incluir </a>
		</div>
	</form>
	</div> <!-- FIM DA DIV pai -->


<div class="base-lista">
		<table border="1" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
				<th align="center"> id</th>
				<th>Número documento</th>
				<th width="10%">Tipo documento</th>
				<th width="10%">Denunciante</th>
				<th width="30%">Narração da denúncia</th>
				<th width="7%">Data de entrada</th>
				<th width="30%">Denunciados</th>
				<th width="30%">Documentos anexados</th>
				<th width="30%">observação</th>
				<th width="10%" align="center" colspan="2">Nesta denúncia</th>
				<th width="10%" align="center" colspan="3">Incluir Processo</th>
			</tr>
	<?php
	if(isset($dados)){ 
	foreach($dados as $den){
	?>
		<tr>
		   <td align="center"><?php echo $den->id_denuncia  ?> </td>
		   <td align="center"><?php echo $den->numero_documento  ?></td> 
		   <td align="center"><?php echo $den->tipo_de_documento ?> </td>
		   <td align="center"><?php echo $den->nome_denunciante ?> </td>
		   <td><?php echo $den->denuncia_fato  ?> </td>
	<?php $dt_entrada = explode("-",$den->data_entrada);
	   $dia = $dt_entrada[2];
	   $mes = $dt_entrada[1];
	   $ano = $dt_entrada[0];
	?>
	         <td align="center"><?php echo $dia."/".$mes."/".$ano  ?> </td> 
		
			 <td><?php echo $den->denunciados ?> </td>
	
			 <td><?php echo $den->documentos_anexados ?> </td>

			 <td><?php echo $den->observacao ?> </td>
	
			 <td>
			<div class="btn-editar"> 
				<a href="<?php echo URL_BASE ."denuncia/Edit/".$den->id_denuncia ?>" >Editar</a>
	  	      </div>	
               </td>

			   <td>
			<div class="btn-excluir"> 
				<a href="<?php echo URL_BASE ."denuncia/Excluir/".$den->id_denuncia ?>" >Excluir</a>
				</div>
			</td>

			<td>
			<div class="btn-editar"> 
				<a href="<?php echo URL_BASE ."processo/novo/?f=1&id=".$den->id_denuncia ?>" >Preliminar</a>
	  	      </div>	
               </td>

			   <td>
			<div class="btn-editar"> 
				<a href="<?php echo URL_BASE ."processo/novo/?f=2&id=".$den->id_denuncia ?>" >Sindicância</a>
	  	      </div>	
               </td>

			   <td>
			<div class="btn-editar"> 
				<a href="<?php echo URL_BASE ."processo/novo/?f=3&id=".$den->id_denuncia ?>" >PAD</a>
	  	      </div>	
               </td>


		   </tr>
	<?php }
	} ?>
	</div> <!-- FIM DA DIV base-lista !-->
	</div> <!-- FIM DA DIV container-conteudo -->
	</table>
	<div class="paginacao">
				<?php
					if(isset($totalPaginas)){

						for($q=1; $q<=$totalPaginas; $q++):  
							echo "<a href=".URL_BASE.'Pesquisa/ConsultaDenuncia/?p='.($q); ?> > <?php echo "[".($q)."]" ?> </a> 
				<?php

						endfor;
					}

				?>
	</div>
