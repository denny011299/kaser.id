<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "suppliers";
    protected $primaryKey = "sp_id";
    public $timestamps = true;
    public $incrementing = true;

    function getSupplier($data = [])
    {
        $data = array_merge([
            "sp_name"=>null,
            "sp_id"=>null,
            "city_id"=>null
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["sp_name"]) $result->where('sp_name','like','%'.$data["sp_name"].'%');
        if($data["city_id"]) $result->where('city_id','=',$data["city_id"]);
        if($data["sp_id"]) $result->where('sp_id','=',$data["sp_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
        foreach ($result as $key => $value) {
            $value->city_name = city::find($value->city_id)->name;
        }
        
        return $result;
    }

    function insertSupplier($data)
    {
        $t = new self();
        $t->sp_name = $data["sp_name"];
        $t->sp_cp_name = $data["sp_cp_name"];
        $t->sp_cp_nomer = $data["sp_cp_nomer"];
        $t->sp_nomer = $data["sp_nomer"];
        $t->sp_nomer = $data["sp_nomer"];
        $t->sp_address = $data["sp_address"];
        $t->city_id = $data["city_id"];
        $t->sp_email = $data["sp_email"];
        $t->sp_bank_name = $data["sp_bank_name"];
        $t->sp_bank_account = $data["sp_bank_account"];
        $t->sp_notes = $data["sp_notes"];
        if(isset($data["sp_img"])) $t->sp_img = $data["sp_img"];
        $t->save();
        return $t->pu_id;
    }

    function updateSupplier($data)
    {
        $t = self::find($data["sp_id"]);
        $t->sp_name = $data["sp_name"];
        $t->sp_cp_name = $data["sp_cp_name"];
        $t->sp_cp_nomer = $data["sp_cp_nomer"];
        $t->sp_nomer = $data["sp_nomer"];
        $t->sp_nomer = $data["sp_nomer"];
        $t->sp_address = $data["sp_address"];
        $t->city_id = $data["city_id"];
        $t->sp_email = $data["sp_email"];
        $t->sp_bank_name = $data["sp_bank_name"];
        $t->sp_bank_account = $data["sp_bank_account"];
        $t->sp_notes = $data["sp_notes"];
        if(isset($data["sp_img"]))$t->sp_img = $data["sp_img"];
        $t->save();
        return $t->pu_id;
    }

    function deleteSupplier($data)
    {
        $t = self::find($data["sp_id"]);
        $t->status = 0;
        $t->save();
    }
}
