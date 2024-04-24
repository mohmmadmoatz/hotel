<?php

namespace App\CRUD;

use EasyPanel\Contracts\CRUDComponent;
use EasyPanel\Parsers\Fields\Field;
use App\Models\Expense;

class ExpenseComponent implements CRUDComponent
{
    // Manage actions in crud
    public $create = true;
    public $delete = true;
    public $update = true;

    // If you will set it true it will automatically
    // add `user_id` to create and update action
    public $with_user_id = false;

    public function getModel()
    {
        return Expense::class;
    }

    // which kind of data should be showed in list page
    public function fields()
    {
        return [
            "category.name",
            "amount",
            "date",
            "description"

        ];
    }

    // Searchable fields, if you dont want search feature, remove it
    public function searchable()
    {
        return [
            "category.name",
            "amount",
            "date",
            "description"
        ];
    }

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "checkbox", "text", "select", "file", "textarea"
    // "password", "number", "email", "select", "date", "datetime", "time"
    public function inputs()
    {
        return [
            "category_id"=>"text",
            "amount"=>"text",
            "date"=>"date",
            "description"=>"textarea"

        ];
    }

    // Validation in update and create actions
    // It uses Laravel validation system
    public function validationRules()
    {
        return [
            "amount"=>"required",
            "date"=>"required",
            "description"=>"required"
        ];
    }

    // Where files will store for inputs
    public function storePaths()
    {
        return [];
    }
}
