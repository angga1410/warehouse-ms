<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EntryQueue;
use App\Models\EntryQueueDetail;
use App\Models\Mover;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\QcRequest;
use App\Models\QcRequestItemParts;
use App\Models\QcRequestSerialNo;
use App\Models\QcReturn;
use App\Models\QcReturnItems;
use App\Models\ReturnReport;
use App\Models\ReturnReportDetail;
use App\Models\QcReturnSerialNo;
use App\Models\ReportSerialNo;
use App\Models\ReceiveReport;
use App\Models\Product;
use App\Models\ItemProduct;
use App\Models\MaterialRequest;
use App\Models\PODetail;
use App\User;
use App\Models\PurchaseOrder;
use App\Models\ReceiveDocument;
use App\Models\ReceiveItems;
use App\Models\ReceiveItemsDetail;
use App\Models\SendItemsToWarehouse;
use App\Models\SupContact;
use App\Models\SupplierVendor;
use App\Models\Vendor;
use Yajra\Datatables\Facades\Datatables;
use App\ResponseDto\DefaultResponse;
use Auth;
use Carbon\Carbon;

class QueueController extends Controller
{
	public function viewEntryQueueList()
	{
		$warehouses = Warehouse::with('warehouseLocation')->get();
		return view("queue.entry-queue", compact('warehouses'));
	}

	public function entryQueueList()
	{
		$entryQueueList = EntryQueue::with("mover", "user")->orderBy('created_at', 'DESC')->get();

		$datatableRes = new DefaultResponse($entryQueueList);

		return $datatableRes->getResponse();
	}

	public function viewAddNewEntryQueue()
	{
		$movers = Mover::all();
		$warehouses = Warehouse::with('warehouseLocation')->get();

		$users = User::where("status", 1)->get();

		return view("queue.add-new-entry-queue", compact('movers', 'users', 'warehouses'));
	}
	public function addNewEntryQueue(Request $request)
	{
		//return $request->all();
		$queueLastData = EntryQueue::latest()->first();

		$entryQueue = new EntryQueue;
		if ($queueLastData != null) {
			if ($queueLastData->created_at->isToday()) {
				$entryQueue->queue_id = $queueLastData->queue_id + 1;
			} else {
				$entryQueue->queue_id = 1;
			}
		} else {
			$entryQueue->queue_id = 1;
		}
		$entryQueue->document_no = $request->get("document_no");
		$entryQueue->mover_id    = $request->get("mover");
		$entryQueue->user_id     = $request->get("employee");;
		$entryQueue->save();



		flash()->success("Successfully New Entry Queue.")->important();
		return redirect()->to('/entry-queue');
	}


	public function updateQueueView($id)
	{
		$movers = Mover::all();
		$warehouses = Warehouse::with('warehouseLocation')->get();
		$users = User::where("status", 1)->get();
		$queueList = EntryQueue::where("id", $id)->first();
		return view("queue.update-queue", compact('queueList', 'movers', 'users', 'warehouses'));
	}
	public function updateQueue(Request $request)
	{
		//return $request->all();
		$queueData = EntryQueue::where("id", $request->get("e_queue_id"))->first();
		$queueData->document_no = $request->get("document_no");
		$queueData->mover_id    = $request->get("mover");
		$queueData->user_id     = $request->get("employee");;
		$queueData->update();


		flash()->success("Successfully Update Queue.")->important();
		return redirect()->to('/entry-queue');
	}
	public function deleteEntryQueue(Request $request)
	{
		EntryQueue::where("id", $request->get("id"))->delete();

		return "success";
	}

	//receive Document
	public function viewReceiveDocument()
	{
		return view("queue.receive-document");
	}
	public function receiveDocument()
	{
		$receiveDocuments = ReceiveDocument::where("status", 0)->get();

		$datatableRes = new DefaultResponse($receiveDocuments);

		return $datatableRes->getResponse();
	}

	public function receiveLast()
	{
		$receiveDocuments = ReceiveDocument::where("status", 0)->orderBy('created_at', 'DESC')->first();

		return view("dashboard.dashboard", compact('receiveDocuments'));
	}
	public function viewAddNewReceiveDocument(Request $id)

