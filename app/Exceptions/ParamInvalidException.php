<?php
namespace app\Exceptions;

class ParamInvalidException extends \Exception 
{
    // 正しくない項目のリスト 
    public $params;

    public function __construct($p){
        $this->code = 400;
        $this->message = 'パラメータが正しくありません。';
        $this->params=$p;
      }
}
