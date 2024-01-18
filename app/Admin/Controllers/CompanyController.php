<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Company';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Company());

        $grid->column('id', __('Id'));
        $grid->column('owner_id', __('Owner id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('logo', __('Logo'));
        $grid->column('website', __('Website'));
        $grid->column('about', __('About'));
        $grid->column('status', __('Status'));
        $grid->column('address', __('Address'));
        $grid->column('license_expire', __('License expire'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('phone_number_2', __('Phone number 2'));
        $grid->column('pobox', __('Pobox'));
        $grid->column('color', __('Color'));
        $grid->column('slogan', __('Slogan'));
        $grid->column('facebook', __('Facebook'));
        $grid->column('twitter', __('Twitter'));
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
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('owner_id', __('Owner id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('logo', __('Logo'));
        $show->field('website', __('Website'));
        $show->field('about', __('About'));
        $show->field('status', __('Status'));
        $show->field('address', __('Address'));
        $show->field('license_expire', __('License expire'));
        $show->field('phone_number', __('Phone number'));
        $show->field('phone_number_2', __('Phone number 2'));
        $show->field('pobox', __('Pobox'));
        $show->field('color', __('Color'));
        $show->field('slogan', __('Slogan'));
        $show->field('facebook', __('Facebook'));
        $show->field('twitter', __('Twitter'));
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
        $form = new Form(new Company());

        $form->number('owner_id', __('Owner id'));
        $form->textarea('name', __('Name'));
        $form->textarea('email', __('Email'));
        $form->textarea('logo', __('Logo'));
        $form->textarea('website', __('Website'));
        $form->textarea('about', __('About'));
        $form->text('status', __('Status'));
        $form->textarea('address', __('Address'));
        $form->date('license_expire', __('License expire'))->default(date('Y-m-d'));
        $form->textarea('phone_number', __('Phone number'));
        $form->textarea('phone_number_2', __('Phone number 2'));
        $form->textarea('pobox', __('Pobox'));
        $form->textarea('color', __('Color'));
        $form->textarea('slogan', __('Slogan'));
        $form->textarea('facebook', __('Facebook'));
        $form->textarea('twitter', __('Twitter'));

        return $form;
    }
}
