<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'message',
        'email',
        'phone_number',
        'avatar',
        'category_id'
    ];

    protected $append = [
        'avatar_url',
    ];

    public function getAvatarUrlAttribute()
    {
        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }
        return $this->avatar ? Storage::url($this->avatar) : null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //sebetulnya dalam pemanggila fungsi fungsi seperti ini kalau misalnya temen temen declare nama fk beda dari standar laravel
    //gak akan bisa jalan dengan benar relasinya
    //supaya bisa terkait nanti di setiap fungsi-fungsi relasi cek aja karena butuh beberapa parameter yang dimasukin
}
