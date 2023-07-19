<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory; 
    
    protected $fillable = [
        'p_id',
        'r_reference',
        'date',
        'time',
        'weather',
        'temperature',
        'other_involved_party',
        'performed_services',
        'equipments_materials',
        'other_events',
        'notes',
    ];

    protected $primaryKey = 'record_id';
    public $timestamps = false;

    /**
    * Get the project that the record belongs to.
    */
    public function project()
    {
        return $this->belongsTo(Project::class, 'p_id', 'project_id');
    }

    /**
     * Get the media files associated with the record.
    */
    public function media()
    {
        return $this->hasMany(Media::class, 'r_id', 'record_id');
    }

    /**
     * Get the workers associated with the record.
    */
    public function workers()
    {
        return $this->hasMany(Worker::class, 'r_id', 'record_id');
    }
}
