<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Mover;
use App\Models\Task;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\WarehouseLocation;
use App\Models\WarehouseLoc;
use App\Models\WarehouseRacking;
use App\Models\WhRack;
use Yajra\Datatables\Facades\Datatables;
use App\ResponseDto\DefaultResponse;
use Auth;

class WarehouseController extends Controller
{
    public function viewTask()
    {
        return view("dashboard.task");
    }
    public function taskList(Request $request)
    {
        $taskList = Task::all();

        $datatableRes = new DefaultResponse($taskList);

        return $datatableRes->getResponse();
    }

    public function viewWarehouseList()
    {
        return view("dashboard.warehouse-list");
    }

    public function warehouseList(Request $request)
    {
        $warehouseList = Warehouse::all();

        $datatableRes = new DefaultResponse($warehouseList);

        return $datatableRes->getResponse();
    }

    public function viewAddNewWarehouse()
    {
        return view("dashboard.add-new-warehouse");
    }

    public function addNewWarehouse(Request $request)
    {
        $warehouse = new Warehouse;
        $warehouse->name        = $request->get("name");
        $warehouse->description = $request->get("description");
        $warehouse->address1        = $request->get("address1");
        $warehouse->address2        = $request->get("address2");
        $warehouse->city        = $request->get("city");
        $warehouse->zipcode        = $request->get("zipcode");
        $warehouse->country        = $request->get("country");
        $warehouse->lattitude        = $request->get("lattitude");
        $warehouse->longitude        = $request->get("longitude");
        $warehouse->user_id     = Auth::user()->id;
        $warehouse->save();

        flash()->success("Successfully new Warehouse added !")->important();
        return redirect()->to('/warehouse-list');
    }

    public function viewEditWarehouse(Request $request, $id)
    {
        $warehouse = Warehouse::find($id);

        if($warehouse == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/warehouse-list');
        }
        return view("dashboard.edit-warehouse", compact('warehouse'));
    }

    public function updateWarehouse(Request $request, $id)
    {
        $warehouse = Warehouse::find($id);

        if($warehouse == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/warehouse-list');
        }

        $warehouse->name        = $request->get("name");
        $warehouse->description = $request->get("description");
        $warehouse->user_id     = Auth::user()->id;
        $warehouse->update();
        
        flash()->success("Successfully warehouse updated.")->important();
        return redirect()->to('/warehouse-list');
    }

    public function viewWarehouseLocationList()
    {
        $warehouseList = Warehouse::all();

        return view("dashboard.warehouse-location-list", compact('warehouseList'));
    }

    public function warehouseLocationList(Request $request)
    {
        $LocationList = WarehouseLocation::with("warehouse")->get();

        $datatableRes = new DefaultResponse($LocationList);

        return $datatableRes->getResponse();
    }

    public function viewAddNewWarehouseLocation()
    {
        $warehouseList = Warehouse::all();

        return view("dashboard.add-warehouse-location", compact('warehouseList'));  
    }

    public function addNewWarehouseLocation(Request $request)
    {
        $warehouseLocation = new WarehouseLocation;
        $warehouseLocation->zone     = $request->get("zone");
        $warehouseLocation->zone_description  = $request->get("zone_description");
        $warehouseLocation->warehouse_id = $request->get("warehouse_id");
        $warehouseLocation->user_id      = Auth::user()->id;
        $warehouseLocation->subzone  = $request->get("subzone");
        $warehouseLocation->subzone_desc  = $request->get("subzone_desc");
        $warehouseLocation->row  = $request->get("row");
        $warehouseLocation->row_desc  = $request->get("row_desc");
        $warehouseLocation->save();

        flash()->success("Successfully new warehouse location added.")->important();
        return redirect()->to('/warehouse-location-list');
    }

    public function viewEditWarehouseLocation(Request $request, $id)
    {
        $warehouseLocation = WarehouseLocation::where("id", $id)->first();

        $warehouseList = Warehouse::all();

        if($warehouseLocation == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/warehouse-location-list');
        }
        return view("dashboard.edit-warehouse-location", compact('warehouseList', 'warehouseLocation'));
    }

    public function updateWarehouseLocation(Request $request, $id)
    {
        $warehouseLocation = WarehouseLocation::where("id", $id)->first();

        if($warehouseLocation == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/warehouse-location-list');
        }

        $warehouseLocation->zone     = $request->get("zone");
        $warehouseLocation->zone_description  = $request->get("zone_description");
        $warehouseLocation->warehouse_id = $request->get("warehouse_id");
        $warehouseLocation->user_id      = Auth::user()->id;
        $warehouseLocation->update();
        
        flash()->success("Successfully warehouse location updated.")->important();
        return redirect()->to('/warehouse-location-list');
    }

    public function viewMoverList()
    {
        return view("dashboard.mover-list");
    }

