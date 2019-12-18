<?php

namespace App\Models;

class Item
{
    public static $requireProps = ['name','categoryId','purchaseDate','limitDate','quantity'];
    
    public $id;
    public $name;
    public $categoryId;
    public $purchaseDate;
    public $limitDate;
    public $createDateTime;
    public $updateDateTime;
    public $deleted;
    public $quantity;
    public $owner;

}
