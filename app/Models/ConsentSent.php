<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsentSent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'company_id',
        'customer_id',
        'type',
        'sent_success',
        'document_id',
        'accept'
    ];

    /**
     * table
     *
     * @var string
     */
    protected $table = 'consents_sent';
}
