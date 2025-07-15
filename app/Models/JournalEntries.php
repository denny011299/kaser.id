<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntries extends Model
{
    protected $table = "journal_entries";
    protected $primaryKey = "je_id";
    public $timestamps = true;
    public $incrementing = true;

    function getJournalEntries($data = []){
        $data = array_merge([
            "je_description"=>null,
            "coa_id"=>null,
            "coa_nama"=>null,
            "je_date"=>null,
            "je_id"=>null
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["je_description"]) $result->where('je_description','like','%'.$data["je_description"].'%');
        if($data["coa_id"]) $result->where('coa_id','=',$data["coa_id"]);
        if($data["je_id"]) $result->where('je_id','=',$data["je_id"]);
        if($data["je_date"]) $result->where('je_date','=',$data["je_date"]);
        
        // Pengecekan untuk cashflow
        if($data["coa_nama"]) {
            $coa_id = (new Coa())->getCoa(["coa_nama" => $data["coa_nama"]]);
            if ($coa_id && !$coa_id->isEmpty()) {
                $coaId = $coa_id->map(function ($item) {
                    return $item->coa_id;
                });
                $result->whereIn('coa_id', $coaId);
            }else {
                $result->whereRaw('1 = 0');
            }
        };

        $result->orderBy('je_date', 'desc')->orderBy('created_at', 'desc');
        
        $result = $result->get();
        
        foreach ($result as $key => $value) {
            $value->coa_nama = Coa::find($value->coa_id)->coa_nama;
        }
        $gross = 0;
        $reversed = $result->reverse()->values();
        foreach ($reversed as $key => $value) {
            $gross += $value->je_debit;
            $gross -= $value->je_credit;
            $value->gross = $gross;
        }
        
        return $result;
    }

    function insertJournalEntries($data){
        $t = new self();
        $t->je_date = $data["je_date"];
        $t->je_description = $data["je_description"];
        $t->je_reference = $data["je_reference"];
        $t->je_debit = $data["je_debit"] ?? 0;
        $t->je_credit = $data["je_credit"] ?? 0;
        $t->coa_id = $data["coa_id"];
        
        $t->save();
        return $t->coa_id;
    }
}
