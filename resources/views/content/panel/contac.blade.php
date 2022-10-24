@extends('layouts/contentLayoutMaster')
@section('title', 'Edición de contacto')
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
				<div class="card-body border-bottom text-right d-none">
					<button type="button" class="btn btn-info me-1 contac-save">Guardar</button>
					<button type="button" class="btn btn-outline-danger contac-delete">Eliminar</button>
				</div>
				<div class="card-body border-bottom">
					<form id="ContactEdit" name="ContactEdit" class="row gy-1 pt-75" enctype="multipart/form-data">
						<div class="col-12 col-md-6">
							<label class="form-label" for="name">Nombres *</label>
							<input type="text" id="name" name="name" class="form-control" placeholder="Nombre" data-msg="Ingrese sus nombres" value="{{$contact->name}}" required/>
						</div>
						<div class="col-12 col-md-6">
							<label class="form-label" for="last_name">Apellidos *</label>
							<input type="text" id="last_name" name="last_name" class="form-control" value="{{$contact->last_name}}" placeholder="Apellidos" data-msg="Ingrese sus apellidos" required/>
						</div>
						
						<div class="col-12" id="div-phones">
							<span>Teléfono</span><hr>
							@foreach ($contacPhones as $contacPhone)
								<div class="row">
									<div class="col">
										<label class="form-label" for="type_phone">Etiqueta</label>
										<select name="type_phone[]" class="form-select" aria-label="Seleccionar" required>
											@foreach ($phoneTypes as $phoneType)
												<option value="{{$phoneType->id}}" <?php if($phoneType->id==$contacPhone->phonetype_id){ echo 'selected'; }?>>{{$phoneType->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col">
										<label class="form-label" for="phone">Numero</label>
										<input type="text" name="phone[]" value="{{$contacPhone->phone}}" class="form-control" required/>
									</div>
									<div class="col-1 mx-auto my-auto"><a type="button" class="delete" data-valorid="{{$contacPhone->id}}"><i class="feather-2rem" data-feather="x-circle" color="red"  width="24" height="24" style="cursor: pointer;"></i></a></div>
								</div>
							@endforeach
							@if (is_countable($contacPhones) && count($contacPhones)==0)
								<div class="row">
									<div class="col">
										<label class="form-label" for="type_phone">Etiqueta</label>
										<select name="type_phone[]" class="form-select" aria-label="Seleccionar" required>
											@foreach ($phoneTypes as $phoneType)
												<option value="{{$phoneType->id}}" >{{$phoneType->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col">
										<label class="form-label" for="phone">Numero</label>
										<input type="text" name="phone[]" class="form-control" required/>
									</div>
								</div>
							@endif
						</div>
						<div class="col-md-12 text-right">
							<button class="btn btn-icon rounded-circle btn-outline-primary waves-effect" id="btn-plus-phone" type="button"><i data-feather="plus"  style="cursor: pointer;"></i></button>
						</div>
						<div class="col-12" id="div-address">
							<span>Dirección</span><hr>
							@foreach ($contacAddress as $contacAddress)
								<div class="row">
									<div class="col">
										<label class="form-label" for="type_address">Etiqueta</label>
										<select name="type_address[]" class="form-select" aria-label="Seleccionar" required>
											@foreach ($addressTypes as $addressType)
												<option value="{{$addressType->id}}" <?php if($addressType->id==$contacAddress->addresstype_id){ echo 'selected'; }?>>{{$addressType->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col">
										<label class="form-label" for="address">Dirección</label>
										<input type="text" id="address" value="{{$contacAddress->address}}" name="address[]" class="form-control"/>
									</div>
									
									<div class="col-1 mx-auto my-auto"><a type="button" class="delete" data-valorid="{{$contacAddress->id}}"><i class="feather-2rem" data-feather="x-circle" color="red"  width="24" height="24" style="cursor: pointer;"></i></a></div>
								</div>
							@endforeach
							@if (is_countable($contacAddress) && count($contacAddress)==0)
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
							@endif
						</div>
						<div class="col-md-12 text-right">
							<button class="btn btn-icon rounded-circle btn-outline-primary waves-effect" id="btn-plus-address" type="button"><i data-feather="plus"  style="cursor: pointer;"></i></button>
						</div>
						<div class="col-12 col-md-12">
							<label class="form-label" for="nickname">Nickname</label>
							<input type="text" id="nickname" name="nickname" value="{{$contact->nickname}}" class="form-control"/>
						</div>
						<div class="col-12 col-md-12">
							<label class="form-label" for="business">Empresa</label>
							<input type="text" id="business" name="business" value="{{$contact->business}}" class="form-control" placeholder="Empresa"/>
						</div>
						<div class="col-12 col-md-12">
							<label class="form-label" for="email">Correo</label>
							<input type="email" id="email" value="{{$contact->email}}" class="form-control dt-email" placeholder="john.doe@example.com" name="email"/>
						</div>
						<div class="col-12 text-right mt-2 pt-50">
							<button type="button" class="btn btn-info me-1 contac-save" id="contac-save" data-valorid="{{$contact->id}}">Guardar</button>
							<button type="button" class="btn btn-outline-danger " id="contac-delete" data-valorid="{{$contact->id}}">Eliminar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page-script')
	<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
	<script>
		$("#contac-save").click(function(){
			numeroID=$(this).data('valorid');
			isValid = $("#ContactEdit").valid();
			if(isValid){
				v_token = "{{ csrf_token() }}";
				formData = new FormData(document.getElementById("ContactEdit"));
				formData.append("_method", "POST");
				formData.append("_token", v_token);
					$.ajax({
						url: "{{route('agenda.update')}}/"+numeroID,
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
		$("#contac-delete").click(function(){
			numeroID=$(this).data('valorid');
			Swal.fire({
					title: "Estas seguro de eliminar esté contacto ?",
					icon: "question",
					showCancelButton: true,
					confirmButtonText: "Si, eliminar!",
					customClass: {
						confirmButton: "btn btn-info",
						cancelButton: "btn btn-outline-danger ms-1"
					},
					buttonsStyling: false
				}).then((function(t) {
					if(t.isConfirmed==true){
						v_token = "{{ csrf_token() }}";
						method = 'PUT';
						$.ajax({
							url: "{{ route('agenda.delete') }}/"+numeroID,
							type: "POST",
							data: {_token:v_token,_method:method},
							dataType: 'json',
							success: function(obj){
								if(obj.sw_error==1){
									Swal.fire({
										position: "bottom-end",
										icon: "warning",
										title: "Atención",
										text: obj.message,
										showConfirmButton: false,
										timer: 2500
									});
								}else{
									Swal.fire({
										position: "bottom-end",
										icon: "success",
										title: "Éxito",
										text: obj.message,
										showConfirmButton: false,
										timer: 2500
									});
									setTimeout( function() { window.location.href = "{{route('agenda.index')}}"; }, 2500 );
								}
							}
						});
					}
				}))
		});
		
	</script>
	<script>
		$( document ).ready(function() {
			checkbtndeletePhone();
			checkbtndeleteAddress();
		});
		var htmlPhone = '<div class="row"><div class="col"><label class="form-label" for="type_phone">Etiqueta</label><select name="type_phone[]" class="form-select" aria-label="Seleccionar" required>';
		var htmlAddress = '<div class="row"><div class="col"><label class="form-label" for="type_address">Etiqueta</label><select name="type_address[]" class="form-select" aria-label="Seleccionar" required>';

		<?php foreach($addressTypes as $addressType){?>
			htmlAddress+= '<option value="<?php echo $addressType->id;?>"><?php echo $addressType->name;?></option>';
		<?php } ?>
		htmlAddress+='</select></div><div class="col"><label class="form-label" for="address">Dirección</label><input type="text" id="address" name="address[]" class="form-control"/></div></div>';
		var htmlDelete = '<div class="col-1 mx-auto my-auto"><a type="button" class="delete" data-valorid="0"><i class="feather-2rem" data-feather="x-circle" color="red"  width="24" height="24" style="cursor: pointer;"></i></a></div>';
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
			
			botondelete=$(this);
			numeroID=botondelete.data('valorid');
			if(numeroID!='0'){
				Swal.fire({
					title: "Estas seguro de eliminar esté numero ?",
					icon: "question",
					showCancelButton: true,
					confirmButtonText: "Si, eliminar!",
					customClass: {
						confirmButton: "btn btn-info",
						cancelButton: "btn btn-outline-danger ms-1"
					},
					buttonsStyling: false
				}).then((function(t) {
					if(t.isConfirmed==true){
						v_token = "{{ csrf_token() }}";
						method = 'PUT';
						$.ajax({
							url: "{{ route('agenda.deletephone') }}/"+numeroID,
							type: "POST",
							data: {_token:v_token,_method:method},
							dataType: 'json',
							success: function(obj){
								if(obj.sw_error==1){
									Swal.fire({
										position: "bottom-end",
										icon: "warning",
										title: "Atención",
										text: obj.message,
										showConfirmButton: false,
										timer: 2500
									});
								}else{
									Swal.fire({
										position: "bottom-end",
										icon: "success",
										title: "Éxito",
										text: obj.message,
										showConfirmButton: false,
										timer: 2500
									});
									botondelete.parent().parent().remove();
									checkbtndeletePhone();
								}
							}
						});
					}
				}))
			}else{
				botondelete.parent().parent().remove();
				checkbtndeletePhone();
			}
			
			
		});
		$("#div-address").on('click','.delete',function(){
			botondelete=$(this);
			addressID=botondelete.data('valorid');
			if(addressID!='0'){
				Swal.fire({
					title: "Estas seguro de eliminar esté numero ?",
					icon: "question",
					showCancelButton: true,
					confirmButtonText: "Si, eliminar!",
					customClass: {
						confirmButton: "btn btn-info",
						cancelButton: "btn btn-outline-danger ms-1"
					},
					buttonsStyling: false
				}).then((function(t) {
					if(t.isConfirmed==true){
						v_token = "{{ csrf_token() }}";
						method = 'PUT';
						$.ajax({
							url: "{{ route('agenda.deleteaddress') }}/"+addressID,
							type: "POST",
							data: {_token:v_token,_method:method},
							dataType: 'json',
							success: function(obj){
								if(obj.sw_error==1){
									Swal.fire({
										position: "bottom-end",
										icon: "warning",
										title: "Atención",
										text: obj.message,
										showConfirmButton: false,
										timer: 2500
									});
								}else{
									Swal.fire({
										position: "bottom-end",
										icon: "success",
										title: "Éxito",
										text: obj.message,
										showConfirmButton: false,
										timer: 2500
									});
									botondelete.parent().parent().remove();
									checkbtndeleteAddress();
								}
							}
						});
					}
				}))
			}else{
				botondelete.parent().parent().remove();
				checkbtndeleteAddress();
			}
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