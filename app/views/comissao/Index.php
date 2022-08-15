<?php
	if(!isset($_SESSION)){
	session_start();
	}

?>
<div class="base-home">
	<h1 class="titulo-pagina">Comissão de Sindicância</h1>
</div> <!-- FIM base-home -->


<div class="pai">
	<div class="filho1">
		<form method="POST" action="<?php echo URL_BASE . 'Comissao/consulta'; ?>" >
		<input type="hidden" name="view" value="<?php echo $view ?>">
		<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
		<input type="hidden" name="tabela" value='<?php echo $tabela ?>'>

		<label>Pesquisa</label> 
			<select name="pesquisa">
				<option value="1">Nome</option>
				<option hidden value="2">CPF</option>
				<option value="3">Número portaria</option>
			</select>

			<input type="text" autofocus name="valorPreenchidoUsuario"> 
			<input type="submit" value="pesquisar">
		</div>

		<div class="filho2">
			<a href="<?php echo URL_BASE . "comissao/Novo" ?>" class="btn-inc">Incluir </a>
		</div>
	</form>
	</div> <!-- FIM DA DIV pai -->


<div class="base-lista">
		<table border="1" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
				<th align="center">id</th>
				<th>Número portaria</th>
				<th width="30%">data elaboração</th>
				<th width="10%">data inicio</th>
				<th width="10%">data fim</th>
				<th width="30%">assinatura gestor</th>
				<th width="10%" align="center" colspan="4">Ações</th>
			</tr>
	<?php
	if(isset($dados)){ 
	foreach($dados as $com){

	?>
		<tr>
		   <td align="center"><?php echo $com->id_portaria  ?> </td>
		   <td align="center"><?php echo $com->numero_portaria  ?></td>
		   <td align="center"><?php echo $com->data_elaboracao ?> </td>
		   <td align="center"><?php echo $data = $com->data_vigencia ?> </td>
		   <td align="center"><?php echo $com->data_fim_vigencia ?> </td>
		   <td><?php echo "implementar chave estrangeira na portaria"//$com->assinatura_gestor  ?> </td>

			<td>
			  <div class="btn-editar"> 
					<a href="<?php echo URL_BASE ."Comissao/Edit/".$com->id_portaria ?>">Editar</a>
	  	      </div>	
			</td>
			
			<td>
				<div class="btn-excluir"> 
					<a href="<?php echo URL_BASE ."comissao/Excluir/".$com->id_portaria ?>">Excluir</a>
				</div>
			</td>

			<td>
  				<div  class="btn-denunciar"> 
 				<a href="<?php echo URL_BASE ."comissao/Novo/".$com->id_portaria ?>" >Implementar Incluir</a>
				</div>
			</td>

		</tr>

							<?php  } 
				}?>
				
	</div> <!-- FIM DA DIV base-lista !-->
	</div> <!-- FIM DA DIV container-conteudo -->
	</table>

	<fieldset>
		<legend>ENCAIXA TABELA Membros da comissão de sindicância e Processos Administrativos NAS PORTARIAS</legend>	
			<table>
				<tr>
					<th>id</th>		
					<th>Nome</th>		
					<th>Matrpicula</th>		
					<th>Ações</th>
				</tr>
				
				<tr>
					<th>id</th>		
					<th>Nome</th>		
					<th>Matrpicula</th>		
					<th>Ações</th>
				</tr>
				

			</table>
	</fieldset>

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
