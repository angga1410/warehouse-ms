<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/itemstore-data', 'QueueController@ItemStoredata');
Route::get('/unloading-dashboard', 'ItemController@unloadingDashboard');
Route::get('/warehouse-dashboard', 'ItemController@loadingDashboard');
Route::post('/receivedocument-dt1', 'QueueController@dashboardPOdata');
Route::post('/DOdocument-dt', 'QueueController@dashboardDOdata');

Route::get('/mr-list', 'QueueController@mrList');
Route::get('/rr-list', 'QueueController@rrList');
Route::get('/do-list', 'QueueController@doList');

Route::get("/coba",'QueueController@supplierList');
Route::get('/', function () {
    //
    ('welcome');
    return redirect()->to('/login');
});

Route::get('/login', function(){
	return view("login");
})->name('login');

Route::post('/login', 'UserController@doLogin');

Route::get('/view-newUser','UserController@viewAddNewUser');
Route::post('/add-newUser','UserController@addNewUser');


  Route::group(['middleware' => ['auth']], function () {
	Route::get('/logout', 'UserController@logOut');

	//dashboard
  	Route::get('/dashboard', function(){
		return view("dashboard.dashboard");
	});
  	Route::get('/change-password', function(){
		return view("dashboard.change-password");
	});




  	Route::post('/change-password','UserController@changePassword');
  Route::group(['middleware' => ['role:admin']], function() {

  	//user list and add new user
  	Route::get('/user-list','UserController@viewUserList');
	Route::post('/userList-dt','UserController@userListDt');
	Route::post('/edit-user','UserController@editUser');
	Route::get('/update-user/{id}','UserController@updateUserView');
	Route::post('/update-user','UserController@updateUser');
	Route::post('/delete-user','UserController@deleteUser');

	//warehouse list and add new warehouse and edit,delete warehouse.
	Route::get('/warehouse-list', 'WarehouseController@viewWarehouseList');
	Route::post('/warehouse-list-dt', 'WarehouseController@warehouseList');
	Route::get('/new-warehouse', 'WarehouseController@viewAddNewWarehouse');
	Route::post('/add-new-warehouse', 'WarehouseController@addNewWarehouse');
	Route::get('/warehouse/{id}', 'WarehouseController@viewEditWarehouse');
	Route::post('/update-warehouse/{id}', 'WarehouseController@updateWarehouse');
	Route::post('/delete-warehouse','WarehouseController@deleteWarehouse');

	Route::get('/task-list', 'WarehouseController@viewTask');
	Route::post('/task-list-dt', 'WarehouseController@taskList');

	//warehouse location list and add new location and also edit,delete it.
	Route::get('/warehouse-location-list', 'WarehouseController@viewWarehouseLocationList');
	Route::post('/warehouse-location-list-dt', 'WarehouseController@warehouseLocationList');
	Route::get('/new-warehouse-location', 'WarehouseController@viewAddNewWarehouseLocation');
	
	Route::get('/warehouse-location/{id}', 'WarehouseController@viewEditWarehouseLocation');
	Route::get('/rack/{id}', 'WarehouseController@whRackData');
	Route::post('/update-warehouse-location/{id}', 'WarehouseController@updateWarehouseLocation');
	Route::post("/delete-warehouse-location",'WarehouseController@deleteWarehouseLocation');

	Route::post('/save-wh-location', 'WarehouseController@addWHLoaction');
	Route::get('/wh-location-dt', 'WarehouseController@whLocationGetData');
	

		//warehouse racking list and add new location and also edit,delete it.
		Route::get('/warehouse-racking-list', 'WarehouseController@viewWarehouseRackingList');
		Route::post('/warehouse-racking-list-dt', 'WarehouseController@warehouseRackingList');
		Route::get('/new-warehouse-racking', 'WarehouseController@viewAddNewWarehouseRacking');
		Route::post('/add-new-warehouse-racking', 'WarehouseController@addNewWarehouseRacking');
		Route::get('/warehouse-racking/{id}', 'WarehouseController@viewEditWarehouseRacking');
		Route::post('/update-warehouse-racking/{id}', 'WarehouseController@updateWarehouseRacking');
		Route::post("/delete-warehouse-racking",'WarehouseController@deleteWarehouseRacking');

	//mover list and also edit,delete mover.
	Route::get('/mover-list', 'WarehouseController@viewMoverList');
	Route::post('/mover-list-dt', 'WarehouseController@moverList');
	Route::get('/new-mover', 'WarehouseController@viewAddNewMover');
	Route::post('/add-new-mover', 'WarehouseController@addNewMover');
	Route::get('/mover/{id}', 'WarehouseController@viewEditMover');
	Route::post('/update-mover/{id}', 'WarehouseController@updateMover');
	Route::post('/delete-mover','WarehouseController@deleteMover');

	//supplier list and also edit,delete mover.
	Route::get('/supplier-list', 'WarehouseController@viewSupplierList');
	Route::post('/supplier-list-dt', 'WarehouseController@supplierList');
	Route::get('/new-supplier', 'WarehouseController@viewAddNewSupplier');
	Route::post('/add-new-supplier', 'WarehouseController@addNewSupplier');
	Route::get('/supplier/{id}', 'WarehouseController@viewEditSupplier');
	Route::post('/update-supplier/{id}', 'WarehouseController@updateSupplier');
	Route::post('/delete-supplier','WarehouseController@deleteSupplier');

		//customer list and also edit,delete mover.
		Route::get('/customer-list', 'WarehouseController@viewCustomerList');
		Route::post('/customer-list-dt', 'WarehouseController@customerList');
		Route::get('/new-customer', 'WarehouseController@viewAddNewCustomer');
		Route::post('/add-new-customer', 'WarehouseController@addNewCustomer');
		Route::get('/customer/{id}', 'WarehouseController@viewEditCustomer');
		Route::post('/update-customer/{id}', 'WarehouseController@updateCustomer');
		Route::post('/delete-customer','WarehouseController@deleteCustomer');

  });

//   Route::group(['middleware' => ['role:admin|internal_department']], function() {

  	//store item request
 //  	Route::get('/store-item-request','ItemController@storeItemReq');
	// Route::get('/store-item-reqdata/{storeReq_id}','ItemController@storeItemReqData');
	// Route::post('/add-store-item-req','ItemController@addStoreItemReq');

	Route::get('/storing','ItemController@storingDashboard');
	Route::get('/internal-storing','ItemController@InternalstoringDashboard');
	Route::get('/storeitem-request','ItemController@storeitemRequest');
	Route::post('/storeitem-request-dt','ItemController@storeitemRequestDt');
	Route::get('/new-storeitem-request', 'ItemController@viewAddNewStoreItemRequest');
	Route::post('/add-new-storeitem-request', 'ItemController@addStoreItemRequest');
	Route::get('/storeitem-request-list/{item_id}','ItemController@storeitemRequestPartList');
	Route::get('/edit-storeitem-request/{id}','ItemController@editStoreItemRequest');
	Route::post('/update-storeitem-request','ItemController@updateStoreItemRequest');
	Route::post('/delete-storeitem-parts','ItemController@deleteStoreItemParts');
	Route::get('/storeitems-data','ItemController@storeitemData');
	Route::post('/delete-sir','ItemController@deleteSIR');
	Route::get('/mr/{id}','ItemController@mr');
	Route::get('/mr1/{id}','ItemController@mr_post');

	//product
	Route::get('/product-list','ItemController@ProductListView');
	Route::post('/product-dt', 'ItemController@productList');
	Route::post('/new-product', 'ItemController@addNewProduct');
	Route::get('/add-new-product', 'ItemController@viewAddNewProduct');
	Route::get('/product/{id}', 'ItemController@viewEditProduct');
	Route::get('/po/{id}', 'ItemController@po');
	Route::get('/sup/{id}', 'ItemController@sup');
	Route::get('/doc/{id}', 'ItemController@doc');
	Route::get('/qc/{id}', 'ItemController@qc');
	Route::get('/mover/{id}', 'ItemController@mover');
	Route::post('/update-product/{id}', 'ItemController@updateProduct');
	Route::post('/delete-product','ItemController@deleteProduct');

	//send store items
	Route::get('/send-store-items-list','ItemController@sendStoreItemList');
	Route::post('/send-store-items-list-dt','ItemController@sendStoreItemListDt');
	Route::get('/send-store-items-detail/{id}','ItemController@sendStoreItemDetail');
	Route::post('/delete-send-store-items','ItemController@deleteSendStoreItem');
	Route::get('/send-store-items','ItemController@sendStoreItems');
	Route::get('/sendstore-itemsdata/{storeReq_id}','ItemController@sendStoreItemsData');
	Route::post('/add-sendstore-items','ItemController@addSendStoreItems');

//   });

//   Route::group(['middleware' => ['role:admin|warehouse']], function() {

  	//receive items in warehouse
  	Route::get('/receive-itemwh-list','ItemController@receiveItemWHList');
	Route::post('/receive-itemwh-list-dt','ItemController@receiveItemWHListDt');
	
	Route::get('/receive-itemwh-detail/{id}','ItemController@receiveItemWHDetail');
	Route::post('/delete-receiveitem-wh','ItemController@deleteReceiveItemWH');
  	Route::get('/receiveitem-wh','ItemController@receiveItemsWH');
	Route::get('/receive-itemsWH-data/{id}/{type}','ItemController@receiveItemWHData');
	Route::get('/receiveItemswh-type/{type}','ItemController@receiveItemsWHType');
	Route::post('/add-receiveitems-wh','ItemController@addReceiveItemWH');

	//store items in warehouse
	Route::get('/store-items-list','ItemController@storeItemsDetailList');
	Route::post('/store-items-list-dt','ItemController@storeItemsListDt');
	Route::get('/store-items-detail/{id}','ItemController@storeItemsDetail');
	Route::post('/delete-store-items','ItemController@deleteStoreItems');
	Route::get('/store-item','ItemController@storeItemList');
	Route::get('/store-itemdata/{id}','ItemController@storeItemsData');
	Route::get('/storeItems-type/{type}','ItemController@storeItemsType');
	Route::post('/add-storeitems','ItemController@addStoreItem');

	//pick list in warehouse
	Route::get('/picking-dashboard','ItemController@pickingDashboard');
	Route::get('/pick-items-list','ItemController@pickItemsDetailList');
	Route::post('/pick-items-list-dt','ItemController@pickItemsListDt');
	Route::get('/pick-items-detail/{id}','ItemController@pickItemsDetail');
	Route::post('/delete-pick-items','ItemController@deletePickItems');
	Route::get('/pick-item','ItemController@pickItem');
	Route::get('/pick-item-req-doc','ItemController@pickItemReqDoc');
	Route::get('/pick-item-data/{request_val}','ItemController@pickItemData');
	Route::get('/pick-item-data-req-doc/{request_val}','ItemController@pickItemDataReqDoc');
	Route::get('/pickitem-type/{type}','ItemController@pickItemType');
	Route::post('/add-pick-item','ItemController@addPickItem');
	Route::post('/add-pick-item-req-doc','ItemController@addPickItemReqDoc');

	//send items from warehouse
	Route::get('/packing-dashboard','ItemController@packingDashboard');
	Route::get('/senditems-fromwh-list','ItemController@sendItemsFromWHDetailList');
	Route::post('/senditems-fromwh-list-dt','ItemController@sendItemsFromWHListDt');
	Route::get('/senditems-fromwh-detail/{id}','ItemController@sendItemsFromWHDetail');
	Route::post('/delete-senditems-fromwh','ItemController@deleteSendItemsFromWH');
	Route::get('/senditem-fromwh','ItemController@sendItemFromWH');
	Route::get('/sendwh-item-data/{pick_val}','ItemController@sendwhItemData');
	Route::get('/sendItems-type/{type}','ItemController@sendItemsType');
	Route::post('/add-senditems-fromwh','ItemController@addSendItemFromWH');

	//transfer items
	Route::get('/transfer-item-list','ItemController@transferItemDetailList');
	Route::post('/transfer-item-list-dt','ItemController@transferItemListDt');
	Route::get('/transfer-item-detail/{id}','ItemController@transferItemDetail');
	Route::post('/delete-transfer-item','ItemController@deletetransferItem');
	Route::get('/transfer-item','ItemController@transferItem');
	Route::post('/add-transfer-item','ItemController@addTransferItem');
	Route::get('/transferitems-data','ItemController@transferItemsData');

	//Inventory List

	Route::get('/inventory-list','ItemController@inventoryList');
	Route::get('/inventory-tr-list','ItemController@inventoryTrList');
	Route::get('/inventory-wip-list','ItemController@inventoryWipList');
	Route::get('/inventory-dt','ItemController@inventoryDt');
	Route::post('/delete-inventory','ItemController@deleteInventory');


	//Reserve stock
	Route::get('/reserve-stock-list','ItemController@reserveStockList');
	Route::get('/add-reserve-stock','ItemController@newreserveStockList');

	//Transaction Inventory

	Route::get('/transaction-inventory-list','ItemController@transactionInventoryList');
	Route::post('/transaction-inventory-dt','ItemController@transactionInventoryDt');
	Route::post('/delete-transaction-inventory','ItemController@deleteInventoryTransaction');
//   });

//   Route::group(['middleware' => ['role:admin|loading_department']], function() {

  	//entry queue
  	Route::get('/entry-queue', 'QueueController@viewEntryQueueList');
	Route::post('/entry-queue-dt', 'QueueController@entryQueueList');
	Route::get('/new-entry-queue', 'QueueController@viewAddNewEntryQueue');
	Route::post('/add-new-entry-queue', 'QueueController@addNewEntryQueue');
	Route::get('/update-queue/{queue_id}','QueueController@updateQueueView');
	Route::post('/update-queue','QueueController@updateQueue');
	Route::post('/delete-entryQueue','QueueController@deleteEntryQueue');
	Route::get('/entry-queue-item/{id}','QueueController@entryQueueItemList');

	//receive documents
	Route::get('/receive-document', 'QueueController@viewReceiveDocument');
	Route::post('/receivedocument-dt', 'QueueController@receiveDocument');
	Route::post('/receivedocument-dt-dahsboard', 'QueueController@receiveDocumentdahsboard');
	Route::get('/new-receive-document', 'QueueController@viewAddNewReceiveDocument');
	Route::post('/add-new-receive-document', 'QueueController@addNewReceiveDocument');
	Route::get('/edit-receive-document/{id}', 'QueueController@viewEditReceiveDocument');
	Route::post('/update-receive-document/{id}', 'QueueController@updateReceiveDocument');
	Route::post('/status-receive-document/{id}', 'QueueController@updateStatusReceiveDocument');
	Route::post('/delete-receive-document','QueueController@deleteReceiveDocument');
	Route::post('/inspectiondocument-dt', 'QueueController@inspectionDocument');

	Route::get('/inspection-document', 'QueueController@viewInspectionDocument');
	Route::get('/receive', 'QueueController@viewReceiveDoc');
	//qc request
	Route::get('/qc-request-list','QueueController@qcRequestList');
	Route::post('/qcRequestlist-dt','QueueController@qcRequestListDt');
	Route::post('/qcRequestlist-dispatch','QueueController@qcRequestListDispatch');
	Route::post('/qcRequestoutstanding-dt','QueueController@qcRequestListOutstanding');
	Route::get('/inspection', 'QueueController@viewAddNewQcRequest');
	Route::get('/get-remark/{id}', 'QueueController@getRemark');
	Route::post('/add-new-qc-request', 'QueueController@addNewQcRequest');
	Route::get('/qc-request-parts-list/{item_id}','QueueController@qcRequestPartList');
	Route::get('/edit-qcRequest/{id}','QueueController@editQcRequest');
	Route::post('/update-qcRequest','QueueController@updateQcRequest');
	Route::post('/delete-qc-request','QueueController@deleteQcRequest');
	Route::get('/qc-data/{queue_id}','QueueController@qcData');
	Route::get('/products-data','QueueController@productData');
	Route::get('/document','QueueController@document');


	//dispatch to warehouse

// Route::get('/dispatch-wh','QueueController@viewDispatchWH');

	//qc request serial no.
	Route::get('/qc-request-serial-no','QueueController@qcRequestSerialNo');
	Route::post('/qc-request-serialNo-dt','QueueController@qcRequestSerialNoDt');
	Route::get('/new-qcRequest-serialno','QueueController@viewAddQcRequestSerialno');
	Route::post('/add-qcRequest-serialno','QueueController@addNewQcRequestSerialno');
	Route::get('/serialno-parts/{id}','QueueController@getSerialnoParts');
	Route::get('/update-qcsrno/{id}','QueueController@updateQcSrNoView');
	Route::post('/update-qcsrno','QueueController@updateQcSrNo');
	Route::post('/delete-qcRequest-serialno','QueueController@deleteQcRequestSerialno');

  //report serial no.
	Route::get('/report-serial-no','QueueController@ReportSerialNo');
	Route::post('/report-serialNo-dt','QueueController@ReportSerialNoDt');
	Route::get('/new-report-serialno','QueueController@viewAddReportSerialno');
	Route::post('/add-report-serialno','QueueController@addNewReportSerialno');
	Route::get('/serialRno-parts/{id}','QueueController@getRSerialnoParts');
	Route::get('/update-reportno/{id}','QueueController@updateReportNoView');
	Route::post('/update-reportno','QueueController@updateReportNo');
	Route::post('/delete-report-serialno','QueueController@deleteReportSerialno');

	//return form
	Route::get('/qcReturn-list','QueueController@qcReturnList');
	Route::post('/qcReturn-dt','QueueController@qcReturnListDt');
	Route::get('/qcReturn','QueueController@qcReturnItems');
	Route::get('/qcReturndata/{id}','QueueController@qcReturnItemsData');
	Route::post('/add-qcReturn','QueueController@addQcReturnItems');
	Route::post('/edit-qcReturn','QueueController@editQcReturnStatus');
	Route::get('/update-return/{id}','QueueController@updateReturnView');
	Route::post('/update-return','QueueController@updateReturn');
	Route::post('/delete-qc-return','QueueController@deleteReturn');


	//return sorm serial no
  Route::get('/qc-return-serial-no','QueueController@qcReturnSerialNo');
Route::post('/qc-return-serialNo-dt','QueueController@qcReturnSerialNoDt');
Route::get('/new-qcReturn-serialno','QueueController@viewAddQcReturnSerialno');
Route::post('/add-qcReturn-serialno','QueueController@addNewQcReturnSerialno');
Route::get('/returnSerialno-parts/{id}','QueueController@getReturnSerialnoParts');
Route::get('/update-returnsrno/{id}','QueueController@updateReturnSrNoView');
Route::post('/update-returnsrno','QueueController@updateReturnSrNo');
Route::post('/delete-qcReturn-serialno','QueueController@deleteQcReturnSerialno');

//receive report
	Route::get('/report-list','ItemController@reportList');
	Route::post('/report-list-dt','ItemController@reportListDt');
	Route::get('/new-report', 'ItemController@viewAddNewReport');
	Route::post('/add-new-report', 'ItemController@addNewReport');
	Route::get('/report-detail-list/{report_id}','ItemController@reportDetailList');
	Route::post('/delete-report','ItemController@deleteReport');
	// Route::get('/report-type/{type}','ItemController@reportType');
	Route::get('/report-data/{id}','ItemController@reportData');
	Route::get('/report-data2/{id}','ItemController@reportData2');
	Route::get('/po-data/{id}','ItemController@poData');
  	Route::get('/report-data-sup/{id}','ItemController@reportDataSup');
	Route::get('/update-report/{id}','ItemController@updateReportView');
	Route::post('/update-report','ItemController@updateReport');

  //receive serial no report
	Route::get('/report-serial-list','ItemController@reportListno');
	Route::post('/report-serial-list-dt','ItemController@reportListDtno');
	Route::post('/add-new-report-serial', 'ItemController@addNewReportno');
	Route::get('/report-detail-list-serial/{report_id}','ItemController@reportDetailListno');
	Route::post('/delete-report-serial','ItemController@deleteReportno');
	// Route::get('/report-type/{type}','ItemController@reportType');
	Route::get('/report-data-serial/{id}','ItemController@reportDatano');
	Route::get('/update-report-serial/{id}','ItemController@updateReportViewno');
	Route::post('/update-report-serial','ItemController@updateReportno');

	//return report

	Route::get('/report-return-list','ItemController@reportReturnList');
	Route::post('/report-return-list-dt','ItemController@reportReturnListDt');
	Route::get('/new-report-return', 'ItemController@viewAddNewReportReturn');
	Route::get('/report-return-data/{id}','ItemController@reportReturnData');
	Route::post('/add-new-report-return', 'ItemController@addNewReportReturn');
	Route::get('/report-return-detail-list/{report_id}','ItemController@reportReturnDetailList');
	Route::post('/delete-return-report','ItemController@deleteReportReturn');
	Route::get('/update-report-return/{id}','ItemController@updateReportReturnView');
	Route::post('/update-report-return','ItemController@updateReportReturn');

	//receive items in loading department
  	Route::get('/item-list','ItemController@itemList');
	Route::post('/dt/itemlist','ItemController@itemListDt');
	// Route::get('/dt/item-list','ItemController@itemListDt');
	Route::get('/new-item', 'ItemController@viewAddNewItem');
	Route::post('/add-new-item', 'ItemController@addNewItem');
	Route::get('/item-parts-list/{item_id}','ItemController@itemPartList');
	Route::get('/report-itemlist/{id}','ItemController@itemReportDetail');
	Route::post('/delete-item','ItemController@deleteItem');
	Route::get('/update-item/{id}','ItemController@updateItemView');
	Route::post('/update-item','ItemController@updateItem');

	//send items to wharehouse from loading department
	Route::get('/senditems-towh-list','ItemController@sendItemsToWHList');
	Route::post('/senditems-towh-dt','ItemController@sendItemsToWHListDt');
	Route::get('/senditems-towh-detail/{id}','ItemController@sendItemsToWHDetail');
	Route::post('/delete-senditems-towh','ItemController@deleteSendItemsToWH');
	Route::get('/sendItem-toWarehouse','ItemController@sendItemToWH');
	Route::get('/sendItem-toWarehouse-data/{id}','ItemController@sendItemToWHData');
	Route::get('/handover/{id}','ItemController@handover');
	Route::post('/add-sendItem-toWarehouse','ItemController@addSendItemToWH');

	//packing items
	Route::get('/packing-items-list','ItemController@packingList');
	Route::post('/packing-items-dt','ItemController@packingListDt');
	Route::post('/packing-items-dt-dashboard','ItemController@packingListDtDashboard');
	Route::get('/packing-items','ItemController@packingItems');
	Route::get('/packing-itemsdata/{id}','ItemController@packingItemsData');
	Route::post('/add-packing-items','ItemController@addPackingItems');
	Route::post('/edit-packing-items','ItemController@editStatus');
	Route::get('/pack-data/{id}','ItemController@packData');
	

	//send dispatch order items
	Route::get('/sendingDo-list','ItemController@sendingDoList');
	Route::post('/sendingDo-dt','ItemController@sendingDoListDt');
	Route::get('/sendingDo','ItemController@sendingDoItems');
	Route::get('/sendingDodata/{id}','ItemController@sendingDoItemsData');
	Route::post('/add-sendingDo','ItemController@addSendDoItems');
	Route::post('/edit-sendingDo','ItemController@editSendDoStatus');

//   });

//   Route::group(['middleware' => ['role:admin|loading_department|internal_department']], function() {

  	//receive items from warehouse for both department loading and internal
  	Route::get('/receiveitem-fromwh-list','ItemController@receiveItemsFromWHList');
	Route::post('/receiveitem-fromwh-list-dt','ItemController@receiveItemsFromWHListDt');
	Route::get('/receiveitem-fromwh-detail/{id}','ItemController@receiveItemsFromWHDetail');
	Route::post('/delete-receiveitem-fromwh','ItemController@deleteReceiveItemsFromWH');
  	Route::get('/receiveitem-fromwh','ItemController@receiveItemFromWH');
	Route::get('/receivewh-item-data/{pick_val}','ItemController@receivewhItemData');
	Route::get('/receiveItems-type/{type}','ItemController@receiveItemType');
	Route::post('/add-receiveitems-fromwh','ItemController@addReceiveItemFromWH');

	//material request
  	Route::get('/material-request','ItemController@materialRequest');
	Route::post('/material-request-dt','ItemController@materialRequestDt');
	Route::post('/do-dt','ItemController@DODt');
	Route::get('/new-material-request', 'ItemController@viewAddNewMaterialRequest');
	Route::get('/new-doc-request', 'ItemController@addNewDocPick');
	Route::post('/add-new-material-request', 'ItemController@addMaterialRequest');
	Route::get('/material-request-list/{item_id}','ItemController@materialRequestPartList');
	Route::get('/edit-material-request/{id}','ItemController@editMaterialRequest');
	Route::post('/update-material-request','ItemController@updateMaterialRequest');
	Route::post('/delete-material-parts','ItemController@deleteMaterialParts');

	Route::post('/delete-mr','ItemController@deleteMR');

	Route::get('/view-print/{id}','ItemController@viewPrint');

	Route::post('/replace','ItemController@replace')->name('replace');

	Route::get('/inventory-request','ItemController@inventoryRequest');
	Route::post('/save-inventory-request','ItemController@saveInventoryReq');

	Route::get('/request-doc-list','ItemController@ReqDocList');
	
	Route::get('/request-doc-dt','ItemController@docReqDT');

	Route::get('/request-doc-print/{id}','ItemController@viewPrintDoc');
	Route::get('/request-doc-del/{id}','ItemController@deleteDocReq');
	Route::get('/new-official-report', 'ItemController@addNewOfficialReport');
	Route::post('/save-official-report','ItemController@saveOfficialReport');
	Route::get('/official-report-list','ItemController@OfficialReportList');
	Route::get('/official-report-dt','ItemController@officialReportDT');
	Route::get('/official-report-print/{id}','ItemController@viewPrintOfficialReport');
	Route::get('/official-report-del/{id}','ItemController@deleteOfficialreport');
	Route::get('/po-data2/{id}','ItemController@poData2');

	Route::get('/transfer-request','ItemController@transferRequest');
	Route::get('/new-do', 'ItemController@viewAddNewDO');
	Route::get('/do/{id}','ItemController@do');
	Route::get('/transaction-item/{id}','ItemController@transactionItem');
	Route::get('/stock-opname-list','ItemController@stockOpnameListView');
	Route::get('/stock-opname-new','ItemController@stockOpnameListNew');
	Route::post('/stock-opname-save','ItemController@saveStockOpname');
	Route::get('/stock-opname-add','ItemController@stockOpnameListAdd');
	Route::post('/stock-opname-add-save','ItemController@saveStockOpnameAdd');

	Route::get('/po-do-report','ItemController@podoReportList');
	Route::get('/po-do-dt','ItemController@podoData');
	Route::get('/po-do-list/{po}','ItemController@podoList');

	Route::get('/testing','ItemController@Testing');


	Route::get('/queue-list', 'QueueController@viewQueue');
	Route::get('/prob-inv-list', 'ItemController@problemInventoryList');
	Route::get('/prob-inv-update/{id}', 'ItemController@updateStatusProb');

	Route::get('/wip-data', 'ItemController@wipGetData');
	Route::get('/tr-data', 'ItemController@trGetData');

	Route::get('/get-do/{id}','ItemController@getDoDetail');
	Route::get('/match-pn/{id}','ItemController@matchPN');


	Route::get('/add-new-do-po', 'QueueController@addNewDo');
	Route::post('/save-po-do','ItemController@savePoDo');
	
	

	
	
//   });
});


