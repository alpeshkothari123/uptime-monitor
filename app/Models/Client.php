<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Client extends Model
{
protected $fillable = ['email', 'name'];
use HasFactory; 

public function websites(): HasMany
{
 return $this->hasMany(Website::class);
}
}