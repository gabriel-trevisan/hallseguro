<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'company_id',
        'type',
        'title',
        'body',
        'user_id',
        'version'
    ];
    
    /**
     * table
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * incrementing
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string'
    ];

    static function nextVersion(){
        $company = session('company');

        return Document::where('company_id', $company['id'])
                ->max('version') + 1;
    }
}