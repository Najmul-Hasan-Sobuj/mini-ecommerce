<?php

namespace App\Models;

use App\Models\ProductAttachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function attachments()
    {
        return $this->hasMany(ProductAttachment::class);
    }
}
