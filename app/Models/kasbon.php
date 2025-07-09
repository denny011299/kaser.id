<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kasbon extends Model
{
    protected $table = "kasbons";
    protected $primaryKey = "ks_id";
    public $timestamps = true;
    public $incrementing = true;

    function getKasbon($data = [])
    {
        $data = array_merge([
            "st_id"=>null,
            "ks_id"=>null
        ], $data);

        $result = self::where('status', '>=', 1);
        if($data["st_id"]) $result->where('st_id','=',$data["st_id"]);
        if($data["ks_id"]) $result->where('ks_id','=',$data["ks_id"]);
        $result->orderBy('created_at', 'asc');
       
        return $result->get();
    }

    function insertKasbon($data)
    {
        $t = new self();
        $t->ks_nomer = $this->generateKSNumber();
        $t->st_id = $data["st_id"];
        $t->ks_date = $data["ks_date"];
        $t->ks_tujuan = $data["ks_tujuan"];
        $t->ks_jumlah = $data["ks_jumlah"];
        if(isset($data["ks_notes"]))$t->ks_notes = $data["ks_notes"];
        $t->save();
        return $t->pu_id;
    }

    function updateKasbon($data)
    {
        $t = self::find($data["ks_id"]);
        $t->st_id = $data["st_id"];
        $t->ks_date = $data["ks_date"];
        $t->ks_tujuan = $data["ks_tujuan"];
        $t->ks_jumlah = $data["ks_jumlah"];
        if(isset($data["ks_notes"]))$t->ks_notes = $data["ks_notes"];
        $t->save();
        return $t->pu_id;
    }

    function deleteKasbon($data)
    {
        $t = self::find($data["ks_id"]);
        $t->status = 0;
        $t->save();
    }

    function ActionKasbon($data)
    {
        $t = self::find($data["ks_id"]);
        $t->status = $data["st"];
        if(isset( $data["ks_notes"]))$t->ks_notes = $data["ks_notes"];
        $t->save();
    }
    function generateKSNumber()
    {
        $latest = self::max('ks_id');
        $latest = is_null($latest) ? 1 : $latest + 1;
        return "KSB" . str_pad($latest, 5, "0", STR_PAD_LEFT);
    }
}
