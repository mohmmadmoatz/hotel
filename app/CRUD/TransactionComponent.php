<?php

namespace App\CRUD;

use EasyPanel\Contracts\CRUDComponent;
use EasyPanel\Parsers\Fields\Field;
use App\Models\Transaction;

class TransactionComponent implements CRUDComponent
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
        return Transaction::class;
    }

    // which kind of data should be showed in list page
    public function fields()
    {
        return [
            "details",
            "type",
            "amount",
            "date",
            "booking_id"
        ];
    }

    // Searchable fields, if you dont want search feature, remove it
    public function searchable()
    {
        return [
            "details",
            "type",
            "amount",
            "date",
            "booking_id"
        ];
    }

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "checkbox", "text", "select", "file", "textarea"
    // "password", "number", "email", "select", "date", "datetime", "time"
    public function inputs()
    {
        return [
            "details" => "textarea",
            "type" => "text",
            "amount" => "text",
            "date" => "date",
            
           
        ];
    }

    // Validation in update and create actions
    // It uses Laravel validation system
    public function validationRules()
    {
        return [
            "details" => "required",
            "type" => "required",
            "amount" => "required",
            "date" => "required",
        
        ];
    }

    // Where files will store for inputs
    public function storePaths()
    {
        return [];
    }
}
