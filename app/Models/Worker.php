<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'r_id',
        'w_first_name',
        'w_surname',
        'start_time',
        'end_time',
    ];

    protected $primaryKey = 'worker_id';
    public $timestamps = false;
    
    /**
    * Get the record that the worker belongs to.
    */
    public function record()
    {
        return $this->belongsTo(Record::class, 'r_id', 'record_id');
    }
}
