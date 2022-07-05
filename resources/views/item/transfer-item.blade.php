@extends('layout.admin.base')
@section('style')
<style type="text/css">
	.dataRow input{
		border: none!important;
	}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Transfer Item
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-transfer-item')}}">
					<div class="row">
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>Search Items</b></label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" id="searchProduct1" type="text" dir="ltr" placeholder="Search Product" style="width: 1000px;">
						</div>
					</div>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>Transfer to</b></label>
						<div class="m-typeahead">
			    	<select class="form-control" name="to_location">
						@foreach($wh as $get)
						<option value="{{$get->id}}">{{$get->warehouse->name}} {{$get->wh_name}}</option>
						@endforeach
					</select>
						</div>
					</div>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>Transfer by</b></label>
						<div class="m-typeahead">
						<select class="form-control" name="user_id">
								
									@foreach($users as $user)
										<option value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
									</select>
						</div>
					</div>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>Remark</b></label>
						<div class="m-typeahead">
						<textarea class="form-control" style="width: 300px;" name="remark"></textarea>
							
						</div>
					</div>
					</div>
					<div class="form-group m-form__group table-responsive">
								<table class="table m-table m-table--head-bg-metal new_raw_report m--margin-top-20" id="new_raw_report">
								<thead>
							        <tr>
							          <th>Id</th>
							          <th class="first">Mfr.</th>
							          <th class="second">Part Number</th>
							          <th class="second">Part Name</th>
							          <th class="third">Description</th>
									  <th class="eighth">U/M</th>
							          <th class="seventh">Qty in Stock</th>
									
									  <th class="eighth">Action</th>
							        </tr>
							    </thead>
							    <tbody>
							        <!-- <tr>
							          <td><input type="text" name="mfr[]" class="form-control m-input mfr" style="width: 100px;" required="true"></td>
							          <td><input type="text" name="part_name[]" class="form-control m-input part_name" required="true"></td>
							          <td><input type="text" name="description[]" class="form-control m-input description" required="true"></td>
							          <td><input type="number" name="qty_receive[]" class="form-control m-input qty_receive" style="width: 100px;" required="true"></td>
							          <td><input type="text" name="um[]" class="form-control m-input um" style="width: 100px;" required="true"></td>
							        </tr> -->
							    </tbody>
						        </table>
							</div>
							<div class="form-group m-form__group text-center">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
				</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(function () {
  $("select").select2();
});

$('#new_raw_report').on('click', '.deleteItem', function(){
    $(this).closest ('tr').remove ();
});

$(function () {
	var engine = new Bloodhound({
            remote:{

               
				url: "{{ URL::to('/transfer-request?term=%QUERY%') }}",
               
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchProduct1").typeahead({
            hint: true,
            highlight: true,
            minLength:3
            }, 
            {
                source: engine.ttAdapter(),
                 displayKey: 'part_num',
                 limit:20,
                templates: {
                    empty: [
                        '<div class="empty-message">unable to find any</div>'
                    ],
                                suggestion: function (data) 
                                {
                                     return '<li id="suggestion">' + data.part_num +' - '+data.mfr +'- '+data.part_name +'- '+data.part_desc +' ('+data.warehouse+ '-'+data.wh_name+')</li>'
                                }

                }

         });
        $('#searchProduct1').on('typeahead:selected', function (e, datum) {
            // $("#btn_qc").show();
			console.log("ok")
            $("#new_raw_report").append('<tr class"table-replace">'+
                // '<td><input type="text" class="form-control m-input" name="product_id[]" value="1" readonly="true" style="width:75px;border:none;"></td>'+
				'<input type="hidden"  name="qty_reserve[]" value="'+datum.qty_reserve+'">'+
				'<input type="hidden"  name="qty_balance[]" value="'+datum.qty_balance+'">'+
				'<input type="hidden"  name="wh_location[]" value="'+datum.wh_location+'">'+
				'<input type="hidden"  name="inventory_id[]" value="'+datum.inventory_id+'">'+
                '<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.id+'" readonly="true" style="width:90px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" value="'+datum.mfr+'" readonly="true" style="width:120px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input"  value="'+datum.part_num+'" readonly="true" style="width:120px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input"  value="'+datum.part_name+'" readonly="true" style="width:120px;border:none;"></td>'+
                '<td><textarea type="text" class="form-control m-input"  readonly="true" style="width:200px;border:none;">'+datum.part_desc+'</textarea></td>'+
				'<td><input type="text" class="form-control m-input" value="'+datum.default_um+'" readonly="true" style="width:75px;border:none;"></td>'+
				'<td><input type="number" class="form-control m-input" name="qty[]"  value="'+datum.qty+'" readonly="true" style="width:120px;border:none;"></td>'+
			
                '<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+
                '</tr>');

				$('#form').modal('hide');
				$('#searchProduct').val('');
            
        });
});
</script>
@endsection