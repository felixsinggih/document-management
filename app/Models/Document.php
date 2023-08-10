<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
