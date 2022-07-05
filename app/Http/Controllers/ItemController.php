<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Sup;
use App\Models\SupAddress;
use App\Models\SupContact;
use App\Models\Mover;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ItemProduct;
use App\User;
use App\Models\WarehouseLoc;
use App\Models\QcRequest;
use App\Models\QcRequestItemParts;
use App\Models\EntryQueueDetail;
use App\Models\Item;
use App\Models\SendItemsToWarehouse;
use App\Models\ReceiveItems;
use App\Models\ReceiveItemsDetail;
use App\Models\Warehouse;
use App\Models\WarehouseLocation;
use App\Models\TransferItem;
use App\Models\TransferItemDetail;
use App\Models\PickItem;
use App\Models\PickItemDetail;
use App\Models\SendItemFromWH;
use App\Models\ReceiveItemFromWH;
use App\Models\ReceiveItemFromWHDetail;
use App\Models\PackingItems;
use App\Models\PackingItemDetail;
use App\Models\SendingDoItems;
use App\Models\StoreItemRequest;
use App\Models\StoreItemRequestItem;
use App\Models\SendStoreItems;
use App\Models\ItemPartDetail;
use App\Models\MaterialRequest;
use App\Models\ReceiveDocument;
use App\Models\MaterialRequestItem;
use App\Models\StoreItems;
use App\Models\StoreItemsDetail;
use App\Models\ReceiveReport;
use App\Models\ReceiveReportDetail;
use App\Models\ReceiveReportSerialNo;
use App\Models\ReceiveReportDetailSerialNo;
use App\Models\QcReturn;
use App\Models\QcReturnItems;
use App\Models\ReturnReport;
use App\Models\ReturnReportDetail;
use App\Models\Inventory;
use Yajra\Datatables\Facades\Datatables;
use App\ResponseDto\DefaultResponse;
use Auth;
use Carbon\Carbon;
use App\Events\TransactionInventoryEvent;
use App\Models\ItemsReq;
use App\Models\PODetail;
use App\Models\PurchaseOrder;
use App\Models\ReserveStock;
use App\Models\SupplierVendor;
use App\Models\TransactionInventory;
use App\Models\WarehouseRacking;
use App\Models\PRDetail;
use App\Models\PurchaseRequest;
use App\Models\DocumentReq;
use App\Models\DocumentReqDetail;
use App\Models\OfficialReport;
use App\Models\OfficialReportDetail;
use App\Models\Employee;
use App\Models\InventoryProb;
use App\Models\StockOpname;
use App\Models\StockOpnameDetail;
use App\PoSupplierDetail;
use Guzzle\Http\Client as HttpClient;

