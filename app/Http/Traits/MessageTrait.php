<?php
/**
 * Trait        MessageTrait
 * @package     App\Http\Traits
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */

namespace App\Http\Traits;


trait MessageTrait
{
    protected $message = 'The Requested data could not be found.';

    protected function envMessage(\Throwable $e, $str = null)
    {
        if(getenv('APP_ENV') === 'production'){
            \Log::error($e->getMessage());
            $this->message = $e->getMessage();
        } else {
            $str ?? $this->message;
        }
        return $this;
    }

}
