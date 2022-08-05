<div class="base-home">
	<h1 class="titulo-pagina">Lista de denunciados</h1>
</div>
<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($denunciados) ?></b> denunciado(s) cadastrado(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denunciado/novo" ?>" >INCLUIR </a></div>

	<!-- INCLUÍDO EM 29/07/2022                                                                                -->
	<div class="base-home">
	<h1 class="titulo-pagina"> Consulta servidor 
		<?php  
			$qtde = 0;
			if(isset($denunciados) && count($denunciados) > 0){
				$qtde = count($denunciados);
			}else{
				$qtde = 0; 
			}
			echo "Qtde: ".$qtde;
		?></h1>
	</div>

<?php //paramentros para pesquisa dos formulários de denuncia e processo
		$tabela = 'servidor';
		$view =  'denunciado/index';
		$_SESSION['view'] = $view; 
		$_SESSION['tabela'] = $tabela; 
?>
<div class="pai">  
	<div class="filho1">  
		<form method="POST" action="<?php echo URL_BASE . 'Pesquisa/ConsultaDenuncia_e_Processo'; ?>" >
				<label>Pesquisa</label>
					<select name="pesquisa" class="select">
<!-- 						<option value="1">Número documento da denúncia</option>
						<option value="2">NÚMERO DO PROCESSO</option>
 -->						<option value="3">Nome</option>
						<option value="4">CPF</option>
					</select>
				
					<input class="" type="text" autofocus name="valorPreenchidoUsuario">
					<input type="hidden" name="view" value="<?php echo $view ?>">
					<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
					<input type="hidden" name="tabela" value="<?php echo $tabela ?>">
					<input type="submit" value="pesquisar">
		</form>
	</div>
</div>
<!--                                                                                                      -->

	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead>
			   <tr>
				<th width="5%" align="center">Id_denunciado</th>
				<th width="5%" align="center">Id do servidor</th>
				<th width="25%" align="left">Nome do servidor</th>
				<th width="10%" align="left">Vinculo</th>
				<th width="15%" align="left">Secretaria</th>
				<th width="15%" align="left">Unidade</th>
				<th width="15%" align="left">Observacao</th>
				<th width="15%" align="left">Data Encerramento</th>
				<th width="10%" colspan="2" align="center">Ação</th>
			  </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($denunciados as $denunciado){   ?>
				<tr class="cor1">
				<td align="center"><?php echo $denunciado->id_denunciado  ?></td>
				<td align="center"><?php echo $denunciado->id_servidor  ?></td>
				<td><?php echo $denunciado->nome_servidor  ?></td>
				<td><?php echo $denunciado->vinculo  ?></td>
				<td><?php echo $denunciado->secretaria  ?></td>
				<td><?php echo $denunciado->unidade  ?></td>	
				<td><?php echo $denunciado->observacao  ?></td>	
				<td><?php echo $denunciado->data_fechamento ?></td>	
				<td align="center">
					<div class="btn-editar">
					<a href="<?php echo URL_BASE ."denunciado/Editar/".$denunciado->id_denunciado ?>" >Editar</a>
			  	</div>
				</td>
				<td align="center">
					<div class="btn-excluir">
					<a href="<?php echo URL_BASE ."denunciado/Excluir/".$denunciado->id_denunciado ?>" >excluir</a>
			  	</dvi>	
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