	{
		$data = PurchaseOrder::find($id);
		$purchase = PurchaseOrder::where("status", 0)->get();
		$supplier = SupplierVendor::all();
		$movers = Mover::all();
		$users = User::where("status", 1)->get();
		$entryQueue = EntryQueue::where("status", 0)->get();
		return view("queue.add-new-receive-document", compact('movers', 'entryQueue', 'supplier', 'users', 'purchase', 'data'));
	}
	public function addNewReceiveDocument(Request $request)
	{

		//return $request->all();
		$receiveDocument = new ReceiveDocument;
		// $receiveDocument->queue_id 		 = $request->get("queue_id");
		$receiveDocument->document_no    = $request->get("document_no");
		$receiveDocument->reference_type = $request->get("reference_type");
		$receiveDocument->reference      = $request->get("reference");
		$receiveDocument->reference_rr      = $request->get("reference_rr");
		$receiveDocument->sender_name    = $request->get("sender_name");
		$receiveDocument->sender_phone   = $request->get("sender_phone");
		$receiveDocument->document_via   = $request->get("document_via");
		$receiveDocument->source 		 = $request->get("source");
		$receiveDocument->source_type 	 = $request->get("source_type");
		$receiveDocument->mover_id 	 = $request->get("mover_id");
		//  $receiveDocument->supplier_id 	 = $request->get("supplier_id");
		$receiveDocument->employee_id 	 = $request->get("employee_id");
		$receiveDocument->source_id 	 = $request->get("source_id");
		$receiveDocument->source_name 	 = $request->get("source_name");
		$receiveDocument->assign_to 	 = $request->get("assign_to");
		$receiveDocument->remark 		 = $request->get("remark");
		$receiveDocument->po_id 		 = $request->get("po_id");
		$receiveDocument->partial_status 		 = $request->get("partial_status");

		$receiveDocument->user_id 		 = Auth::user()->id;;
		// $receiveDocument->item_linked 	 = $request->get("item_linked");
		$receiveDocument = $this->uploadImage($receiveDocument, $request->file('attach_pic'));
		$receiveDocument->save();

		 $documentStatus = PurchaseOrder::where("id",$receiveDocument->po_id)->first();
		$documentStatus->queue_status = 1;
		$documentStatus->update();

		// $entryQueueStatus = EntryQueue::where("id",$receiveDocument->queue_id)->first();
		// $entryQueueStatus->status = 1;
		// $entryQueueStatus->update();

		flash()->success("Successfully Add Receive Document.")->important();
		return redirect()->to('/receive-document');
	}

	private function uploadImage($receiveDocument, $attach_pic)
	{
		$imagePath   = '';
		if ($attach_pic && $attach_pic->isValid()) {

			$destinationPath = 'Media/images/';
			$extension = $attach_pic->getClientOriginalExtension();
			$imageName = str_random(32) . '.' . $extension;

			if ($attach_pic->move($destinationPath, $imageName)) {
				$imagePath = $destinationPath . $imageName;
			}

			$receiveDocument->attach_pic = $imagePath;
		}
		return $receiveDocument;
	}
	public function viewEditReceiveDocument(Request $request, $id)
	{
		$receiveDocuments = ReceiveDocument::find($id);

		if ($receiveDocuments == null) {
			flash()->error("Invalid request.")->important();
			return redirect()->to('/receive-document');
		}
		$suppliers = Supplier::all();
		return view("queue.edit-receive-document", compact('receiveDocuments', 'suppliers'));
	}
	public function updateReceiveDocument(Request $request, $id)
	{
		$receiveDocument = ReceiveDocument::find($id);

		if ($receiveDocument == null) {
			flash()->error("Invalid request.")->important();
			return redirect()->to('/receiv-document');
		}

		$receiveDocument->document_no 	 = $request->get("document_no");
		$receiveDocument->reference_type = $request->get("reference_type");
		$receiveDocument->reference 	 = $request->get("reference");
		$receiveDocument->reference_rr 	 = $request->get("reference_rr");
		$receiveDocument->sender_name 	 = $request->get("sender_name");
		$receiveDocument->sender_phone 	 = $request->get("sender_phone");
		$receiveDocument->document_via 	 = $request->get("document_via");
		$receiveDocument->source 		 = $request->get("source");
		$receiveDocument->source_type 	 = $request->get("source_type");
		$receiveDocument->remark 		 = $request->get("remark");
		$receiveDocument->status 		 = $request->get("status");
		$receiveDocument->user_id 		 = Auth::user()->id;
		// $receiveDocument->item_linked 	 = $request->get("item_linked");
		// $receiveDocument->is_verified 		 = $request->get("document_status");
		$receiveDocument = $this->uploadImage($receiveDocument, $request->file('edit_attach_pic'));
		$receiveDocument->update();

		flash()->success("Successfully Receive Document updated.")->important();
		return redirect()->to('/receive-document');
	}
	public function updateStatusReceiveDocument(Request $request, $id)
	{
		$receiveDocument = ReceiveDocument::find($id);

		if ($receiveDocument == null) {
			flash()->error("Invalid request.")->important();
			return redirect()->to('/receiv-document');
		}

		$receiveDocument->status 	 = $request->get("status");


		// $receiveDocument->item_linked 	 = $request->get("item_linked");
		// $receiveDocument->is_verified 		 = $request->get("document_status");

		$receiveDocument->update();

		flash()->success("Successfully Receive Document updated.")->important();
		return redirect()->to('/receive-document');
	}
	public function deleteReceiveDocument(Request $request)
	{
		ReceiveDocument::where("id", $request->get('id'))->delete();
		return "success";
	}
	public function supplierList()
	{
		$supplierList = Supplier::all();
		return $supplierList;
	}

