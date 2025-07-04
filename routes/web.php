<?php

use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SettingTaxController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Middleware\checkSession;
use Illuminate\Support\Facades\Route;

Route::get('/',[CashierController::class,"index"]);
Route::get('/login', [GeneralController::class,"login"]);
Route::post('/login', [GeneralController::class,"mekanismeLogin"]);
Route::get('/logout', [GeneralController::class,"logout"]);
Route::post('/autocompleteLocation', [AutocompleteController::class,"autocompleteLocation"]);
Route::post('/autocompleteSupplier', [AutocompleteController::class,"autocompleteSupplier"]);
Route::post('/autocompleteCategory', [AutocompleteController::class,"autocompleteCategory"]);
Route::post('/autocompleteUnit', [AutocompleteController::class,"autocompleteUnit"]);
Route::post('/autocompleteProductVariant', [AutocompleteController::class,"autocompleteProductVariant"]);
Route::post('/autocompleteProduct', [AutocompleteController::class,"autocompleteProduct"]);
Route::post('/autocompleteSupplies', [AutocompleteController::class,"autocompleteSupplies"]);
Route::post('/autocompleteCategoryStaff', [AutocompleteController::class,"autocompleteCategoryStaff"]);
Route::post('/autocompleteCustomer', [AutocompleteController::class,"autocompleteCustomer"]);

