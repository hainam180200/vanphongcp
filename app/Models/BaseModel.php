<?php
namespace App\Models;
use Carbon\Carbon;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;


class BaseModel extends Eloquent  {




	public function setCreatedAtAttribute($value) {


		if($this->verifyDate($value,'d/m/Y H:i')){
			$this->attributes['created_at']=Carbon::createFromFormat('d/m/Y H:i', $value);;
		}
		else
		{
			$this->attributes['created_at']=Carbon::now();
		}

	}

    public function setEndedAtAttribute($value) {


        if($this->verifyDate($value,'d/m/Y H:i')){
            $this->attributes['created_at']=Carbon::createFromFormat('d/m/Y H:i', $value);;
        }
        else
        {
            $this->attributes['created_at']=Carbon::now();
        }

    }

    public function setSlugAttribute($value) {

        $this->attributes['slug']= Str::slug($value, '-');

    }


	function verifyDate($value,$format){
		return (DateTime::createFromFormat($format, $value) !== false);
	}
}
