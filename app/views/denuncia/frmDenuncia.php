<div="base-home">
	<h1 class="titulo"><span class="cor">Lista de</span> denuncia</h1>
<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($denuncia) ?></b> denuncia(s) cadastrada(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denuncia/novo" ?>" >INCLUIR </a></div>

		<form action="" method="post" >
			<?php foreach($denuncia as $d){   ?>
				<label width="5%" align="left">id</label>
				<input type="number"> align="center"><?php echo $d->id_denuncia  ?>

				<label width="22%" align="left">NOME DO DENUNCIANTE</label>
				<input type="text"> <?php echo  $d->nome_denunciante; ?>

				<label width="10%" align="left">tipo documento</label>
				<input  type="text"><?php echo $d->tipo_documento  ?>
				<label width="8%" align="center">número</label>
				<input  type="number"align="center"><?php echo $d->numero_documento  ?>

				<label width="10%" align="left">data de entrada</label>
				<input  type="date"><?php echo date('d/m/Y', strtotime($d->data_entrada))  ?></input>

				<label width="15%" align="left">observação</label>
				<input  type="textarea><?php echo $d->observacao  ?>

				<label width="10%" colspan="2" align="center">Ação</label>
				<?php }   ?>
			
		</form>	
		
			  <tbody>
			  	<?php foreach($denuncia as $d){   ?>
				<tr class="cor1">

				<input align="center">
					<a href="<?php echo URL_BASE ."denuncia/Edit/".$d->id_denuncia ?>" class="btn">Editar</a>
				</input>
				<input align="center">
					<a href="<?php echo URL_BASE ."denuncia/Excluir/".$d->id_denuncia ?>" class="btn excluir">excluir</a>
				</input>
			 </tr>	
			 <?php } ?>									  

		  	</tbody>
</div>					
</div>
</div>

</body>
</html>