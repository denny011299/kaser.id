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
            "list_status" => null,
            "so_to_company" => null,
        ], $data);
        $result = self::where('soi_status', '!=', "Deleted");
        if ($data["soi_nomer"]) {
            $result->where('soi_nomer', 'like', '%' . $data["soi_nomer"] . '%');
        }
        if ($data["list_status"]) {
            $result->whereIn('soi_status', $data["list_status"]);
        }
        if ($data["so_id"]) {
            $result->where('so_id', '=', $data["so_id"]);
        }
        if ($data["soi_id"]) {
            $result->where('soi_id', '=', $data["soi_id"]);
        }

        // Pengecekan untuk Filter PayablesReceiveables
        if($data["so_to_company"]) {
            $so_to_company = (new SalesOrder())->getSalesOrder(["so_to_company" => $data["so_to_company"]]);
            if ($so_to_company && !$so_to_company->isEmpty()) {
                $soIds = $so_to_company->map(function ($item) {
                    return $item->so_id;
                });
                $result->whereIn('so_id', $soIds);
            }else {
                $result->whereRaw('1 = 0');
            }
        };
        
        $result->orderBy('created_at', 'asc');
        $result = $result->get();

        foreach ($result as $key => $value) {
            $value->so_nomer = SalesOrder::find($value->so_id)->so_nomer;
            $value->so_to_company = SalesOrder::find($value->so_id)->so_to_company;
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
