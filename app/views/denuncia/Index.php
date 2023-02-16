<?php
	if(!isset($_SESSION)){
	session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
	    header("Location: ". URL_BASE . "index");
	}else{
	    
?>

 <div class="areaTrabalho"> 
	 <div class="base-home">
       	<h1 class="titulo-pagina">Lista de denúncias</h1>
     </div> 

	<div class="superior">
<!--	<div class="col1"> OCULTADO PORQUE QUANDO MINIMIZA FICA MELHOR SEM A DIV A VISUZALIZAÇÃO -->
			<?php include "app/views/radio.php";
 ?>
    
	<form method="GET" action="<?php echo URL_BASE . 'PesquisaDenuncia/ConsultaDenuncia'; ?>" >
        		<label>Pesquisa</label> 
        			<select name="pesquisa">
        				<option value="1">Número do documento</option>
        				<!-- <option value="2">Número do Processo</option> !-->
        				<option value="3">Nome</option>
        				<option hidden value="4">CPF</option> <!-- Ocultado pois na tabela denuncia não há cpf -->
        				<option type="number" value="6">Id da denúncia</option>
        			</select>
        			<input type="text" autofocus name="valorPreenchidoUsuario"> 
        			<input class="btn btn-secondary" type="submit" value="pesquisar">
<!--	</div>  Fim da coluna1 -->

<!--		<div class="col2"> -->
			<a href="<?php echo URL_BASE . "denuncia/Novo" ?>" class="btn btn-Primary">Incluir </a>
<!--		</div> -->
	</form>
	</div>
 
	<div class="inferior">
		<div class="tableResponsividade">
			<table class="table table-bordered">
>
					<thead>
						<tr>
							<th width="10px" align="center">id</th>
							<th width="20">Número documento</th>
							<th width="10%">Tipo documento</th>
							<th width="15%">Denunciante</th>
							<th width="100%">Narração da denúncia</th>
							<th width="10%">Denunciados</th>
							<th width="5%">Data de entrada</th>
							<th width="10%">Documentos anexados</th>
							<th width="20%" align="center" colspan="4">Ações</th>
						</tr>
					</thead>
				<?php
				if(isset($dados)){ 
					foreach($dados as $den){
			
				?>
					<tr>
					<td align="center"><?php echo $den->id_denuncia  ?> </td>
					<td align="center"><?php echo $den->numero_documento  ?></td> 
					<td align="center"><?php echo $den->tipo_de_documento ?> </td>
					<td align="center"><div class="TextOver"><?php echo $den->nome_denunciante ?></div> </td>
					<td><div class="TextOver"><?php echo $den->denuncia_fato  ?></div> </td>
					<td align="center"><div class="TextOver"><?php echo $den-> denunciados ?> </div></td>
			
							<?php 
								$dt_entrada = explode("-",$den->data_entrada);
								$dia = $dt_entrada[2];
								$mes = $dt_entrada[1];
								$ano = $dt_entrada[0];
							?>
						<td align="center"><?php echo $dia."/".$mes."/".$ano  ?> </td> 
					
						<td width="30"><div class="TextOver"><?php echo $den->documentos_anexados ?></div></td>
			
						<td>
							<a class="btn btn-info" href="<?php echo URL_BASE ."Upload/Anexar/".$den->id_denuncia ?>">Anexar</a>
						</td>
			
						<td>
							<a class="btn btn-success" href="<?php echo URL_BASE ."denuncia/Edit/".$den->id_denuncia ?>">Editar</a>
						</td>
						
						<td>
							<a class="btn btn-dark" href="<?php echo URL_BASE ."denunciado/Novo/".$den->id_denuncia ?>">Denunciados</a>
						</td>
	
						<td>
							<a class="btn btn-danger" href="<?php echo URL_BASE ."denuncia/Excluir/".$den->id_denuncia ?>" >Excluir</a>
						</td>

						<td>
 							<a class="btn btn-secondary" href="<?php echo URL_BASE ."FecharDenunciaProcesso/BuscarDenunciados/".$den->id_denuncia ?>">Pesquisar denunciados</a> 
						</td>
			
					</tr>
								<?php  } 
							}?>
							
				</div> <!-- FIM DA DIV base-lista !-->
				</table>
			</div>
					
			<div class="paginacao">
        				<?php
        					if(isset($totalPaginas)){
        
        						for($q=1; $q<=$totalPaginas; $q++):  
        							echo "<a href=".URL_BASE.'PesquisaDenuncia/ConsultaDenuncia/?p='.($q); ?> > <?php echo "[".($q)."]" ?> </a> 
        				<?php
        
        						endfor;
        					}
                    	}
        	?>
        	</div>

	</div>

 </div> <!- fim da div areaTrabalho 