    public function moverList()
    {
        $moverList = Mover::all();

        $datatableRes = new DefaultResponse($moverList);

        return $datatableRes->getResponse();
    }

    public function viewAddNewMover()
    {
        return view("dashboard.add-new-mover");
    }

    public function addNewMover(Request $request)
    {
        $mover = new Mover;
        $mover->name        = $request->get("name");
        $mover->description = $request->get("description");
        $mover->contact       = $request->get("contact");
        $mover->user_id     = Auth::user()->id;
        $mover->save();

        flash()->success("Successfully new Mover added.")->important();
        return redirect()->to('/mover-list');
    }

    public function viewEditMover(Request $request, $id)
    {
        $mover = Mover::find($id);

        if($mover == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/mover-list');
        }

        return view("dashboard.edit-mover", compact('mover'));
    }

    public function updateMover(Request $request, $id)
    {
        $mover = Mover::find($id);

        if($mover == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/mover-list');
        }

        $mover->name        = $request->get("name");
        $mover->contact        = $request->get("contact");
        $mover->description = $request->get("description");
        $mover->user_id     = Auth::user()->id;
        $mover->update();

        flash()->success("Successfully mover updated.")->important();
        return redirect()->to('/mover-list');
    }
    public function deleteMover(Request $request)
    {
        Mover::where("id",$request->get('id'))->delete();
        return "success";
    }
    public function deleteWarehouse(Request $request)
    {
        Warehouse::where("id",$request->get('id'))->delete();
        return "success";
    }
    public function deleteWarehouseLocation(Request $request)
    {
        WarehouseLocation::where("id",$request->get('id'))->delete();
        return "success";
    }
    public function deleteWarehouseRacking(Request $request)
    {
        WarehouseLocation::where("id",$request->get('id'))->delete();
        return "success";
    }

    public function viewWarehouseRackingList()
    {
        $warehouseList = WarehouseRacking::all();

        return view("dashboard.warehouse-racking-list", compact('warehouseList'));
    }
    public function viewWarehouseRackingCount()
    {
        $warehouseList = WarehouseRacking::all()->count();

        return view("dashboard.warehouse-racking-list", compact('warehouseList'));
    }

    public function warehouseRackingList(Request $request)
    {
        $LocationList = WarehouseRacking::all();

        $datatableRes = new DefaultResponse($LocationList);

        return $datatableRes->getResponse();
    }

    public function viewAddNewWarehouseRacking()
    {
        $warehouseList = WarehouseLocation::all();

        return view("dashboard.add-warehouse-racking", compact('warehouseList'));  
    }

    public function addNewWarehouseRacking(Request $request)
    {
        $warehouseRacking = new WarehouseRacking;
       
        $warehouseRacking->rack     = $request->get("rack");
        $warehouseRacking->rack_desc  = $request->get("rack_desc");
        $warehouseRacking->level = $request->get("level");
        $warehouseRacking->bin  = $request->get("bin");
        $warehouseRacking->location_id = $request->get("location_id");
        $warehouseRacking->user_id      = Auth::user()->id;
        $warehouseRacking->save();

        flash()->success("Successfully new warehouse Racking added.")->important();
        return redirect()->to('/warehouse-racking-list');
    }

    public function viewEditWarehouseRacking(Request $request, $id)
    {
        $warehouseRacking = WarehouseRacking::where("id", $id)->first();

        $warehouseList = Warehouse::all();

        if($warehouseRacking == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/warehouse-racking-list');
        }
        return view("dashboard.edit-warehouse-racking", compact('warehouseList', 'warehouseRacking'));
    }

    public function updateWarehouseRacking(Request $request, $id)
    {
        $warehouseRacking = WarehouseRacking::where("id", $id)->first();

        if($warehouseRacking == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/warehouse-racking-list');
        }

        $warehouseRacking->rack     = $request->get("rack");
        $warehouseRacking->rack_desc  = $request->get("rack_desc");
        $warehouseRacking->level = $request->get("level");
        $warehouseRacking->bin  = $request->get("bin");
        $warehouseRacking->location_id = $request->get("location_id");
        $warehouseRacking->user_id      = Auth::user()->id;
        $warehouseRacking->update();
        
        flash()->success("Successfully warehouse racking updated.")->important();
        return redirect()->to('/warehouse-racking-list');
    }

//CUSTOMER
    public function viewCustomerList()
    {
        return view("dashboard.customer-list");
    }

    public function customerList()
    {
        $customerList = Customer::all();

        $datatableRes = new DefaultResponse($customerList);

        return $datatableRes->getResponse();
    }

    public function viewAddNewCustomer()
    {
        return view("dashboard.add-new-customer");
    }

