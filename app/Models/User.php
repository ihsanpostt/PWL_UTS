<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName; // Tambahan untuk mengatasi error nama
use Filament\Panel;

// Tambahkan implementasi HasName
class User extends Authenticatable implements FilamentUser, HasName
{
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'level_id', 'username', 'email', 'nama', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true; 
    }

    public function level() 
    { 
        return $this->belongsTo(Level::class, 'level_id', 'level_id'); 
    }

    // FUNGSI INI YANG MENYELESAIKAN ERROR TADI
    public function getFilamentName(): string
    {
        return $this->nama; // Mengarahkan Filament untuk menggunakan kolom 'nama'
    }
}
