<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderDetailInvoice extends Model
{
    protected $table = "sales_order_invoices";
    protected $primaryKey = "soi_id";
    public $timestamps = true;
    public $incrementing = true;

    function getInvoices($data = [])
    {
        $data = array_merge([
            "soi_nomer" => null,
            "so_id" => null,
            "soi_id" => null,
        ], $data);

        $result = self::where('soi_status', '!=', "Deleted");
        if ($data["spoi_nomer"]) {
            $result->where('soi_nomer', 'like', '%' . $data["soi_nomer"] . '%');
        }

        if ($data["spo_id"]) {
            $result->where('so_id', '=', $data["so_id"]);
        }
        if ($data["spoi_id"]) {
            $result->where('soi_id', '=', $data["soi_id"]);
        }
        
        $result->orderBy('created_at', 'asc');
        $result = $result->get();

        foreach ($result as $key => $value) {
            $value->so_nomer = SalesOrder::find($value->so_id)->so_nomer;
        }
        return $result;
    }

    function insertInvoice($data)
    {
        $t = new self();
        $t->soi_nomer = $this->generateInvNumber();
        $t->so_id = $data["so_id"];
        $t->soi_date = $data["soi_date"];
        $t->soi_total = $data["soi_total"];
        $t->soi_due_date = $data["soi_due_date"];
        $t->save();
        $po = SalesOrder::find($t->so_id);
        $po->so_status ="Invoice";
        $po->save();
        return $t->soi_id;
    }

    function updateInvoice($data)
    {
        $t = self::find($data["soi_id"]);
        $t->soi_nomer = $this->generateInvNumber();
        $t->so_id = $data["so_id"];
        $t->soi_date = $data["soi_date"];
        $t->soi_total = $data["soi_total"];
        $t->soi_due_date = $data["soi_due_date"];
        $t->save();
        return $t->soi_id;
    }

    function deleteInvoice($data)
    {
        $t = self::find($data["soi_id"]);
        $t->soi_status = "Deleted";
        $t->save();
    }

}
