<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Complaint;

class Message extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['user_id', 'complaint_id', 'content', 'read_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function complaint() {
        return $this->belongsTo(Complaint::class);
    }
    public function scopeUnread($query, $userId)
{
    return $query->whereNull('read_at')->where('user_id', '!=', $userId);
}
}
