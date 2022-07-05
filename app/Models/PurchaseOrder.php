<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'po_supplier';

    protected $fillable = ['po_number','po_number_seq','pr_id', 'rfq_id', 'supplier_id', 'supplier_contact_id', 'shipment_term', 'payment_term', 'import_via', 'cost_freight', 'cost_freight_amount', 'vat', 'qs_rating', 'remark', 'attached_file', 'status', 'invoice_status', 'pos_supplier_rating', 'approved', 'verified','verified_by','approved_by', 'approved_date', 'created_by', 'modified_by'];

    public function details()
    {
        return $this->hasMany('App\Models\PODetail','pos_id');
    }
    public function supplier()
    {
        return $this->hasOne('App\Models\SupplierVendor','id','supplier_id');
    }
}
