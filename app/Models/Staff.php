<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Staff extends Model
{
    protected $table = "staffs";
    protected $primaryKey = "st_id";
    public $timestamps = true;
    public $incrementing = true;

    function getStaff($data = [])
    {
        $data = array_merge([
            "st_name"=>null,
            "st_id"=>null,
            "cs_id"=>null
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["st_name"]) $result->where('st_name','like','%'.$data["st_name"].'%');
        if($data["cs_id"]) $result->where('cs_id','=',$data["cs_id"]);
        if($data["st_id"]) $result->where('st_id','=',$data["st_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
        foreach ($result as $key => $value) {
            $value->cs_name = CategoryStaff::find($value->cs_id)->cs_name;
        }
        
        return $result;
    }

    function insertStaff($data)
    {
        $t = new self();
        $t->st_name = $data["st_name"];
        $t->st_nomer = $data["st_nomer"];
        $t->st_address = $data["st_address"];
        $t->st_email = $data["st_email"];
        $t->cs_id = $data["cs_id"];
        $t->st_gender = $data["st_gender"];
        $t->st_nik = $data["st_nik"];
        $t->st_religion = $data["st_religion"];
        $t->st_birthdate = $data["st_birthdate"];
        $t->st_age = $data["st_age"];
        $t->st_username = $data["st_username"];
        $t->st_password = Hash::make($data["st_password"]);
        $t->st_profile = $data["st_profile"];
        $t->st_ktp = $data["st_ktp"];
        $t->save();
        return $t->st_id;
    }

    function updateStaff($data)
    {
        $t = self::find($data["st_id"]);
        $old_password = $t->st_password;
        $t->st_name = $data["st_name"];
        $t->st_nomer = $data["st_nomer"];
        $t->st_address = $data["st_address"];
        $t->st_email = $data["st_email"];
        $t->cs_id = $data["cs_id"];
        $t->st_gender = $data["st_gender"];
        $t->st_nik = $data["st_nik"];
        $t->st_religion = $data["st_religion"];
        $t->st_birthdate = $data["st_birthdate"];
        $t->st_age = $data["st_age"];
        $t->st_username = $data["st_username"];
        if (Hash::check($data["st_password"], $old_password)){
            if ($data["st_new_password"] != ""){
                $t->st_password = Hash::make($data["st_new_password"]);
            }else{
                $t->st_password = Hash::make($data["st_password"]);
            }
        }
        else{
            return ['message' => "Mohon cek kembali password"];
        }
        if(isset($data["st_profile"]))$t->st_profile = $data["st_profile"];
        if(isset($data["st_ktp"]))$t->st_ktp = $data["st_ktp"];
        $t->save();
        return $t->st_id;
    }

    function deleteStaff($data)
    {
        $t = self::find($data["st_id"]);
        $t->status = 0;
        $t->save();
    }
}
