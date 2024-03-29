<?php

namespace App\Admin\Controllers;

use App\Models\StockItem;
use App\Models\StockRecord;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StockRecordController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Stock Out Records';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StockRecord());

        $grid->column('id', __('Id'));
        $grid->column('company_id', __('Company id'));
        $grid->column('stock_item_id', __('Stock item id'));
        $grid->column('stock_category_id', __('Stock category id'));
        $grid->column('stock_sub_category_id', __('Stock sub category id'));
        $grid->column('created_by_id', __('Created by id'));
        $grid->column('sku', __('Sku'));

        $grid->column('name', __('Name'));
        $grid->column('measurement_unit', __('Measurement unit'));
        $grid->column('description', __('Description'));
        $grid->column('type', __('Type'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('selling_price', __('Selling price'));
        $grid->column('total_sales', __('Total sales'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(StockRecord::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_id', __('Company id'));
        $show->field('stock_item_id', __('Stock item id'));
        $show->field('stock_category_id', __('Stock category id'));
        $show->field('stock_sub_category_id', __('Stock sub category id'));
        $show->field('created_by_id', __('Created by id'));
        $show->field('sku', __('Sku'));
        $show->field('name', __('Name'));
        $show->field('measurement_unit', __('Measurement unit'));
        $show->field('description', __('Description'));
        $show->field('type', __('Type'));
        $show->field('quantity', __('Quantity'));
        $show->field('selling_price', __('Selling price'));
        $show->field('total_sales', __('Total sales'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new StockRecord());
        $u = Admin::user();

        $form->hidden('company_id', __('Company id'))->default($u->company_id);

        $stock_item_ajax_url = url('api/stock-items');
        $stock_item_ajax_url = $stock_item_ajax_url. '?company_id=' . $u->company_id;
        $form->select('stock_item_id', __('Stock Item'))
            ->ajax($stock_item_ajax_url)
            ->options(function ($id){
                $stock_item = StockItem::find($id);
                if($stock_item){
                    return [$stock_item->id => $stock_item->name ];
                }else{
                    return [];
                }
            })
            ->rules('required');
        // $form->number('stock_category_id', __('Stock category id'));
        // $form->number('stock_sub_category_id', __('Stock sub category id'));
        $form->hidden('created_by_id', __('Created by id'))->default($u->id);
        // $form->text('sku', __('Sku'));
        // $form->text('name', __('Name'));
        // $form->text('measurement_unit', __('Measurement unit'));
        $form->text('description', __('Description'));
        $form->radio('type', __('Type'))
            ->options(
                [
                   'Sale'=> 'Sale',
                   'Damage'=> 'Damage',
                   'Lost'=> 'Lost',
                   'Others' => 'Others',
                   'Internal Use'=> 'Internal Use',
                ]
            );
        $form->decimal('quantity', __('Quantity'));
        // $form->decimal('selling_price', __('Selling price'));
        // $form->decimal('total_sales', __('Total sales'));

        return $form;
    }
}
