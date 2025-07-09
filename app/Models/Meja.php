<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = "mejas";
    protected $primaryKey = "m_id";
    public $timestamps = true;
    public $incrementing = true;

    function getMeja($data = [])
    {
        $data = array_merge([
            "fl_id"=>null
        ], $data);

        $result = self::where('status', '=', 1);
        $result->orderBy('created_at', 'asc');
        if ($data["fl_id"]) $result->where("fl_id", $data["fl_id"]);
        $result = $result->get();

        return $result;
    }

    function insertMeja($data)
    {
        $t = new self();
        $t->fl_id = $data["fl_id"];
        $t->m_name = $data["m_name"];
        $t->m_kapasitas = $data["m_kapasitas"];
        $t->m_type = $data["m_type"];
        $t->m_x = $data["m_x"];
        $t->m_y = $data["m_y"];
        $t->save();
        return $t;
    }

    function updateMeja($data)
    {
        $t = self::find($data["m_id"]);
        $t->fl_id = $data["fl_id"];
        $t->m_name = $data["m_name"];
        $t->m_kapasitas = $data["m_kapasitas"];
        $t->m_type = $data["m_type"];
        $t->m_x = $data["m_x"];
        $t->m_y = $data["m_y"];
        $t->save();
        return $t;
    }

    function updateKoordinatMeja($data)
    {
        $t = self::find($data["m_id"]);
        $t->m_x = $data["m_x"];
        $t->m_y = $data["m_y"];
        $t->save();
        return $t->m_id;
    }

    function deleteMeja($data)
    {
        $t = self::find($data["m_id"]);
        $t->status = 0;
        $t->save();
        return $t->m_id;
    }
}
