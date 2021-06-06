<div="base-home">
	<h1 class="titulo"><span class="cor">Lista de</span> denuncia</h1>
<div class="base-lista">
	<script type="text/javascript" src="<?php echo URL_BASE.'assets\js\script.js' ?>"> </script> 
	<span class="qtde">Há <b><?php echo count($denuncia) ?></b> denuncia(s) cadastrada(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denuncia/novo" ?>" >INCLUIR </a></div>
	<?php 
		foreach($denuncia as $den){
		  //$den = $den;
		  //$id_denuncia_pesquisa = $_GET['id_denuncia'];
	?>
		
	<div class="ini">
	</div>
	<br/><br/>
	
	<table border="1">
	<div class="tabela">	

<!-- Incluindo um formulário de pesquisa de denuncia !-->
		<form method="post" action="<?php echo URL_BASE ."denuncia/Pesquisar/"?>">
		<label>Pesquisar número</label>
			<input name="id_denuncia" type="number">
			<input type="submit" value="Pesquisar">
		</form>
		  <thead>
			   <tr>
			  </tr>
		  </thead>
		  <tbody>
			<div class="col">
				<label for="id"> id</label><br/>
				<input name="id" value="<?php echo $den->id_denuncia  ?>">
			
				<label>fato da denúncia</label><br/>
				<input value="<?php echo $den->denuncia_fato  ?>">

				<label>nome denunciante</label><br/>
				<input value="<?php echo $den->nome_denunciante ?>"> 
			</div>
				<label>tipo documento</label><br/>
				<input value="<?php echo $den->tipo_documento  ?>"> 

				<label>número</label><br/>
				<input value="<?php echo $den->numero_documento  ?>">

				<label>data de entrada</label><br/>
				<input value="<?php echo date('d/m/Y', strtotime($den->data_entrada))  ?>"> 

				<label>observação</label><br/>
				<input value="<?php echo $den->observacao  ?>"> 
		   </tbody>
		</form>
				
		<p>...</P>
	

	<!-- TABELA FILHA	          !-->
		<table width="100%" border="3" cellspacing="0" cellpadding="0">
		<?php URL_BASE."denuncia/denunciado"; ?>

		<p>Tabela filha</p>
			 <tr>
				<th width="5%" align="left">id denuncia</th>
				<th width="15%" align="left">id_denunciado</th>
				<th width="15%" align="left">nome denunciado</th>
				<th width="10%" align="left">matricula</th>
				<th width="15%" align="left">observação</th>
				<th width="20%" colspan="2" align="center">Ação</th>
			  </tr>

		  	<?php foreach($denunciado as $dnc){   ?>
				<tr class="cor1">
				<td align="center"><?php echo $dnc->id_denuncia ?></td>
				<td align="center"><?php echo $dnc->id_denunciado  ?></td>
				<td align="center"><?php echo $dnc->id_denuncia  ?></td>
				<td align="center"><?php echo $dnc->id_servidor  ?></td>
				<td><?php echo $dnc->observacao  ?></td>

			 </tr>	
			 <?php } ?>		
						  
			 <?php } ?>		
						  

		  </tbody>
		</table>
</div>					
</div>
</div>

</body>
</html>