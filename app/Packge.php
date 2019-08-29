<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packge extends Model
{
    protected $table = 'tour_packages';
    
    public function PackageType()
    {
        return $this->belongsTo(PackgeType::class);
    }
    
    public function packageImage()
    {
        return $this->belongsToMany(PackgeImage::class);
    }
}
