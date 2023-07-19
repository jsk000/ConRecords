<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'c_name',
        'c_email', 
        'c_telefon', 
        'c_street',
        'c_house_no', 
        'c_postal_code', 
        'c_city', 
    ];

    public $timestamps = false;
    protected $table = 'companies';
    protected $primaryKey = 'company_id';

    /**
     * Get the users associated with the company.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'c_id', 'company_id');
    }

    /**
     * Get the projects associated with the company.
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'c_id', 'company_id');
    }

}
