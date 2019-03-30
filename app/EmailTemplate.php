<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    //
    protected $fillable = [
        'template_name',
        'mail_subject',
        'mail_body',
        'attach_file',
    ];
}
