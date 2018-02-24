﻿<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
			Listar Posts
            <small>Lista de Posts Cadastrados</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url("index.php/slides/listar");?>">Posts</a></li>
          <li class="active">Listar</li>
        </ol>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Posts Cadastrados</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						 <table id="example2" class="table table-bordered table-hover">
							<thead>
							  <tr>
								<th>#</th>
								<th>Título</th>							
								<th>Imagem Destacada</th>							
								<th>Ações</th>
							  </tr>
							</thead>
							<tbody>
							<?php 
								foreach ($posts->result() as $row) {
							?>
							  <tr>
								<td><?php echo $row->idNoticia; ?></td>
								<td><?php echo $row->titulo; ?></td>
								<td> <img src="<?php echo $row->imagem_destacada; ?>" style="width:150px"> </td>
								<td>
									<!--i class="fa fa-eye" u="<?php echo $row->idNoticia; ?>" title="Visualizar"></i-->
									<i class="fa fa-edit edit" u="<?php echo $row->idNoticia; ?>" title="Editar" data-toggle="modal" data-target="#myModal"></i>&nbsp
									<i class="fa fa-remove" u="<?php echo $row->idNoticia; ?>" title="Inativar"></i>
								</td>
							  </tr>
							<?php 
								} 
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Detalhes</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-4">
							<button class="btn btn-default editar hidden-print"><i class="fa fa-edit" title="Editar"></i></button>&nbsp
							<button class="btn btn-default imprimir hidden-print" onclick="window.print();"><i class="fa fa-print" title="Imprimir"></i></button>

						</div>
						<div class="col-md-4" style="text-align:center;">
							<img src="" name="img_noticia" id="img_noticia" class="img_noticia" style="width:70%;">
						</div>
						<div class="col-md-4">

						</div>

					</div>

				</div>

				<br />
				<br />

				<form id="demo-form2"enctype="multipart/form-data" method="POST" action="<?php echo base_url('index.php/site/editarPost') ?>">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="input-group">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
							  <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">								
								<select class="form-control" id="categoria" name="categoria">  
									<option>Categoria - Selecione...</option>
									<?php
										foreach ($categorias->result() as $row) {
											echo "<option value='$row->idCategoriapost'>$row->descricao</option>";
										}

									?>
								</select>
							</div>
						</div>
					</div>
				</div>	
			  
				<div class="row">
					<div class="col-md-12">				
						 <div class="box-body pad">			  
								<textarea id="editor1" name="editor1" rows="10" cols="80" >
									
								</textarea>              
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputFile">Imagem Destacada</label>
								<input type="file" id="userfile" name="userfile">
								<p class="help-block">Selecione uma Imagem</p>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="txtCod" id="txtCod">
			</div>
		
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="submit" class="btn btn-primary">Salvar Alterações</button>
			</div>
		</div>
		</form>
	</div>
</div>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

<script>
	function getData(cod){
		$.ajax({
			url: "<?php echo base_url("index.php/site/getPost");?>",
			datatype: 'json',
			data: {
				cod: cod
			},
			error: function (request, status, error) {
				alert(request.responseText);
			},
			type: "POST",
			cache: false
		}).success(function (html) { 
			var res = html.split("|");
			var titulo=res[0];
			var texto=res[1];
			var imagem=res[2];			
			var cat=res[3];			
			$("#img_noticia").attr('src', imagem);
			$("#titulo").val(titulo);
			$("#txtCod").val(cod);
			$("#categoria").val(cat);
			CKEDITOR.instances.editor1.setData(texto);

		});

	}
    $(function () {
		 CKEDITOR.replace('editor1');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
		
		$(".edit").click(function(){
			var cod = $(this).attr("u");
			$('.form-control').attr("disabled", false);
			$('.editar').attr("disabled", true);
			getData(cod);
		});
		
		$(".fa-remove").click(function(){
			var cod = $(this).attr("u");
			//alert($(this).children().attr("codImg"));
			var r = confirm("Deseja Excluir o registro?");
			if (r == true){		
			$.ajax({
                url: "<?php echo base_url("index.php/site/excluirNoticia"); ?>",
                data: {
                    cod : cod,					
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                },
                type: "POST"
            }).success(function (html) {
				alert(html);
				location.reload();
			});

			}

		});
    });
</script>