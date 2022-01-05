<?php
	if(!isset($_SESSION)){
	session_start();
	}
?>

<div class="base-home">
	<h1 class="titulo-pagina"> Consulta servidor por processo 
		<?php  
			$qtde = 0;
			if(isset($servidor) && count($servidor) > 0){
				$qtde = count($servidor);
			}else{
				$qtde = 0; 
			}
			echo "Qtde: ".$qtde;
		?></h1>
</div>

<?php //paramentros para pesquisa dos formulários de denuncia e processo
		$tabela = 'servidor';
		$view =  'servidor/index';
		$_SESSION['view'] = $view; 
		$_SESSION['tabela'] = $tabela; 
?>
<div class="frmConsulta">  

<!-- Formulário de pesquisa !--> 
<form method="POST" action="<?php echo URL_BASE . 'Pesquisa/ConsultaServidor'; ?>" >
	<label>Pesquisa</label>
		<select name="pesquisa" class="select">
			<option value="1">Número documento da denúncia</option>
			<option value="2">NÚMERO DO PROCESSO</option>
			<option value="3">Nome</option>
			<option value="4">CPF</option>
		</select>
	
		<input class="pesquisa" type="text" autofocus name="valorPreenchidoUsuario">
		<input type="hidden" name="view" value="<?php echo $view ?>">
		<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
		<input type="hidden" name="tabela" value="<?php echo $tabela ?>">
		<input type="submit" value="pesquisar">
	</form>
</div>

<div class="base-lista">

<!-- Tabela de denuncias !-->
<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>

		  <!-- CABEÇALHO da denúncia !-->
		  <tr>
			<th align="left">Número doc Denuncia </th>
			<th align="center">Data entrada </th>
			<th colspan="2" align="center">Denunciante </th>
			<th colspan="3" align="center">Narração da Denuncia </th>
		</tr>

		<!-- DADOS da denúncia !-->
		<?php	
			if(isset($servidor) && count($servidor) > 0){
				foreach($servidor as $s){  // loop na tabela denúncia
					$id = isset($s->numero_documento);
						if($id > 0){
							echo "<tr>";
							echo "<td>". $s->numero_documento ."</td>";
							echo "<td>". $s->data_entrada ."</td>";
							echo "<td colspan='2'>". $s->nome_denunciante ."</td>";
							echo "<td colspan='3'>". $s->denuncia_fato ."</td>";
							echo "</tr>";
						}
					}
				}?>
</table>
	<br/>

<!-- Tabela de processos  !-->
<table width="100%" border="1" cellspacing="0" cellpadding="0">

		<!-- CABEÇALHO de processos !-->
		<tr>
			<th width="15%" align="left">Número do Processo</th>
			<th width="15%" align="center">Fase</th>
			<th width="15%" align="center">data entrada</th>
			<th width="15%" align="center">data encerramento</th>
		</tr>

		<?php	
		if(isset($servidor) && count($servidor) > 0){
			foreach($servidor as $s){  // loop na tabela processo
				$id = isset($s->numero_processo);
					if($id > 0){
						echo "<tr>";
						echo"<td>". $s->numero_processo ."</td>";
						echo"<td>". $s->fase ."</td>";
						echo"<td>". $s->data_entrada ."</td>";
						echo"<td>". $s->data_encerramento ."</td>";
						echo "</tr>";
				}
			} 
		}?>
	</table>

<br/>

<!-- Tabela de servidores  !-->
<table width="100%" border="1" cellspacing="0" cellpadding="0">

		  <tr>
				<th width="15%" align="left">Nome do servidor</th>
				<th width="5%" align="center">Cpf</th>
				<th width="5%" align="center">Matricula</th>
				<th width="7%" align="left">Vinculo</th>
				<th width="10%" align="left">Secretaria</th>
				<th width="10%" align="left">Unidade</th>
				<th width="5%" colspan="2" align="center">Ação</th>
			  </tr>
		</thead>

		<tbody>
		<?php	
			if(isset($servidor)){
				foreach($servidor as $s){   ?>
						<tr class="cor1">
						<td align="center"><?php echo $s->nome_servidor  ?></td>
						<td align="center"><?php echo $s->cpf  ?></td>
						<td><?php echo $s->matricula  ?></td>
						<td><?php echo $s->vinculo  ?></td>
						<td><?php echo $s->secretaria  ?></td>
						<td><?php echo $s->unidade  ?></td>	
						<td align="center">
							<div class="btn-editar">
								<a href="<?php echo URL_BASE ."servidor/Editar/".$s->id_servidor ?>" >Editar</a>
							</div>
						</td>
						<td align="center">
							<div class="btn-excluir">
								<a href="<?php echo URL_BASE ."servidor/Excluir/".$s->id_servidor ?>" >excluir</a>
							</div>
						</td>
					</tr>
			 <?php }
			 } ?>									  
		  </tbody>
		<table class="paginacao">
		<tr><td>
		<?php

				$totalPaginas = $_SESSION['totalPaginas'];

				for($q=1; $q<=$totalPaginas; $q++):  
					echo "<a href=".URL_BASE.'pesquisa/LinkServidor/?p='.($q); ?> > <?php echo "[".($q)."]" ?> </a> 
		<?php
			endfor;
/* 		}
 */
		 ?>
		</td></tr>
		</fieldset>
	</table>
</div>