Route::middleware(checkSession::class)->prefix('admin')->group(function () {
    Route::get('/',[GeneralController::class,"index"]);
    Route::get('/category',[ProductController::class,"Category"]);
    Route::get('/getCategory', [ProductController::class, "getCategory"])->name('getCategory');
    Route::post('/insertCategory', [ProductController::class, "insertCategory"])->name('insertCategory');
    Route::post('/updateCategory', [ProductController::class, "updateCategory"])->name('updateCategory');
    Route::post('/deleteCategory', [ProductController::class, "deleteCategory"])->name('deleteCategory');
    
    Route::get('/product_unit',[ProductController::class,"product_unit"]);
    Route::get('/getProductUnit', [ProductController::class, "getProductUnit"])->name('getProductUnit');
    Route::post('/insertProductUnit', [ProductController::class, "insertProductUnit"])->name('insertProductUnit');
    Route::post('/updateProductUnit', [ProductController::class, "updateProductUnit"])->name('updateProductUnit');
    Route::post('/deleteProductUnit', [ProductController::class, "deleteProductUnit"])->name('deleteProductUnit');
    
    Route::get('/product_variant',[ProductController::class,"product_variant"]);
    Route::get('/getProductVariant', [ProductController::class, "getProductVariant"])->name('getProductVariant');
    Route::post('/insertProductVariant', [ProductController::class, "insertProductVariant"])->name('insertProductVariant');
    Route::post('/updateProductVariant', [ProductController::class, "updateProductVariant"])->name('updateProductVariant');
    Route::post('/deleteProductVariant', [ProductController::class, "deleteProductVariant"])->name('deleteProductVariant');
    
    Route::get('/supplies',[ProductController::class,"Supplies"]);
    Route::get('/getSupplies', [ProductController::class, "getSupplies"])->name('getSupplies');
    Route::post('/insertSupplies', [ProductController::class, "insertSupplies"])->name('insertSupplies');
    Route::post('/updateSupplies', [ProductController::class, "updateSupplies"])->name('updateSupplies');
    Route::post('/deleteSupplies', [ProductController::class, "deleteSupplies"])->name('deleteSupplies');
    
    Route::get('/supplier',[SupplierController::class,"supplier"]);
    Route::get('/getSupplier', [SupplierController::class, "getSupplier"])->name('getSupplier');
    Route::get('/supplierDetail/{id}', [SupplierController::class, "supplierDetail"])->name('supplierDetail');
    Route::post('/insertSupplier', [SupplierController::class, "insertSupplier"])->name('insertSupplier');
    Route::post('/updateSupplier', [SupplierController::class, "updateSupplier"])->name('updateSupplier');
    Route::post('/deleteSupplier', [SupplierController::class, "deleteSupplier"])->name('deleteSupplier');
    
    Route::get('/getSupplierPrice', [SupplierController::class, "getSupplierPrice"])->name('getSupplierPrice');
    Route::post('/insertSupplierPrice', [SupplierController::class, "insertSupplierPrice"])->name('insertSupplierPrice');
    Route::post('/updateSupplierPrice', [SupplierController::class, "updateSupplierPrice"])->name('updateSupplierPrice');
    Route::post('/deleteSupplierPrice', [SupplierController::class, "deleteSupplierPrice"])->name('deleteSupplierPrice');

    Route::get('/customer',[CustomerController::class,"customer"]);
    Route::get('/getCustomer', [CustomerController::class, "getCustomer"])->name('getCustomer');
    Route::get('/customerDetail/{id}', [CustomerController::class, "customerDetail"])->name('customerDetail');
    Route::post('/insertCustomer', [CustomerController::class, "insertCustomer"])->name('insertCustomer');
    Route::post('/updateCustomer', [CustomerController::class, "updateCustomer"])->name('updateCustomer');
    Route::post('/deleteCustomer', [CustomerController::class, "deleteCustomer"])->name('deleteCustomer');
    
    Route::get('/voucher',[PromotionController::class,"voucher"]);
    Route::get('/getVoucher', [PromotionController::class, "getVoucher"])->name('getVoucher');
    Route::post('/insertVoucher', [PromotionController::class, "insertVoucher"])->name('insertVoucher');
    Route::post('/updateVoucher', [PromotionController::class, "updateVoucher"])->name('updateVoucher');
    Route::post('/deleteVoucher', [PromotionController::class, "deleteVoucher"])->name('deleteVoucher');
    
    Route::get('/bundling',[PromotionController::class,"bundling"]);
    Route::get('/getBundling', [PromotionController::class, "getBundling"])->name('getBundling');
    Route::post('/insertBundling', [PromotionController::class, "insertBundling"])->name('insertBundling');
    Route::post('/updateBundling', [PromotionController::class, "updateBundling"])->name('updateBundling');
    Route::post('/deleteBundling', [PromotionController::class, "deleteBundling"])->name('deleteBundling');

    Route::get('/purchase_order',[SupplierController::class,"purchase_order"]);
    Route::get('/PurchaseOrderDetail/{id}',[SupplierController::class,"PurchaseOrderDetail"]);
    Route::get('/creatPurchaseOrder',[SupplierController::class,"creatPurchaseOrder"]);
    Route::get('/getPurchaseOrder', [SupplierController::class, "getPurchaseOrder"])->name('getPurchaseOrder');
    Route::post('/insertPurchaseOrder', [SupplierController::class, "insertPurchaseOrder"])->name('insertPurchaseOrder');
    Route::post('/updatePurchaseOrder', [SupplierController::class, "updatePurchaseOrder"])->name('updatePurchaseOrder');
    Route::post('/deletePurchaseOrder', [SupplierController::class, "deletePurchaseOrder"])->name('deletePurchaseOrder');
    
    Route::get('/product',[ProductController::class,"product"]);
    Route::get('/getProduct', [ProductController::class, "getProduct"])->name('getProduct');
    Route::get('/insertProduct', [ProductController::class, "ViewInsertProduct"])->name('ViewInsertProduct');
    Route::post('/insertProduct', [ProductController::class, "insertProduct"])->name('insertProduct');
    Route::get('/updateProduct/{id}', [ProductController::class, "ViewUpdateProduct"])->name('ViewUpdateProduct');
    Route::post('/updateProduct', [ProductController::class, "updateProduct"])->name('updateProduct');
    Route::post('/deleteProduct', [ProductController::class, "deleteProduct"])->name('deleteProduct');
    
    Route::get('/manageSupplies',[StockController::class,"manageSupplies"]);
    Route::get('/getManageSupplies', [StockController::class, "getManageSupplies"])->name('getManageSupplies');
    Route::post('/insertManageSupplies', [StockController::class, "insertManageSupplies"])->name('insertManageSupplies');
    Route::post('/updateManageSupplies', [StockController::class, "updateManageSupplies"])->name('updateManageSupplies');
    Route::post('/deleteManageSupplies', [StockController::class, "deleteManageSupplies"])->name('deleteManageSupplies');
    
    Route::get('/StaffPosition',[StaffController::class,"CategoryStaff"]);
    Route::get('/getCategoryStaff', [StaffController::class, "getCategoryStaff"])->name('getCategoryStaff');
    Route::post('/insertCategoryStaff', [StaffController::class, "insertCategoryStaff"])->name('insertCategoryStaff');
    Route::post('/updateCategoryStaff', [StaffController::class, "updateCategoryStaff"])->name('updateCategoryStaff');
    Route::post('/deleteCategoryStaff', [StaffController::class, "deleteCategoryStaff"])->name('deleteCategoryStaff');
    
    Route::get('/Receipt',[PengaturanController::class,"Receipt"]);
    Route::post('/getPengaturan',[PengaturanController::class,"getPengaturan"])->name('getPengaturan');
    Route::post('/updatePengaturan',[PengaturanController::class,"updatePengaturan"])->name('updatePengaturan');

    Route::get('/getPoInvoice', [SupplierController::class, "getPoInvoice"])->name('getPoInvoice');
    Route::post('/insertPoInvoice', [SupplierController::class, "insertPoInvoice"])->name('insertPoInvoice');
    Route::post('/updatePoInvoice', [SupplierController::class, "updatePoInvoice"])->name('updatePoInvoice');
    Route::post('/deletePoInvoice', [SupplierController::class, "deletePoInvoice"])->name('deletePoInvoice');
    

    Route::get('/getSoInvoice', [CustomerController::class, "getSoInvoice"])->name('getSoInvoice');
    Route::post('/insertSoInvoice', [CustomerController::class, "insertSoInvoice"])->name('insertSoInvoice');
    Route::post('/updateSoInvoice', [CustomerController::class, "updateSoInvoice"])->name('updateSoInvoice');
    Route::post('/deleteSoInvoice', [CustomerController::class, "deleteSoInvoice"])->name('deleteSoInvoice');
    
    
    Route::get('/getPaymentPo', [SupplierController::class, "getPaymentPo"])->name('getPaymentPo');
    Route::post('/insertPaymentPo', [SupplierController::class, "insertPaymentPo"])->name('insertPaymentPo');
    Route::post('/updatePaymentPo', [SupplierController::class, "updatePaymentPo"])->name('updatePaymentPo');
    Route::post('/deletePaymentPo', [SupplierController::class, "deletePaymentPo"])->name('deletePaymentPo');
    
    Route::get('/getCustomerPrice', [CustomerController::class, "getCustomerPrice"])->name('getCustomerPrice');
    Route::post('/insertCustomerPrice', [CustomerController::class, "insertCustomerPrice"])->name('insertCustomerPrice');
    Route::post('/updateCustomerPrice', [CustomerController::class, "updateCustomerPrice"])->name('updateCustomerPrice');
    Route::post('/deleteCustomerPrice', [CustomerController::class, "deleteCustomerPrice"])->name('deleteCustomerPrice');

    Route::get('/Staff',[StaffController::class,"Staff"]);
    Route::get('/staffDetail/{id}', [StaffController::class, "staffDetail"])->name('staffDetail');
    Route::get('/getStaff', [StaffController::class, "getStaff"])->name('getStaff');
    Route::post('/insertStaff', [StaffController::class, "insertStaff"])->name('insertStaff');
    Route::post('/updateStaff', [StaffController::class, "updateStaff"])->name('updateStaff');
    Route::post('/deleteStaff', [StaffController::class, "deleteStaff"])->name('deleteStaff');
    
    Route::get('/salesOrder',[CustomerController::class,"salesOrder"]);
    Route::get('/SalesOrderDetail/{id}',[CustomerController::class,"salesOrderDetail"]);
    Route::get('/createSalesOrder',[CustomerController::class,"createSalesOrder"]);
    Route::get('/getSalesOrder', [CustomerController::class, "getSalesOrder"])->name('getSalesOrder');
    Route::post('/insertSalesOrder', [CustomerController::class, "insertSalesOrder"])->name('insertSalesOrder');
    Route::post('/updateSalesOrder', [CustomerController::class, "updateSalesOrder"])->name('updateSalesOrder');
    Route::post('/deleteSalesOrder', [CustomerController::class, "deleteSalesOrder"])->name('deleteSalesOrder');

    Route::get('/Payment',[SettingTaxController::class,"Payment"]);
    Route::post('/insertTax',[SettingTaxController::class,"insertTax"])->name('insertTax');
    Route::post('/deleteTax',[SettingTaxController::class,"deleteTax"])->name('deleteTax');
    Route::get('/getTax',[SettingTaxController::class,"getTax"])->name('getTax');
    Route::post('/toggleActiveTax',[SettingTaxController::class,"toggleActiveTax"])->name('toggleActiveTax');

});
