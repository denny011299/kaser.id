<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\product_price;
use App\Models\Product_unit;
use App\Models\Product_variant;
use App\Models\product_variasi;
use App\Models\Supplies;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //category product
    function Category() {
        $param["featherIcon"] = ["activity","airplay","alert-circle","alert-octagon","alert-triangle","align-center","align-justify","align-left","align-right","anchor","aperture","archive","arrow-down-circle","arrow-down-left","arrow-down-right","arrow-down","arrow-left-circle","arrow-left","arrow-right-circle","arrow-right","arrow-up-circle","arrow-up-left","arrow-up-right","arrow-up","at-sign","award","bar-chart-2","bar-chart","battery-charging","battery","bell-off","bell","bluetooth","bold","book-open","book","bookmark","box","briefcase","calendar","camera-off","camera","cast","check-circle","check-square","check","chevron-down","chevron-left","chevron-right","chevron-up","chevrons-down","chevrons-left","chevrons-right","chevrons-up","chrome","circle","clipboard","clock","cloud-drizzle","cloud-lightning","cloud-off","cloud-rain","cloud-snow","cloud","code","codepen","codesandbox","coffee","columns","command","compass","copy","corner-down-left","corner-down-right","corner-left-down","corner-left-up","corner-right-down","corner-right-up","corner-up-left","corner-up-right","cpu","credit-card","crop","crosshair","database","delete","disc","divide-circle","divide-square","divide","dollar-sign","download-cloud","download","dribbble","droplet","edit-2","edit-3","edit","external-link","eye-off","eye","facebook","fast-forward","feather","figma","file-minus","file-plus","file-text","file","film","filter","flag","folder-minus","folder-plus","folder","framer","frown","gift","git-branch","git-commit","git-merge","git-pull-request","github","gitlab","globe","grid","hard-drive","hash","headphones","heart","help-circle","hexagon","home","image","inbox","info","instagram","italic","key","layers","layout","life-buoy","link-2","link","linkedin","list","loader","lock","log-in","log-out","mail","map-pin","map","maximize-2","maximize","meh","menu","message-circle","message-square","mic-off","mic","minimize-2","minimize","minus-circle","minus-square","minus","monitor","moon","more-horizontal","more-vertical","mouse-pointer","move","music","navigation-2","navigation","octagon","package","paperclip","pause-circle","pause","pen-tool","percent","phone-call","phone-forwarded","phone-incoming","phone-missed","phone-off","phone-outgoing","phone","pie-chart","play-circle","play","plus-circle","plus-square","plus","pocket","power","printer","radio","refresh-ccw","refresh-cw","repeat","rewind","rotate-ccw","rotate-cw","rss","save","scissors","search","send","server","settings","share-2","share","shield-off","shield","shopping-bag","shopping-cart","shuffle","sidebar","skip-back","skip-forward","slack","slash","sliders","smartphone","smile","speaker","square","star","stop-circle","sun","sunrise","sunset","table","tablet","tag","target","terminal","thermometer","thumbs-down","thumbs-up","toggle-left","toggle-right","tool","trash-2","trash","trello","trending-down","trending-up","triangle","truck","tv","twitch","twitter","type","umbrella","underline","unlock","upload-cloud","upload","user-check","user-minus","user-plus","user-x","user","users","video-off","video","voicemail","volume-1","volume-2","volume-x","volume","watch","wifi-off","wifi","wind","x-circle","x-octagon","x-square","x","youtube","zap-off","zap","zoom-in","zoom-out"];
        return view('Backoffice.Product.Category')->with($param);
    }
    function getCategory(Request $req)
    {
        $data =  (new Category())->getCategory(["category_name"=>$req->category_name]);
        return json_encode($data);
    }

    function insertCategory(Request $req)
    {
        $data = $req->all();
        return (new Category())->insertCategory($data);
    }

    function updateCategory(Request $req)
    {
        $data = $req->all();
        (new Category())->updateCategory($data);
    }

    function deleteCategory(Request $req)
    {
        $data = $req->all();
        return (new Category())->deleteCategory($data);
    }
   
    //product unit
    function product_unit() {
        return view('Backoffice.Product.Product_unit');
    }
    function getProductUnit(Request $req)
    {
        $data =  (new Product_unit())->getProductUnit([
            "pu_short_name"=>$req->pu_short_name,
            "pu_full_name"=>$req->pu_full_name
        ]);
        return json_encode($data);
    }

    function insertProductUnit(Request $req)
    {
        $data = $req->all();
        return (new Product_unit())->insertProductUnit($data);
    }

    function updateProductUnit(Request $req)
    {
        $data = $req->all();
        (new Product_unit())->updateProductUnit($data);
    }

    function deleteProductUnit(Request $req)
    {
        $data = $req->all();
        return (new Product_unit())->deleteProductUnit($data);
    }
   
    //product variant
    function product_variant() {
        return view('Backoffice.Product.Product_variant');
    }
    function getProductVariant(Request $req)
    {
        $data =  (new Product_variant())->getProductVariant([
            "pv_name"=>$req->pv_name
        ]);
        return json_encode($data);
    }

    function insertProductVariant(Request $req)
    {
        $data = $req->all();
        return (new Product_variant())->insertProductVariant($data);
    }

    function updateProductVariant(Request $req)
    {
        $data = $req->all();
        (new Product_variant())->updateProductVariant($data);
    }

    function deleteProductVariant(Request $req)
    {
        $data = $req->all();
        return (new Product_variant())->deleteProductVariant($data);
    }
   
    //Supplies
    function supplies() {
        return view('Backoffice.Product.Supplies');
    }
    function getSupplies(Request $req)
    {
        $data =  (new Supplies())->getSupplies([
            "sup_name"=>$req->sup_name
        ]);
        return json_encode($data);
    }

    function insertSupplies(Request $req)
    {
        $data = $req->all();
        return (new Supplies())->insertSupplies($data);
    }

    function updateSupplies(Request $req)
    {
        $data = $req->all();
        (new Supplies())->updateSupplies($data);
    }

    function deleteSupplies(Request $req)
    {
        $data = $req->all();
        return (new Supplies())->deleteSupplies($data);
    }
   
    //Product
    function product() {
        return view('Backoffice.Product.Product');
    }
    
    function ViewInsertProduct() {
        $param["mode"]=1; // 1 = insert, 2 = update
        $param["data"] = [];
        return view('Backoffice.Product.UploadProduct')->with($param);
    }
   
    function ViewUpdateProduct($id) {
        $param["mode"]=2; // 1 = insert, 2 = update
        $param["data"] = (new Product())->getProduct(["pr_id"=>$id])[0];
        return view('Backoffice.Product.UploadProduct')->with($param);
    }

    function getProduct(Request $req)
    {
        $data =  (new Product())->getProduct([
            "pr_name"=>$req->pr_name,
            "pr_sku"=>$req->pr_sku,
            "c_id"=>$req->c_id,
        ]);
        return json_encode($data);
    }

    function insertProduct(Request $req)
    {
        $data = $req->all();
        if(isset($req->main)&&$req->main!="undefined")$data["pr_img"] = $this->insertFile($req->main, "product");
        $pr_id = (new Product())->insertProduct($data);
        foreach (json_decode($data["list_variant"], true) as $key => $value) {
            $value["pr_id"] = $pr_id;
            if(isset($value["pvs_id"])&&$value["pvs_id"]!="") {
                (new product_variasi())->updateProductVariant($value);
            } else {
                (new product_variasi())->insertProductVariant($value);
            }
        }
        foreach (json_decode($data["list_bulk_price"], true) as $key => $value) {
            $value["pr_id"] = $pr_id;
            if(isset($value["pp_id"])&&$value["pp_id"]!="") {
                (new product_price())->updateProductPrice($value);
            } else {
                (new product_price())->insertProductPrice($value);
            }
        }
    }

    function updateProduct(Request $req)
    {
        $data = $req->all();
        $list_id_bulk = [];
        $list_id_variant = [];

        if(isset($req->main)&&$req->main!="undefined")$data["pr_img"] = $this->insertFile($req->main, "product");
        $pr_id = (new Product())->updateProduct($data);

        foreach (json_decode($data["list_variant"], true) as $key => $value) {
            $value["pr_id"] = $pr_id;
            if(isset($value["pvs_id"])&&$value["pvs_id"]!="") {
                $id = (new product_variasi())->updateProductVariant($value);
            } else {
                $id = (new product_variasi())->insertProductVariant($value);
            }
            array_push($list_id_variant, $id);
        }
        
        foreach (json_decode($data["list_bulk_price"], true) as $key => $value) {
            $value["pr_id"] = $pr_id;
            if(isset($value["pp_id"])&&$value["pp_id"]!="") {
                $id = (new product_price())->updateProductPrice($value);
                array_push($list_id_bulk, $id);
            } else {
                $id = (new product_price())->insertProductPrice($value);
                array_push($list_id_bulk, $id);
            }
        }
        product_price::whereNotIn('pp_id', $list_id_bulk)->where('pr_id','=',$pr_id)->update(['status' => 0]);
        product_variasi::whereNotIn('pvs_id', $list_id_variant)->where('pr_id','=',$pr_id)->update(['status' => 0]);
    }

    function deleteProduct(Request $req)
    {
        $data = $req->all();
        return (new Product())->deleteProduct($data);
    }
    
        //lain lain
    public function insertFile($file, $type)
    {
        try {
            $fileName = uniqid() . '.' . $file->extension();
            $filePath = 'upload/' . $type . "/" . $fileName;

            $file->move(public_path('upload/' . $type), $fileName);
            return $filePath;
        } catch (\Throwable $th) {
            dd($th);
            return -1;
        }
    }
}