	//qcrequest List
	public function qcRequestList()
	{
		return view("queue.qc-request");
	}
	public function qcRequestListDt()
	{
		$qcRequestList = QcRequest::with("user", "document")->where("status", 2)
			// ->orWhere("status",2)
			->orWhere("status", 3)
			// ->orWhere("status",4)
			->get();


		$datatableRes = new DefaultResponse($qcRequestList);

		return $datatableRes->getResponse();
	}
	public function qcRequestListDispatch()
	{
		$qcRequestList = QcRequest::with("user", "document")->where("status", 2)
			// ->orWhere("status",2)
			->orWhere("status", 2)
			// ->orWhere("status",4)
			->get();


		$datatableRes = new DefaultResponse($qcRequestList);

		return $datatableRes->getResponse();
	}
	public function qcRequestListOutstanding()
	{
		$qcRequestList = QcRequest::with("user", "document")->where("status", 0)
			->orWhere("status", 1)

			// ->orWhere("status",4)
			->get();


		$datatableRes = new DefaultResponse($qcRequestList);

		return $datatableRes->getResponse();
	}
	public function viewAddNewQcRequest()
	{
		$users = User::where("status", 1)->get();
		//$queues = EntryQueue::all();
		// $warehouses = Warehouse::with('warehouseLocation')->get();
		$documents = ReceiveDocument::where("status", 0)->get();
		return view("queue.add-new-qc-request", compact('users', 'documents'));
	}
	public function getRemark($id)
	{
		$documents = ReceiveDocument::where("id", $id)->select('remark')->first();
		return $documents;
	}
	public function qcData($queue_id)
	{
		$entryQueueData = EntryQueueDetail::where("entry_queue_id", $queue_id)->get();
		return $entryQueueData;
	}
	public function addNewQcRequest(Request $request)
	{
		//return $request->all();
		$qcRequest = new QcRequest;
		// $qcRequest->entry_queue_id      = $request->get("entry_queue_id");
		$qcRequest->receive_document_id   		= $request->get("receive_document_id");
		$qcRequest->document_no    		= $request->get("document_no");
		$qcRequest->remark         		= $request->get("remark");
		$qcRequest->reference_do          		= $request->get("reference_do");
		$qcRequest->status          		= $request->get("status");
		$qcRequest->user_id        		= Auth::User()->id;
		$qcRequest->save();

		$documentStatus = ReceiveDocument::where("id", $qcRequest->document_no)->first();

		$documentStatus->update();

		$product_id  = $request->get("product_id");
		// $mfr         = $request->get("mfr");
		// $part_name   = $request->get("part_name");
		// $description = $request->get("description");
		$qty_qc      = $request->get("qty_receive");
		$po_detail_id      = $request->get("po_detail_id");
		$qty_balance      = $request->get("qty_balance");
		$status_po      = $request->get("status_po");
		// $um          = $request->get("um");
		$po_status = PODetail::where('pos_id', $qcRequest->receive_document_id)->get();

		for ($i = 0; $i < count($product_id); $i++) {

			if ($product_id != null && $qty_qc != null) {
				$qcItemParts = new QcRequestItemParts;
				$qcItemParts->qc_request_id = $qcRequest->id;
				$qcItemParts->product_id    = $product_id[$i];
				// $qcItemParts->mfr 		   = $mfr[$i];
				// $qcItemParts->part_name    = $part_name[$i];
				// $qcItemParts->description  = $description[$i];
				$qcItemParts->qty_qc       = $qty_qc[$i];
				$qcItemParts->qty_balance       = $qty_balance[$i];
				$qcItemParts->po_detail_id       = $po_detail_id[$i];

				// $qcItemParts->um           = $um[$i];
				$qcItemParts->save();

				$po_status = PODetail::where('id', $po_detail_id[$i])
					->decrement('qty_delivered', $qty_qc[$i]);
			}
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

		flash()->success("Successfully Add New Qc Request.")->important();
		return redirect()->to('/inspection-document');
	}
	public function qcRequestPartList($qc_request_id)
	{
		$qcRequestParts = QcRequestItemParts::with("products")->where('qc_request_id', $qc_request_id)->get();

		return $qcRequestParts;
	}
	public function editQcRequest($id)
	{
		$users = User::where("status", 1)->get();
		$qcRequestData = QcRequest::with('qcrequestitems.products')->with("document")->where("id", $id)->first();
		// $qcRequestData = json_decode($qcRequestData,true);
		return view('queue.edit-qcRequest', compact('qcRequestData', 'users'));
	}
	public function updateQcRequest(Request $request)
	{
		//return $request->all();
		$qcRequest = QcRequest::where("id", $request->get("qcrequest_id"))->first();
		// $qcRequest->entry_queue_id = $request->get("entry_queue_id");

		$qcRequest->remark      = $request->get("remark");
		$qcRequest->qc_by       = $request->get("qc_by");
		$qcRequest->user_id     = Auth::User()->id;
		$qcRequest->status = $request->get("request_status");
		$qcRequest->update();

		$id          = $request->get("id");
		// $mfr         = $request->get("mfr");
		// $part_name   = $request->get("part_name");
		// $description = $request->get("description");
		$qty_qc      = $request->get("qty_qc");
		// $um          = $request->get("um");

		for ($i = 0; $i < count($id); $i++) {
			if ($id != null && $qty_qc != null) {
				$qcItemParts = QcRequestItemParts::where("id", $id[$i])->first();
				// $qcItemParts->qc_request_id = $qcRequest->id;
				// $qcItemParts->qc_request_id = 1;
				// $qcItemParts->mfr 		   = $mfr[$i];
				// $qcItemParts->part_name    = $part_name[$i];
				// $qcItemParts->description  = $description[$i];
				$qcItemParts->qty_qc       = $qty_qc[$i];
				// $qcItemParts->um           = $um[$i];
				$qcItemParts->update();
			}
		}
		flash()->success("Successfully update Qc Request.")->important();
		return redirect()->to('/qc-request-list');
	}
	public function deleteQcRequest(Request $request)
	{
		QcRequest::where("id", $request->get("id"))->delete();
		QcRequestItemParts::where("qc_request_id", $request->get("id"))->delete();
		return "success";
	}

	public function productData(Request $request)
	{
		$term = $request->get('term');

		$data = ItemProduct::where('part_num', 'LIKE', '%' . $term . '%')->orWhere('part_name', 'LIKE', '%' . $term . '%')->orWhere('part_desc', 'LIKE', '%' . $term . '%')->get();

		$results = array();

		foreach ($data as $query) {
			$results[] = ['id' => $query->id, 'mfr' => $query->mfr, 'part_num' => $query->part_num, 'part_name' => $query->part_name, 'part_desc' => $query->part_desc, 'default_um' => $query->default_um];
		}
		return response()->json($results);
	}

	public function document(Request $request)
	{
		$term = $request->get('term');

		$data = PurchaseOrder::where('po_number', 'LIKE', '%' . $term . '%')->orWhere('po_number_seq', 'LIKE', '%' . $term . '%')->get();

		$results = array();

		foreach ($data as $query) {
			$results[] = ['id' => $query->id, 'po_number' => $query->po_number, 'po_number_seq' => $query->po_number_seq,];
		}
		return response()->json($results);
	}
	//qc serial no
	public function qcRequestSerialNo()
	{
		return view('queue.qcRequest-serialno');
	}
	public function qcRequestSerialNoDt()
	{
		$qcRequestSerialno = QcRequestSerialNo::all();
		$datatableRes = new DefaultResponse($qcRequestSerialno);

		return $datatableRes->getResponse();
	}
	public function viewAddQcRequestSerialno()
	{
		$serialnoDetails = QcRequest::where("status", 3)
			->orWhere("status", 4)
			->get();
		//$serialnoDetails = json_decode($serialnoDetails, true);
		return view("queue.add-new-qcRequest-serialno", compact('serialnoDetails'));
	}
	public function getSerialnoParts($e_queue_id)
	{
		$parts = QcRequestItemParts::with("products")->where('qc_request_id', $e_queue_id)->get();
		return $parts;
	}
	public function addNewQcRequestSerialno(Request $request)
	{
		//return $request->all();
		$serialNo = $request->get("serial_no");

		for ($i = 0; $i < count($serialNo); $i++) {
			if ($serialNo != null) {
				$serialNumber  = new QcRequestSerialNo;
				$serialNumber->qc_request_item_parts_id = $request->get("part_id");
				$serialNumber->serial_no = $serialNo[$i];
				$serialNumber->document_no = $request->get("document_no");
				$serialNumber->product_number = $request->get("product_number");
				$serialNumber->qc_request_id = $request->get("qc_request_id");
				$serialNumber->save();
			}
		}

		flash()->success("Successfully Add New Serial No.")->important();
		return redirect()->to('/qc-request-serial-no');
	}
	public function deleteQcRequestSerialno(Request $request)
	{
		QcRequestSerialNo::where("id", $request->get("id"))->delete();
		return "success";
	}
	public function updateQcSrNoView($id)
	{
		$qcSrNo = QcRequestSerialNo::where("id", $id)->first();
		return view("queue.update-qcsrno", compact('qcSrNo'));
	}
	public function updateQcSrNo(Request $request)
	{
		//return $request->all();
		$srNumber  = QcRequestSerialNo::where("id", $request->get("qcsrno_id"))->first();
		$srNumber->serial_no = $request->get("serial_no");
		$srNumber->update();

		flash()->success("Successfully Update Serial No.")->important();
		return redirect()->to('/qc-request-serial-no');
	}

	//report serial no
	public function ReportSerialNo()
	{
		return view('queue.report-serial-no');
	}
	public function ReportSerialNoDt()
	{
		$ReportSerialno = ReportSerialNo::all();
		$datatableRes = new DefaultResponse($ReportSerialno);

		return $datatableRes->getResponse();
	}
	public function viewAddReportSerialno()
	{
		$serialnoDetails = QcRequest::where("status", 3)
			->orWhere("status", 4)
			->get();
		//$serialnoDetails = json_decode($serialnoDetails, true);
		return view("queue.add-new-report-serialno", compact('serialnoDetails'));
	}
	public function getRSerialnoParts($e_queue_id)
	{
		$parts = QcRequestItemParts::with("products")->where('qc_request_id', $e_queue_id)->get();
		return $parts;
	}
	public function addNewReportSerialno(Request $request)
	{
		//return $request->all();
		$serialNo = $request->get("serial_no");

		for ($i = 0; $i < count($serialNo); $i++) {
			if ($serialNo != null) {
				$serialNumber  = new ReportSerialNo;
				$serialNumber->qc_request_item_parts_id = $request->get("part_id");
				$serialNumber->serial_no = $serialNo[$i];
				$serialNumber->document_no = $request->get("document_no");
				$serialNumber->product_number = $request->get("product_number");
				$serialNumber->qc_request_id = $request->get("qc_request_id");
				$serialNumber->save();
			}
		}

		flash()->success("Successfully Add New Serial No.")->important();
		return redirect()->to('/report-serial-no');
	}
	public function deleteReportSerialno(Request $request)
	{
		QcRequestSerialNo::where("id", $request->get("id"))->delete();
		return "success";
	}
	public function updateReportNoView($id)
	{
		$qcSrNo = QcRequestSerialNo::where("id", $id)->first();
		return view("queue.update-reportno", compact('qcSrNo'));
	}
	public function updateReportNo(Request $request)
	{
		//return $request->all();
		$srNumber  = QcRequestSerialNo::where("id", $request->get("qcsrno_id"))->first();
		$srNumber->serial_no = $request->get("serial_no");
		$srNumber->update();

		flash()->success("Successfully Update Serial No.")->important();
		return redirect()->to('/report-serial-no');
	}

	//qc return

	public function qcReturnList()
	{
		return view("queue.qc-return-list");
	}
	public function qcReturnListDt(Request $request)
	{
		$qcReturnList = QcReturn::with("supplier", "mover")->get();

		$datatableRes = new DefaultResponse($qcReturnList);

		return $datatableRes->getResponse();
	}
	public function qcReturnItems()
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();
		$suppliers = Supplier::all();
		$qcRequestItem = QcRequest::where("status", 3)->orWhere("status", 4)->get();
		return view("queue.qc-return-items", compact('qcRequestItem', 'users', 'movers', 'suppliers'));
	}
	public function qcReturnItemsData($id)
	{
		$qcReturnDetails = QcRequestItemParts::with('products')->where('qc_request_id', $id)->get();
		return $qcReturnDetails;
	}
	public function addQcReturnItems(Request $request)
	{
		//return $request->all();
		$qcReturnData = new QcReturn;
		$qcReturnData->qc_request_id    = $request->get("qc_request_id");
		$qcReturnData->document_no      = $request->get("document_no");
		$qcReturnData->supplier_id      = $request->get("supplier_id");
		$qcReturnData->supplier_contact = $request->get("supplier_contact");
		$qcReturnData->mover_id         = $request->get("mover_id");
		$qcReturnData->remark           = $request->get("remark");
		$qcReturnData->save();

		$qcReqStatus = QcRequest::where('id', $qcReturnData->qc_request_id)->first();
		$qcReqStatus->status = 3;
		$qcReqStatus->update();

		$product_id = $request->get("product_id");
		// $mfr           = $request->get("mfr");
		// $part_name 	   = $request->get("part_name");
		// $description   = $request->get("description");
		$qty_return   = $request->get("qty_return");
		// $um            = $request->get("um");

		for ($i = 0; $i < count($product_id); $i++) {
			if ($product_id[$i] != null && $qty_return[$i] != null) {
				$storeQcReturnitemParts = new QcReturnItems;
				$storeQcReturnitemParts->qc_return_id = $qcReturnData->id;
				$storeQcReturnitemParts->product_id   = $product_id[$i];
				// $storeQcReturnitemParts->mfr          	= $mfr[$i];
				// $storeQcReturnitemParts->part_name 	  	= $part_name[$i];
				// $storeQcReturnitemParts->description  	= $description[$i];
				$storeQcReturnitemParts->qty_return  	= $qty_return[$i];
				// $storeQcReturnitemParts->um           	= $um[$i];
				$storeQcReturnitemParts->save();
			}
		}
		flash()->success("Successfully Add Return Item.")->important();
		return redirect()->to("/qcReturn-list");
	}
	public function editQcReturnStatus(Request $request)
	{
		$changeStatus = QcReturn::where("id", $request->get("id"))->first();
		//status 1 = Return.
		//Status 0 = Progress.
		if ($changeStatus->status == 1) {
			$changeStatus->status = 0;
		} else {
			$changeStatus->status = 1;
		}
		$changeStatus->update();
		return "success";
	}
	public function updateReturnView($id)
	{
		$users = User::where("status", 1)->get();
		$movers = Mover::all();
		$suppliers = Supplier::all();
		$updateReturn = QcReturn::with("retirndetail")->where("id", $id)->first();
		return view("queue.update-return", compact('updateReturn', 'suppliers', 'movers'));
	}
	public function updateReturn(Request $request)
	{
		//return $request->all();
		$returnData = QcReturn::where("id", $request->get("return_id"))->first();
		$returnData->document_no      = $request->get("document_no");
		$returnData->supplier_id      = $request->get("supplier_id");
		$returnData->supplier_contact = $request->get("supplier_contact");
		$returnData->mover_id         = $request->get("mover_id");
		$returnData->remark           = $request->get("remark");
		$returnData->is_verified      = $request->get("return_status");
		$returnData->update();

		$return_detail_id = $request->get("return_detail_id");

		// $mfr           = $request->get("mfr");
		// $part_name 	   = $request->get("part_name");
		// $description   = $request->get("description");
		$qty_return   = $request->get("qty_return");
		// $um            = $request->get("um");

		for ($i = 0; $i < count($return_detail_id); $i++) {
			if ($return_detail_id[$i] != null && $qty_return[$i] != null) {
				$updateQcReturnitemParts = QcReturnItems::where("id", $return_detail_id[$i])->first();

				// $updateQcReturnitemParts->mfr          	= $mfr[$i];
				// $updateQcReturnitemParts->part_name 	= $part_name[$i];
				// $updateQcReturnitemParts->description  	= $description[$i];
				$updateQcReturnitemParts->qty_return  	= $qty_return[$i];
				// $updateQcReturnitemParts->um           	= $um[$i];
				$updateQcReturnitemParts->update();
			}
		}
		flash()->success("Successfully Update Return Item.")->important();
		return redirect()->to("/receive");
	}
	public function deleteReturn(Request $request)
	{
		QcReturn::where("id", $request->get("id"))->delete();
		QcReturnItems::where("qc_return_id", $request->get("id"))->delete();
		return "success";
	}
	//return serial no

