<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title','description','file_url', 'status','short_description','header_image','position'

    ];

    protected $casts = [
        'created_at' => 'date:Y-M-d'
    ];


    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('l d, Y');
    }


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

    public static function getAllPosts(){

        return Post::latest()->get();
    }
}
