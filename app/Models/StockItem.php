<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    

    protected static function boot(){
        parent::boot();
    
        //created
        static::creating(function($model){
            $model = self::prepare($model);
            $model ->current_quantity = $model->original_quantity;
           
            return $model;
        });

        //created
        static::updating(function($model){
            $model = self::prepare($model);

            return $model;
            
        });

    

    }

    static public function prepare($model){
        // $stock_category = StockCategory::find($model->stock_category_id);
        // if($stock_category == null){
        //     throw new Exception("Invalid stock category");
        // }

        $sub_category = StockSubCategory::find($model->stock_sub_category_id);
        if($sub_category == null){
            throw new \Exception("Invalid Stock Sub Category");
        }
        $model->stock_category_id = $sub_category->stock_category_id;

        $user = User::find($model->created_by_id); //User who created the model item
        if($user == null){
            throw new \Exception("Invalid user");
        }

        $financial_period = Utils::getActiveFinancialPeriod($user->company_id);

        if ($financial_period == null){
            throw new \Exception("Invalid Financial Period");
        }
        $model->financial_period_id = $financial_period->id;
        $model->company_id = $user->company_id;

        if($model->sku == null || strlen($model->sku) < 2){
    //dd(Utils::generateSKU($model->company_id));
            $model->sku = Utils::generateSKU($model->stock_sub_category_id); 
           // dd($model->sku);      
        }
        
        if($model->update_sku == "Yes" && $model->generate_sku == "Manual"){
            $model->sku = Utils::generateSKU($model->stock_sub_category_id);
            $model->generate_sku = "No";
        }

        return $model;
    }



    //getter for gallery

    public function getGalleryAttributes($value){
        if($value != null && strlen($value) > 2){
            return json_decode($value);
        }
        return [];;
    }

    //setter

    public function setGalleryAttributes($value){
        $this->attributes['gallery'] = json_encode($value, true);
        
      
    }
    use HasFactory;

}
