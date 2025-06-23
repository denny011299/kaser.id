<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    protected $table = "vouchers";
    protected $primaryKey = "vc_id";
    public $timestamps = true;
    public $incrementing = true;

    function getVoucher($data = [])
    {
        $data = array_merge([
            "vc_name"=>null,
            "vc_id"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["vc_name"]) $result->where('vc_name','like','%'.$data["vc_name"].'%');
        if($data["vc_id"]) $result->where('vc_id','=',$data["vc_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
        return $result;
    }

    function insertVoucher($data)
    {
        $t = new self();
        $t->vc_name = $data["vc_name"];
        $t->vc_deskripsi = $data["vc_deskripsi"];
        $t->vc_nominal = $data["vc_nominal"];
        $t->vc_persen = $data["vc_persen"];
        $t->save();
        return $t->pu_id;
    }

    function updateVoucher($data)
    {
        $t = self::find($data["vc_id"]);
        $t->vc_name = $data["vc_name"];
        $t->vc_deskripsi = $data["vc_deskripsi"];
        $t->vc_nominal = $data["vc_nominal"];
        $t->vc_persen = $data["vc_persen"];
        $t->save();
        return $t->pu_id;
    }

    function deleteVoucher($data)
    {
        $t = self::find($data["vc_id"]);
        $t->status = 0;
        $t->save();
    }
}
