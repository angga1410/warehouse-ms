@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="customerList">
@include('flash::message')
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">Customer List</h3>
			</div>
		</div>
	</div>
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
						</h3>
					</div>
				</div>
				<a href="{{url('/new-customer')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
					<span>
						<i class="la la-cart-plus"></i>
						<span>New Customer</span>
					</span>
				</a>
			</div>
			<input type="hidden" id="token" value="{{csrf_token()}}">
			<div class="m-portlet__body">
				<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
					<table class="table table-striped- table-bordered table-hover table-checkable" id="customer_list">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Address</th>
								<th>City</th>
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
@section('script')
<script type="text/javascript">
	$(function(){
		$("#customer_list").DataTable( {
			"processing": true,
        	"serverSide": true,
            ajax: {
                'url':"/customer-list-dt",
                'type':"post",
                'headers':{
                	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[ {
                data: "id"
            }
            , {
                data: "name"
            }
            , {
                data: "address"
            },
			{
                data: "city"
            },
            {
                data: function(data){
                    return '<a href="/customer/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
            ],
            "drawCallback":function(setting){

                $("#customer_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#customer_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-customer",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                    	
                        alert("Successfully Customer Deleted.");
                        $("#customer_list").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            }
        })
	});
</script>
@endsection
