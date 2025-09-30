<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Testimonial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_name','file_url','designation','description','position'

    ];


    public static function updatePosition($rows){        

        try {

            foreach($rows as $row){
                foreach($row as $r){

                    $id = $r['id'];
                    $position = $r['position'];
                    self::whereId($id)->update(['position' => $position]);
                }
            }

        } catch (Exception $e) {

            return $e->getMessage();
        }
        
    }


    public static function getRecordsWihPosition(){
        return self::orderBy('position','asc')->get();
    }
}
