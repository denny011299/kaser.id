<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengaturan extends Model
{
    protected $table = "pengaturans";
    protected $primaryKey = "pengaturan_id";
    public $timestamps = true;
    public $incrementing = true;

    function getPengaturan($data=[]) {
        $data = array_merge([
            'select' => null,
        ], $data);

        $result = pengaturan::where('status', '=', 1);
        if ($data["select"]) $result->whereIn("pengaturan_nama",$data["select"] );
        $result = $result->get();

        $param = [];
        foreach ($result as $key => $value) {
            $param[$value["pengaturan_nama"]] = $value["pengaturan_value"];
        };
        
        return $param;
    }

    function updatePengaturan($name, $value)
    {
        if (isset($value) && $name != '_token') {
           
            $p = pengaturan::where('pengaturan_nama', '=', $name)->first();
            if ($p) {
               
                $p->pengaturan_value = $value;
                $p->save();
            } else {
                $newP = new pengaturan();
                $newP->pengaturan_nama = $name;
                $newP->pengaturan_value = $value;
                $newP->save();
            }
        }
    }
}