    public function addNewCustomer(Request $request)
    {
        $customer = new Customer;
        $customer->name        = $request->get("name");
        $customer->address = $request->get("address");
        $customer->city       = $request->get("city");
        $customer->lantitude       = $request->get("lantitude");
        $customer->longitude       = $request->get("longitude");
        $customer->user_id     = Auth::user()->id;
        $customer->save();

        flash()->success("Successfully new Customer added.")->important();
        return redirect()->to('/customer-list');
    }

    public function viewEditCustomer(Request $request, $id)
    {
        $customer = Customer::find($id);

        if($customer == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/customer-list');
        }

        return view("dashboard.edit-customer", compact('customer'));
    }


    public function updateCustomer(Request $request, $id)
    {
        $customer = Customer::find($id);

        if($customer == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/customer-list');
        }

        $customer->name        = $request->get("name");
        $customer->address = $request->get("address");
        $customer->city        = $request->get("city");
        $customer->lantitude        = $request->get("lantitude");
        $customer->longitude        = $request->get("longitude");
        $customer->user_id     = Auth::user()->id;
        $customer->update();

        flash()->success("Successfully customer updated.")->important();
        return redirect()->to('/customer-list');
    }
    public function deleteCustomer(Request $request)
    {
        Customer::where("id",$request->get('id'))->delete();
        return "success";
    }

    public function viewSupplierList()
    {
        return view("dashboard.supplier-list");
    }

    public function supplierList()
    {
        $supplierList = Supplier::all();

        $datatableRes = new DefaultResponse($supplierList);

        return $datatableRes->getResponse();
    }

    public function viewAddNewSupplier()
    {
        return view("dashboard.add-new-supplier");
    }

    public function addNewSupplier(Request $request)
    {
        $supplier = new Supplier;
        $supplier->name        = $request->get("name");
        $supplier->address = $request->get("address");
        $supplier->city       = $request->get("city");
        $supplier->lantitude       = $request->get("lantitude");
        $supplier->longitude       = $request->get("longitude");
        $supplier->user_id     = Auth::user()->id;
        $supplier->save();

        flash()->success("Successfully new Supplier added.")->important();
        return redirect()->to('/supplier-list');
    }

    public function viewEditSupplier(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if($supplier == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/supplier-list');
        }

        return view("dashboard.edit-supplier", compact('supplier'));
    }

    public function updateSupplier(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if($supplier == null){
            flash()->error("Invalid request.")->important();
            return redirect()->to('/supplier-list');
        }

        $supplier->name        = $request->get("name");
        $supplier->description = $request->get("description");
        $supplier->user_id     = Auth::user()->id;
        $supplier->update();

        flash()->success("Successfully supplier updated.")->important();
        return redirect()->to('/supplier-list');
    }
    public function deleteSupplier(Request $request)
    {
        Supplier::where("id",$request->get('id'))->delete();
        return "success";
    }

public function whRackData($id){
    $rack = WhRack::where("wh_id",$id)->get();
    return $rack;
}

public function addWHLoaction(Request $request)

{
    $zone = $request->get("zone_id");
    $rack = $request->get("rack_id");
    $level = $request->get("level_id");
    $bin = $request->get("bin_id");

    if($request->get("zone_id") == null){
        $supplier = new WarehouseLoc;
        $supplier->wh_id        = $request->get("wh_id");
        $supplier->save();
}elseif($request->get("rack_id") == null){
    $supplier = new WarehouseLoc;
    $supplier->wh_id        = $request->get("wh_id");
    $supplier->zone_id = $request->get("zone_id");
    $supplier->wh_name = $zone;
    $supplier->save();
}elseif($request->get("level_id") == null){
    $supplier = new WarehouseLoc;
    $supplier->wh_id        = $request->get("wh_id");
    $supplier->zone_id = $request->get("zone_id");
    $supplier->rack_id       = $request->get("rack_id");
    $supplier->wh_name = $zone.'.'.$rack;
    $supplier->save();
}elseif($request->get("bin_id") == null){
    $supplier = new WarehouseLoc;
    $supplier->wh_id        = $request->get("wh_id");
    $supplier->zone_id = $request->get("zone_id");
    $supplier->rack_id       = $request->get("rack_id");
    $supplier->level_id       = $request->get("level_id");
    $supplier->wh_name = $zone.'.'.$rack.'.'.$level;
    $supplier->save();
}
else{
    $supplier = new WarehouseLoc;
    $supplier->wh_id        = $request->get("wh_id");
    $supplier->zone_id = $request->get("zone_id");
    $supplier->rack_id       = $request->get("rack_id");
    $supplier->level_id       = $request->get("level_id");
    $supplier->bin_id       = $request->get("bin_id");
    $supplier->wh_name = $zone.'.'.$rack.'.'.$level.'.'.$bin;
    $supplier->save();
}
  
}

public function whLocationGetData()
{

        $customerList = WarehouseLoc::with('warehouse')->get();

        $datatableRes = new DefaultResponse($customerList);

        return $datatableRes->getResponse();

        
}


}
