<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/inventory','ItemController@inventoryDt1');
Route::get('/inventory-items{id}','ItemController@inventoryItemsId');
Route::get('/items','ItemController@ItemsDT');
Route::post('/items-req', 'ItemController@saveItemReq');
Route::get('/get-items-req', 'ItemController@getItemReq');
Route::get('/get-items/{id}', 'ItemController@ItemsId');
Route::get('/get-partnum/{part_num}', 'ItemController@ItemsPartnum');
Route::get('/itemspr-all','ItemController@ItemsDTPrice');
Route::get('/itemspr-mfr','ItemController@ItemsDTMfr');
Route::get('/itemspr-partname','ItemController@ItemsDTPartname');
Route::get('/itemspr/{id}', 'ItemController@ItemsIdPrice');
Route::get('/itemspr','ItemController@itemData');
Route::get('/itemspr-src-all','ItemController@itemDataAll');
Route::post('/save-material-request', 'ItemController@addReserveStockAPI');
Route::get('/reserve-list', 'ItemController@ReserveListAPI');
Route::get('/reserve-list/{id}', 'ItemController@DelReserveAPI');
Route::get('/pr-data', 'ItemController@getDataPR');
Route::post('/save-pr', 'ItemController@savePrAPI');
Route::get('/pr-items/{id}', 'ItemController@getItems');
Route::get('/pr-items-outstanding', 'ItemController@getItemsApprove');
Route::get('/po-data', 'ItemController@getPO');
Route::post('/report-inv-list', 'ItemController@problemInventorySave');
Route::get('/report-inv/{status}', 'ItemController@problemInventoryListAPI');
Route::get('/test','ItemController@inventorytest');


Route::get('/store-item-po','ItemController@storeItemsExternalAPI');
Route::get('/store-item-data/{id}','ItemController@storeItemsData');
Route::get('/wh-list','ItemController@WHListAPI');
Route::get('/user-list','ItemController@UserListAPI');
Route::get('/pickitem/{type}','ItemController@pickItemType');
Route::get('/pickitem-data/{request_val}','ItemController@pickItemData');
Route::get('/inventory-req','ItemController@inventoryRequest');
Route::post('/store-item', 'ItemController@StoreItemAPI');
Route::post('/pick-item', 'ItemController@addPickItemAPI');
Route::post('/transfer-item', 'ItemController@addTransferItemAPI');
Route::get('/inventory-transfer-dt','ItemController@transferRequestAPI');
Route::get('/item-prodid/{id}','ItemController@ItemsProdID');
Route::get('/po-count','ItemController@poCountAPI');
Route::get('/mr-count','ItemController@mrCountAPI');
Route::get('/in-count','ItemController@inspectionCountAPI');
Route::get('/inspection-list','ItemController@insoectionListlAPI');
Route::post('/inspection-save', 'ItemController@saveInspectionAPI');

Route::get('/inspection-data/{id}','ItemController@poData');
Route::get('/po-list/{id}','ItemController@poListApi');
Route::get('/sup-list','ItemController@supListAPI');
Route::get('/po-detail/{id}','ItemController@poDetailListAPI');
Route::get('/sup-contact/{id}','ItemController@supContactAPI');
Route::get('/sup-address/{id}','ItemController@supAddressAPI');

Route::get('/item-price/{id}','ItemController@itemPriceAPI');
Route::get('/po-status/{id}/{status}','ItemController@poStatusAPI');
Route::get('/rr-list/{id}','ItemController@rrListAPI');
Route::get('/rr-detail/{id}','ItemController@rrDetailAPI');
Route::get('/rr-status/{id}/{status}','ItemController@rrStatusAPI');
Route::get('/po-item-outstanding','ItemController@poDetailAPI');




















