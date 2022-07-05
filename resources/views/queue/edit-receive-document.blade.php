@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Edit Receive Document
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/update-receive-document/'.$receiveDocuments->id)}}" enctype='multipart/form-data'>
				<div class="row">
					<div class="col-sm-12">
					  <div class="row">
						
						<div class="col-sm-6">
							
								
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Document No.</label>
									<input type="text" class="form-control m-input" readonly="true" name="document_no" value="{{$receiveDocuments->document_no}}" required="true" style="border:none;">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Reference RR</label>
									<input type="text" class="form-control m-input"  name="reference_rr" value="{{$receiveDocuments->reference_rr}}" required="true" >
								</div>
								<!-- <div class="form-group m-form__group">
									<label for="exampleInputEmail1">Reference Type</label>
									<select class="form-control m-input m-input--square" name="reference_type" required="true">
									<option @if($receiveDocuments->reference_type == 'external') selected="selected" @endif value="external">{{$receiveDocuments->reference_type}}</option>
									</select>
								</div> -->
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Reference</label>
									<select class="form-control m-input m-input--square" name="reference" required="true">
									<option @if($receiveDocuments->reference == 'external') selected="selected" @endif value="internal">{{$receiveDocuments->reference}}</option>
									</select>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Sender Name</label>
									<input type="text" class="form-control m-input" name="sender_name" value="{{$receiveDocuments->sender_name}}" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Sender Phone</label>
									<input type="text" class="form-control m-input" name="sender_phone" value="{{$receiveDocuments->sender_phone}}" required="true">
								</div>
								<div class="m-radio-inline">
									<label class="m-radio">
										<input type="radio" name="document_via" required="true" value="direct_from_source"  {{ $receiveDocuments->document_via == 'direct_from_source' ? 'checked' : '' }}>Direct Form Source 
										<span></span>
									</label>
									<label class="m-radio">
										<input type="radio" name="document_via" required="true" value="via_mover" {{ $receiveDocuments->document_via == 'via_mover' ? 'checked' : '' }}> 
										Via Mover
										<span></span>
									</label>
								</div><br>
								<!-- <div class="form-group m-form__group">
									<label for="exampleInputEmail1">Document Status</label>
									<select class="form-control m-input m-input--square" name="document_status" required="true">
									<option @if($receiveDocuments->is_verified == 0) selected="selected" @endif value="0">Pending</option>
									<option @if($receiveDocuments->is_verified == 1) selected="selected" @endif value="1">OK</option>
									<option @if($receiveDocuments->is_verified == 2) selected="selected" @endif value="2">Defect</option>
									</select>
								</div> -->
						</div>
								<!-- <div class="m-radio-inline">
								<label>Item Linked? </label>
									<label class="m-radio">
										<input type="radio" name="item_linked" {{ $receiveDocuments->item_linked == 1 ? 'checked' : '' }} value="1">Yes 
										<span></span>
									</label>
									<label class="m-radio">
										<input type="radio" name="item_linked" {{ $receiveDocuments->item_linked == 0 ? 'checked' : '' }} value="0"> 
										No
										<span></span>
									</label>
								</div> -->
						<div class="col-sm-6">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Source</label>
								<select class="form-control m-input m-input--square" name="source" required="true">
								<option @if($receiveDocuments->source == 'external') selected="selected" @endif value="external">{{$receiveDocuments->source}}</option>
								</select>
							</div>
							<!-- <div class="form-group m-form__group">
								<label for="exampleInputEmail1">Source Type</label>
								<select class="form-control m-input m-input--square" name="source_type" required="true">
								<option @if($receiveDocuments->source_type == 'supplier') selected="selected" @endif value="supplier">{{$receiveDocuments->source_type}}</option>
								</select>
							</div> -->
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">source Name</label>
								<!-- <input type="text" class="form-control m-input" name="source_name" value="{{$receiveDocuments->source_id}}" required="true"> -->
								<input type="text" class="form-control m-input" readonly="true" name="source_name" value="{{$receiveDocuments->source_name}}" required="true" readonly>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Remark</label>
								<textarea rows="5" class="form-control m-input" name="remark" required="true">{{$receiveDocuments->remark}}</textarea>
							</div>

							
							<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Document Status</label>
									<select class="form-control m-input m-input--square" name="status" required="true">
									<option @if($receiveDocuments->status == 0) selected="selected" @endif value="0">Outstanding</option>
									<option @if($receiveDocuments->status == 1) selected="selected" @endif value="1">Quality Check</option>
									<option @if($receiveDocuments->status == 2) selected="selected" @endif value="2">Dispatch To Warehouse </option>
								
									</select>
								</div>
							
							<div class="form-group m-form__group">
						
								<img src="/{{$receiveDocuments->attach_pic}}" height="150px" id="attach_pic"><br><br>
                            	<button type="button" id="change_attach_pic" class="btn btn-info">Change Attach Pic</button>
                                <input id="edit_attach_pic" type="file" name="edit_attach_pic" style="display: none;">
							</div>
						</div>
					  </div>
							<div class="form-group m-form__group text-center">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
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
	$(function(){
        $("#change_attach_pic").on("click", function(e){
            e.preventDefault();
            console.log();
            $("#edit_attach_pic").click();
        });

        $("#edit_attach_pic").change(function() {
            $("#attach_pic").attr("src",null);
            readURL(this, '#attach_pic');
        });
    });
    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(previewId).attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
