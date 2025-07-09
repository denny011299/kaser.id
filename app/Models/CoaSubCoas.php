<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoaSubCoas extends Model
{
    protected $table = "coa_sub_coas";
    protected $primaryKey = "sc_id";
    public $timestamps = true;
    public $incrementing = true;

    function getSubCoa($data = []){
        $data = array_merge([
            "sc_nama"=>null,
            "sc_kode"=>null,
            "sc_id"=>null,
            "coa_id"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["sc_nama"]) $result->where('sc_nama','like','%'.$data["sc_nama"].'%');
        if($data["sc_kode"]) $result->where('sc_kode','like','%'.$data["sc_kode"].'%');
        if($data["sc_id"]) $result->where('sc_id','=',$data["sc_id"]);
        if($data["coa_id"]) $result->where('coa_id','=',$data["coa_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();

        foreach ($result as $key => $value) {
            $value->coa_kode = Coa::find($value->coa_id)->coa_kode;
            $value->coa_nama = Coa::find($value->coa_id)->coa_nama;
        }
        
        return $result;
    }

    function insertSubCoa($data)
    {
        $t = new self();
        $t->sc_kode = $data["sc_kode"];
        $t->sc_nama = $data["sc_nama"];
        $t->coa_id = $data["coa_id"];
        $t->save();
        return $t->sc_id;
    }

    function updateSubCoa($data)
    {
        $t = self::find($data["sc_id"]);
        $t->sc_kode = $data["sc_kode"];
        $t->sc_nama = $data["sc_nama"];
        $t->coa_id = $data["coa_id"];
        $t->save();
        return $t->sc_id;
    }

    function deleteSubCoa($data)
    {
        $t = self::find($data["sc_id"]);
        $t->status = 0;
        $t->save();
    }
}