	public function qcReturnSerialNo()
	{
		return view('queue.qcReturn-serialno');
	}
	public function qcReturnSerialNoDt()
	{
		$qcReturnSerialno = QcReturnSerialNo::all();
		$datatableRes = new DefaultResponse($qcReturnSerialno);

		return $datatableRes->getResponse();
	}
	public function viewAddQcReturnSerialno()
	{
		$serialnoDetails = QcReturn::where("status", 0)->orWhere("status", 1)->get();
		//$serialnoDetails = json_decode($serialnoDetails, true);
		// $serialnoDetails = ReturnReport::where("status",0)->get();
		return view("queue.add-new-qcReturn-serialno", compact('serialnoDetails'));
	}
	public function getReturnSerialnoParts($e_queue_id)
	{
		// $parts = ReturnReportDetail::where('return_report_id',$e_queue_id)->get();
		$parts = QcReturnItems::with("products")->where('qc_return_id', $e_queue_id)->get();
		return $parts;
	}
	public function addNewQcReturnSerialno(Request $request)
	{
		//return $request->all();
		$serialNo = $request->get("serial_no");

		for ($i = 0; $i < count($serialNo); $i++) {
			if ($serialNo != null) {
				$serialNumber  = new QcReturnSerialNo;
				$serialNumber->qc_return_items_id = $request->get("part_id");
				$serialNumber->document_no = $request->get("document_no");
				// $serialNumber->return_report_id = $request->get("return_report_id");
				$serialNumber->qc_return_id = $request->get("qc_return_id");
				$serialNumber->serial_no = $serialNo[$i];
				$serialNumber->product_number = $request->get("product_number");
				$serialNumber->save();
			}
		}

		$returnData = QcReturn::where("id", $request->get('qc_return_id'))->first();
		$returnData->status = 1;
		$returnData->update();

		// $editParts = ReturnReportDetail::where("id",$request->get("part_id"))
		// 							   ->first();
		// $editParts->qty_return = $request->get("qty_return");
		// $editParts->um = $request->get("um");
		// $editParts->description = $request->get("description");
		// $editParts->update();

		flash()->success("Successfully Add New Serial No.")->important();
		return redirect()->to('/qc-return-serial-no');
	}
	public function deleteQcReturnSerialno(Request $request)
	{
		QcReturnSerialNo::where("id", $request->get("id"))->delete();
		return "success";
	}
	public function updateReturnSrNoView($id)
	{
		$returnSrNo = QcReturnSerialNo::where("id", $id)->first();
		return view("queue.update-returnsrno", compact('returnSrNo'));
	}
	public function updateReturnSrNo(Request $request)
	{
		//return $request->all();
		$srNumber  = QcReturnSerialNo::where("id", $request->get("returnsrno_id"))->first();
		$srNumber->serial_no = $request->get("serial_no");
		$srNumber->update();

		flash()->success("Successfully Update Serial No.")->important();
		return redirect()->to('/qc-return-serial-no');
	}

