<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function rdvPanneauxPhotovoltaiques()
    {
        return $this->hasMany(RdvPanneauxPhotovoltaique::class, 'agent_id');
    }

    public function rdvPompeAChaleurs()
    {
        return $this->hasMany(RdvPompeAChaleur::class, 'agent_id');
    }

    public function rdvThermostats()
    {
        return $this->hasMany(RdvThermostat::class, 'agent_id');
    }


    public function rdvPanneauxPhotovoltaiquesp()
    {
        return $this->hasMany(RdvPanneauxPhotovoltaique::class, 'partenaire_id');
    }

    public function rdvPompeAChaleursp()
    {
        return $this->hasMany(RdvPompeAChaleur::class, 'partenaire_id');
    }

    public function rdvThermostatsp()
    {
        return $this->hasMany(RdvThermostat::class, 'partenaire_id');
    }










}
