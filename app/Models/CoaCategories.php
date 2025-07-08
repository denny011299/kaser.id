<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoaCategories extends Model
{
    protected $table = "coa_categories";
    protected $primaryKey = "cc_id";
    public $timestamps = true;
    public $incrementing = true;

    function getCoaCategory($data = []){
        $data = array_merge([
            "cc_nama"=>null,
            "cc_kode"=>null,
            "cc_id"=>null,
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["cc_nama"]) $result->where('cc_nama','like','%'.$data["cc_nama"].'%');
        if($data["cc_kode"]) $result->where('cc_kode','like','%'.$data["cc_kode"].'%');
        if($data["cc_id"]) $result->where('cc_id','=',$data["cc_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
        return $result;
    }

    function insertCoaCategory($data)
    {
        $t = new self();
        $t->cc_kode = $data["cc_kode"];
        $t->cc_nama = $data["cc_nama"];
        $t->save();
        return $t->cc_id;
    }

    function updateCoaCategory($data)
    {
        $t = self::find($data["cc_id"]);
        $t->cc_kode = $data["cc_kode"];
        $t->cc_nama = $data["cc_nama"];
        $t->save();
        return $t->cc_id;
    }

    function deleteCoaCategory($data)
    {
        $t = self::find($data["cc_id"]);
        $t->status = 0;
        $t->save();
    }
}
