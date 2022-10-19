<?php

namespace App\Http\Controllers\Website;

use App\Exports\OrderExport;
use App\Exports\ProductExport;
use App\Exports\ShopExport;
use App\Exports\TransactionExport;
use App\Exports\UsersBuyerExport;
use App\Exports\UsersExport;
use App\Exports\UsersSellerExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;

class ExcelController extends Controller
{
    /**
     * Export/download excel file of all users
     */
    public function exportAllUsers() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    /**
     * Export/download excel file of all users
     */
    public function exportBuyerUsers() 
    {
        return Excel::download(new UsersBuyerExport, 'buyers.xlsx');
    }
    /**
     * Export/download excel file of all users
     */
    public function exportSellerUsers() 
    {
        return Excel::download(new UsersSellerExport, 'sellers.xlsx');
    }
    /**
     * Export/download excel file of all users
     */
    public function exportOrders() 
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }
    /**
     * Export/download excel file of all users
     */
    public function exportProducts() 
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
    /**
     * Export/download excel file of all users
     */
    public function exportShops() 
    {
        return Excel::download(new ShopExport, 'shops.xlsx');
    }
    /**
     * Export/download excel file of all users
     */
    public function exportTransactions() 
    {
        return Excel::download(new TransactionExport, 'transactions.xlsx');
    }
}
