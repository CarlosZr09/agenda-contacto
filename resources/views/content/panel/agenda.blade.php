@extends('layouts/contentLayoutMaster')
@section('title', 'Agenda')
@section('page-style')
<style>
	.feather-2rem{
		width: 2em;
		height: 2em;
	}
</style>
@endsection
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="card">
				<div class="card-body border-bottom text-right">
					<button class="btn btn-info" tabindex="0" type="button" data-bs-toggle="modal" data-bs-target="#modals-add-contac"><span>Nuevo</span></button>
				</div>
				<div class="card-body border-bottom text-left">
					<div class="list-group">
						@foreach ($contacs as $contac)
							<a type="button" class="list-group-item list-group-item-action" href="{{ route('agenda.contac',$contac->id) }}">{{$contac->name}}</a>
						@endforeach
					</div>
				</div>
				<!-- Modal to add new asignacion starts-->
				
				<!-- Modal to add new sede Ends-->
			</div>
			{{-- Modal --}}
			<div class="modal fade" id="modals-add-contac" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
					<div class="modal-header bg-transparent">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body pb-5 px-sm-5 pt-50">
						<div class="text-center mb-2">
							<h1 class="mb-1">Nuevo contacto</h1>
						</div>
						<form id="newContact" name="newContact" class="row gy-1 pt-75" enctype="multipart/form-data">
							<div class="col-12 col-md-6">
								<label class="form-label" for="name">Nombres *</label>
								<input type="text" id="name" name="name" class="form-control" placeholder="Nombre" data-msg="Ingrese sus nombres" required/>
							</div>
							<div class="col-12 col-md-6">
								<label class="form-label" for="last_name">Apellidos *</label>
								<input type="text" id="last_name" name="last_name" class="form-control" placeholder="Apellidos" data-msg="Ingrese sus apellidos" required/>
							</div>
							
							<div class="col-12" id="div-phones">
								<span>Teléfono</span><hr>
								<div class="row">
									<div class="col">
										<label class="form-label" for="type_phone">Etiqueta</label>
										<select name="type_phone[]" class="form-select" aria-label="Seleccionar" required>
											@foreach ($phoneTypes as $phoneType)
												<option value="{{$phoneType->id}}">{{$phoneType->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col">
										<label class="form-label" for="phone">Numero</label>
										<input type="text" name="phone[]" class="form-control" required/>
									</div>
									
								</div>
							</div>
							<div class="col-md-12 text-right">
								<button class="btn btn-icon rounded-circle btn-outline-primary waves-effect" id="btn-plus-phone" type="button"><i data-feather="plus"  style="cursor: pointer;"></i></button>
							</div>
							<div class="col-12" id="div-address">
								<span>Dirección</span><hr>
								<div class="row">
									<div class="col">
										<label class="form-label" for="type_address">Etiqueta</label>
										<select name="type_address[]" class="form-select" aria-label="Seleccionar" required>
											@foreach ($addressTypes as $addressType)
												<option value="{{$addressType->id}}">{{$addressType->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col">
										<label class="form-label" for="address">Dirección</label>
										<input type="text" id="address" name="address[]" class="form-control"/>
									</div>
								</div>
							</div>
							<div class="col-md-12 text-right">
								<button class="btn btn-icon rounded-circle btn-outline-primary waves-effect" id="btn-plus-address" type="button"><i data-feather="plus"  style="cursor: pointer;"></i></button>
							</div>
							<div class="col-12 col-md-12">
								<label class="form-label" for="nickname">Nickname</label>
								<input type="text" id="nickname" name="nickname" class="form-control"/>
							</div>
							<div class="col-12 col-md-12">
								<label class="form-label" for="business">Empresa</label>
								<input type="text" id="business" name="business" class="form-control" placeholder="Empresa"/>
							</div>
							<div class="col-12 col-md-12">
								<label class="form-label" for="email">Correo</label>
								<input type="email" id="email" class="form-control dt-email" placeholder="john.doe@example.com" name="email"/>
							</div>
							<div class="col-12 text-right mt-2 pt-50">
								<button type="button" id="btn-create" class="btn btn-info me-1">Guardar</button>
								<button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
							</div>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('page-script')
	<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
	<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
	<script>
		$("#btn-create").click(function(){
			isValid = $("#newContact").valid();
			if(isValid){
				v_token = "{{ csrf_token() }}";
				formData = new FormData(document.getElementById("newContact"));
				formData.append("_method", "POST");
				formData.append("_token", v_token);
					$.ajax({
						url: "{{route('agenda.create')}}",
						type: "POST",
						data: formData,
						cache:false,
						contentType: false,
						processData: false,
						dataType: 'json',
						success: function(obj){
							if(typeof obj.message === 'object' && obj.message !== null){
								mensaje='';
								Object.values(obj.message).forEach(element => {
									mensaje+=element+'<br>';
								});
							}else{
								mensaje=obj.message;
							}


							if(obj.sw_error==1){
								Swal.fire({
									position: "bottom-end",
									icon: "warning",
									title: "Atención",
									text: mensaje,
									showConfirmButton: false,
									timer: 2500
								});
							}else{
								Swal.fire({
									position: "bottom-end",
									icon: "success",
									title: "Éxito",
									text: mensaje,
									showConfirmButton: false,
									timer: 2500
								});
								$("#modals-add-contac").modal('hide');
							}
						}
					});
			}
		});
		$('#modals-add-contac').on('hidden.bs.modal', function () {
			document.getElementById("newContact").reset();
		});
	</script>
	<script>
		var htmlPhone = '<div class="row"><div class="col"><label class="form-label" for="type_phone">Etiqueta</label><select name="type_phone[]" class="form-select" aria-label="Seleccionar" required>';
		var htmlAddress = '<div class="row"><div class="col"><label class="form-label" for="type_address">Etiqueta</label><select name="type_address[]" class="form-select" aria-label="Seleccionar" required>';

		<?php foreach($addressTypes as $addressType){?>
			htmlAddress+= '<option value="<?php echo $addressType->id;?>"><?php echo $addressType->name;?></option>';
		<?php } ?>
		htmlAddress+='</select></div><div class="col"><label class="form-label" for="address">Dirección</label><input type="text" id="address" name="address[]" class="form-control"/></div></div>';
		var htmlDelete = '<div class="col-1 mx-auto my-auto"><a type="button" class="delete"><i class="feather-2rem" data-feather="x-circle" color="red"  width="24" height="24" style="cursor: pointer;"></i></a></div>';
		<?php foreach ($phoneTypes as $phoneType) {?>
			htmlPhone+= '<option value="<?php echo $phoneType->id;?>"><?php echo $phoneType->name;?></option>';
		<?php } ?>
											
		htmlPhone+='</select></div><div class="col"><label class="form-label" for="phone">Numero</label><input type="text" name="phone[]" class="form-control" required/></div></div>';
		
		$("#btn-plus-phone").click(function(){
			$("#div-phones").append(htmlPhone);
			checkbtndeletePhone();
		});
		$("#btn-plus-address").click(function(){
			$("#div-address").append(htmlAddress);
			checkbtndeleteAddress();
		});
		$("#div-phones").on('click','.delete',function(){
			$(this).parent().parent().remove();
			checkbtndeletePhone();
		});
		$("#div-address").on('click','.delete',function(){
			$(this).parent().parent().remove();
			checkbtndeleteAddress();
		})

		function checkbtndeletePhone(){
			rows=$("#div-phones").find('.row');
			if(rows.length>1){
				rows.each(function(){
					if($(this).find('.delete').length==0){
						$(this).append(htmlDelete);
						feather.replace();
					}
				})
			}else{
				rows.find('.delete').parent().remove();
			}
		}

		function checkbtndeleteAddress(){
			rows=$("#div-address").find('.row');
			if(rows.length>1){
				rows.each(function(){
					if($(this).find('.delete').length==0){
						$(this).append(htmlDelete);
						feather.replace();
					}
				})
			}else{
				rows.find('.delete').parent().remove();
			}
		}

	</script>
@endsection