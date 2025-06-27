<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPurchaseOrderInvoice extends Model
{
    protected $table = "supplier_purchase_order_invoices";
    protected $primaryKey = "spoi_id";
    public $timestamps = true;
    public $incrementing = true;

    function getInvoices($data = [])
    {
        $data = array_merge([
            "spoi_nomer" => null,
            "spo_id" => null,
            "spoi_id" => null,
        ], $data);

        $result = self::where('spoi_status', '!=', "Deleted");
        if ($data["spoi_nomer"]) {
            $result->where('spoi_nomer', 'like', '%' . $data["spoi_nomer"] . '%');
        }

        if ($data["spo_id"]) {
            $result->where('spo_id', '=', $data["spo_id"]);
        }
        if ($data["spoi_id"]) {
            $result->where('spoi_id', '=', $data["spoi_id"]);
        }
        
        $result->orderBy('created_at', 'asc');
        $result = $result->get();

        foreach ($result as $key => $value) {
            $value->spo_nomer = SupplierPurchaseOrder::find($value->spo_id)->spo_nomer;
        }
        return $result;
    }

    function insertInvoice($data)
    {
        $t = new self();
        $t->spoi_nomer = $data["spoi_nomer"];
        $t->spo_id = $data["spo_id"];
        $t->spoi_date = $data["spoi_date"];
        $t->spoi_total = $data["spoi_total"];
        $t->save();
        $po = SupplierPurchaseOrder::find($t->spo_id);
        $po->spo_status ="Invoice";
        $po->save();
        return $t->spoi_id;
    }

    function updateInvoice($data)
    {
        $t = self::find($data["spoi_id"]);
        $t->spoi_nomer = $data["spoi_nomer"];
        $t->spo_id = $data["spo_id"];
        $t->spoi_date = $data["spoi_date"];
        $t->spoi_total = $data["spoi_total"];
        $t->save();
        return $t->spoi_id;
    }

    function deleteInvoice($data)
    {
        $t = self::find($data["spoi_id"]);
        $t->spoi_status = "Deleted";
        $t->save();
    }
}
