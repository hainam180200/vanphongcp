<?php 
namespace App\Library;
use App\Models\SubItem;
use App\Models\Item;
use App\Models\Provinces;
use App\Models\Districts;
use Illuminate\Support\Facades\Log;

class HelperOrder
{
    public static function getValDetai(object $data, $module){
        try{
            if(isset($data) && count($data) > 0){
                foreach($data as $item){
                    if($item->module === $module){
                        return $item->value;
                        break;
                    }
                    continue;
                }
                return null;
            }
        }
        catch(\Exception $e){
            Log::error($e);
            return null; 
        }
    }
    public static function getDataTitleAttribute($id){
        $data = Item::where('module','=', 'product-attribute')->where('id',$id)->first();
        if(!$data){
            return null;
        }
        return $data->title;
    }
    public static function getDataValueAttribute($attribute_id){
        $data = SubItem::where('id', $attribute_id)->first();
        if(!$data){
            return null;
        }
        return $data->content;
    }
    public static function getAttribute($attribute){
        try{
            $result = array();
            $attribute = (array)json_decode($attribute);
            foreach($attribute as $key => $val_att){
                $result[] = [
                    'key' => self::getDataTitleAttribute($key),
                    'value' => self::getDataValueAttribute($val_att),
                ];
            }
            return $result;
        }
        catch(\Exception $e){
            Log::error($e);
            return null; 
        }
       
    }
    public static function getProvinces(object $data){
        try{
            if(isset($data) && count($data) > 0){
                foreach($data as $item){
                    if($item->module === 'provinces'){
                        // return $item->value;
                        $provinces = Provinces::where('id',$item->value)->first();
                        return $provinces->name;
                        break;
                    }
                    continue;
                }
                return null;
            }
        }
        catch(\Exception $e){
            Log::error($e);
            return null; 
        }
    }
    public static function getDistricts(object $data){
        try{
            if(isset($data) && count($data) > 0){
                foreach($data as $item){
                    if($item->module === 'districts'){
                        // return $item->value;
                        $districts = Districts::where('id',$item->value)->first();
                        return $districts->name;
                        break;
                    }
                    continue;
                }
                return null;
            }
        }
        catch(\Exception $e){
            Log::error($e);
            return null; 
        }
    }
}