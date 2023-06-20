<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultInspection extends Model
{
    use SoftDeletes, HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'customer_id',
        'company_id',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'consult_inspection';

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
}