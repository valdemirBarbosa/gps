<?php
	if(!isset($_SESSION)){
	session_start();
	}

	//paramentros para pesquisa dos formulários de denunciante
 	
	$tabela = 'denunciante';
	$view = 'denunciante/index';
?>

<div class="base-home">
	<h1 class="titulo-pagina">Lista de Denunciantes</h1>
</div>

<div class="pai">
	<div class="filho1">
		<form method="POST" action="<?php echo URL_BASE . 'Pesquisa/ConsultaDenunciante'; ?>" >
			<input type="hidden" name="view" value="<?php echo $view ?>">
			<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
			<input type="hidden" name="tabela" value='<?php echo $tabela ?>'>

				<label>Pesquisa</label> 
						<select name="pesquisa" class="select">
							<option value="5">Nome</option>
						</select>

						<input autofocus type="text" autofocus name="valorPreenchidoUsuario"> 
						<input type="submit" value="pesquisar">
	</div>

	<div class="filho2">
		<a href="<?php echo URL_BASE . "denunciante/Novo" ?>" class="btn-inc">Incluir </a>
	</div> <!-- FIM DA DIV pai -->	
	
	</form>
</div> <!-- FIM DA DIV pai -->
	
	<div class="base-lista">
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th width="5%" align="left">codigo</th>
					<th width="60%" align="left">denunciante</th>
					<th width="25%" align="left">observação</th>
					<th colspan="2" align="center">Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($dados)){
						foreach($dados as $dnc){   
				?>
					<tr class="cor1">
						<td align="center"><?php echo $dnc->id_denunciante  ?></td>
						<td><?php echo $dnc->nome_denunciante  ?></td>
						<td><?php echo $dnc->observacaoDenunciante  ?></td>

						<td align="center">
							<div class="btn-editar">
								<a href="<?php echo URL_BASE ."denunciante/Editar/".$dnc->id_denunciante ?>" >Editar</a>
						</td>

						<td align="center">
							<div class="btn-editar">
								<a href="<?php echo URL_BASE."denunciante/Excluir/".$dnc->id_denunciante ?>" >Excluir</a>
							</div>
						</td>
					</tr>	
				<?php }}
				?>					
				
				</table>
	
				<table class="paginacao">
				<tr><td>
				<?php
					if(isset($totalPaginas)){

						for($q=1; $q<=$totalPaginas; $q++):  
							echo "<a href=".URL_BASE.'Pesquisa/ConsultaDenunciante/?p='.($q); ?> > <?php echo "[".($q)."]" ?> </a> 
				<?php

			endfor;
			}

	 ?>
	</td></tr>
</table>
		
			</tbody>
		</table>
	</div>					
