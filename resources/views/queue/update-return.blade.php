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
                            Update Return
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="col-sm-12">
                <form method="post" action="{{url('/update-return')}}">
                <input type="hidden" name="return_id" value="{{$updateReturn->id}}">
                <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        {!! csrf_field() !!}
                        <div class="col-sm-6">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Supplier</label>
                                <select class="form-control m-input m-input--square" name="supplier_id" required="true">
                                <option>Select</option>
                                @foreach($suppliers as $supplier)
                                    <option @if($updateReturn->supplier_id == $supplier->id) selected="selected" @endif value="{{$supplier->id}}">{{$supplier->name}}</option>
                                @endforeach
                                </select>
                            </div>  

                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Mover</label>
                                <select class="form-control m-input m-input--square" name="mover_id" required="true">
                                <option value="0">Select</option>
                                @foreach($movers as $mover)
                                    <option @if($updateReturn->mover_id == $mover->id) selected="selected" @endif value="{{$mover->id}}">{{$mover->name}}</option>
                                @endforeach
                                </select>
                            </div> 
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Remark</label>
                                <textarea rows="5" class="form-control m-input" name="remark" required="true">{{$updateReturn->remark}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Document No.</label>
                                <input type="text" class="form-control m-input document_no" name="document_no" style="border: none;" readonly="true" required="true" value="{{$updateReturn->document_no}}">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Supplier Contact</label>
                                <input type="text" class="form-control m-input" name="supplier_contact" required="true" value="{{$updateReturn->supplier_contact}}">
                            </div>
                            <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">Return Status</label>
                                    <select class="form-control m-input m-input--square" name="return_status" required="true">
                                    <option @if($updateReturn['is_verified'] == 0) selected="selected" @endif value="0">Pending</option>
                                    <option @if($updateReturn['is_verified'] == 1) selected="selected" @endif value="1">Approve</option>
                                    <option @if($updateReturn['is_verified'] == 2) selected="selected" @endif value="2">Reject</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group table-responsive">
                        <table class="table m-table m-table--head-bg-metal new_raw_qcreturn m--margin-top-20" id="new_raw_qcreturn"> 
                        <thead>
                            <tr>
                              <th>Mfr.</th>
                              <th>Part Name</th>
                              <th>Product Number</th>
                              <th>Description</th>
                              <th>Qty Return</th>
                              <th>U/M</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($updateReturn->retirndetail as $itemList)
                            <input type="hidden" name="return_detail_id[]" value="{{$itemList->id}}">
                            <tr>
                              <td><input type="text" name="mfr[]" class="mfr form-control m-input" value="{{$itemList->products->mfr}}" style="width: 100px;border:none;" required="true"></td>
                              <td><input type="text" name="product_number[]" class="product_number form-control m-input" value="{{$itemList->products->product_number}}" style="width: 100px;border:none;"></td> 
                              <td><input type="text" name="part_name[]" class="part_name form-control m-input" value="{{$itemList->products->part_name}}" style="width: 100px;border:none;"></td> 
                              <td><textarea rows="1" class="form-control m-input" name="description[]" style="width: 150px;border:none;" required="true">{{$itemList->products->description}}</textarea></td>
                              <td><input type="text" name="qty_return[]" class="qty_po form-control m-input" value="{{$itemList->qty_return}}" style="width: 100px;" required="true"></td>
                              <td><input type="text" name="um[]" class="um form-control m-input" value="{{$itemList->products->um}}" style="width: 100px;border:none;" required="true"></td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                    <div class="form-group m-form__group text-center">
                        <button type="submit" class="btn btn-primary" id="btn_return" >Submit</button>
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