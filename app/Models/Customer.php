<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'rg',
        'note',
        'company_id',
        'cellphone',
        'email',
        'voter',
        'passport',
        'work_card',
        'bloqued'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';
        
    /**
     * incrementing
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * Opcional, informar a coluna deleted_at como um Mutator de data
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string'
    ];

    public function consults()
    {
        return $this->hasMany(ConsultInspection::class);
    }
}
