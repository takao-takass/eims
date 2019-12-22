<?php

namespace App\Models;

class Inspect
{
    public static $requireProps = ['inspectDate','comment'];
    
    public $id;
    public $historyId;
    public $inspectDate;
    public $comment;

}
