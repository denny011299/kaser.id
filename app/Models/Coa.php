<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    protected $table = "coas";
    protected $primaryKey = "coa_id";
    public $timestamps = true;
    public $incrementing = true;

    function getCoa($data = []){
        $data = array_merge([
            "coa_nama"=>null,
            "coa_kode"=>null,
            "coa_id"=>null,
            "cc_id"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["coa_nama"]) $result->where('coa_nama','like','%'.$data["coa_nama"].'%');
        if($data["coa_kode"]) $result->where('coa_kode','like','%'.$data["coa_kode"].'%');
        if($data["coa_id"]) $result->where('coa_id','=',$data["coa_id"]);
        if($data["cc_id"]) $result->where('cc_id','=',$data["cc_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();

        foreach ($result as $key => $value) {
            $value->cc_kode = CoaCategories::find($value->cc_id)->cc_kode;
            $value->cc_nama = CoaCategories::find($value->cc_id)->cc_nama;
        }
        
        return $result;
    }

    function insertCoa($data)
    {
        $t = new self();
        $t->coa_kode = $data["coa_kode"];
        $t->coa_nama = $data["coa_nama"];
        $t->cc_id = $data["cc_id"];
        $t->save();
        return $t->coa_id;
    }

    function updateCoa($data)
    {
        $t = self::find($data["coa_id"]);
        $t->coa_kode = $data["coa_kode"];
        $t->coa_nama = $data["coa_nama"];
        $t->cc_id = $data["cc_id"];
        $t->save();
        return $t->coa_id;
    }

    function deleteCoa($data)
    {
        $t = self::find($data["coa_id"]);
        $t->status = 0;
        $t->save();
    }
}
