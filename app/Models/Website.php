<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model
{
protected $fillable = ['client_id', 'url', 'active'];

protected $casts = ['active' => 'boolean'];

public function client(): BelongsTo
{
return $this->belongsTo(Client::class);
}
}