class ItemController extends Controller
{
	public function ItemsProdID($id)
	{

		$records = ItemProduct::where('ProdID', $id)->select('id', 'mfr', 'part_num', 'part_name', 'part_desc', 'default_um', 'default_curr', 'sell_price', 'price_valid_until')->get();
		return json_decode($records);
	}
	public function getItemReq()
	{
		$items = ItemsReq::all();
		return $items;
	}
	public function saveItemReq(Request $request)
	{
		$items = $request->getContent();
		$get = collect(json_decode($items, true));


		// Parameters
		$check = ItemProduct::where('part_num', $get["part_num"])->where('part_desc', $get["part_desc"])->where('type', 2)->first();

		if ($check == null) {
			$pickItemDetail = new ItemProduct;

			$pickItemDetail->mfr = 	$get["mfr"];

			$pickItemDetail->part_num =	$get["part_num"];
			$pickItemDetail->part_name = 	$get["part_name"];
			$pickItemDetail->part_desc = 	$get["part_desc"];
			$pickItemDetail->default_um = 	$get["default_um"];
			$pickItemDetail->default_curr = 	$get["default_curr"];
			$pickItemDetail->type = $get["type"];

			$pickItemDetail->save();
			return $pickItemDetail->id;
		} else {
			return 0;
		}
	}
	public function ItemsDT()
	{

		$records = ItemProduct::select('id', 'mfr', 'part_num', 'part_name', 'part_desc', 'default_um', 'type')->get();
		return $records;
	}
	public function ItemsId($id)
	{

		$records = ItemProduct::where('id', $id)->select('id', 'mfr', 'part_num', 'part_name', 'part_desc', 'default_um')->first();
		return $records;
	}
	public function ItemsPartnum($part_num)
	{

		$records = ItemProduct::where('part_num', $part_num)->select('id')->first();
		return $records;
	}
	public function ItemsDTPrice()
	{

		$records = ItemProduct::where('type', 2)->select('id', 'mfr', 'part_num', 'part_name', 'part_desc', 'default_um', 'default_curr', 'sell_price', 'price_valid_until')->get();
		return json_decode($records);
	}
	public function ItemsDTMfr()
	{

		$records = ItemProduct::select('mfr')->groupBy('mfr')->get();
		return json_decode($records);
	}
	public function ItemsDTPartname()
	{

		$records = ItemProduct::select('part_name')->groupBy('part_name')->get();
		return json_decode($records);
	}
	public function ItemsIdPrice($id)
	{

		$records = ItemProduct::where('id', $id)->select('id', 'mfr', 'part_num', 'part_name', 'part_desc', 'default_um', 'default_curr', 'sell_price', 'price_valid_until')->first();
		return $records;
	}
	public function itemList()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.item-list", compact('warehouses'));
	}
	public function itemListDt(Request $request)
	{
		$itemList    = Item::with("user")->get();
		// return ["aaData" => $itemList,"iTotalDisplayRecords" => count($itemList),"iTotalRecords" => count($itemList),"sColumns" => "","sEcho" => 0];
		$datatableRes = new DefaultResponse($itemList);

		return $datatableRes->getResponse();
	}
	public function viewAddNewItem()
	{
		$users = User::where("status", 1)->get();
		$reports = ReceiveReport::where("status", 0)->get();
		$warehouses = Warehouse::with('warehouseLocation')->get();
		// $locations = WarehouseLocation::select('location')->get();
		return view("item.add-new-item", compact('users', 'reports', 'warehouses', 'locations'));
	}
	public function itemReportDetail($id)
	{
		$reportDetail = ReceiveReportDetail::where("receive_report_id", $id)->get();
		return $reportDetail;
	}
	public function addNewItem(Request $request)
	{
		//status 0 processing
		//status 1 sent
		//status 2 receive in warehouse
		//status 3 store in warehouse
		//return $request->all();
		$itemList = new Item;
		$itemList->document_no       = $request->get("document_no");
		$itemList->receive_report_id = $request->get("receive_report_id");
		$itemList->reference 		 = $request->get("reference");
		$itemList->reference_type 	 = $request->get("reference_type");
		$itemList->source 			 = $request->get("source");
		$itemList->source_type 		 = $request->get("source_type");
		$itemList->source_id 		 = $request->get("source_id");
		$itemList->source_reference  = $request->get("source_reference");
		$itemList->receiver_id 		 = $request->get("receiver_id");
		$itemList->user_id 			 = Auth::User()->id;
		// $itemList->item_name		= $request->get("item_name");
		$itemList->save();

		$reportStatus = ReceiveReport::where("id", $itemList->receive_report_id)->first();
		$reportStatus->status = 1;
		$reportStatus->update();


		$mfr           = $request->get("mfr");
		$part_name 	   = $request->get("part_name");
		$description   = $request->get("description");
		$qty_po        = $request->get("qty_receive");
		$um            = $request->get("um");
		$warehouse     = $request->get("warehouse");
		$location_rack = $request->get("location_rack");

		for ($i = 0; $i < count($mfr); $i++) {
			if ($mfr[$i] != null && $part_name[$i] != null && $description[$i] != null && $qty_po[$i] != null && $um[$i] != null && $warehouse[$i] != null && $location_rack[$i] != null) {

				$itemParthDetail = new ItemPartDetail;
				$itemParthDetail->item_id     	= $itemList->id;
				$itemParthDetail->mfr         	= $mfr[$i];
				$itemParthDetail->part_name   	= $part_name[$i];
				$itemParthDetail->description 	= $description[$i];
				$itemParthDetail->qty_po 	    = $qty_po[$i];
				$itemParthDetail->um          	= $um[$i];
				$itemParthDetail->warehouse   	= $warehouse[$i];
				$itemParthDetail->location_rack = $location_rack[$i];
				$itemParthDetail->save();
			}
		}

		flash()->success("Successfully Add New Item.")->important();
		return redirect()->to('/item-list');
	}
	public function itemPartList($item_id)
	{
		$itemParts = ItemPartDetail::where('item_id', $item_id)->get();
		return $itemParts;
	}
	public function deleteItem(Request $request)
	{
		Item::where("id", $request->get("id"))->delete();
		ItemPartDetail::where("item_id", $request->get("id"))->delete();
		return "success";
	}
	public function updateItemView($id)
	{
		$users = User::where("status", 1)->get();

		$warehouses = Warehouse::with('warehouseLocation')->get();
		$itemData = Item::with("itemdetail")->where("id", $id)->first();
		return view("item.update-item", compact('users', 'itemData', 'warehouses', 'locations'));
	}
	public function updateItem(Request $request)
	{
		//return $request->all();
		$itemList = Item::where("id", $request->get('item_id'))->first();
		$itemList->reference 		 = $request->get("reference");
		$itemList->reference_type 	 = $request->get("reference_type");
		$itemList->source 			 = $request->get("source");
		$itemList->source_type 		 = $request->get("source_type");
		$itemList->source_id 		 = $request->get("source_id");
		$itemList->source_reference  = $request->get("source_reference");
		$itemList->receiver_id 		 = $request->get("receiver_id");
		// $itemList->item_name		= $request->get("item_name");
		$itemList->update();

		$item_detail_id = $request->get("item_detail_id");
		$mfr           = $request->get("mfr");
		$part_name 	   = $request->get("part_name");
		$description   = $request->get("description");
		$qty_po        = $request->get("qty_receive");
		$um            = $request->get("um");
		$warehouse     = $request->get("warehouse");
		$location_rack = $request->get("location_rack");

		for ($i = 0; $i < count($item_detail_id); $i++) {
			if ($item_detail_id[$i] != null && $mfr[$i] != null && $part_name[$i] != null && $description[$i] != null && $qty_po[$i] != null && $um[$i] != null && $warehouse[$i] != null && $location_rack[$i] != null) {

				$itemParthDetail = ItemPartDetail::where("id", $item_detail_id[$i])->first();
				$itemParthDetail->mfr         	= $mfr[$i];
				$itemParthDetail->part_name   	= $part_name[$i];
				$itemParthDetail->description 	= $description[$i];
				$itemParthDetail->qty_po 	    = $qty_po[$i];
				$itemParthDetail->um          	= $um[$i];
				$itemParthDetail->warehouse   	= $warehouse[$i];
				$itemParthDetail->location_rack = $location_rack[$i];
				$itemParthDetail->update();
			}
		}

		flash()->success("Successfully Update Item.")->important();
		return redirect()->to('/item-list');
	}
	//receive Report

	public function reportList()
	{
		return view("item.report-list");
	}
	public function reportListDt()
	{
		$reportList = ReceiveReport::with("user", "mover", "supplier")->get();

		$datatableRes = new DefaultResponse($reportList);

		return $datatableRes->getResponse();
	}
	public function viewAddNewReport()
	{
		$rrnum = ReceiveReport::max('rr_num_seq');
		$rr = $rrnum + 1;
		$users = User::where("status", 1)->get();
		$movers = Mover::all();
		$suppliers = SupplierVendor::all();
		$qcpassData = QcRequest::where("status", 2)->with("user", "document")
			->get();



		// $documents = ReceiveDocument::where("status",1)->get();
		//$warehouses = Warehouse::with('warehouseLocation')->get();
		// $locations = WarehouseLocation::select('location')->get();
		return view("item.add-new-report", compact('users', 'movers', 'qcpassData', 'suppliers', 'rr'));
	}
	// public function reportType($type)
	// {
	// 	if($type == "qc_pass")
	// 	{
	// 		$qcpassData = QcRequest::where("status",2)->get();
	// 		$qcpassData = json_decode($qcpassData, true);
	// 		$qcpassData = array_merge(['items' => $qcpassData], ['type' => 'qc_pass']);
	// 		return $qcpassData;
	// 	}
	// 	else if($type == "verified_doc")
	// 	{
	// 		$documents = ReceiveDocument::where("is_verified",1)->where("status",0)->get();
	// 		$documents = json_decode($documents, true);
	// 		$documents = array_merge(['items' => $documents], ['type' => 'verified_doc']);
	// 		return $documents;
	// 	}
	// }
	public function poData($id)
	{

		$poData = PODetail::with("products")->where("pos_id", $id)->where('qty_delivered', '!=', 0)->get();

		return $poData;

		// else if($type == "verified_doc")
		// {
		// 	$documents = ReceiveDocument::where("id",$id)->first();
		// 	$documentsData = EntryQueueDetail::where("entry_queue_id",$documents->queue_id)->get();
		// 	return $documentsData;
		// }
	}

	public function reportData($id)
	{

		$qcpassData = QcRequestItemParts::with("products")->where("qc_request_id", $id)->get();
		return $qcpassData;
	}
	public function reportData2($id)
	{

		$qcpassData = QcRequestItemParts::with("products")->where("qc_request_id", $id)->get();
		return $qcpassData;
	}
	public function reportDataSup($id)
	{

		$qcpassData = Supplier::with("receive_document")->where("id", $id)->get();
		return $qcpassData;
	}



	public function addNewReport(Request $request)
	{
		//return $request->all();


		$reportList = new ReceiveReport;
		$reportList->document_no    = $request->get("document_no");
		$reportList->rr_num_seq    = $request->get("rr_num_seq");
		$reportList->rr_num    = $request->get("rr_num");
		$reportList->reference_id	= $request->get("reference_id");
		$reportList->reference_type = $request->get("reference_type");
		$reportList->source 		= $request->get("source");
		$reportList->source_type 	= $request->get("source_type");
		$reportList->source_id 	    = $request->get("source_id");
		$reportList->sender         = $request->get("sender");
		$reportList->sender_phone   = $request->get("sender_phone");
		$reportList->mover_id 	    = $request->get("mover_id");
		$reportList->remark		    = $request->get("remark");
		$reportList->save();


		// $qcpassData = QcRequest::where("id",$reportList->reference_id)->first();
		// $qcpassData->status = 1;
		// $qcpassData->update();

		// else if($reportList->reference_type == "verified_doc")
		// {
		// 	$documents = ReceiveDocument::where("id",$reportList->reference_id)->first();
		// 	$documents->status = 2;
		// 	$documents->update();

		// }
		$product_id   = $request->get("product_id");
		$mfr           = $request->get("mfr");
		$part_name 	   = $request->get("part_name");
		$description   = $request->get("description");
		$qty_receive   = $request->get("qty_receive");
		$um            = $request->get("um");
		$po_detail_id            = $request->get("po_detail_id");


		for ($i = 0; $i < count($product_id); $i++) {
			if ($product_id[$i] != null && $qty_receive[$i] != null) {

				$reportDetail = new ReceiveReportDetail;
				$reportDetail->receive_report_id = $reportList->id;
				$reportDetail->product_id        = $product_id[$i];

				$reportDetail->qty_receive 	     = $qty_receive[$i];
				$reportDetail->po_detail_id 	     = $po_detail_id[$i];

				$reportDetail->save();
			}
		}

		$qc = QcRequest::where('id', $reportList->reference_id)->first();
		$check_status = PODetail::where('pos_id', $qc->receive_document_id)->count();
		$blc_status = PODetail::where('pos_id', $qc->receive_document_id)->where('qty_delivered', 0)->count();

		if ($check_status == $blc_status) {
			$po = PurchaseOrder::where('id', $qc->receive_document_id)->first();

			$po->status = 2;
			$po->delivered_date = date('Y-m-d');
			$po->update();

			$qc = QcRequest::where('receive_document_id', $qc->receive_document_id)->first();

			$qc->status = 5;
			$qc->update();
		}
		flash()->success("Successfully Add New Receive Report.")->important();
		return redirect()->to('/report-list');
	}
	public function reportDetailList($item_id)
	{
		$reportsParts = ReceiveReportDetail::with('products')->where('receive_report_id', $item_id)->get();
		return $reportsParts;
	}
	public function deleteReport(Request $request)
	{
		ReceiveReport::where("id", $request->get("id"))->delete();
		ReceiveReportDetail::where("receive_report_id", $request->get("id"))->delete();
		return "success";
	}
	public function updateReportView($id)
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();
		$suppliers = Supplier::all();
		$reportLists = ReceiveReport::with("reportdetail")->where("id", $id)->first();
		return view("item.update-report", compact('users', 'movers', 'reportLists', 'suppliers'));
	}
	public function updateReport(Request $request)
	{
		//return $request->all();
		$reportList = ReceiveReport::where("id", $request->get("report_id"))->first();
		$reportList->source 		= $request->get("source");
		$reportList->source_type 	= $request->get("source_type");
		$reportList->source_id 	    = $request->get("source_id");
		$reportList->sender         = $request->get("sender");
		$reportList->sender_phone   = $request->get("sender_phone");
		$reportList->mover_id 	    = $request->get("mover_id");
		$reportList->remark		    = $request->get("remark");
		$reportList->update();

		$detail_id     = $request->get("detail_id");
		// $mfr           = $request->get("mfr");
		// $part_name 	   = $request->get("part_name");
		// $description   = $request->get("description");
		$qty_receive   = $request->get("qty_receive");
		// $um            = $request->get("um");


		for ($i = 0; $i < count($detail_id); $i++) {
			if ($detail_id[$i] != null &&  $qty_receive[$i] != null) {

				$reportDetail = ReceiveReportDetail::where("id", $detail_id[$i])->first();
				$reportDetail->receive_report_id = $reportList->id;
				// $reportDetail->mfr         	     = $mfr[$i];
				// $reportDetail->part_name   	     = $part_name[$i];
				// $reportDetail->description 	     = $description[$i];
				$reportDetail->qty_receive 	     = $qty_receive[$i];
				// $reportDetail->um          	     = $um[$i];
				$reportDetail->update();
			}
		}
		flash()->success("Successfully Update Receive Report.")->important();
		return redirect()->to('/report-list');
	}

	//receive report seial no
	public function reportListno()
	{
		return view("item.report-serial-list");
	}
	public function reportListDtno()
	{
		$reportList = ReceiveReportSerialNo::with("user", "mover", "supplier")->get();

		$datatableRes = new DefaultResponse($reportList);

		return $datatableRes->getResponse();
	}
	public function viewAddNewReportno()
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();
		$suppliers = Supplier::all();
		$qcpassData = QcRequest::where("status", 2)
			->orWhere("status", 4)
			->get();
		// $documents = ReceiveDocument::where("status",1)->get();
		//$warehouses = Warehouse::with('warehouseLocation')->get();
		// $locations = WarehouseLocation::select('location')->get();
		return view("item.add-new-report", compact('users', 'movers', 'qcpassData', 'suppliers'));
	}
	// public function reportType($type)
	// {
	// 	if($type == "qc_pass")
	// 	{
	// 		$qcpassData = QcRequest::where("status",2)->get();
	// 		$qcpassData = json_decode($qcpassData, true);
	// 		$qcpassData = array_merge(['items' => $qcpassData], ['type' => 'qc_pass']);
	// 		return $qcpassData;
	// 	}
	// 	else if($type == "verified_doc")
	// 	{
	// 		$documents = ReceiveDocument::where("is_verified",1)->where("status",0)->get();
	// 		$documents = json_decode($documents, true);
	// 		$documents = array_merge(['items' => $documents], ['type' => 'verified_doc']);
	// 		return $documents;
	// 	}
	// }
	public function reportDatano($id)
	{

		$qcpassData = QcRequestItemParts::with("products")->where("qc_request_id", $id)->get();
		return $qcpassData;

		// else if($type == "verified_doc")
		// {
		// 	$documents = ReceiveDocument::where("id",$id)->first();
		// 	$documentsData = EntryQueueDetail::where("entry_queue_id",$documents->queue_id)->get();
		// 	return $documentsData;
		// }
	}

	public function addNewReportno(Request $request)
	{
		//return $request->all();
		$reportList = new ReceiveReportSerialNo;
		$reportList->document_no    = $request->get("document_no");
		$reportList->reference_id	= $request->get("reference_id");
		$reportList->reference_type = $request->get("reference_type");
		$reportList->source 		= $request->get("source");
		$reportList->source_type 	= $request->get("source_type");
		$reportList->source_id 	    = $request->get("source_id");
		$reportList->sender         = $request->get("sender");
		$reportList->sender_phone   = $request->get("sender_phone");
		$reportList->mover_id 	    = $request->get("mover_id");
		$reportList->remark		    = $request->get("remark");
		$reportList->save();


		// $qcpassData = QcRequest::where("id",$reportList->reference_id)->first();
		// $qcpassData->status = 1;
		// $qcpassData->update();

		// else if($reportList->reference_type == "verified_doc")
		// {
		// 	$documents = ReceiveDocument::where("id",$reportList->reference_id)->first();
		// 	$documents->status = 2;
		// 	$documents->update();

		// }
		$product_id   = $request->get("product_id");
		// $mfr           = $request->get("mfr");
		// $part_name 	   = $request->get("part_name");
		// $description   = $request->get("description");
		$qty_receive   = $request->get("qty_receive");
		// $um            = $request->get("um");


		for ($i = 0; $i < count($product_id); $i++) {
			if ($product_id[$i] != null && $qty_receive[$i] != null) {

				$reportDetail = new ReceiveReportDetailSerialNo;
				$reportDetail->receive_report_id = $reportList->id;
				$reportDetail->product_id        = $product_id[$i];
				// $reportDetail->part_name   	     = $part_name[$i];
				// $reportDetail->description 	     = $description[$i];
				$reportDetail->qty_receive 	     = $qty_receive[$i];
				// $reportDetail->um          	     = $um[$i];
				$reportDetail->save();
			}
		}
		flash()->success("Successfully Add New Receive Report.")->important();
		return redirect()->to('/report-serial-list');
	}
	public function reportDetailListNo($item_id)
	{
		$reportsParts = ReceiveReportDetailSerialNo::with('products')->where('receive_report_id', $item_id)->get();
		return $reportsParts;
	}
	public function deleteReportno(Request $request)
	{
		ReceiveReportSerialNo::where("id", $request->get("id"))->delete();
		ReceiveReportDetailSerialNo::where("receive_report_id", $request->get("id"))->delete();
		return "success";
	}
	public function updateReportViewno($id)
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();
		$suppliers = Supplier::all();
		$reportLists = ReceiveReportSerialNo::with("reportdetail")->where("id", $id)->first();
		return view("item.update-report", compact('users', 'movers', 'reportLists', 'suppliers'));
	}
	public function updateReportno(Request $request)
	{
		//return $request->all();
		$reportList = ReceiveReportSerialNo::where("id", $request->get("report_id"))->first();
		$reportList->source 		= $request->get("source");
		$reportList->source_type 	= $request->get("source_type");
		$reportList->source_id 	    = $request->get("source_id");
		$reportList->sender         = $request->get("sender");
		$reportList->sender_phone   = $request->get("sender_phone");
		$reportList->mover_id 	    = $request->get("mover_id");
		$reportList->remark		    = $request->get("remark");
		$reportList->update();

		$detail_id     = $request->get("detail_id");
		// $mfr           = $request->get("mfr");
		// $part_name 	   = $request->get("part_name");
		// $description   = $request->get("description");
		$qty_receive   = $request->get("qty_receive");
		// $um            = $request->get("um");


		for ($i = 0; $i < count($detail_id); $i++) {
			if ($detail_id[$i] != null &&  $qty_receive[$i] != null) {

				$reportDetail = ReceiveReportDetailSerialNo::where("id", $detail_id[$i])->first();
				$reportDetail->receive_report_id = $reportList->id;
				// $reportDetail->mfr         	     = $mfr[$i];
				// $reportDetail->part_name   	     = $part_name[$i];
				// $reportDetail->description 	     = $description[$i];
				$reportDetail->qty_receive 	     = $qty_receive[$i];
				// $reportDetail->um          	     = $um[$i];
				$reportDetail->update();
			}
		}
		flash()->success("Successfully Update Receive Report Serial No.")->important();
		return redirect()->to('/report-serial-list');
	}


	//return report

	public function reportReturnList()
	{
		return view("item.report-return-list");
	}
	public function reportReturnListDt()
	{
		$reportReturnList = ReturnReport::with("user", "mover")->get();

		$datatableRes = new DefaultResponse($reportReturnList);

		return $datatableRes->getResponse();
	}
	public function viewAddNewReportReturn()
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();
		$returnData = QcReturn::where("is_verified", 1)->where("status", 0)->get();
		//$warehouses = Warehouse::with('warehouseLocation')->get();
		// $locations = WarehouseLocation::select('location')->get();
		return view("item.add-new-report-return", compact('users', 'movers', 'returnData'));
	}
	public function reportReturnData($id)
	{
		$qcReturnData = QcReturnItems::where("qc_return_id", $id)->get();
		return $qcReturnData;
	}
	public function addNewReportReturn(Request $request)
	{
		//return $request->all();
		$reportList = new ReturnReport;
		$reportList->document_no    = $request->get("document_no");
		$reportList->reference_id	= $request->get("reference_id");
		$reportList->source 		= $request->get("source");
		$reportList->source_type 	= $request->get("source_type");
		$reportList->source_id 	= $request->get("source_id");
		$reportList->sender         = $request->get("sender");
		$reportList->sender_phone   = $request->get("sender_phone");
		$reportList->mover_id 	    = $request->get("mover_id");
		$reportList->remark		    = $request->get("remark");
		$reportList->save();

		$qcpassData = QcReturn::where("id", $reportList->reference_id)->first();
		$qcpassData->status = 3;
		$qcpassData->update();

		$mfr           = $request->get("mfr");
		$part_name 	   = $request->get("part_name");
		$description   = $request->get("description");
		$qty_return   = $request->get("qty_return");
		$um            = $request->get("um");


		for ($i = 0; $i < count($mfr); $i++) {
			if ($mfr[$i] != null && $part_name[$i] != null && $description[$i] != null && $qty_return[$i] != null && $um[$i] != null) {

				$reportDetail = new ReturnReportDetail;
				$reportDetail->return_report_id  = $reportList->id;
				$reportDetail->mfr         	     = $mfr[$i];
				$reportDetail->part_name   	     = $part_name[$i];
				$reportDetail->description 	     = $description[$i];
				$reportDetail->qty_return 	     = $qty_return[$i];
				$reportDetail->um          	     = $um[$i];
				$reportDetail->save();
			}
		}
		flash()->success("Successfully Add New Return Report.")->important();
		return redirect()->to('/report-return-list');
	}
	public function reportReturnDetailList($item_id)
	{
		$reportReturnParts = ReturnReportDetail::where('return_report_id', $item_id)->get();
		return $reportReturnParts;
	}
	public function deleteReportReturn(Request $request)
	{
		ReturnReport::where("id", $request->get("id"))->delete();
		ReturnReportDetail::where("return_report_id", $request->get("id"))->delete();
		return "success";
	}
	public function updateReportReturnView($id)
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();

		$reportLists = ReturnReport::with("returndetail")->where("id", $id)->first();
		return view("item.update-report-return", compact('users', 'movers', 'reportLists'));
	}
	public function updateReportReturn(Request $request)
	{
		//return $request->all();
		$reportList = ReturnReport::where("id", $request->get("report_id"))->first();
		$reportList->source 		= $request->get("source");
		$reportList->source_type 	= $request->get("source_type");
		$reportList->source_id 	= $request->get("source_id");
		$reportList->sender         = $request->get("sender");
		$reportList->sender_phone   = $request->get("sender_phone");
		$reportList->mover_id 	    = $request->get("mover_id");
		$reportList->remark		    = $request->get("remark");
		$reportList->update();

		$detail_id     = $request->get("detail_id");
		$mfr           = $request->get("mfr");
		$part_name 	   = $request->get("part_name");
		$description   = $request->get("description");
		$qty_return    = $request->get("qty_return");
		$um            = $request->get("um");


		for ($i = 0; $i < count($detail_id); $i++) {
			if ($detail_id[$i] != null && $mfr[$i] != null && $part_name[$i] != null && $description[$i] != null && $qty_return[$i] != null && $um[$i] != null) {

				$reportDetail = ReturnReportDetail::where("id", $detail_id[$i])->first();
				$reportDetail->return_report_id = $reportList->id;
				$reportDetail->mfr         	     = $mfr[$i];
				$reportDetail->part_name   	     = $part_name[$i];
				$reportDetail->description 	     = $description[$i];
				$reportDetail->qty_return 	     = $qty_return[$i];
				$reportDetail->um          	     = $um[$i];
				$reportDetail->update();
			}
		}
		flash()->success("Successfully Update Return Report.")->important();
		return redirect()->to('/report-return-list');
	}
	//send items to warehouse
	public function sendItemsToWHList()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.senditems-towh-list", compact('warehouses'));
	}
	public function sendItemsToWHListDt(Request $request)
	{
		$sendItesToWHList = SendItemsToWarehouse::all()->map(function ($i) {
			$i->user;
			$i->sender;
			$i->document;

			return $i;
		});
		// $sendItesToWHList = SendItemsToWarehouse::with("user", "sender", "document")->get();

		$datatableRes = new DefaultResponse($sendItesToWHList);

		return $datatableRes->getResponse();
	}
	public function deleteSendItemsToWH(Request $request)
	{
		SendItemsToWarehouse::where("id", $request->get('id'))->delete();
		return "success";
	}
	public function sendItemsToWHDetail($rr_id)
	{
		$itemParts = ReceiveReportDetail::with('products')->where('receive_report_id', $rr_id)->get();
		return $itemParts;
	}
	public function sendItemToWH()
	{
		// $itemLists = Item::where("status",0)->get();
		$itemLists = ReceiveReport::where("status", 0)->with("document")->get();
		$users = User::where("status", 1)->get();
		return view('item.sendItems-toWharehouse', compact('itemLists', 'users'));
	}
	public function sendItemToWHData($item_id)
	{
		$itemParts = ReceiveReportDetail::with('products')->where('receive_report_id', $item_id)->get();
		return $itemParts;
	}
	public function addSendItemToWH(Request $request)
	{

		//status 0 Processing
		//status 1 received item in warehouse
		//status 2 store item in warehouse
		$addsendItems = new SendItemsToWarehouse;
		$addsendItems->receive_report_id = $request->get("item_id");
		$addsendItems->document_no = $request->get("document_no");
		$addsendItems->sender_id = $request->get("sender");
		$addsendItems->handover_by_id = $request->get("handover_by_id");
		$addsendItems->save();

		$item = ReceiveReport::where("id", $request->get("item_id"))->first();
		$item->status = 1;
		$item->update();

		flash()->success("Successfully Sent Items To Warehouse.")->important();
		return redirect()->to('/senditems-towh-list');
	}

	//receive Items = warehouse
	public function receiveItemWHList()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.receive-items-list", compact('warehouses'));
	}
	public function receiveItemWHListDt(Request $request)
	{
		$receiveItemsWh = ReceiveItems::all()->map(function ($i) {
			$i->user;
			$i->sender;


			return $i;
		});
		//	$receiveItemsWh = ReceiveItems::with("user", "sender")->get();

		$datatableRes = new DefaultResponse($receiveItemsWh);

		return $datatableRes->getResponse();
	}
	public function receiveItemWHDetail($id)
	{
		$receiveItemDetail = ReceiveItemsDetail::with('products')->where('receive_items_id', $id)->get();
		return $receiveItemDetail;
	}
	public function deleteReceiveItemWH(Request $request)
	{
		ReceiveItems::where("id", $request->get('id'))->delete();
		ReceiveItemsDetail::where("receive_items_id", $request->get('id'))->delete();
		return "success";
	}
	public function receiveItemsWH()
	{
		$users = User::where("status", 1)->get();
		$sendItemsToWH = SendItemsToWarehouse::with("document")->get();
		return view("item.receive-items", compact('sendItemsToWH', 'users'));
	}
	public function receiveItemsWHType($type)
	{
		if ($type == "dispatch_order") {
			$sendItemsToWH = SendItemsToWarehouse::where("status", 0)->with("document")->get();
			$sendItemsToWH = json_decode($sendItemsToWH, true);
			$sendItemsToWH = array_merge(['items' => $sendItemsToWH], ['type' => 'dispatch_order']);
			return $sendItemsToWH;
		} else if ($type == "internal_department") {
			$sendStoreRequest = SendStoreItems::where("status", 0)->select('id', 'store_item_request_id')->get();
			$sendStoreRequest = json_decode($sendStoreRequest, true);
			$sendStoreRequest = array_merge(['items' => $sendStoreRequest], ['type' => 'internal_department']);
			return $sendStoreRequest;
		}
	}
	public function receiveItemWHData($item_val, $type)
	{

		if ($type == "internal_department") {
			$storeItemreq = StoreItemRequestItem::with('products')->where("store_item_request_id", $item_val)->get();
			return $storeItemreq;
		} else if ($type == "dispatch_order") {
			$itemPart = ReceiveReportDetail::with('products')->where("receive_report_id", $item_val)->get();
			$handover = SendItemsToWarehouse::where('receive_report_id', $item_val)->select('sender_id')->first();
			$sender = User::where('id', $handover->sender_id)->first();

			// dd([
			// 	'itemPart' => $itemPart,
			// 	'id' => $sender->id,
			// 	'name' => $sender->name
			//   ]);
			return [
				'itemPart' => $itemPart,
				'id' => $sender->id,
				'name' => $sender->name
			];
		}
	}
	public function addReceiveItemWH(Request $request)
	{
		//return $request->all();
		//status 0 Processing
		//status 1 Store in warehouse
		$receiveItem = new ReceiveItems;
		$receiveItem->reference_type = $request->get("reference_type");
		$receiveItem->reference_id   = $request->get("reference_id");
		$receiveItem->document_no   = $request->get("document_no");
		$receiveItem->sender_id      = $request->get("sender");
		$receiveItem->received_by_id = $request->get("received_by_id");
		$receiveItem->save();

		if ($receiveItem->reference_type == 'dispatch_order') {

			$sendItemToWH = SendItemsToWarehouse::where("receive_report_id", $receiveItem->reference_id)->first();
			$sendItemToWH->status = 1;
			$sendItemToWH->update();

			$itemStatus = ReceiveReport::where("id", $sendItemToWH->receive_report_id)->first();
			$itemStatus->status = 1;
			$itemStatus->update();
		} else if ($receiveItem->reference_type == "internal_department") {
			$sendStoreItem = SendStoreItems::where("id", $receiveItem->reference_id)->first();
			$sendStoreItem->status = 0;
			$sendStoreItem->update();

			$storeItem = StoreItemRequest::where("id", $sendStoreItem->store_item_request_id)->first();
			$storeItem->status = 1;
			$storeItem->update();
		}

		$product_id    = $request->get('product_id');
		$mfr           = $request->get("mfr");
		$part_name     = $request->get('part_name');
		$description   = $request->get('description');
		$um       	   = $request->get("um");
		$qty_receive   = $request->get("qty_receive");
		$warehouse     = $request->get("warehouse");
		$location_rack = $request->get("location_rack");

		for ($i = 0; $i < count($product_id); $i++) {
			if ($product_id[$i] != null && $qty_receive[$i] != null) {

				$receiveItemDetail = new ReceiveItemsDetail;
				$receiveItemDetail->receive_items_id  = $receiveItem->id;
				$receiveItemDetail->mfr        = $mfr[$i];
				$receiveItemDetail->product_id        = $product_id[$i];
				$receiveItemDetail->part_name	   	  = $part_name[$i];
				$receiveItemDetail->description   	  = $description[$i];
				$receiveItemDetail->um	           	  = $um[$i];
				$receiveItemDetail->qty_receive    	  = $qty_receive[$i];
				// $receiveItemDetail->warehouse 	   	  = $warehouse[$i];
				// $receiveItemDetail->location_rack 	  = $location_rack[$i];
				$receiveItemDetail->save();
			}
		}



		flash()->success("Successfully Receive Items.")->important();
		return redirect()->to('/receive-itemwh-list');
	}

	//store Item
	public function storeItemsDetailList()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.store-items-list", compact('warehouses'));
	}
	public function storeItemsListDt(Request $request)
	{
		$storeItems = StoreItems::with("user")->get();

		$datatableRes = new DefaultResponse($storeItems);

		return $datatableRes->getResponse();
	}
	public function storeItemsDetail($id)
	{
		$receiveItemDetail = StoreItemsDetail::with('products')->where('store_items_id', $id)->get();
		return $receiveItemDetail;
	}
	public function deleteStoreItems(Request $request)
	{
		StoreItems::where("id", $request->get('id'))->delete();
		StoreItemsDetail::where("store_items_id", $request->get('id'))->delete();
		return "success";
	}
	public function storeItemList()
	{
		$warehouses = WarehouseLoc::orderBy('wh_id', 'DESC')->with('warehouse')->get();
		$locations = WarehouseLocation::get();
		$racks = WarehouseRacking::get();
		$users = User::where("status", 1)->get();
		return view("item.store-items", compact('users', 'warehouses', 'locations', 'racks'));
	}
	public function storeItemsData($receive_val)
	{
		$receiveItemPart = ReceiveItemsDetail::with('products')->with('inventory.warehouse.warehouse')->where("receive_items_id", $receive_val)->get();
		return $receiveItemPart;
	}
	public function storeItemsType($type)
	{
		$reciveItems = ReceiveItems::where("status", 0)->where("reference_type", $type)->with("rr")->get();
		// dd($reciveItems);
		return $reciveItems;
	}
	public function addStoreItem(Request $request)
	{
		//return $request->all();
		$storeItems = new StoreItems;
		$storeItems->reference_type = $request->get("reference_type");
		$storeItems->reference_id   = $request->get("reference_id");
		$storeItems->storer_id      = $request->get("storer_id");
		$storeItems->save();

		$receiveStatus = ReceiveItems::where("id", $storeItems->reference_id)->first();
		$receiveStatus->status = 1;
		$receiveStatus->update();

		if ($storeItems->reference_type == 'dispatch_order') {

			$sendItemToWH = SendItemsToWarehouse::where("receive_report_id", $receiveStatus->reference_id)->first();
			$sendItemToWH->status = 2;
			$sendItemToWH->update();

			$itemStatus = ReceiveReport::where("id", $sendItemToWH->receive_report_id)->first();
			$itemStatus->status = 3;
			$itemStatus->update();
		} else if ($storeItems->reference_type == "internal_department") {
			$sendStoreItem = SendStoreItems::where("id", $receiveStatus->reference_id)->first();
			$sendStoreItem->status = 2;
			$sendStoreItem->update();

			$storeItem = StoreItemRequest::where("id", $sendStoreItem->store_item_request_id)->first();
			$storeItem->status = 3;
			$storeItem->update();
		}

		$product_id    = $request->get("product_id");
		$mfr           = $request->get("mfr");
		$part_name 	   = $request->get("part_name");
		$description   = $request->get("description");
		$qty_store     = $request->get("qty_store");
		$um            = $request->get("um");
		$warehouse_id     = $request->get("warehouse_id");
		// $location_id = $request->get("location_id");
		// $rack_id = $request->get("rack_id");

		for ($i = 0; $i < count($product_id); $i++) {
			if ($product_id[$i] != null && $qty_store[$i] != null) {
				$storeItemsParts = new StoreItemsDetail;
				$storeItemsParts->store_items_id = $storeItems->id;
				$storeItemsParts->product_id     = $product_id[$i];
				$storeItemsParts->mfr         	 = $mfr[$i];
				$storeItemsParts->part_name 	 = $part_name[$i];
				$storeItemsParts->description 	 = $description[$i];
				$storeItemsParts->qty_store 	 = $qty_store[$i];
				$storeItemsParts->um          	 = $um[$i];
				$storeItemsParts->warehouse      = $warehouse_id[$i];
				// $storeItemsParts->location_id  = $location_id[$i];
				// $storeItemsParts->rack_id  = $rack_id[$i];
				$storeItemsParts->save();


				$inventoryDetail  = new Inventory;

				$inventory = $inventoryDetail->where("product_id", $product_id[$i])->where("warehouse_id", $warehouse_id[$i])->first();

				if ($inventory != null) {
					$inventory->qty = $inventory->qty + $qty_store[$i];
					$inventory->qty_balance = $inventory->qty_balance + $qty_store[$i];
					$inventory->update();
					event(new TransactionInventoryEvent("store", $storeItems->id, $inventory->id, $qty_store[$i], null));
				} else {

					$inventoryDetail->product_id   = $product_id[$i];
					$inventoryDetail->warehouse_id = $warehouse_id[$i];
					// $inventoryDetail->location_id  = $location_id[$i];
					// $inventoryDetail->rack_id  = $rack_id[$i];
					$inventoryDetail->qty          = $qty_store[$i];
					$inventoryDetail->qty_balance          = $qty_store[$i];
					$inventoryDetail->status       = 0;
					$inventoryDetail->save();

					event(new TransactionInventoryEvent("store", $storeItems->id, $inventoryDetail->id, $qty_store[$i], null));
				}
			}
		}


		flash()->success("Successfully Store Items.")->important();
		return redirect()->to('/storing');
	}

	// Material Request
	public function materialRequest()
	{
		return view('item.material-request');
	}
	public function materialRequestDt()
	{
		$materialRequestList = MaterialRequest::where("reference_type", "internal_department")->with("user", 'supplier')->get();

		$datatableRes = new DefaultResponse($materialRequestList);

		return $datatableRes->getResponse();
	}
	public function DODt()
	{
		$materialRequestList = MaterialRequest::where("reference_type", "dispatch_order")->with("user", 'supplier')->get();

		$datatableRes = new DefaultResponse($materialRequestList);

		return $datatableRes->getResponse();
	}
	public function viewAddNewMaterialRequest()
	{

		$client = new \GuzzleHttp\Client();
		$response = $client->request('GET', 'https://gw.iotech.my.id/ppic/materialrequests?status=0');
		$content = $response->getBody()->getContents();
		$content = json_decode($content, true);

		$users = User::where("status", 1)->get();
		$suppliers = Supplier::all();
		return view('item.add-new-material-request', compact('users', 'suppliers', 'content'));
	}
	public function addMaterialRequest(Request $request)
	{

		if ($request->get("do") == 1) {
			$client = new \GuzzleHttp\Client();
			$url = "https://gw.iotech.my.id/ppic/materialrequests";
			$array = array(
				"id" => $request->get("id"),
				"name" => $request->get("name"),
				"status" => 1,
				"createdAt" =>  $request->get("createdAt")

			);
			$data = json_encode($array);


			$requestAPI = $client->post($url, [
				'headers' => ['Content-Type' => 'application/json'],
				'body' => $data
			]);


			$materialRequest = new MaterialRequest;
			$materialRequest->mr_name      = $request->get("name");
			$materialRequest->reference_type = $request->get("reference_type");
			$materialRequest->reference      = $request->get("reference");
			$materialRequest->source         = $request->get("source");
			$materialRequest->source_type    = $request->get("source_type");
			$materialRequest->source_id      = $request->get("receive_document_id");
			$materialRequest->requester_id   = $request->get("requester_id");
			$materialRequest->remark   = $request->get("remark");
			$materialRequest->user_id        = Auth::User()->id;
			$materialRequest->save();


			$product_id	   = $request->get("product_id");
			// $mfr           = $request->get("mfr");
			// $part_name 	   = $request->get("part_name");
			// $description   = $request->get("description");
			$qty_request   = $request->get("qty_request");
			// $um            = $request->get("um");
			$warehouse     = $request->get("warehouse");
			$location_rack = $request->get("location_rack");

			for ($i = 0; $i < count($product_id); $i++) {
				if ($product_id[$i] != null && $qty_request[$i] != null) {
					$materialParts = new MaterialRequestItem;
					$materialParts->material_request_id = $materialRequest->id;
					$materialParts->product_id			= $product_id[$i];
					// $materialParts->mfr         		= $mfr[$i];
					// $materialParts->part_name 	 		= $part_name[$i];
					// $materialParts->description 		= $description[$i];
					$materialParts->qty_request 		= $qty_request[$i];
					$materialParts->type          		= 0;
					$materialParts->warehouse           = $warehouse[$i];
					// $materialParts->location_rack       = $location_rack[$i];
					$materialParts->save();
				}
			}
		} else {
			$id = $request->get("id");
			$client = new \GuzzleHttp\Client();
			$response = $client->request('GET', 'http://127.0.0.1:8080/api/update-do/' . $id);


			$materialRequest = new MaterialRequest;
			$materialRequest->mr_name      = $request->get("name");
			$materialRequest->reference_type = $request->get("reference_type");
			$materialRequest->reference      = $request->get("reference");
			$materialRequest->source         = $request->get("source");
			$materialRequest->source_type    = $request->get("source_type");
			$materialRequest->source_id      = $request->get("receive_document_id");
			$materialRequest->requester_id   = $request->get("requester_id");
			$materialRequest->remark   = $request->get("remark");
			$materialRequest->user_id        = Auth::User()->id;
			$materialRequest->save();


			$product_id	   = $request->get("product_id");
			// $mfr           = $request->get("mfr");
			// $part_name 	   = $request->get("part_name");
			// $description   = $request->get("description");
			$qty_request   = $request->get("qty_request");
			// $um            = $request->get("um");
			$warehouse     = $request->get("warehouse");
			$location_rack = $request->get("location_rack");

			for ($i = 0; $i < count($product_id); $i++) {
				if ($product_id[$i] != null && $qty_request[$i] != null) {
					$materialParts = new MaterialRequestItem;
					$materialParts->material_request_id = $materialRequest->id;
					$materialParts->product_id			= $product_id[$i];
					// $materialParts->mfr         		= $mfr[$i];
					// $materialParts->part_name 	 		= $part_name[$i];
					// $materialParts->description 		= $description[$i];
					$materialParts->qty_request 		= $qty_request[$i];
					$materialParts->type          		= 1;
					$materialParts->warehouse           = $warehouse[$i];
					// $materialParts->location_rack       = $location_rack[$i];
					$materialParts->save();
				}
			}
		}


		flash()->success("Successfully Add Request.")->important();
		return redirect()->to('/material-request');
	}
	public function materialRequestPartList($m_request_id)
	{
		$itemParts = MaterialRequestItem::with('products')->where('material_request_id', $m_request_id)->get();
		return $itemParts;
	}
	public function editMaterialRequest($id)
	{
		$users = User::where("status", 1)->get();
		$materialData = MaterialRequest::with('materialrequest', 'user')
			->where("id", $id)->first();
		// $materialData = json_decode($materialData,true);
		$suppliers = Supplier::all();
		return view('item.edit-material-request', compact('materialData', 'users', 'suppliers'));
	}
	public function updateMaterialRequest(Request $request)
	{
		//return $request->all();
		$updateRequest = MaterialRequest::where("id", $request->get("request_id"))->first();
		// $updateRequest->reference_type = $request->get("reference_type");
		$updateRequest->reference      = $request->get("reference");
		$updateRequest->source         = $request->get("source");
		$updateRequest->source_type    = $request->get("source_type");

		$updateRequest->requester_id   = $request->get("requester_id");
		// $updateRequest->user_id        = Auth::User()->id;
		$updateRequest->is_approve     = $request->get("request_status");
		$updateRequest->update();

		$material_request_item_id            = $request->get("material_request_item_id");
		// $item_id	   = $request->get("item_id");
		// $mfr           = $request->get("mfr");
		// $part_name 	   = $request->get("part_name");
		// $description   = $request->get("description");
		$qty_request   = $request->get("qty_request");
		// $um            = $request->get("um");


		for ($i = 0; $i < count($material_request_item_id); $i++) {
			if ($material_request_item_id[$i] != null && $qty_request[$i] != null) {
				$materialParts = MaterialRequestItem::where('id', $material_request_item_id[$i])->first();
				// $materialParts->material_request_id = $updateRequest->id;
				//         	$materialParts->item_id			    = $item_id[$i];
				// $materialParts->mfr         		= $mfr[$i];
				// $materialParts->part_name 	 		= $part_name[$i];
				// $materialParts->description 		= $description[$i];
				$materialParts->qty_request 		= $qty_request[$i];
				// $materialParts->um          		= $um[$i];

				$materialParts->update();
			}
		}
		flash()->success("Successfully Update Request.")->important();
		return redirect()->to('/material-request');
	}
	public function itemData(Request $request)
	{
		$term = $request->get('term');

		$data = ItemProduct::where('part_num', 'LIKE', '%' . $term . '%')->orWhere('part_name', 'LIKE', '%' . $term . '%')->orWhere('mfr', 'LIKE', '%' . $term . '%')->get();

		$results = array();

		foreach ($data as $query) {
			$results[] = ['id' => $query->id, 'mfr' => $query->mfr, 'part_num' => $query->part_num, 'part_name' => $query->part_name, 'part_desc' => $query->part_desc, 'qty' => $query->qty, 'default_um' => $query->default_um, 'default_curr' => $query->default_curr, 'sell_price' => $query->sell_price, 'price_valid_until' => $query->price_vlid_until];
		}
		return response()->json($results);
	}
	public function itemDataAll(Request $request)
	{
		$part_name = $request->get('part_name');
		$mfr = $request->get('mfr');
		$part_desc = $request->get('part_desc');
		$part_num = $request->get('part_num');
		$type = $request->get('type');

		$data = ItemProduct::where('mfr', 'LIKE', '%' . $mfr . '%')->where('part_name', 'LIKE', '%' . $part_name . '%')->where('part_desc', 'LIKE', '%' . $part_desc . '%')->where('part_num', 'LIKE', '%' . $part_num . '%')->where('type', $type)->get();

		$results = array();

		foreach ($data as $query) {
			$results[] = ['id' => $query->id, 'mfr' => $query->mfr, 'part_num' => $query->part_num, 'part_name' => $query->part_name, 'part_desc' => $query->part_desc, 'qty' => $query->qty, 'default_um' => $query->default_um, 'default_curr' => $query->default_curr, 'sell_price' => $query->sell_price, 'price_valid_until' => $query->price_vlid_until];
		}
		return response()->json($results);
	}
	public function deleteMaterialParts(Request $request)
	{
		MaterialRequestItem::where("id", $request->get("id"))->delete();
		return redirect()->back();
	}
	public function deleteMR(Request $request)
	{
		MaterialRequest::where("id", $request->get("id"))->delete();
		MaterialRequestItem::where("material_request_id", $request->get("id"))->delete();
		return "success";
	}
	//transfer items
	public function transferItemDetailList()
	{
		$warehouses = Warehouse::get();
		$warehousesLocation = WarehouseLocation::get();
		$warehousesRacking = WarehouseRacking::get();
		return view("item.transfer-item-list", compact('warehouses', 'warehousesLocation', 'warehousesRacking'));
	}
	public function transferItemListDt()
	{
		// $inventoryList = Inventory::with("products", "warehouse", "location")->get();
		$transferItemsDetail = TransferItem::with('warehouse1.warehouse', 'warehouse2.warehouse')->get();

		$datatableRes = new DefaultResponse($transferItemsDetail);

		return $datatableRes->getResponse();
	}
	public function transferItemDetail($id)
	{
		$Details = TransferItemDetail::with('products')->where('transfer_items_id', $id)->get();
		return $Details;
	}
	public function deletetransferItem(Request $request)
	{
		TransferItem::where("id", $request->get('id'))->delete();
		TransferItemDetail::where("transfer_items_id", $request->get('id'))->delete();
		return "success";
	}
	public function transferItem()
	{
		$wh = WarehouseLoc::with('warehouse')->get();
		$users = User::where("status", 1)->get();
		return view("item.transfer-item", compact('wh', 'users'));
	}
	public function addTransferItem(Request $request)
	{
		$product_id = $request->get("product_id");
		$qty        = $request->get("qty");
		$qty_balance        = $request->get("qty_balance");
		$qty_reserve        = $request->get("qty_reserve");
		$inventory_id = $request->get("inventory_id");
		$wh_location = $request->get("wh_location");




		for ($i = 0; $i < count($product_id); $i++) {

			$transferItem = new TransferItem;
			$transferItem->from_location = $wh_location[$i];
			$transferItem->to_location  = $request->get("to_location");
			$transferItem->user_id            = $request->get("user_id");
			$transferItem->remark            = $request->get("remark");
			$transferItem->status            = 0;
			$transferItem->save();

			$transferItemDetail = new TransferItemDetail;
			$transferItemDetail->transfer_items_id = $transferItem->id;
			$transferItemDetail->product_id		   = $product_id[$i];
			$transferItemDetail->qty         	   = $qty[$i];
			$transferItemDetail->save();

			$store = new Inventory;
			$store->product_id = $product_id[$i];
			$store->warehouse_id = $request->get("to_location");
			$store->qty = $qty[$i];
			$store->qty_reserve = $qty_reserve[$i];
			$store->qty_balance = $qty_balance[$i];
			$store->save();

			event(new TransactionInventoryEvent("transfer", $transferItem->id, $inventory_id[$i], null, $qty[$i]));
			event(new TransactionInventoryEvent("transfer", $transferItem->id, $store->id, $qty[$i], null));

			Inventory::where('id', $inventory_id[$i])->delete();
		}

		flash()->success("Successfully Transfer Items.")->important();
		return redirect()->to('/transfer-item-list');
	}
	public function transferItemsData(Request $request)
	{
		$term = $request->get('term');

		$data = ItemProduct::where('part_num', 'LIKE', '%' . $term . '%')->orWhere('part_name', 'LIKE', '%' . $term . '%')->orWhere('part_desc', 'LIKE', '%' . $term . '%')->get();

		$results = array();

		foreach ($data as $query) {
			$results[] = ['id' => $query->id, 'mfr' => $query->mfr, 'part_num' => $query->part_num, 'part_name' => $query->part_name, 'part_desc' => $query->part_desc, 'qty' => $query->qty, 'default_um' => $query->default_um];
		}
		return response()->json($results);
	}
	//pick Items

	public function PickItemsDetailList()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.pick-items-list", compact('warehouses'));
	}
	public function PickItemsListDt(Request $request)
	{
		$pickItem = PickItem::with("user")->get();

		$datatableRes = new DefaultResponse($pickItem);

		return $datatableRes->getResponse();
	}
	public function PickItemsDetail($id)
	{
		$receiveItemDetail = PickItemDetail::with('products')->where('pick_item_id', $id)->get();
		return $receiveItemDetail;
	}
	public function deletePickItems(Request $request)
	{
		PickItem::where("id", $request->get('id'))->delete();
		PickItemDetail::where("pick_item_id", $request->get('id'))->delete();
		return "success";
	}
	public function pickItemData($request_val)
	{
		$data = MaterialRequestItem::with('products')->where('material_request_id', $request_val)->get();


		$results = array();

		foreach ($data as $query) {
			$inventory = Inventory::where('id', $query->warehouse)->with('products')->with('warehouse.warehouse')->first();
			// dd($inventory);
			if ($inventory != null) {
				if ($inventory->warehouse->wh_name == null) {
					$results[] = ['id' => $inventory->products->id, 'mfr' => $inventory->products->mfr, 'part_num' => $inventory->products->part_num, 'part_name' => $inventory->products->part_name, 'part_desc' => $inventory->products->part_desc, 'qty' => $query->qty_request, 'default_um' => $inventory->products->default_um, 'location' => "", 'warehouse' => $inventory->warehouse->warehouse->name, 'wh_id' => $inventory->warehouse->id, 'mr_detail_id' => $query->id];
				} else {
					$results[] = ['id' => $inventory->products->id, 'mfr' => $inventory->products->mfr, 'part_num' => $inventory->products->part_num, 'part_name' => $inventory->products->part_name, 'part_desc' => $inventory->products->part_desc, 'qty' => $query->qty_request, 'default_um' => $inventory->products->default_um, 'location' => $inventory->warehouse->wh_name, 'warehouse' => $inventory->warehouse->warehouse->name, 'wh_id' => $inventory->warehouse->id, 'mr_detail_id' => $query->id];
				}
			} else {
				continue;
			}
		}

		// dd(response()->json($results));
		return response()->json($results);
	}

	public function pickItemDataReqDoc($request_val)
	{
		$data = DocumentReqDetail::with('item')->where('doc_id', $request_val)->get();
		// dd($data);

		$results = array();

		foreach ($data as $query) {
			$inv = Inventory::where('product_id', $query->product_id)->with('products')->with('warehouse.warehouse')->get();
			// dd($inventory);

			foreach ($inv as $inventory) {
				if ($inventory != null) {
					if ($inventory->warehouse->wh_name == null) {
						$results[] = ['id' => $inventory->products->id, 'mfr' => $inventory->products->mfr, 'part_num' => $inventory->products->part_num, 'part_name' => $inventory->products->part_name, 'part_desc' => $inventory->products->part_desc, 'qty' => $query->qty, 'default_um' => $inventory->products->default_um, 'location' => "", 'warehouse' => $inventory->warehouse->warehouse->name, 'wh_id' => $inventory->warehouse->id, 'mr_detail_id' => $query->id];
					} else {
						$results[] = ['id' => $inventory->products->id, 'mfr' => $inventory->products->mfr, 'part_num' => $inventory->products->part_num, 'part_name' => $inventory->products->part_name, 'part_desc' => $inventory->products->part_desc, 'qty' => $query->qty, 'default_um' => $inventory->products->default_um, 'location' => $inventory->warehouse->wh_name, 'warehouse' => $inventory->warehouse->warehouse->name, 'wh_id' => $inventory->warehouse->id, 'mr_detail_id' => $query->id];
					}
				} else {
					continue;
				}
			}
		}

		// dd(response()->json($results));
		return response()->json($results);
	}
	public function pickItem()
	{

		$warehouses = Warehouse::with('warehouseLocation')->get();
		$users = User::where("status", 1)->get();

		return view("item.pick-item", compact('warehouses', 'users'));
	}
	public function pickItemReqDoc()
	{

		$warehouses = Warehouse::with('warehouseLocation')->get();
		$users = User::where("status", 1)->get();
		$document = DocumentReq::where('status', 0)->get();
		// dd($document);
		return view("item.pick-item-req-doc", compact('warehouses', 'users', 'document'));
	}
	public function pickItemType($type)
	{
		$materialRequest = MaterialRequest::where("is_approve", 1)->where("status", 0)->where("reference_type", $type)->get();
		return $materialRequest;
	}
	public function addPickItem(Request $request)
	{
		// dd($request);
		// \DB::beginTransaction();
		//status 0 Pending
		//status 1 send item from warehouse
		$pickItem = new PickItem;
		$pickItem->material_request_id = $request->get("material_request_id");
		$pickItem->reference_type 	   = $request->get("reference_type");
		$pickItem->pick_by_id    	   = $request->get("pick_by_id");
		$pickItem->user_id       	   = Auth::User()->id;


		$materialReqStatus = MaterialRequest::where("id", $pickItem->material_request_id)->first();
		$materialReqStatus->status = 1;


		$product_id    = $request->get("product_id");
		$qty_picked    = $request->get("qty_picked");
		$warehouse_id     = $request->get("wh_id");
		$comment       = $request->get("comment");
		$mr_item_id       = $request->get("mr_detail_id");

		for ($i = 0; $i < count($product_id); $i++) {

			if ($product_id[$i] != null && $qty_picked[$i] != null && $warehouse_id[$i] != null) {
				// dd("ok");
				$inventoryDetail = Inventory::where("product_id", $product_id[$i])->where("warehouse_id", $warehouse_id[$i])->first();
				// dd($inventoryDetail);
				if ($inventoryDetail == null) {
					// \DB::rollBack();
					flash("Product not available in this warehouse.", "danger")->important();
					return redirect()->back();
				}
				// if ($inventoryDetail->qty < $qty_picked[$i]) {
				// 	flash("Product Quantity is not available in inventory.", "danger")->important();
				// 	return redirect()->back();
				// }
				if ($i == 0) {
					$pickItem->save();
					$materialReqStatus->update();
				}

				$inventoryDetail->qty = $inventoryDetail->qty - $qty_picked[$i];
				$inventoryDetail->qty_balance = $inventoryDetail->qty - $qty_picked[$i];
				$inventoryDetail->status = 1;
				$inventoryDetail->update();


				$pickItemDetail = new PickItemDetail;
				$pickItemDetail->pick_item_id  = $pickItem->id;
				$pickItemDetail->product_id	   = $product_id[$i];
				$pickItemDetail->qty_picked    = $qty_picked[$i];
				$pickItemDetail->warehouse      = $warehouse_id[$i];
				$pickItemDetail->comment       = $comment[$i];
				$pickItemDetail->mr_item_id       = $mr_item_id[$i];
				$pickItemDetail->save();

				// \DB::commit();
				event(new TransactionInventoryEvent("pick", $pickItem->id, $inventoryDetail->id, null, $qty_picked[$i]));
			}
		}

		flash()->success("Successfully Picked Items.")->important();
		return redirect()->to('/pick-items-list');
	}

	public function addPickItemReqDoc(Request $request)
	{
		// dd($request);
		// \DB::beginTransaction();
		//status 0 Pending
		//status 1 send item from warehouse
		$pickItem = new PickItem;
		$pickItem->material_request_id = $request->get("material_request_id");
		$pickItem->reference_type 	   = "request_document";
		$pickItem->pick_by_id    	   = $request->get("pick_by_id");
		$pickItem->user_id       	   = Auth::User()->id;


		$materialReqStatus = DocumentReq::where("id", $pickItem->material_request_id)->first();
		$materialReqStatus->status = 2;


		$product_id    = $request->get("product_id");
		$qty_picked    = $request->get("qty_picked");
		$warehouse_id     = $request->get("wh_id");
		$comment       = $request->get("comment");
		$mr_item_id       = $request->get("mr_detail_id");

		for ($i = 0; $i < count($product_id); $i++) {

			if ($product_id[$i] != null && $qty_picked[$i] != null && $warehouse_id[$i] != null) {
				// dd("ok");
				$inventoryDetail = Inventory::where("product_id", $product_id[$i])->where("warehouse_id", $warehouse_id[$i])->first();
				// dd($inventoryDetail);
				if ($inventoryDetail == null) {
					// \DB::rollBack();
					flash("Product not available in this warehouse.", "danger")->important();
					return redirect()->back();
				}
				// if ($inventoryDetail->qty < $qty_picked[$i]) {
				// 	flash("Product Quantity is not available in inventory.", "danger")->important();
				// 	return redirect()->back();
				// }
				if ($i == 0) {
					$pickItem->save();
					$materialReqStatus->update();
				}

				$inventoryDetail->qty = $inventoryDetail->qty - $qty_picked[$i];
				$inventoryDetail->qty_balance = $inventoryDetail->qty - $qty_picked[$i];
				$inventoryDetail->status = 1;
				$inventoryDetail->update();


				$pickItemDetail = new PickItemDetail;
				$pickItemDetail->pick_item_id  = $pickItem->id;
				$pickItemDetail->product_id	   = $product_id[$i];
				$pickItemDetail->qty_picked    = $qty_picked[$i];
				$pickItemDetail->warehouse      = $warehouse_id[$i];
				$pickItemDetail->comment       = $comment[$i];
				$pickItemDetail->mr_item_id       = $mr_item_id[$i];
				$pickItemDetail->save();

				// \DB::commit();
				event(new TransactionInventoryEvent("pick", $pickItem->id, $inventoryDetail->id, null, $qty_picked[$i]));
			}
		}

		flash()->success("Successfully Picked Items.")->important();
		return redirect()->to('/pick-items-list');
	}

	//send Items from Warehouse

	public function sendItemsFromWHDetailList()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.senditems-fromwh-list", compact('warehouses'));
	}
	public function sendItemsFromWHListDt(Request $request)
	{
		$sendItemsFRomWH = SendItemFromWH::with("handover", "warehouse", "location", "sender")->get();

		$datatableRes = new DefaultResponse($sendItemsFRomWH);

		return $datatableRes->getResponse();
	}
	public function sendItemsFromWHDetail($id)
	{
		$sendItemFromWhDetails = PickItemDetail::with('products')->where('pick_item_id', $id)->get();
		return $sendItemFromWhDetails;
	}
	public function deleteSendItemsFromWH(Request $request)
	{
		SendItemFromWH::where("id", $request->get('id'))->delete();
		return "success";
	}
	public function sendItemFromWH()
	{
		$locations = WarehouseLocation::get();
		$racks = WarehouseRacking::get();
		$warehouses = Warehouse::with('warehouseLocation')->get();
		$users = User::where("status", 1)->get();
		return view("item.senditem-fromwh", compact('warehouses', 'locations', 'racks', 'users'));
	}
	public function sendItemsType($type)
	{
		$pickItems = PickItem::where("status", 0)->where("reference_type", $type)->get();
		return $pickItems;
	}
	public function sendwhItemData($pick_val)
	{
		$pickItem = PickItemDetail::with("products", "warehouses")->where("pick_item_id", $pick_val)->get();
		return $pickItem;
	}
	public function addSendItemFromWH(Request $request)
	{


		//return $request->all();
		//status 0 pending
		//status 1 receive item from warehouse
		$sendItemWh = new SendItemFromWH;
		$sendItemWh->reference_type = $request->get("reference_type");
		$sendItemWh->pick_item_id   = $request->get("pick_id");
		$sendItemWh->sender_id      = $request->get("sender_id");
		$sendItemWh->handover_by_id = $request->get("handover_by_id");
		// $sendItemWh->warehouse      = $request->get("warehouse");
		// $sendItemWh->location       = $request->get("location_rack");
		$sendItemWh->save();

		$pickStatus = PickItem::where("id", $sendItemWh->pick_item_id)->first();
		$pickStatus->status = 1;
		$pickStatus->update();

		$materialReqStatus = MaterialRequest::where("id", $pickStatus->material_request_id)->first();
		$materialReqStatus->status = 2;
		$materialReqStatus->update();


		flash()->success("Successfully Send Items From WH.")->important();
		return redirect()->to('/senditems-fromwh-list');
	}

	//receive Items from Warehouse
	public function receiveItemsFromWHList()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.receiveitem-fromwh-list", compact('warehouses'));
	}
	public function receiveItemsFromWHListDt(Request $request)
	{
		$receiveItemsFromWh = ReceiveItemFromWH::with("user", "sender")->get();

		$datatableRes = new DefaultResponse($receiveItemsFromWh);

		return $datatableRes->getResponse();
	}
	public function receiveItemsFromWHDetail($id)
	{
		$receiveItemDetail = ReceiveItemFromWHDetail::with('products')->where('receive_item_from_wh_id', $id)->get();
		return $receiveItemDetail;
	}
	public function deleteReceiveItemsFromWH(Request $request)
	{
		ReceiveItemFromWH::where("id", $request->get('id'))->delete();
		ReceiveItemFromWHDetail::where("receive_item_from_wh_id", $request->get('id'))->delete();
		return "success";
	}
	public function receiveItemFromWH()
	{
		$users = User::where("status", 1)->get();
		return view("item.receiveitem-fromwh", compact('users'));
	}
	public function receivewhItemData($pick_val)
	{
		$pickItem = PickItemDetail::with('products')->where("pick_item_id", $pick_val)->get();
		return $pickItem;
	}
	public function addReceiveItemFromWH(Request $request)
	{
		//return $request->all();
		//status 0 Pending
		//status 1 add in to store item Request
		$receiveItem = new ReceiveItemFromWH;
		$receiveItem->reference_type = $request->get("reference_type");
		$receiveItem->send_item_id   = $request->get("send_id");
		$receiveItem->sender_id         = $request->get("sender");
		$receiveItem->received_by_id = $request->get("received_by_id");
		$receiveItem->save();

		$sendItemFromWHStatus = SendItemFromWH::where("id", $receiveItem->send_item_id)->first();
		$sendItemFromWHStatus->status = 1;
		$sendItemFromWHStatus->update();

		$pickStatus = PickItem::where("id", $sendItemFromWHStatus->pick_item_id)->first();
		$pickStatus->status = 2;
		$pickStatus->update();

		$materialReqStatus = MaterialRequest::where("id", $pickStatus->material_request_id)->first();
		$materialReqStatus->status = 3;
		$materialReqStatus->update();

		$product_id           = $request->get("product_id");
		// $mfr           = $request->get("mfr");
		// $part_name     = $request->get('part_name');
		// $description   = $request->get('description');
		// $um       	   = $request->get("um");
		$qty_receive   = $request->get("qty_receive");
		$warehouse     = $request->get("warehouse");
		$location_rack = $request->get("location_rack");



		for ($i = 0; $i < count($product_id); $i++) {
			if ($product_id[$i] != null && $qty_receive[$i] != null && $warehouse[$i] != null && $location_rack[$i] != null) {
				$receiveItemDetail = new ReceiveItemFromWHDetail;
				$receiveItemDetail->receive_item_from_wh_id  = $receiveItem->id;
				$receiveItemDetail->product_id	           	 = $product_id[$i];
				// $receiveItemDetail->mfr                      = $mfr[$i];
				// $receiveItemDetail->part_name	   			 = $part_name[$i];
				// $receiveItemDetail->description   			 = $description[$i];
				// $receiveItemDetail->um	           			 = $um[$i];
				$receiveItemDetail->qty_receive    			 = $qty_receive[$i];
				$receiveItemDetail->warehouse 	   			 = $warehouse[$i];
				$receiveItemDetail->location_rack 			 = $location_rack[$i];
				$receiveItemDetail->save();
			}
		}

		flash()->success("Successfully Receive Items From WH.")->important();
		return redirect()->to('/receiveitem-fromwh-list');
	}
	public function receiveItemType($type)
	{
		$sendItems = SendItemFromWH::where("status", 0)->where("reference_type", $type)->get();
		return $sendItems;
	}

	//send store items
	public function sendStoreItemList()
	{
		$warehouses = Warehouse::with('warehouseLocation')->orderBy('created_at')->get();
		return view("item.send-store-items-list", compact('warehouses'));
	}
	public function sendStoreItemListDt(Request $request)
	{
		$sendStoreItemsData = SendStoreItems::with("user", "sender")->get();

		$datatableRes = new DefaultResponse($sendStoreItemsData);

		return $datatableRes->getResponse();
	}
	public function sendStoreItemDetail($id)
	{
		$sendstoreRequest = StoreItemRequestItem::with('products')->where('store_item_request_id', $id)->get();
		return $sendstoreRequest;
	}
	public function deleteSendStoreItem(Request $request)
	{
		SendStoreItems::where("id", $request->get('id'))->delete();
		return "success";
	}
	public function sendStoreItems()
	{
		$users = User::where("status", 1)->get();
		$storeItemRequest = StoreItemRequest::where("status", 0)->select("id")->get();
		return view('item.send-store-items', compact('storeItemRequest', 'users'));
	}
	public function sendStoreItemsData($storeReq_id)
	{
		$storeRequest = StoreItemRequestItem::with('products')->where('store_item_request_id', $storeReq_id)->get();
		return $storeRequest;
	}
	public function addSendStoreItems(Request $request)
	{
		//return $request->all();
		//status 0 Pending
		//status 1 receive in warehouse
		//status 2 store in warehouse
		$sendStoreItemData = new SendStoreItems;
		$sendStoreItemData->store_item_request_id = $request->get("store_item_request_id");
		$sendStoreItemData->sender_id             = $request->get("sender");
		$sendStoreItemData->handover_by_id        = $request->get("handover_by_id");
		$sendStoreItemData->save();

		$storeItemReq = StoreItemRequest::where("id", $sendStoreItemData->store_item_request_id)->first();
		$storeItemReq->status = 1;
		$storeItemReq->update();

		flash()->success("Successfully Sent Store Items.")->important();
		return redirect()->to('/send-store-items-list');
	}

	//store Item Request
	public function storeItemReq()
	{
		$users = User::where("status", 1)->get();
		$receiveItemFromWh = ReceiveItemFromWH::where("status", 0)->where("reference_type", "internal_department")->get();
		return view('item.store-item-request', compact('receiveItemFromWh', 'users'));
	}
	public function storeItemReqData($store_id)
	{
		$storeitemRequestdata = ReceiveItemFromWHDetail::where("receive_item_from_wh_id", $store_id)->get();
		return $storeitemRequestdata;
	}
	public function addStoreItemReq(Request $request)
	{
		//status 0 Pending
		//status 1 send item based on request
		//starus 2 receive in to warehouse
		//status 3 store item in warehouse
		$storeitemRequest = new StoreItemRequest;
		$storeitemRequest->reference_type = $request->get("reference_type");
		$storeitemRequest->reference_id   = $request->get("reference_id");
		$storeitemRequest->source         = $request->get("source");
		$storeitemRequest->source_type    = $request->get("source_type");
		// $storeitemRequest->source_id    = $request->get("source_id");
		$storeitemRequest->requester_id   = $request->get("requester_id");
		$storeitemRequest->user_id        = Auth::User()->id;
		$storeitemRequest->save();

		$receiveItemFromWhStatus = ReceiveItemFromWH::where("id", $storeitemRequest->reference_id)->first();
		$receiveItemFromWhStatus->status = 1;
		$receiveItemFromWhStatus->update();

		$mfr           = $request->get("mfr");
		$part_name 	   = $request->get("part_name");
		$description   = $request->get("description");
		$qty_request   = $request->get("qty_request");
		$um            = $request->get("um");
		$warehouse     = $request->get("warehouse");
		$location_rack = $request->get("location_rack");

		for ($i = 0; $i < count($mfr); $i++) {
			if ($mfr[$i] != null && $part_name[$i] != null && $description[$i] != null && $qty_request[$i] != null && $um[$i] != null && $warehouse[$i] != null && $location_rack[$i] != null) {
				$storeitemParts = new StoreItemRequestItem;
				$storeitemParts->store_item_request_id = $storeitemRequest->id;
				$storeitemParts->mfr         		  = $mfr[$i];
				$storeitemParts->part_name 	 		  = $part_name[$i];
				$storeitemParts->description 		  = $description[$i];
				$storeitemParts->qty_request 		  = $qty_request[$i];
				$storeitemParts->um          		  = $um[$i];
				$storeitemParts->warehouse            = $warehouse[$i];
				$storeitemParts->location_rack        = $location_rack[$i];
				$storeitemParts->save();
			}
		}
		flash()->success("Successfully Add Store Item Request.")->important();
		return redirect()->back();
	}

	//packing
	public function packingList()
	{
		return view("item.packing-list");
	}
	public function packingListDt(Request $request)
	{
		$packingItemList = PackingItems::with("doUser", "packByUser")->get();

		$datatableRes = new DefaultResponse($packingItemList);

		return $datatableRes->getResponse();
	}

	public function packingListDtDashboard(Request $request)
	{
		$packingItemList = PackingItems::where("status", 0)->with("doUser", "packByUser")->get();

		$datatableRes = new DefaultResponse($packingItemList);

		return $datatableRes->getResponse();
	}
	public function packingItems()
	{
		$users = User::where("status", 1)->get();
		// $receiveItems = ReceiveItemFromWH::where("status",0)->where("reference_type","dispatch_order")->get();
		$sendItems = SendItemFromWH::where("status", 0)->where("reference_type", "dispatch_order")->get();

		return view("item.packing-items", compact('sendItems', 'users'));
	}
	public function packingItemsData($id)
	{
		// $receiveItemDetails = ReceiveItemFromWHDetail::where('receive_item_from_wh_id',$id)->get();
		// return $receiveItemDetails;
		$sendItem = PickItemDetail::with("products")->where("pick_item_id", $id)->get();
		return $sendItem;
	}
	public function addPackingItems(Request $request)
	{
		//return $request->all();
		//status 0 = Pending.
		//Status 1 = send Do.
		$packing =  new PackingItems;
		$packing->do_id                   = $request->get("do_id");
		$packing->pack_by_id 			  = $request->get("pack_by_id");
		$packing->send_items_from_wh_id = $request->get("send_items_from_wh_id");
		$packing->save();

		$sendItemFromWhStatus = SendItemFromWH::where("id", $packing->send_items_from_wh_id)->first();
		$sendItemFromWhStatus->status = 1;
		$sendItemFromWhStatus->update();

		$product_id    = $request->get("product_id");
		// $mfr           = $request->get("mfr");
		// $part_name     = $request->get('part_name');
		// $description   = $request->get('description');
		// $um       	   = $request->get("um");
		$qty_pack      = $request->get("qty_pack");
		$warehouse     = $request->get("warehouse");
		$location_rack = $request->get("location_rack");



		for ($i = 0; $i < count($product_id); $i++) {
			if ($product_id[$i] != null && $qty_pack[$i] != null && $warehouse[$i] != null && $location_rack[$i] != null) {
				$packingItemDetail = new PackingItemDetail;
				$packingItemDetail->packing_id    = $packing->id;
				$packingItemDetail->product_id	  = $product_id[$i];
				// $packingItemDetail->mfr                      = $mfr[$i];
				// $packingItemDetail->part_name	   			 = $part_name[$i];
				// $packingItemDetail->description   			 = $description[$i];
				// $packingItemDetail->um	           			 = $um[$i];
				$packingItemDetail->qty_pack      = $qty_pack[$i];
				$packingItemDetail->warehouse     = $warehouse[$i];
				$packingItemDetail->location_rack = $location_rack[$i];
				$packingItemDetail->save();
			}
		}



		flash()->success("Successfully Pack Items.")->important();
		return redirect()->to('/packing-items-list');
	}
	public function packData($id)
	{
		$packItems = PackingItemDetail::with("products")->where("id", $id)->get();
		return $packItems;
	}
	public function packDataDashboard($id)
	{
		$packItems = PackingItemDetail::with("products")->where("id", $id)->where("status", 0)->get();
		return $packItems;
	}
	public function editStatus(Request $request)
	{
		$changeStatus = PackingItems::where("id", $request->get("id"))->first();
		//status 1 = Completed.
		//Status 0 = Progress.
		if ($changeStatus->is_packed == 1) {
			$changeStatus->is_packed = 0;
		} else {
			$changeStatus->is_packed = 1;
		}
		$changeStatus->update();
		return "success";
	}


	//sending Do Items

	public function sendingDoList()
	{
		return view("item.sending-do-list");
	}
	public function sendingDoListDt(Request $request)
	{
		$packingItemList = SendingDoItems::with("doUser", "handoverByUser", "sender")->get();

		$datatableRes = new DefaultResponse($packingItemList);

		return $datatableRes->getResponse();
	}
	public function sendingDoItems()
	{
		$users = User::where("status", 1)->get();
		$packingItems = PackingItems::where("status", 0)->where("is_packed", 1)->get();
		return view("item.sendingDo-items", compact('packingItems', 'users'));
	}
	public function sendingDoItemsData($id)
	{
		$packingitemDetails = PackingItemDetail::with('products')->where('id', $id)->get();
		return $packingitemDetails;
	}
	public function addSendDoItems(Request $request)
	{
		//return $request->all();
		$sendingDo =  new SendingDoItems;
		$sendingDo->packing_items_id = $request->get("packing_item_id");
		$sendingDo->send_via         = $request->get("send_via");
		$sendingDo->do_id            = $request->get("do_id");
		$sendingDo->handover_by_id   = $request->get("handover_by_id");
		$sendingDo->contact 	     = $request->get("contact");
		$sendingDo->sender_id 		 = $request->get("sender_id");
		$sendingDo->pickup_date      = $request->get("pickup_date");
		$sendingDo->save();

		$packingStatus = PackingItems::where("id", $sendingDo->packing_items_id)->first();
		$packingStatus->status = 1;
		$packingStatus->update();

		flash()->success("Successfully Sending Do Items.")->important();
		return redirect()->to("/sendingDo-list");
	}
	public function editSendDoStatus(Request $request)
	{
		$changeStatus = SendingDoItems::where("id", $request->get("id"))->first();
		//status 1 = Delivered.
		//Status 0 = Progress.
		if ($changeStatus->is_delivered == 1) {
			$changeStatus->is_delivered = 0;
		} else {
			$changeStatus->is_delivered = 1;
		}
		$changeStatus->update();
		return "success";
	}

	//store item request old way not to consider all function

	public function storeitemRequest()
	{
		return view('item.storeitem-request');
	}
	public function storeitemRequestDt()
	{
		$storeitemRequestList = StoreItemRequest::with("user", "supplier")->get();

		$datatableRes = new DefaultResponse($storeitemRequestList);

		return $datatableRes->getResponse();
	}
	public function viewAddNewStoreItemRequest()
	{
		$users = User::where("status", 1)->get();
		$suppliers = Supplier::all();
		return view('item.add-new-storeitem-request', compact('users', 'suppliers'));
	}
	public function addStoreItemRequest(Request $request)
	{
		//return $request->all();
		$storeitemRequest = new StoreItemRequest;
		$storeitemRequest->reference_type = $request->get("reference_type");
		$storeitemRequest->reference      = $request->get("reference");
		$storeitemRequest->source         = $request->get("source");
		$storeitemRequest->source_type    = $request->get("source_type");
		$storeitemRequest->source_id      = $request->get("source_id");
		$storeitemRequest->requester_id   = $request->get("requester_id");
		$storeitemRequest->user_id        = Auth::User()->id;
		$storeitemRequest->save();

		$product_id    = $request->get("product_id");
		// $mfr           = $request->get("mfr");
		// $part_name 	   = $request->get("part_name");
		// $description   = $request->get("description");
		$qty_request   = $request->get("qty_request");
		// $um            = $request->get("um");
		// $warehouse     = $request->get("warehouse");
		// $location_rack = $request->get("location_rack");

		for ($i = 0; $i < count($product_id); $i++) {
			if ($product_id[$i] != null && $qty_request[$i] != null) {
				$storeitemParts = new StoreItemRequestItem;
				$storeitemParts->store_item_request_id = $storeitemRequest->id;
				$storeitemParts->product_id            = $product_id[$i];
				// $storeitemParts->mfr         		  = $mfr[$i];
				// $storeitemParts->part_name 	 		  = $part_name[$i];
				// $storeitemParts->description 		  = $description[$i];
				$storeitemParts->qty_request 		  = $qty_request[$i];
				// $storeitemParts->um          		  = $um[$i];
				// $storeitemParts->warehouse            = $warehouse[$i];
				// $storeitemParts->location_rack        = $location_rack[$i];
				$storeitemParts->save();
			}
		}
		flash()->success("Successfully Add Store Item Request.")->important();
		return redirect()->to('/storeitem-request');
	}
	public function storeitemRequestPartList($s_request_id)
	{
		$itemParts = StoreItemRequestItem::with('products')->where('storeitem_request_id', $s_request_id)->get();
		return $itemParts;
	}
	public function editStoreItemRequest($id)
	{
		$users = User::where("status", 1)->get();
		$suppliers = Supplier::all();
		$storeitemData = StoreItemRequest::with('storeitemrequestitem', 'user')
			->where("id", $id)->first();
		// $storeitemData = json_decode($storeitemData,true);
		return view('item.edit-storeitem-request', compact('storeitemData', 'users', 'suppliers'));
	}
	public function updateStoreItemRequest(Request $request)
	{
		//return $request->all();
		$updateRequest = StoreItemRequest::where("id", $request->get("request_id"))->first();
		$updateRequest->reference_type = $request->get("reference_type");
		$updateRequest->reference      = $request->get("reference");
		$updateRequest->source         = $request->get("source");
		$updateRequest->source_type    = $request->get("source_type");
		$updateRequest->source_id      = $request->get("source_id");
		$updateRequest->requester_id   = $request->get("requester_id");
		$updateRequest->user_id        = Auth::User()->id;
		$updateRequest->status         = $request->get("request_status");
		$updateRequest->update();

		$id            = $request->get("storeitem_request_item_id");
		$qty_request   = $request->get("qty_request");

		for ($i = 0; $i < count($id); $i++) {
			if ($id[$i] != null && $qty_request[$i] != null) {
				$storeitemParts = StoreItemRequestItem::where('id', $id[$i])->first();
				$storeitemParts->qty_request = $qty_request[$i];
				$storeitemParts->update();
			}
		}
		flash()->success("Successfully Update Request.")->important();
		return redirect()->to('/storeitem-request');
	}
	public function deleteStoreItemParts(Request $request)
	{
		StoreItemRequestItem::where("id", $request->get("id"))->delete();
		return redirect()->back();
	}

	public function storeitemData(Request $request)
	{
		$term = $request->get('term');

		$data = ItemProduct::where('part_num', 'LIKE', '%' . $term . '%')->orWhere('part_name', 'LIKE', '%' . $term . '%')->orWhere('part_desc', 'LIKE', '%' . $term . '%')->get();

		$results = array();

		foreach ($data as $query) {
			$results[] = ['id' => $query->id, 'mfr' => $query->mfr, 'part_num' => $query->part_num, 'part_name' => $query->part_name, 'part_desc' => $query->part_desc, 'qty' => $query->qty, 'default_um' => $query->default_um];
		}
		return response()->json($results);
	}

	public function deleteSIR(Request $request)
	{
		StoreItemRequest::where("id", $request->get("id"))->delete();
		StoreItemRequestItem::where("store_item_request_id", $request->get("id"))->delete();
		return "success";
	}

	//inventory

	public function inventoryList()
	{
		return view("item.inventory-list");
	}

	public function inventoryTrList()
	{
		return view("item.inventory-tr-list");
	}
	public function inventoryWipList()
	{
		return view("item.inventory-wip-list");
	}
	public function inventoryDt1()
	{
		$inventoryList = Inventory::select('id', 'product_id', 'qty', 'warehouse_id')->where('qty', '!=', 0)->with(['products' => function ($a) {
			$a->select('id', 'mfr', 'part_name', 'part_num', 'part_desc', 'default_um');
		}])->with('warehouse.warehouse')->get();



		return array_map(function ($get) {
			$reserve = ReserveStock::where('transaction_type', "rsv")->where('inventory_id', $get['id'])->sum('qty_reserve');

			$getArr = (array) $get;
			$getArr['reserve'] = (int) $reserve;
			$getArr['balance_rsv'] = $get['qty'] - (int) $reserve;


			return $getArr;
		},  $inventoryList->toArray());
	}
	public function inventoryDt()
	{
		$inventoryList = Inventory::all()->map(function ($i) {
			$i->products;
			$i->warehouse->warehouse;

			return $i;
		});
		$results = array();

		// dd($inventoryList);

		foreach ($inventoryList as $get) {
			$price = PODetail::where('product_id', $get->product_id)->orderBy('created_at', 'desc')->first();
			// dd($price->unit_price);
			if ($price == null) {
				$results[] = [
					'mfr' => $get->products->mfr,
					'part_name' => $get->products->part_name,
					'part_desc' => $get->products->part_desc,
					'part_num' => $get->products->part_num,
					'um' => $get->products->default_um,
					'ProdID' => $get->products->ProdID,
					'price' => 0,
					'curr' => "",
					// 'do_num' => $qc->reference_do,
					// 'do_date' => date('d-m-Y', strtotime($do->created_at))
				];
			} else {
				$results[] = [
					'mfr' => $get->products->mfr,
					'part_name' => $get->products->part_name,
					'part_desc' => $get->products->part_desc,
					'part_num' => $get->products->part_num,
					'um' => $get->products->default_um,
					'ProdID' => $get->products->ProdID,
					'price' => $price->unit_price,
					'curr' => $price->curr,
					// 'do_num' => $qc->reference_do,
					// 'do_date' => date('d-m-Y', strtotime($do->created_at))
				];
			}
		}
		// dd($results);

		$datatableRes = new DefaultResponse($results);

		return $datatableRes->getResponse();
	}
	public function inventoryItemsId($id)
	{
		$inventoryList = Inventory::where('id', $id)->with("products", "warehouse", "location", "rack")->get();

		$datatableRes = new DefaultResponse($inventoryList);

		return $datatableRes->getResponse();
	}
	public function deleteInventory(Request $request)
	{
		Inventory::where("id", $request->get("id"))->delete();
		return "success";
	}
	//transaction inventory

	public function transactionInventoryList()
	{
		$item = ItemProduct::select("mfr", "part_num", "part_name", "part_desc")->get();
		return view("item.transaction-inventory-list", compact('item'));
	}
	public function transactionInventoryDt(Request $request)
	{
		if (request()->ajax()) {


			$product = $request->itemProduct;
			if ($product == 0) {
				$transactionInventory = TransactionInventory::whereBetween('created_at', array($request->from_date, $request->to_date))->with('inventory.products')->with('inventory.warehouse')->get();
			} else {
				$transactionInventory = TransactionInventory::whereHas('inventory', function ($query) use ($product) {
					$query->where('product_id', $product);
				})->whereBetween('created_at', array($request->from_date, $request->to_date))->with('inventory.products')->with('inventory.warehouse')->get();
			}
		}



		$datatableRes = new DefaultResponse($transactionInventory);

		return $datatableRes->getResponse();
	}
	public function deleteInventoryTransaction(Request $request)
	{
		TransactionInventory::where("id", $request->get("id"))->delete();
		return "success";
	}

	public function storingDashboard()
	{
		$countReceive = ReceiveItems::where('status', 0)->count();
		$countStore = StoreItems::where('status', 0)->count();
		$countTransfer = TransferItem::where('status', 0)->count();
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.storing", compact('warehouses', 'countReceive', 'countStore', 'countTransfer'));
	}
	public function InternalstoringDashboard()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.internal-storing", compact('warehouses'));
	}
	public function packingDashboard()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.packing-dashboard", compact('warehouses'));
	}
	public function pickingDashboard()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("item.picking-dashboard", compact('warehouses'));
	}

	//product
	public function ProductListView()
	{
		return view("item.product-list");
	}

	public function productList(Request $request)
	{
		$productList = ItemProduct::all();

		$datatableRes = new DefaultResponse($productList);

		return $datatableRes->getResponse();
	}

	public function viewAddNewProduct()
	{
		return view("item.add-new-product");
	}

	public function addNewProduct(Request $request)
	{
		$product = new Product;
		$product->mfr        = $request->get("mfr");
		$product->product_number = $request->get("product_number");
		$product->part_name       = $request->get("part_name");
		$product->description        = $request->get("description");
		$product->qty        = $request->get("qty");
		$product->um        = $request->get("um");
		$product->moq        = $request->get("moq");
		$product->save();

		flash()->success("Successfully new Product added !")->important();
		return redirect()->to('/product-list');
	}

	public function viewEditProduct(Request $request, $id)
	{
		$product = ItemProduct::find($id);

		if ($product == null) {
			flash()->error("Invalid request.")->important();
			return redirect()->to('/product-list');
		}
		return view("item.edit-product", compact('product'));
	}

	public function deleteProduct(Request $request)
	{
		ItemProduct::where("id", $request->get('id'))->delete();
		return "success";
	}

	public function updateProduct(Request $request, $id)
	{
		$product = ItemProduct::find($id);

		if ($product == null) {
			flash()->error("Invalid request.")->important();
			return redirect()->to('/product-list');
		}

		$product->mfr        = $request->get("mfr");
		$product->product_number        = $request->get("product_number");
		$product->part_name        = $request->get("part_name");
		$product->moq        = $request->get("moq");
		$product->description = $request->get("description");

		$product->update();

		flash()->success("Successfully product updated.")->important();
		return redirect()->to('/product-list');
	}

	public function viewPrint($id)
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();

		$reportLists = ReceiveReport::with("reportdetail", "document")->where("id", $id)->first();
		$suppliers = ReceiveDocument::where("id", $reportLists->document_no)->with("supplier")->first();
		$do = QcRequest::where('id', $reportLists->reference_id)->first();
		$pod = PODetail::where("pos_id", $suppliers->po_id)->get();


		return view("queue.print-rr", compact('users', 'movers', 'reportLists', 'suppliers', 'pod', 'do'));
	}

	public function mr($id)
	{


		$client = new \GuzzleHttp\Client(['base_uri' => 'https://gw.iotech.my.id/ppic/materialrequests/']);
		$response = $client->request('GET', $id);
		$content = $response->getBody();
		$content = json_decode($content, true);

		$collection = collect($content["materialRequestItems"]);
		$collection2 = collect($content);
		// dd($collection);
		foreach ($collection as $a) {
			$item = ItemProduct::where('id', $a["extItemId"])->get();
			foreach ($item as $items) {
				$data[] = array(
					"id" => $items->id,
					"mfr" => $items->mfr,
					"part_name" => $items->part_name,
					"part_num" => $items->part_num,
					"part_desc" => $items->part_desc,
					"qty_mr" => $a["qty"],
					"warehouse" => $a["extInventoryId"],
					"job_id" => $collection["jobId"],

				);
			}
		}

		return $data;
	}

	public function mr_post($id)
	{

		$client = new \GuzzleHttp\Client(['base_uri' => 'https://gw.iotech.my.id/ppic/ppic/materialrequests/']);
		$response = $client->request('GET', $id);
		$content = $response->getBody();
		$content = json_decode($content, true);


		return $content["updatedAt"];
	}

	public function po($id)
	{
		$po = PurchaseOrder::where('id', $id)->first();
		return $po;
	}
	public function sup($id)
	{
		$po = SupplierVendor::where('id', $id)->first();
		return $po;
	}
	public function doc($id)
	{
		$po = ReceiveDocument::where('id', $id)->first();
		return $po;
	}
	public function qc($id)
	{
		$po = QcRequest::where('id', $id)->with("document")->first();
		return $po;
	}
	public function mover($id)
	{
		$po = Mover::where('id', $id)->first();
		return $po;
	}
	public function replace(Request $request)
	{
		$product_id_old = $request->get("product_id_old");
		$qc_id = $request->get("qc_id");
		$save["product_id"] = $request->get("product_id");
		QcRequestItemParts::where('id', $product_id_old)->update($save);
	}

	public function reserveStockList()
	{
		return view("item.reserve-stock");
	}

	public function newreserveStockList()
	{
		return view("item.add-new-reserve-stock");
	}

	public function addMaterialRequestAPI(Request $request)
	{

		$materialRequest = new MaterialRequest;
		$materialRequest->mr_name      = $request->get("name");
		$materialRequest->reference_type = $request->get("reference_type");
		$materialRequest->reference      = $request->get("reference");
		$materialRequest->source         = $request->get("source");
		$materialRequest->source_type    = $request->get("source_type");
		$materialRequest->source_id      = $request->get("receive_document_id");
		$materialRequest->requester_id   = $request->get("requester_id");
		$materialRequest->remark   = $request->get("remark");
		$materialRequest->user_id        = Auth::User()->id;
		$materialRequest->save();


		$product_id	   = $request->get("product_id");
		$qty_request   = $request->get("qty_request");

		for ($i = 0; $i < count($product_id); $i++) {
			if ($product_id[$i] != null && $qty_request[$i] != null) {
				$materialParts = new MaterialRequestItem;
				$materialParts->material_request_id = $materialRequest->id;
				$materialParts->product_id			= $product_id[$i];
				$materialParts->qty_request 		= $qty_request[$i];
				$materialParts->save();
			}
		}
		flash()->success("Successfully Add Request.")->important();
		return redirect()->to('/material-request');
	}
	public function addReserveStockAPI(Request $request)
	{

		$items = $request->getContent();
		$data = collect(json_decode($items, true));
		$return = array();
		foreach ($data["items"] as $get) {
			if ($get["id"] == null) {
				$materialParts = new ReserveStock;
				$materialParts->transaction_type = $get["transaction_type"];
				$materialParts->product_id			=  $get["product_id"];
				$materialParts->inventory_id			=  $get["inventory_id"];
				$materialParts->job_id			=  $data["job_id"];
				$materialParts->qty_reserve 		= $get["qty_reserve"];
				$materialParts->save();

				$return[] = ReserveStock::where('id', $materialParts->id)->first();
			} else {
				$update["transaction_type"] = $get["transaction_type"];
				$update["product_id"]			=  $get["product_id"];
				$update["job_id"]			=  $data["job_id"];
				$update["inventory_id"]			=  $get["inventory_id"];
				$update["qty_reserve"]		= $get["qty_reserve"];
				ReserveStock::where('id', $get["id"])->update($update);
				$return[] = ReserveStock::where('id', $get["id"])->first();
			}
		}
		return $return;
	}

	public function ReserveListAPI(Request $request)
	{

		$term = $request->get('job');

		if ($term != null) {
			$reserve = ReserveStock::where('job_id', $term)->select('id', 'transaction_type', 'job_id', 'qty_reserve', 'product_id', 'inventory_id', 'created_at')->with(['products' => function ($a) {
				$a->select('id', 'mfr', 'part_name', 'part_num', 'part_desc', 'default_um');
			}])->get();
			return $reserve;
		} else {


			$reserve = ReserveStock::select('id', 'transaction_type', 'job_id', 'qty_reserve', 'inventory_id', 'product_id', 'created_at')->with(['products' => function ($a) {
				$a->select('id', 'mfr', 'part_name', 'part_num', 'part_desc', 'default_um');
			}])->get();
			return $reserve;
		}
	}

	public function DelReserveAPI($id)
	{
		$reserve = ReserveStock::where('id', $id)->delete();
	}


	public function savePrAPI(Request $request)
	{

		$date = PurchaseRequest::orderBy('created_at', 'desc')->first();
		$current_timestamp = date("Y-m-d 00:00:00");
		$num = PurchaseRequest::where('created_at', $current_timestamp)->count();
		$pr = new PurchaseRequest;
		$pr->pr_number = $request->get("pr_number");
		if ($current_timestamp == $date['created_at']) {
			$pr->pr_number_seq = str_pad($num + 1, 4, "0", STR_PAD_LEFT);
		} else {
			$pr->pr_number_seq = str_pad(1, 4, "0", STR_PAD_LEFT);
		}
		$pr->request_from = $request->get("request_from");
		$pr->job_id = $request->get("job_id");
		$pr->purpose = $request->get("purpose");
		$pr->purpose_remark = $request->get("purpose_remark");
		$pr->request_mode = $request->get("request_mode");
		$pr->status = 0;
		$pr->pr_date = $request->get("pr_date");
		$pr->pr_target = $request->get("pr_target");

		$pr->save();
		// $prquesttask=Task::create( $data2 );

		$product_id  = $request->get("product_id");
		// $mfr         = $request->get("mfr");
		// $part_name   = $request->get("part_name");
		// $description = $request->get("description");
		$qty_pr      = $request->get("qty_pr");
		$um_pr          = $request->get("um_pr");
		$mfr          = $request->get("mfr");
		$part_name          = $request->get("part_name");
		$part_num          = $request->get("part_num");
		$part_desc          = $request->get("part_desc");
		$unit_cost          = $request->get("unit_cost");
		$curr          = $request->get("curr");
		$job_id          = $request->get("job_id");

		for ($i = 0; $i < count($product_id); $i++) {

			if ($product_id != null && $qty_pr != null) {
				$qcItemParts = new PRdetail;
				$qcItemParts->pr_id = $pr->id;
				$qcItemParts->mfr       = $mfr[$i];
				$qcItemParts->part_name       = $part_name[$i];
				$qcItemParts->part_num       = $part_num[$i];
				$qcItemParts->part_desc       = $part_desc[$i];
				$qcItemParts->curr       = $curr[$i];
				$qcItemParts->unit_cost       = $unit_cost[$i];
				$qcItemParts->product_id    = $product_id[$i];
				$qcItemParts->job_id    = $job_id;


				// $qcItemParts->mfr 		   = $mfr[$i];
				// $qcItemParts->part_name    = $part_name[$i];
				// $qcItemParts->description  = $description[$i];
				$qcItemParts->qty_pr       = $qty_pr[$i];
				$qcItemParts->um_pr           = $um_pr[$i];
				$qcItemParts->balance_qty       = $qty_pr[$i];
				$qcItemParts->save();
			}
		}
	}

	public function getDataPR(Request $request)
	{
		// Get Supplier
		$records = PurchaseRequest::all();

		return $records;
	}

	public function getItems($id)
	{
		$items = PRdetail::where('pr_id', $id)->select('qty_pr', 'product_id', 'job_id')->with('item')->get();
		return $items;
	}

	public function getItemsApprove()
	{
		$items = PRdetail::query()
			->with(array('pr' => function ($query) {
				$query->select('id', 'approved', 'approved_by', 'status');
			}))->select('mfr', 'part_name', 'part_num', 'part_desc', 'um_pr', 'qty_pr', 'pr_id', 'product_id', 'job_id')
			->get();
		return $items;
	}

	public function getPO()
	{
		$items = PurchaseOrder::with('details.products')->get();
		return $items;
	}

	public function addNewDocPick()
	{
		$users = User::where("status", 1)->get();
		$suppliers = Supplier::all();
		$emp = Employee::select('id', 'first_name', 'middle_name', 'last_name')->get();
		return view('item.add-new-doc-pick', compact('users', 'suppliers', 'emp'));
	}

	public function inventoryRequest(Request $request)
	{
		$term = $request->get('term');

		$data = ItemProduct::where('part_num', 'LIKE', '%' . $term . '%')->orWhere('part_name', 'LIKE', '%' . $term . '%')->orWhere('mfr', 'LIKE', '%' . $term . '%')->take(50)->get();

		$results = array();

		foreach ($data as $query) {
			$inv = Inventory::where('product_id', $query->id)->with('products', 'warehouse.warehouse')->get();
			foreach ($inv as $inventory) {
				if ($inventory != null) {
					$results[] = [
						'id' => $inventory->products->id, 'mfr' => $inventory->products->mfr, 'part_num' => $inventory->products->part_num, 'part_name' => $inventory->products->part_name,
						'part_desc' => $inventory->products->part_desc, 'qty' => $inventory->qty, 'default_um' => $inventory->products->default_um,
						'wh_name' => $inventory->warehouse->warehouse->name,
						'wh_loc' => $inventory->warehouse->wh_name,
						'wh_id' => $inventory->id, 'qty_reserve' => $inventory->qty_reserve, 'qty_balance' => $inventory->qty_balance, 'warehouse_id' => $inventory->warehouse_id
					];
				} else {
					continue;
				}
			}
		}
		return response()->json($results);
	}

	public function saveInventoryReq(Request $request)
	{

		$save = new DocumentReq;
		$save->document_no = $request->get("document_no");
		$save->source = $request->get("source");
		$save->purpose = $request->get("purpose");
		$save->request_by = $request->get("request_by");
		$save->remark = $request->get("remark");
		$save->status = 0;
		$save->save();

		$product_id = $request->get("product_id");
		$qty = $request->get("qty");

		for ($i = 0; $i < count($product_id); $i++) {

			if ($product_id != null && $qty != null) {
				$save1 = new DocumentReqDetail;
				$save1->product_id = $product_id[$i];
				$save1->qty = $qty[$i];
				$save1->doc_id = $save->id;
				$save1->save();
			}
		}
		return redirect(url('/request-doc-list'));
	}

	public function ReqDocList()
	{
		return view("item.list-doc-pick");
	}

	public function docReqDT()
	{
		$reportList = DocumentReq::with("employee")->where('status', 0)->get();

		$datatableRes = new DefaultResponse($reportList);

		return $datatableRes->getResponse();
	}

	public function viewPrintDoc($id)
	{
		$doc = DocumentReq::where('id', $id)->with('employee')->first();
		$docItems = DocumentReqDetail::where('doc_id', $id)->with('item')->get();
		// dd($docItems);

		return view("queue.print-doc-req", compact('doc', 'docItems'));
	}

	public function deleteDocReq($id)
	{
		$reportStatus = DocumentReq::where("id", $id)->first();
		$reportStatus->status = 3;
		$reportStatus->update();
		return view("item.list-doc-pick");
	}

	public function addNewOfficialReport()
	{
		$users = User::where("status", 1)->get();
		$suppliers = Supplier::all();
		$emp = Employee::select('id', 'first_name', 'middle_name', 'last_name')->get();
		return view('item.add-new-official-report', compact('users', 'suppliers', 'emp'));
	}

	public function saveOfficialReport(Request $request)
	{

		$save = new OfficialReport;
		$save->doc_ref = $request->get("doc_ref");
		$save->type = $request->get("type");
		$save->purpose = $request->get("purpose");
		$save->created_by = $request->get("created_by");
		$save->comment = $request->get("comment1");
		$save->report_date = $request->get("report_date");
		$save->status = 0;
		$save->save();

		$product_id = $request->get("product_id");
		$qty = $request->get("qty");
		$comment = $request->get("comment");

		for ($i = 0; $i < count($product_id); $i++) {

			if ($product_id != null && $qty != null) {
				$save1 = new OfficialReportDetail;
				$save1->product_id = $product_id[$i];
				$save1->qty = $qty[$i];
				$save1->comment = $comment[$i];
				$save1->report_id = $save->id;
				$save1->save();
			}
		}
		return redirect(url('/official-report-list'));
	}

	public function OfficialReportList()
	{
		return view("item.list-official-report");
	}

	public function officialReportDT()
	{
		$reportList = OfficialReport::with("employee")->where('status', 0)->get();

		$datatableRes = new DefaultResponse($reportList);

		return $datatableRes->getResponse();
	}

	public function viewPrintOfficialReport($id)
	{
		$doc = OfficialReport::where('id', $id)->with('employee')->first();
		$docItems = OfficialReportDetail::where('report_id', $id)->with('item')->get();
		// dd($docItems);

		return view("queue.print-official-report", compact('doc', 'docItems'));
	}

	public function deleteOfficialreport($id)
	{
		$reportStatus = OfficialReport::where("id", $id)->first();
		$reportStatus->status = 3;
		$reportStatus->update();
		return view("item.list-official-report");
	}

	public function poData2($id)
	{

		$poData = PODetail::with("products")->where("pos_id", $id)->get();

		return $poData;
	}

	public function transferRequest(Request $request)
	{
		$term = $request->get('term');

		$data = ItemProduct::where('part_num', 'LIKE', '%' . $term . '%')->orWhere('part_name', 'LIKE', '%' . $term . '%')->orWhere('mfr', 'LIKE', '%' . $term . '%')->take(50)->get();

		$results = array();

		foreach ($data as $query) {
			$inventory = Inventory::where('product_id', $query->id)->with('products')->with('warehouse.warehouse')->first();

			if ($inventory != null) {
				$results[] = [
					'id' => $inventory->products->id, 'mfr' => $inventory->products->mfr, 'part_num' => $inventory->products->part_num, 'part_name' => $inventory->products->part_name, 'part_desc' => $inventory->products->part_desc, 'qty' => $inventory->qty, 'default_um' => $inventory->products->default_um, 'warehouse' => $inventory->warehouse->warehouse->name, 'wh_name' => $inventory->warehouse->wh_name, 'inventory_id' => $inventory->id, 'wh_location' => $inventory->warehouse_id, 'qty_balance' => $inventory->qty_balance, 'qty_reserve' => $inventory->qty_reserve
				];
			} else {
				continue;
			}
		}
		return response()->json($results);
	}

	public function viewAddNewDO()
	{

		$client = new \GuzzleHttp\Client();
		$response = $client->request('GET', 'http://192.168.1.149:5005/api/list-do');
		$content = $response->getBody()->getContents();
		$content = json_decode($content, true);
		// dd($content);
		$users = User::where("status", 1)->get();
		$suppliers = Supplier::all();
		return view('item.add-new-do', compact('users', 'suppliers', 'content'));
	}

	public function getDoDetail($id)
	{

		$client = new \GuzzleHttp\Client(['base_uri' => 'http://192.168.1.149:5005/api/get-do/']);
		$response = $client->request('GET', $id);
		$content = $response->getBody();
		$content = json_decode($content, true);

		// dd($content);

		return $content;
	}

	public function do($id)
	{


		$client = new \GuzzleHttp\Client(['base_uri' => 'http://192.168.1.149:5005/api/list-do-detail/']);
		$response = $client->request('GET', $id);
		$content = $response->getBody();
		$content = json_decode($content, true);


		foreach ($content as $get) {
			$item = ItemProduct::where('id', $get["product_id"])->get();
			foreach ($item as $items) {

				$data[] = array(
					"id" => $items->id,
					"mfr" => $items->mfr,
					"part_name" => $items->part_name,
					"part_num" => $items->part_num,
					"part_desc" => $items->part_desc,
					"qty_mr" => $get["qty"],

				);
			}
		}



		return $data;
	}

	public function matchPN($id)
	{
		$data = array();
		$client = new \GuzzleHttp\Client(['base_uri' => 'http://192.168.1.149:5005/api/list-do-detail/']);
		$response = $client->request('GET', $id);
		$content = $response->getBody();
		$content = json_decode($content, true);
		// dd($content);


		foreach ($content as $get) {
			try {
				$client = new \GuzzleHttp\Client();
				$response = $client->request('GET', 'https://gw.iotech.my.id/ppic/partnumbermatches-proto-search?type=SOURCE&value=' . $get["product_id"]);
				$content = $response->getBody()->getContents();
				$content = json_decode($content, true);
				$items = ItemProduct::where('id', $content["destination"])->first();
				// dd($item);

				$data[] = [
					"id" => $items->id,
					"mfr" => $items->mfr,
					"part_name" => $items->part_name,
					"part_num" => $items->part_num,
					"part_desc" => $items->part_desc,
					"qty_mr" => $get["qty"],

				];
			} catch (\Exception $e) {
			
			}
		}



		return $data;
	}


	public function transactionItem($id)
	{
		$tr = TransactionInventory::where('inventory_id', $id)->with('inventory.products')->with('inventory.warehouse.warehouse')->get();
		// dd($tr);
		return view("item.report-transaction-print", compact('tr'));
	}

	public function viewPrintTransaction($id)
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();

		$reportLists = ReceiveReport::with("reportdetail", "document")->where("id", $id)->first();
		$suppliers = ReceiveDocument::where("id", $reportLists->document_no)->with("supplier")->first();
		$do = QcRequest::where('id', $reportLists->reference_id)->first();
		$pod = PODetail::where("pos_id", $suppliers->po_id)->get();


		return view("queue.print-rr", compact('users', 'movers', 'reportLists', 'suppliers', 'pod', 'do'));
	}

	public function stockOpnameListView()
	{
		$warehouses = Warehouse::get();
		$warehousesLocation = WarehouseLocation::get();
		$warehousesRacking = WarehouseRacking::get();
		return view("stock.stock-opname-list", compact('warehouses', 'warehousesLocation', 'warehousesRacking'));
	}

	public function stockOpnameListNew()
	{
		$users = User::where("status", 1)->get();
		$suppliers = Supplier::all();
		$emp = Employee::select('id', 'first_name', 'middle_name', 'last_name')->get();
		return view('stock.stock-opname-new', compact('users', 'suppliers', 'emp'));
	}


	public function saveStockOpname(Request $request)
	{

		$save = new StockOpname;
		$save->done_by = $request->get("done_by");
		$save->supervise_by = $request->get("supervise_by");
		$save->remark = $request->get("remark");
		$save->status = 0;
		$save->save();

		$product_id = $request->get("product_id");
		$qty_new = $request->get("qty_new");
		$qty_old = $request->get("qty_old");
		$wh_id = $request->get("inv_id");

		for ($i = 0; $i < count($product_id); $i++) {

			if ($product_id != null && $qty_new != null) {
				$save1 = new StockOpnameDetail;
				$save1->product_id = $product_id[$i];
				$save1->wh_id = $wh_id[$i];
				$save1->qty_new = $qty_new[$i];
				$save1->qty_old = $qty_old[$i];
				$save1->stock_id = $save->id;
				$save1->save();

				$po = Inventory::where('id', $wh_id[$i])->first();

				$po->qty = $qty_new[$i];

				$po->qty_balance = $qty_new[$i];
				$po->update();
			}
		}
		return redirect(url('/stock-opname-list'));
	}

	public function stockOpnameListAdd()
	{
		$users = User::where("status", 1)->get();
		$suppliers = Supplier::all();
		$wh = WarehouseLoc::with('warehouse')->get();
		$emp = Employee::select('id', 'first_name', 'middle_name', 'last_name')->get();
		return view('stock.stock-opname-add', compact('users', 'suppliers', 'emp', 'wh'));
	}


	public function saveStockOpnameAdd(Request $request)
	{

		$save = new StockOpname;
		$save->done_by = $request->get("done_by");
		$save->supervise_by = $request->get("supervise_by");
		$save->remark = $request->get("remark");
		$save->status = 0;
		$save->save();

		$product_id = $request->get("product_id");
		$qty = $request->get("qty");

		for ($i = 0; $i < count($product_id); $i++) {



			$inventoryDetail  = new Inventory;


			$inventoryDetail->product_id   = $product_id[$i];
			$inventoryDetail->warehouse_id = $request->get("wh_id");
			// $inventoryDetail->location_id  = $location_id[$i];
			// $inventoryDetail->rack_id  = $rack_id[$i];
			$inventoryDetail->qty          = $qty[$i];
			$inventoryDetail->qty_balance          = $qty[$i];
			$inventoryDetail->status       = 0;
			$inventoryDetail->save();

			event(new TransactionInventoryEvent("opname", $save->id, $inventoryDetail->id, $qty[$i], null));

			$save1 = new StockOpnameDetail;
			$save1->product_id = $product_id[$i];
			$save1->wh_id = $inventoryDetail->id;
			$save1->qty_new = $qty[$i];
			$save1->qty_old = 0;
			$save1->stock_id = $save->id;
			$save1->save();
		}
		return redirect(url('/stock-opname-list'));
	}

	public function Testing()
	{
		$data = TransactionInventory::all();
		return $data;
	}

	public function podoReportList()
	{

		return view("report.podoReport");
	}

	public function podoData(Request $request)
	{
		$term = $request->get('term');

		$data = PurchaseOrder::where('po_number', 'LIKE', '%' . $term . '%')->orWhere('po_number_seq', 'LIKE', '%' . $term . '%')->with('supplier')->get();

		$results = array();
		$product = array();

		foreach ($data as $query) {
			$do = QcRequest::where('receive_document_id', $query->id)->first();
			$do2 = ReceiveDocument::where('po_id', $query->id)->first();
			//


			if ($do != null && $do2 != null) {
				// dd($do2->created_at);
				$rr = ReceiveReport::where('reference_id', $do->id)->first();
				$item = PODetail::where('pos_id', $query->id)->with('products')->get();
				if ($do->reference_do == null) {
					$results[] = [
						'po_id' => $query->id, 'do_num' => $do2->reference_rr, 'po_date' => date('d-m-Y', strtotime($query->po_date)),
						'supplier' => $query->supplier->supplier_name,
						'po_number' => $query->po_number,
						'po_number_seq' => $query->po_number_seq,




					];
				} else {
					$results[] = [
						'po_id' => $query->id, 'do_num' => $do2->reference_do, 'po_date' => date('d-m-Y', strtotime($query->po_date)),
						'supplier' => $query->supplier->supplier_name,
						'po_number' => $query->po_number,
						'po_number_seq' => $query->po_number_seq,


					];
				}
			} else {
				continue;
			}
		}
		return response()->json($results);
	}

	public function podoList($po)
	{
		$poDetail = PODetail::where('pos_id', $po)->get();
		$results = array();

		foreach ($poDetail as $get) {
			$rrDetail = ReceiveReportDetail::where('po_detail_id', $get->id)->with('products')->first();

			if ($rrDetail != null) {
				$rr = ReceiveReport::where('id', $rrDetail->receive_report_id)->first();

				$qc = QcRequest::where('id', $rr->reference_id)->first();

				$do = ReceiveDocument::where('id', $qc->document_no)->first();

				if ($qc->reference_do != null) {
					$results[] = [
						'mfr' => $rrDetail->products->mfr,
						'part_name' => $rrDetail->products->part_name,
						'part_desc' => $rrDetail->products->part_desc,
						'part_num' => $rrDetail->products->part_num,
						'um' => $rrDetail->products->default_um,
						'do_qty' => $rrDetail->qty_receive,
						'po_qty' => $get->qty_pos,
						'rr_num' => $rr->rr_num,
						'do_num' => $qc->reference_do,
						'do_date' => date('d-m-Y', strtotime($do->created_at))
					];
				} else {
					$results[] = [
						'mfr' => $rrDetail->products->mfr,
						'part_name' => $rrDetail->products->part_name,
						'part_desc' => $rrDetail->products->part_desc,
						'part_num' => $rrDetail->products->part_num,
						'um' => $rrDetail->products->default_um,
						'do_qty' => $rrDetail->qty_receive,
						'po_qty' => $get->qty_pos,
						'rr_num' => $rr->rr_num,
						'do_num' => $do->reference_rr,
						'do_date' => date('d-m-Y', strtotime($do->created_at))
					];
				}
			}
		}


		$datatableRes = new DefaultResponse($results);

		return $datatableRes->getResponse();
	}

	public function unloadingDashboard()
	{
		$ldate = date('Y-m-d');
		$poToday = PurchaseOrder::where("po_date", $ldate)->count();
		$poPast = PurchaseOrder::where('status', 0)->whereDate("po_date", '>', "2022-01-10")->whereDate("po_date", '<', $ldate)->count();
		$doToday = MaterialRequest::where("created_at", 'LIKE', '%' . $ldate . '%')->where("reference_type", "dispatch_order")->count();
		$doPast = MaterialRequest::whereDate("created_at", '<', $ldate)->where("reference_type", "dispatch_order")->count();

		return view('dashboard.unloading-dashboard', compact('poToday', 'poPast', 'doToday', 'doPast'));
	}

	public function loadingDashboard()
	{
		$ldate = date('Y-m-d');
		$client = new \GuzzleHttp\Client();
		$response = $client->request('GET', 'https://gw.iotech.my.id/ppic/materialrequests-filtered?date=' . $ldate . '&status=1');
		$content = $response->getBody()->getContents();
		$content = json_decode($content, true);
		if (isset($content["materialRequests"])) {
			$mrToday = count($content["materialRequests"]);
		} else {
			$mrToday = 0;
		}
		$rrToday = ReceiveReport::where("created_at", 'LIKE', '%' . $ldate . '%')->count();


		$poToday = PurchaseOrder::where("po_date", $ldate)->count();
		$poPast = PurchaseOrder::where('status', 0)->whereDate("po_date", '<', $ldate)->count();

		$doPast = MaterialRequest::whereDate("created_at", '<', $ldate)->where("reference_type", "dispatch_order")->count();

		return view('dashboard.warehouse-dashboard', compact('poToday', 'poPast', 'mrToday', 'doPast', 'rrToday'));
	}

	public function problemInventorySave(Request $request)
	{
		$save1 = new InventoryProb;
		$save1->inventory_id = $request['inventory_id'];
		$save1->qty_seen = $request['qty_seen'];
		$save1->status = 0;
		$save1->save();
	}

	public function problemInventoryList()
	{
		$reportList = InventoryProb::where('status', 0)->with('inventory.products')->with('inventory.warehouse.warehouse')->get();

		$datatableRes = new DefaultResponse($reportList);

		return $datatableRes->getResponse();
	}

	public function updateStatusProb($id)
	{
		$po = InventoryProb::where('id', $id)->first();
		$po->status = 1;
		$po->update();
		flash()->success("Successfully Store Items.")->important();
		return redirect()->to('/storing');
	}

	public function problemInventoryListAPI($status)
	{
		$reportList = InventoryProb::where('status', $status)->with(array('inventory.products' => function ($query) {
			$query->select('id', 'mfr', 'part_name', 'part_num', 'part_desc');
		}))->get();

		return $reportList;
	}

	public function inventorytest()
	{
		$inventoryList = Inventory::all()->map(function ($i) {
			$i->products;
			$i->warehouse->warehouse;

			return $i;
		});


		return array_map(function ($get) {
			$reserve = ReserveStock::where('product_id', $get['product_id'])->sum('qty_reserve');

			$getArr = (array) $get;
			$getArr['reserve'] = (int) $reserve;
			$getArr['balance_rsv'] = $get['qty'] - (int) $reserve;


			return $getArr;
		},  $inventoryList->toArray());
	}

	public function storeItemsExternalAPI()
	{
		$reciveItems = ReceiveItems::where("status", 0)->where("reference_type", "dispatch_order")->with("rr")->get();
		// dd($reciveItems);
		return $reciveItems;
	}

	public function WHListAPI()
	{
		$warehouses = WarehouseLoc::with('warehouse')->get();
		return	$warehouses;
	}
	public function UserListAPI()
	{
		$users = User::where("status", 1)->select('id', 'name')->get();
		return	$users;
	}

	public function StoreItemAPI(Request $request)
	{

		$items = $request->getContent();
		$get = collect(json_decode($items, true));

		//return $request->all();
		$storeItems = new StoreItems;
		$storeItems->reference_type = $get["reference_type"];
		$storeItems->reference_id   = $get["reference_id"];
		$storeItems->storer_id      = $get["storer_id"];
		$storeItems->save();

		$receiveStatus = ReceiveItems::where("id", $storeItems->reference_id)->first();
		$receiveStatus->status = 1;
		$receiveStatus->update();

		if ($storeItems->reference_type == 'dispatch_order') {

			$sendItemToWH = SendItemsToWarehouse::where("receive_report_id", $receiveStatus->reference_id)->first();
			$sendItemToWH->status = 2;
			$sendItemToWH->update();

			$itemStatus = ReceiveReport::where("id", $sendItemToWH->receive_report_id)->first();
			$itemStatus->status = 3;
			$itemStatus->update();
		} else if ($storeItems->reference_type == "internal_department") {
			$sendStoreItem = SendStoreItems::where("id", $receiveStatus->reference_id)->first();
			$sendStoreItem->status = 2;
			$sendStoreItem->update();

			$storeItem = StoreItemRequest::where("id", $sendStoreItem->store_item_request_id)->first();
			$storeItem->status = 3;
			$storeItem->update();
		}



		foreach ($get["items"] as $data) {
			if ($data['product_id'] != null && $data['qty_store'] != null) {
				$storeItemsParts = new StoreItemsDetail;
				$storeItemsParts->store_items_id = $storeItems->id;
				$storeItemsParts->product_id     = $data['product_id'];

				$storeItemsParts->qty_store 	 = $data['qty_store'];

				// $storeItemsParts->location_id  = $location_id[$i];
				// $storeItemsParts->rack_id  = $rack_id[$i];
				$storeItemsParts->save();


				$inventoryDetail  = new Inventory;

				$inventory = $inventoryDetail->where("product_id", $data['product_id'])->where("warehouse_id", $data['warehouse_id'])->first();

				if ($inventory != null) {
					$inventory->qty = $inventory->qty + $data['qty_store'];
					$inventory->qty_balance = $inventory->qty_balance + $data['qty_store'];
					$inventory->update();
					event(new TransactionInventoryEvent("store", $storeItems->id, $inventory->id, $data['qty_store'], null));
				} else {

					$inventoryDetail->product_id   = $data['product_id'];
					$inventoryDetail->warehouse_id = $data['warehouse_id'];

					$inventoryDetail->qty          = $data['qty_store'];
					$inventoryDetail->qty_balance          = $data['qty_store'];
					$inventoryDetail->status       = 0;
					$inventoryDetail->save();

					event(new TransactionInventoryEvent("store", $storeItems->id, $inventoryDetail->id, $data['qty_store'], null));
				}
			}
		}


		return response('success', 200);
	}

	public function addPickItemAPI(Request $request)
	{
		$items = $request->getContent();
		$get = collect(json_decode($items, true));

		$pickItem = new PickItem;
		$pickItem->material_request_id = $get["material_request_id"];
		$pickItem->reference_type 	   = $get["reference_type"];
		$pickItem->pick_by_id    	   = $get["pick_by_id"];
		$pickItem->user_id       	   = $get["pick_by_id"];


		$materialReqStatus = MaterialRequest::where("id", $pickItem->material_request_id)->first();
		$materialReqStatus->status = 1;


		foreach ($get["items"] as $data) {

			if ($data['product_id'] != null && $data['qty_picked'] != null) {
				// dd("ok");
				$inventoryDetail = Inventory::where("product_id", $data['product_id'])->where("warehouse_id", $data['warehouse_id'])->first();


				$pickItem->save();
				$materialReqStatus->update();


				$inventoryDetail->qty = $inventoryDetail->qty - $data['qty_picked'];
				$inventoryDetail->qty_balance = $inventoryDetail->qty -  $data['qty_picked'];
				$inventoryDetail->status = 1;
				$inventoryDetail->update();


				$pickItemDetail = new PickItemDetail;
				$pickItemDetail->pick_item_id  = $pickItem->id;
				$pickItemDetail->product_id	   = $data['product_id'];
				$pickItemDetail->qty_picked    = $data['qty_picked'];
				$pickItemDetail->warehouse      = $data['warehouse_id'];
				$pickItemDetail->comment       = $data['comment'];
				$pickItemDetail->mr_item_id       = $data['mr_item_id'];
				$pickItemDetail->save();

				// \DB::commit();
				event(new TransactionInventoryEvent("pick", $pickItem->id, $inventoryDetail->id, null, $data['qty_picked']));
			}
		}

		return response('success', 200);
	}

	public function addTransferItemAPI(Request $request)
	{
		$items = $request->getContent();
		$get = collect(json_decode($items, true));

		foreach ($get["items"] as $data) {

			$transferItem = new TransferItem;
			$transferItem->from_location =  $data['wh_location'];
			$transferItem->to_location  =  $get["to_location"];
			$transferItem->user_id            =  $get["user_id"];
			$transferItem->remark            =  $get["remark"];
			$transferItem->status            = 0;
			$transferItem->save();

			$transferItemDetail = new TransferItemDetail;
			$transferItemDetail->transfer_items_id = $transferItem->id;
			$transferItemDetail->product_id		   = $data['product_id'];
			$transferItemDetail->qty         	   = $data['qty'];
			$transferItemDetail->save();

			$store = new Inventory;
			$store->product_id = $data['product_id'];
			$store->warehouse_id = $get["to_location"];
			$store->qty = $data['qty'];
			$store->qty_reserve = $data['qty_reserve'];
			$store->qty_balance = $data['qty_balance'];
			$store->save();

			event(new TransactionInventoryEvent("transfer", $transferItem->id, $data['inventory_id'], null, $data['qty']));
			event(new TransactionInventoryEvent("transfer", $transferItem->id, $store->id, $data['qty'], null));

			Inventory::where('id', $data['inventory_id'])->delete();
		}

		return response('success', 200);
	}

	public function transferRequestAPI(Request $request)
	{
		$term = $request->get('term');

		$data = ItemProduct::where('part_num', 'LIKE', '%' . $term . '%')->orWhere('part_name', 'LIKE', '%' . $term . '%')->orWhere('mfr', 'LIKE', '%' . $term . '%')->orWhere('part_desc', 'LIKE', '%' . $term . '%')->take(50)->get();

		$results = array();

		foreach ($data as $query) {
			$inventory = Inventory::where('product_id', $query->id)->with('products')->with('warehouse.warehouse')->first();

			if ($inventory != null) {
				$results[] = [
					'id' => $inventory->products->id, 'mfr' => $inventory->products->mfr, 'part_num' => $inventory->products->part_num, 'part_name' => $inventory->products->part_name, 'part_desc' => $inventory->products->part_desc, 'qty' => $inventory->qty, 'default_um' => $inventory->products->default_um, 'warehouse' => $inventory->warehouse->warehouse->name, 'wh_loc' => $inventory->warehouse->wh_name, 'inventory_id' => $inventory->id, 'wh_location' => $inventory->warehouse_id, 'qty_balance' => $inventory->qty_balance, 'qty_reserve' => $inventory->qty_reserve
				];
			} else {
				continue;
			}
		}
		return response()->json($results);
	}

	public function poCountAPI()
	{
		$ldate = date('Y-m-d');
		$poToday = ReceiveItems::where("status", 0)->count();
		return $poToday;
	}
	public function mrCountAPI()
	{
		$ldate = date('Y-m-d');
		$client = new \GuzzleHttp\Client();
		$response = $client->request('GET', 'https://gw.iotech.my.id/ppic/materialrequests-filtered?date=' . $ldate . '&status=1');
		$content = $response->getBody()->getContents();
		$content = json_decode($content, true);
		if (isset($content["materialRequests"])) {
			$mrToday = count($content["materialRequests"]);
		} else {
			$mrToday = 0;
		}
		return $mrToday;
	}

	public function insoectionListlAPI()
	{
		$documents = ReceiveDocument::where("status", 0)->get();
		// dd($reciveItems);
		return $documents;
	}

	public function inspectionCountAPI()
	{
		$documents = ReceiveDocument::where("status", 0)->count();
		return $documents;
	}

	public function saveInspectionAPI(Request $request)
	{
		$items = $request->getContent();
		$get = collect(json_decode($items, true));
		$qcRequest = new QcRequest;
		// $qcRequest->entry_queue_id      = $request->get("entry_queue_id");
		$qcRequest->receive_document_id   		= $get["receive_document_id"];
		$qcRequest->document_no    		= $get["document_no"];
		$qcRequest->remark         		= $get["remark"];
		$qcRequest->reference_do          		= $get["reference_do"];
		$qcRequest->status          		= $get["status"];
		$qcRequest->user_id        		= $get["user_id"];
		$qcRequest->save();

		$documentStatus = ReceiveDocument::where("id", $qcRequest->document_no)->first();

		$documentStatus->update();

		$product_id  = $request->get("product_id");
		$qty_qc      = $request->get("qty_receive");
		$po_detail_id      = $request->get("po_detail_id");
		$qty_balance      = $request->get("qty_balance");
		$status_po      = $request->get("status_po");
		// $um          = $request->get("um");
		$po_status = PODetail::where('pos_id', $qcRequest->receive_document_id)->get();

		foreach ($get["items"] as $data) {

			$qcItemParts = new QcRequestItemParts;
			$qcItemParts->qc_request_id = $qcRequest->id;
			$qcItemParts->product_id    = $data['product_id'];
			$qcItemParts->qty_qc       = $data['qty_qc'];
			$qcItemParts->qty_balance       = $data['qty_balance'];
			$qcItemParts->po_detail_id       = $data['po_detail_id'];


			$qcItemParts->save();

			$po_status = PODetail::where('id',  $data['po_detail_id'])
				->decrement('qty_delivered', $data['qty_qc']);
		}
		$check_status = PODetail::where('pos_id', $qcRequest->receive_document_id)->count();
		$blc_status = PODetail::where('pos_id', $qcRequest->receive_document_id)->where('qty_delivered', 0)->count();



		if ($check_status == $blc_status) {

			$do = ReceiveDocument::where('id', $qcRequest->document_no)->first();
			$do->status = 1;
			$do->update();
		}



		// if($blc_status == $check_status){
		// 	dd($blc_status);
		// }else{
		// 	dd($check_status);
		// }


		return "success";
	}

	public function wipGetData()
	{
		$inventoryList = MaterialRequestItem::where('type', 0)->get()->map(function ($i) {
			$i->products;
			$i->mr;

			return $i;
		});



		$datatableRes = new DefaultResponse($inventoryList);

		return $datatableRes->getResponse();
	}

	public function trGetData()
	{
		$inventoryList = MaterialRequestItem::where('type', 1)->get()->map(function ($i) {
			$i->products;
			$i->mr;

			return $i;
		});



		$datatableRes = new DefaultResponse($inventoryList);

		return $datatableRes->getResponse();
	}

	public function poListAPI($id)
	{
		$data = PurchaseOrder::where('supplier_id', $id)->where('invoice_status', 0)->orWhere('invoice_status', 1)->get();
		return $data;
	}

	public function supListAPI()
	{
		$data = SupplierVendor::select('id', 'supplier_name')->get();
		return $data;
	}

	public function poDetailListAPI($id)
	{
		$data = PODetail::where('pos_id', $id)->select('qty_pos', 'unit_price', 'product_id', 'curr')->with('products')->get();
		return $data;
	}

	public function supContactAPI($id)
	{
		$data = SupContact::where('supplier_id', $id)->get();
		return $data;
	}

	public function supAddressAPI($id)
	{
		$data = SupAddress::where('supplier_id', $id)->first();
		return $data;
	}

	public function itemPriceAPI($id)
	{
		$data = PODetail::where('product_id', $id)->orderBy('created_at', 'desc')->select('curr', 'unit_price')->first();
		return $data;
	}

	public function poStatusAPI($id, $status)
	{
		$data = PurchaseOrder::where('id', $id)->first();
		$data->invoice_status = $status;
		$data->update();
		return "success";
	}

	public function rrGetAPI($id)
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();

		$reportLists = ReceiveReport::with("reportdetail", "document")->where("id", $id)->first();
		$suppliers = ReceiveDocument::where("id", $reportLists->document_no)->with("supplier")->first();
		$do = QcRequest::where('id', $reportLists->reference_id)->first();
		$pod = PODetail::where("pos_id", $suppliers->po_id)->get();


		return view("queue.print-rr", compact('users', 'movers', 'reportLists', 'suppliers', 'pod', 'do'));
	}

	public function rrListAPI($id)
	{
		$results = array();
		$qc = QcRequest::where('receive_document_id', $id)->get();
		foreach ($qc as $get) {
			$rr = ReceiveReport::where('reference_id', $get->id)->where('invoice_status', 0)->with('document')->get();

			foreach ($rr as $getrr) {
				$results[] = [
					'id' => $getrr->id,
					'rr_num' => $getrr->rr_num,
					'rr_num_seq' => $getrr->rr_num_seq,
					'do_num' => $getrr->document->reference_rr,
				];
			}
		}
		return $results;
	}

	public function rrDetailAPI($id)
	{


		$reportLists = ReceiveReport::with("reportdetail.products", "reportdetail.PoDetail", "document")->where("id", $id)->first();
		// $suppliers = ReceiveDocument::where("id", $reportLists->document_no)->with("supplier")->first();
		// $do = QcRequest::where('id', $reportLists->reference_id)->first();
		// $pod = PODetail::where("pos_id", $suppliers->po_id)->get();


		// dd($reportLists);

		return $reportLists;
	}

	public function rrStatusAPI($id, $status)
	{
		$data = ReceiveReport::where('id', $id)->first();
		$data->invoice_status = $status;
		$data->update();
		return "success";
	}

	public function poDetailAPI()
	{
		$data = PODetail::where('qty_delivered', '!=', 0)->select('id', 'product_id', 'qty_pos', 'qty_delivered')->with(array('products' => function ($query) {
			$query->select('id', 'mfr', 'part_name', 'part_num', 'part_desc');
		}))->get();

		// $data = PODetail::where('qty_delivered','!=',0)->select('id','product_id','qty_pos','qty_delivered','pos_id')->with(array('products' => function ($query) {
		// 	$query->select('id', 'mfr', 'part_name', 'part_num', 'part_desc');
		// }))->with('po2')->get();
		return $data;
	}



	public function savePoDo(Request $request)
    {
        // dd($request->pr_id_detail);
        $date = PurchaseOrder::orderBy('created_at', 'desc')->first();
        $current_timestamp = date("Y-m-d 00:00:00");
        $num = PurchaseOrder::where('created_at', $current_timestamp)->count();
        // Parameters
        $input = $request->all();
        $data['po_number'] = $request->po_number;
        if ($current_timestamp == $date['created_at']) {
            $data['po_number_seq'] = str_pad($num + 1, 4, "0", STR_PAD_LEFT);
          
        } else {
            $data['po_number_seq'] = str_pad(1, 4, "0", STR_PAD_LEFT);
         
        }
        $data['pr_id'] = 0;
        $data['supplier_id'] = $request->supplier_id;
        $data['supplier_contact_id'] = $request->supplier_contact_id;
        $data['shipment_term'] = 0;
        $data['payment_term'] =  0;
        $data['import_via'] =  0;
        $data['cost_freight'] =  0;
        $data['currency'] = 0;
        $data['disc_type'] =  0;
        $data['disc_value'] =  0;
        $data['cost_freight_amount'] =  0;
        $data['vat'] = 0;
        $data['remark'] = $request->remark;
        //$data['attached_file'] = $request->attached_file;
        $data['invoice_status'] =  0;
        $data['pos_supplier_rating'] = 0;
        $data['po_date'] = date('Y-m-d H:i:s');
        $data['approved'] = 0;
		$data['po_type'] = 1;
        $data['verified'] = 0;
        $data['verified_by'] = 0;
        // $data['approved_date'] = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->approved_date)));
        $data['created_by'] = Auth::user()->name;
        $data['modified_by'] = Auth::user()->name;


        //

        $Po = PurchaseOrder::create($data);
        // $prquesttask=Task::create( $data2 );

        $product_id = $request->get("product_id");
        $pr_id = $request->get("pr_id");
        $qty = $request->get("qty_pos");
       
        $um = $request->get("um_pr");
    

        for ($i = 0; $i < count($product_id); $i++) {
           
                $Detail = new PoSupplierDetail;
                $Detail->pos_id = $Po->id;
                $Detail->pr_detail_id =  0;
                $Detail->product_id = $product_id[$i];
                $Detail->qty_pos = $qty[$i];
                $Detail->qty_delivered = $qty[$i];
                $Detail->um_pos = $um[$i];
                $Detail->curr = '-';
                $Detail->unit_price =  0;
                $Detail->target_date_new = date('Y-m-d H:i:s');

                $Detail->status = 1;
                $Detail->created_by =  Auth::user()->name;
                $Detail->modified_by = Auth::user()->name;
                $Detail->save();
         
        }
      
    }
}
