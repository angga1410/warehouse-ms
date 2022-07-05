@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>
   
            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel">Create Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="ajaxform">
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
      
		
								<div class="form-group m-form__group">
									<label>Warehouse</label>
									<select name="wh_id" class="form-control m-input m-input--solid wh" required="true">
										@foreach($warehouseList as $warehouse)
											<option value="{{$warehouse->id}}" data="{{$warehouse->id}}">{{$warehouse->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group m-form__group">
									<label>Zone</label>
									<input type="text" class="form-control m-input zone" name="zone_id" required="true">
									
								</div>
								<div class="form-group m-form__group">
									<label>Rack</label>
									<input type="text" class="form-control m-input zone" name="rack_id" required="true">
									
								</div>
								
							
								<div class="form-group m-form__group">
									<label>Level</label>
									<input type="text" class="form-control m-input" name="level_id" required="true">
								</div>
							
								<div class="form-group m-form__group">
									<label>Bin</label>
									<input type="text" class="form-control m-input" name="bin_id" required="true">
								</div>

        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button class="btn btn-success save-data"  data-dismiss="modal"  id="btnupdate">Submit</button>
        </div>
      </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Location List</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !">+</button> </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead class=" text-primary">
                                <th>
                               Warehouse
                                </th>
                                <th>
                              Zone
                                </th>
								<th>
                             Rack
                                </th>
								<th>
                               Level
                                </th>
								<th>
                              Bin
                                </th>
                            </thead>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
@section('script')

    <script src="{{url('/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
load()
  $(".save-data").click(function(event) {
        event.preventDefault();

        let wh_id = $("select[name=wh_id]").val();
		let zone_id = $("input[name=zone_id]").val();
		let rack_id = $("input[name=rack_id]").val();
		let level_id = $("input[name=level_id]").val();
		let bin_id = $("input[name=bin_id]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ URL::to('/save-wh-location') }}",
            type: "POST",
            data: {
                wh_id: wh_id,
				zone_id: zone_id,
				rack_id: rack_id,
				level_id: level_id,
				bin_id: bin_id,
                _token: _token
            },
            success: function(response) {
                console.log(response);
                if (response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },
        });
        $('#wh_id').val('');
        $("input[name=zone_id]").val('');
        $("input[name=rack_id]").val('');
        $("input[name=level_id]").val('');
        $("input[name=bin_id]").val('');
        $('#table').DataTable().clear().destroy();
        load()
     
    });


    function load(){
		$("#table").DataTable( {
            processing: true,
               serverSide: true,
               "searchable":true,
               info:false,
            dom: 'Bfrtip',
    paging: false,
            ajax: {
                'url':"/wh-location-dt",
                'type':"get",
                'headers':{
                	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[   {
                data: function(data){
                    return data.warehouse.name
                }
            }, {
                data: "zone_id"
            }
            , {
                data: "rack_id"
            },
			{
                data: "level_id"
            },
			{
                data: "bin_id"
            },
          
            ],
          
        })
	}
</script>
@endsection


