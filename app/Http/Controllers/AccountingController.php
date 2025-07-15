<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\CoaCategories;
use App\Models\CoaSubCoas;
use App\Models\JournalEntries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            "je_date"=>$req->je_date,
            "coa_id"=>$req->coa_id,
            "coa_nama"=>$req->coa_nama
        ]);
        return json_encode($data);
    }

    function insertJournalEntries(Request $req)
    {
        $data = $req->all();
        if (!isset($data['je_credit']) || $data['je_credit'] == null) $data['je_credit'] = 0;
        if (!isset($data['je_debit']) || $data['je_debit'] == null) $data['je_debit'] = 0;
        return (new JournalEntries())->insertJournalEntries($data);
    }


    // Payables & Receiveables
    function PayReceive(){
        return view('Backoffice.Accounting.PayReceive');
    }

    public function getPayablesChart()
    {
        $payables = DB::table('supplier_purchase_order_invoices')
            ->select(DB::raw('DATE(spoi_date) as date'), DB::raw('SUM(spoi_total) as total'))
            ->where('spoi_status', '!=', 'Cancelled')
            ->groupBy(DB::raw('DATE(spoi_date)'))
            ->orderBy('date')
            ->get();

        return response()->json($payables);
    }


    // Cashflow
    function Cashflow(){
        return view('Backoffice.Accounting.Cashflow');
    }
}
