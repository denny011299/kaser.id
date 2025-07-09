<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $table = "floors";
    protected $primaryKey = "fl_id";
    public $timestamps = true;
    public $incrementing = true;

    function getFloor($data = [])
    {
        $data = array_merge([
            'fl_id'=>null
        ], $data);

        $result = self::where('status', '=', 1);
        $result->orderBy('created_at', 'asc');
        if ($data["fl_id"]) $result->where("fl_id", $data["fl_id"]);
        $result = $result->get();

        foreach ($result as $key => $item) {
           $item->meja = (new Meja())->getMeja();
        }

        return $result;
    }

    function insertFloor($data)
    {
        $t = new self();
        $t->fl_name = $data["fl_name"];
        $t->save();
        return $t->pu_id;
    }

    function updateFloor($data)
    {
        $t = self::find($data["fl_id"]);
        $t->fl_name = $data["fl_name"];
        $t->save();
        return $t->pu_id;
    }

    function deleteFloor($data)
    {
        $t = self::find($data["fl_id"]);
        $t->status = 0;
        $t->save();
    }
}
