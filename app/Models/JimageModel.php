<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JimageModel extends Model
{
    protected $table = 'jimage';
    protected $primaryKey = 'jiid';
    public $timestamps = false;

    protected $fillable = ['jid', 'jimg'];

    public function journey()
    {
        return $this->belongsTo(JourneyModel::class, 'jid');
    }
}
