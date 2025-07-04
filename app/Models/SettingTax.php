<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingTax extends Model
{
    protected $table = "setting_taxes";
    protected $primaryKey = "tx_id";
    public $timestamps = true;
    public $incrementing = true;

    function getTax($data = []){
        $data = array_merge([
            "tx_id"=>null,
            "tx_name"=>null,
        ], $data);

        $result = self::where('status', '>=', 1);
        if($data["tx_id"]) $result->where('tx_id','=',$data["tx_id"]);
        if($data["tx_name"]) $result->where('tx_name','like','%'.$data["tx_name"].'%');
        $result->orderBy('created_at', 'asc');

        return $result->get();
    }

    function insertTax($data)
    {
        $t = new self();
        $t->tx_name = $data["tx_name"];
        $t->tx_percent = $data["tx_percent"];
        $t->save();
        return $t->tx_id;
    }

    function deleteTax($data)
    {
        $t = self::find($data["tx_id"]);
        $t->status = 0;
        $t->save();
    }

    function toggleActiveTax($data)
    {
        $t = self::find($data["tx_id"]);
        $t->status = $data["status"];
        $t->save();
    }
}
