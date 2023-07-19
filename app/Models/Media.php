<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'r_id',
        'm_name',
        'filepath',
    ];

    protected $primaryKey = 'media_id';
    public $timestamps = false;
    
    /**
    * Get the record that the media file belongs to.
    */
    public function record()
    {
        return $this->belongsTo(Record::class, 'r_id', 'record_id');
    }
}
