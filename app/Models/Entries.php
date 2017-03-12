<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entries extends Model
{
    /**
     * @var string The name of the table
     */
    protected $table = 'entries';

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = null;
}