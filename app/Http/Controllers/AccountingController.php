<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\CoaCategories;
use App\Models\CoaSubCoas;
use App\Models\JournalEntries;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    function Coa(){
        return view('Backoffice.Accounting.Coa');
    }

    function getCoaCategory(Request $req){
        $data =  (new CoaCategories())->getCoaCategory([
            "cc_kode"=>$req->cc_kode,
            "cc_nama"=>$req->cc_nama,
            "cc_id"=>$req->cc_id
        ]);
        return json_encode($data);
    }

    function insertCoaCategory(Request $req)
    {
        $data = $req->all();
        return (new CoaCategories())->insertCoaCategory($data);
    }

    function updateCoaCategory(Request $req)
    {
        $data = $req->all();
        (new CoaCategories())->updateCoaCategory($data);
    }

    function deleteCoaCategory(Request $req)
    {
        $data = $req->all();
        return (new CoaCategories())->deleteCoaCategory($data);
    }
    
    function getCoa(Request $req){
        $data =  (new Coa())->getCoa([
            "coa_kode"=>$req->coa_kode,
            "coa_nama"=>$req->coa_nama,
            "coa_id"=>$req->coa_id,
            "cc_id"=>$req->cc_id
        ]);
        return json_encode($data);
    }

    function insertCoa(Request $req)
    {
        $data = $req->all();
        return (new Coa())->insertCoa($data);
    }

    function updateCoa(Request $req)
    {
        $data = $req->all();
        (new Coa())->updateCoa($data);
    }

    function deleteCoa(Request $req)
    {
        $data = $req->all();
        return (new Coa())->deleteCoa($data);
    }

    function getSubCoa(Request $req){
        $data =  (new CoaSubCoas())->getSubCoa([
            "sc_kode"=>$req->sc_kode,
            "sc_nama"=>$req->sc_nama,
            "sc_id"=>$req->sc_id,
            "coa_id"=>$req->coa_id
        ]);
        return json_encode($data);
    }

    function insertSubCoa(Request $req)
    {
        $data = $req->all();
        return (new CoaSubCoas())->insertSubCoa($data);
    }
    
    function updateSubCoa(Request $req)
    {
        $data = $req->all();
        (new CoaSubCoas())->updateSubCoa($data);
    }

    function deleteSubCoa(Request $req)
    {
        $data = $req->all();
        return (new CoaSubCoas())->deleteSubCoa($data);
    }

    // Journal Entries
    function JournalEntries(){
        return view('Backoffice.Accounting.JournalEntries');
    }

    function getJournalEntries(Request $req){
        $data =  (new JournalEntries())->getJournalEntries([
            "je_description"=>$req->je_description,
            "je_id"=>$req->je_id,
            "coa_id"=>$req->coa_id
        ]);
        return json_encode($data);
    }

    function insertJournalEntries(Request $req)
    {
        $data = $req->all();
        return (new JournalEntries())->insertJournalEntries($data);
    }
}
