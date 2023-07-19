<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'c_id',
        'u_id', //responsible project manager
        'p_reference',
        'p_name',
        'p_street',
        'p_house_no',
        'p_postal_code',
        'p_city',
        'owner_first_name',
        'owner_surname',
        'o_email',
        'o_telefon',
    ];

    protected $primaryKey = 'project_id';
    public $timestamps = false;


    /**
    * Get the company that the project belongs to.
    */
    public function company()
    {
        return $this->belongsTo(Company::class, 'c_id', 'company_id');
    }

    /**
    * Get the user that the project belongs to.
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'u_id', 'user_id');
    }

    /**
     * Get the records associated with the project.
    */
    public function records()
    {
        return $this->hasMany(Record::class, 'p_id', 'project_id');
    }
}
