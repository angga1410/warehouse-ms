@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="warehouseLocationList">
@include('flash::message')
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">Warehouse Zoning</h3>
			</div>
		</div>
	</div>
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<select id="warehouse" style="height: 40px;margin-top: 11px; width: 200px;" class="form-control m-input m-input--solid">
					@if(count($warehouseList) > 0)
						<option value="">All</option>
						@foreach($warehouseList as $index => $warehouse)
							<option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
						@endforeach
					@endif
				</select>
				<a href="{{url('/new-warehouse-location')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
					<span>
						<i class="la la-cart-plus"></i>
						<span>New Warehouse Zoning</span>
					</span>
				</a>
			</div>
			<input type="hidden" id="token" value="{{csrf_token()}}">
			<div class="m-portlet__body">
				<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
					<table class="table table-striped- table-bordered table-hover table-checkable" id="warehouse_location_list">
						<thead>
							<tr>
								<th>Id</th>
								<th>Zone</th>
								<th>warehouseid</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
