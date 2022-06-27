<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class OpenTimeMustLessCloseTimeAndActiveDay implements Rule
{

    private string $myMassage;
    public function __construct(private string $OtherTime,private  $isActive=null)
    {
        $this->isActive=($isActive==null)? true:$isActive;
        $this->myMassage='';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->isActive==0){
           return true;
        }
        if(is_null($value)  ){
            $this->myMassage='filed must required';
            return false ;
        }

        $time=Carbon::parse($value);
        $otherTime=Carbon::parse($this->OtherTime);
        
        if((Str::endsWith($attribute,"_S")))
        {
            if(!$time->lessThan($otherTime)){
                $this->myMassage='Time open must less then close';
                return false ;
            }
        }

        if(Str::endsWith($attribute,"_E"))
        { 
            if(!$time->greaterThan($otherTime)){
                // dd($attribute, $value,$this->OtherTime ,$time,$otherTime);
                $this->myMassage='Time close must grater then open';
                return false ;

            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->myMassage;
    }
}
