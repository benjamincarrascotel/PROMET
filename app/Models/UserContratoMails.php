<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContratoMails extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'user_contrato_mails';

    protected $fillable = [
        'contrato_id',

        'creado', //0
        'estado_contrato',
        'user_type',
        'user_id',
        'user_email',
        


    ];
}
