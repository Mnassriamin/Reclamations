<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['user_id', 'subject', 'description', 'status', 'technician_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function technician()
{
    return $this->belongsTo(User::class, 'technician_id');
}
}
