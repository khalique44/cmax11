<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class AreaSurvey extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $appends = ['year', 'month_name']; // optional if you want them in JSON

    protected $fillable = [        
    	'area_id','sub_area_id','file_url','thumbnail_url','survey_date','is_active'
    ];
    
    // Each survey belongs to an Area
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    // Each survey belongs to a Sub Area
    public function subArea()
    {
        return $this->belongsTo(SubArea::class, 'sub_area_id');
    }

    // Accessor for full area name
    public function getFullAreaAttribute()
    {
        $areaName = $this->area->name ?? '';
        $subAreaName = $this->subArea->name ?? '';

        // If sub-area exists, show "Area - SubArea", else just "Area"
        return $subAreaName
            ? "{$areaName} - {$subAreaName}"
            : $areaName;
    }

    public function getYearAttribute(){
        return $this->survey_date ? Carbon::parse($this->survey_date)->year : null;
    }

    // Accessor for Month (numeric)
    public function getMonthAttribute()
    {
        return $this->survey_date ? Carbon::parse($this->survey_date)->month : null;
    }

    public function getMonthNameAttribute()
    {
        return $this->survey_date ? Carbon::parse($this->survey_date)->format('F') : null;
    }

    public function getFormattedSurveyDateAttribute()
    {
        if (!$this->survey_date) {
            return null;
        }

        return Carbon::parse($this->survey_date)->format('jS F, Y');
    }
}
