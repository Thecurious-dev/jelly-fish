<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCategory extends Model
{
    use HasFactory;

    public function update_self(){
     $active_financial_period = Utils::getActiveFinancialPeriod($this->company_id);
     if($active_financial_period == null){
        return;
     }
     $total_buying_price = StockItem::where('stock_category_id', $this->id)
        -> where ('financial_period_id', $active_financial_period->id)
        ->sum('buying_price');

       // dd($total_buying_price);
    }
}

   
   
    
    
   
    // "buying_price" => 0
    // "selling_price" => 0
    // "expected_profit" => 0
    // "earned_profit" => 0
    // "created_at" => "2024-02-10 20:22:10"
    // "updated_at" => "2024-02-10 20:22:10"