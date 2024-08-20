<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens; // Asegúrate de incluir esto
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // Incluye HasApiTokens aquí

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Los atributos que deben ser ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser transformados para sus valores nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relación uno a muchos con favoritos.
     *
     * Un usuario puede tener muchos favoritos.
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
