﻿<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
			Listar Eventos
            <small>Lista de Eventos Cadastrados</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url("index.php/slides/listar");?>">Eventos</a></li>
          <li class="active">Listar</li>
        </ol>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Eventos Cadastrados</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						 <table id="example2" class="table table-bordered table-hover">
							<thead>
							  <tr>
								<th>#</th>
								<th>Nome</th>							
								<th>Data/Hora</th>							
								<th>Ações</th>
							  </tr>
							</thead>
							<tbody>
							<?php 
								foreach ($eventos->result() as $row) {
							?>
							  <tr>
								<td><?php echo $row->idEvento; ?></td>
								<td><?php echo $row->nome; ?></td>
								<td><?php #$row->data_hora; ?>
									<?= date("d/m/Y H:i", strtotime($row->data_hora)) ?>
								</td>
								<td>
									<!--i class="fa fa-eye" u="<?php echo $row->idEvento; ?>" title="Visualizar"></i-->
									<i class="fa fa-edit edit" data-toggle="modal" data-target="#myModal" u="<?php echo $row->idEvento; ?>" title="Editar"></i>&nbsp
									<i class="fa fa-remove" u="<?php echo $row->idEvento; ?>" title="Inativar"></i>
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

				<form id="demo-form2"enctype="multipart/form-data" method="POST" action="<?php echo base_url('index.php/site/editarEvento') ?>">
				<div class="row">
						<div class="col-md-12">	
							<div class="col-md-12">
								<div class="input-group">
								  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
								  <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do Evento" required="required">
								</div>
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">	
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></span>
									<input type="text" name="data" id="data" class="form-control" placeholder="Data do Evento" data-inputmask='"mask": "99/99/9999"' data-mask />
								</div>
							</div>	
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></span>
									<input type="text" name="hora" id="hora" class="form-control" placeholder="Hora do Evento" data-inputmask='"mask": "99:99"' data-mask>
								</div>
							</div>	
						</div>					
					</div>					
					<br />	
					<div class="row">
						<div class="col-md-12">	
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></span>
									<input type="text" name="local" id="local" class="form-control" placeholder="Local do Evento" />
								</div>
							</div>	
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></span>
									<input type="text" name="valor" id="valor" class="form-control" placeholder="Valor" />
								</div>
							</div>	
						</div>					
					</div>					
					<br />
					<div class="row">
						<div class="col-md-12">	
							<div class="col-md-12">
								<div class="input-group">
								  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
								  <input type="text" name="obs" id="obs" class="form-control" placeholder="Observação" required="required">
								</div>
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">							
							<div class="box-body pad">
								<label> Descrição do Evento </label>
								<textarea id="editor1" name="editor1" rows="10" cols="80" >										
								</textarea>              
							</div>
							
						</div>					
					</div>
					<div class="row">
						<div class="col-md-12">	
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputFile">Imagem</label>
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
			url: "<?php echo base_url("index.php/site/getEvento");?>",
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
			var data =res[0];
			var hora=res[1];
			var nome=res[2];			
			var descricao=res[3];			
			var valor=res[4];			
			var local=res[5];			
			var obs=res[6];			
			var imagem=res[7];	
			
			$("#img_noticia").attr('src', imagem);
			$("#data").val(data);
			$("#hora").val(hora);
			$("#nome").val(nome);
			$("#valor").val(valor);
			$("#local").val(local);
			$("#obs").val(obs);
			$("#txtCod").val(cod);
			CKEDITOR.instances.editor1.setData(descricao);

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
                url: "<?php echo base_url("index.php/site/escluirEvento"); ?>",
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