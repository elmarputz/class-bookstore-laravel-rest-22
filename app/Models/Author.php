<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable =  ['firstName', 'lastName'];

    // m:n
    public function books() : BelongsToMany {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

}
