<?php
/**
 * Created by PhpStorm.
 * User: ainaopeyemi
 * Date: 2/23/19
 * Time: 5:14 PM
 */

namespace Changers\Services;


abstract class BaseService
{
    protected $errors = [];
    protected $result;
    protected $successful = false;


    public function getErrors()
    {
        return collect($this->errors);
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function saveResult($result)
    {
        $this->result = $result;
    }
}