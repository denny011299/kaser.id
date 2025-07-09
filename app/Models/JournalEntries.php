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
            "je_id"=>null
        ], $data);

        $result = self::where('status', '=', 1);
        if($data["je_description"]) $result->where('je_description','like','%'.$data["je_description"].'%');
        if($data["coa_id"]) $result->where('coa_id','=',$data["coa_id"]);
        if($data["je_id"]) $result->where('je_id','=',$data["je_id"]);
        $result->orderBy('created_at', 'asc');
        $result = $result->get();
        
        foreach ($result as $key => $value) {
            $value->coa_nama = Coa::find($value->coa_id)->coa_nama;
        }
        
        $gross = 0;
        foreach ($result as $key => $value) {
            $gross += $value->je_debit;
            $gross -= $value->je_credit;
            $value->gross = $gross;
        }
        
        return $result;
    }

    function insertJournalEntries(){

    }
}