	//INSPECTION
	public function viewInspectionDocument()
	{
		return view("queue.inspection-document");
	}
	public function inspectioDocument()
	{
		$receiveDocuments = ReceiveDocument::where("status", 0)->with('user', 'mover', 'supplier')->get();

		$datatableRes = new DefaultResponse($receiveDocuments);

		return $datatableRes->getResponse();
	}

	public function viewReceiveDoc()
	{
		$countQueue = ReceiveDocument::where('status', 0)->count();
		$countQC = QcRequest::where('status', 0)->count();
		$countRR = ReceiveReport::where('status', 0)->count();
		$countSWH = SendItemsToWarehouse::where('status', 0)->count();
		return view("queue.receive", compact('countQueue', 'countQC', 'countRR', 'countSWH'));
	}

	//DISPATCH TO WAREHOUSE
	public function dashboardPOdata()
	{
		$ldate = date('Y-m-d');

		$po = PurchaseOrder::where('queue_status',0)->where("po_date", $ldate)->with('supplier')->get();

		$datatableRes = new DefaultResponse($po);

		return $datatableRes->getResponse();
	}

	public function dashboardDOdata()
	{
		$ldate = date('Y-m-d');

		$po = MaterialRequest::where("created_at", 'LIKE', '%' . $ldate . '%')->where("reference_type", "dispatch_order")->get();

		$datatableRes = new DefaultResponse($po);

		return $datatableRes->getResponse();
	}

