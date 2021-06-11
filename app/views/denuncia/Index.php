<div="base-home">
	<h1 class="titulo"><span class="cor">Lista de</span> denuncia</h1>
<div class="base-home">
<!-- 
	<script type="text/javascript" src="<?php //echo URL_BASE.'assets\js\script.js' ?>"> </script> 
!-->
	<span class="qtde">Há <b><?php echo count($denuncia) ?></b> denuncia(s) cadastrada(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denuncia/novo" ?>" >INCLUIR </a></div>
	<?php 
		foreach($denuncia as $den){
		  //$den = $den;
		  //$id_denuncia_pesquisa = $_GET['id_denuncia'];
	?>
		
	

<!-- Incluindo um formulário de pesquisa de denuncia !-->
	<form method="post" action="<?php echo URL_BASE ."denuncia/Pesquisar/"?>">
	   <table>
		<tr>
		   <td width="20%">
			<label>Pesquisar número</label>
			<input name="id_denuncia" type="number">
               </td>
		   <td> 
		  	<input type="submit" value="Pesquisar" class="btn-inc">
		   </td>
		</tr>
        </table>
      </form>

	
	<div>	
<!-- Formulário que recebe os dados pesquisados  !-->
	<form class="base-formulario">
         <?php foreach($denunciado as $dnc){ ?>

		<table>
			<tr>
				<td width="10%">
					<label for="id"> id</label>
					<input name="id" value="<?php echo $den->id_denuncia  ?>">
				</td>
				
				<td>
					<label>nome denunciante</label>
					<input value="<?php echo $dnc->nome_denunciante ?>">
				</td>
			</tr>

			<tr>
				<td>
					<label>tipo documento</label>
					<input value="<?php echo $den->tipo_documento  ?>"> 
				</td>

				<td width="10%">
					<label>número</label>
					<input value="<?php echo $den->numero_documento  ?>">
				</td>
	
				<td width="20%">
					<label>data de entrada</label>
					<input value="<?php echo date('d/m/Y', strtotime($den->data_entrada))  ?>"> 
				</td>
			</tr>
		
			<tr>
				<td>
					<label for="fato">fato da denúncia</label>
					<input name="fato" value="<?php echo $den->denuncia_fato  ?>">
				</td>
			</tr>
	
			<tr>
				<td>
					<label>observação</label>
					<input value="<?php echo $den->observacao  ?>">
				</td> 
			</tr>

		</table>
	</form>
	</div>				
		<p>...</P>
		<?php } ?>


	<!-- TABELA FILHA	          !-->
		<table class="table-bordered"  width="100%" border="3" cellspacing="0" cellpadding="0">
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