	public function ItemStoredata()
	{
		$ldate = date('Y-m-d');
		$results = array();
		$po = ReceiveItems::where('status', 0)->where("created_at", 'LIKE', '%' . $ldate . '%')->get();

		foreach ($po as $get) {

			$pod = ReceiveItemsDetail::where('receive_items_id', $get->id)->get();

			foreach ($pod as $item) {
				$results[] = [
					'mfr' => $item->mfr,
					'part_name' => $item->part_name,
					'qty' => $item->qty_receive
				];
			}
		}
		$datatableRes = new DefaultResponse($results);

		return $datatableRes->getResponse();
	}


	public function viewQueue()
	{
		
		$purchase = PurchaseOrder::where("status", 0)->get();
		$supplier = SupplierVendor::all();
		$movers = Mover::all();
		$users = User::where("status", 1)->get();
		$entryQueue = EntryQueue::where("status", 0)->get();

		return view("simple_dashboard.list-queue", compact('movers', 'entryQueue', 'supplier', 'users', 'purchase'));
	}

	public function mrList()
	{
		$ldate = date('Y-m-d');
		$client = new \GuzzleHttp\Client();
		$response = $client->request('GET', 'https://gw.iotech.my.id/ppic/materialrequests-filtered?date='.$ldate.'&status=1');
		$content = $response->getBody()->getContents();
		$content = json_decode($content, true);

if(isset($content["materialRequests"])){
	$collection = collect($content["materialRequests"]);

	$datatableRes = new DefaultResponse($collection);

	return $datatableRes->getResponse();
}else{

	$datatableRes = new DefaultResponse($content);

	return $datatableRes->getResponse();
}
			
	}

	public function rrList(){
		$ldate = date('2022-03-02');
		$rr = ReceiveReport::where("created_at", 'LIKE', '%' . $ldate . '%')->get();

		$datatableRes = new DefaultResponse($rr);

	return $datatableRes->getResponse();
	}
	public function doList()
	{
		$ldate = date('Y-m-d');
		$client = new \GuzzleHttp\Client();
		$response = $client->request('GET', 'http://127.0.0.1:8080/api/list-do-today');
		$content = $response->getBody()->getContents();
	


	return $content;

			
	}

	public function addNewDo()
	{
		$users = User::where("status", 1)->get();
		$suppliers = SupplierVendor::all();
		$contact = SupContact::all();
		$emp = Employee::select('id', 'first_name', 'middle_name', 'last_name')->get();
		return view('simple_dashboard.new-queue-doc', compact('users', 'suppliers', 'emp','contact'));
	}



}
