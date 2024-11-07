<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;

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
    public function rdvAudits()
    {
        return $this->hasMany(RdvAudit::class, 'agent_id');
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

    public function rdvAuditsp()
    {
        return $this->hasMany(RdvAudit::class, 'partenaire_id');
    }

    public function rdvThermostatsp()
    {
        return $this->hasMany(RdvThermostat::class, 'partenaire_id');
    }
    
    
    //number of rdv
    
    public function numberofrdvaudit(){

      return RdvAudit::where('partenaire_id',Auth::id())
      ->whereNull('classification')
      ->count();  

    }
    public function numberofrdvpv(){
        return RdvPanneauxPhotovoltaique::where('partenaire_id',Auth::id())
        ->whereNull('classification')
        ->count(); 
        
    }
    public function numberofrdvthermostat(){
        return RdvThermostat::where('partenaire_id',Auth::id())
        ->whereNull('classification')
        ->count(); 
        
    }
    public function numberofrdvpac(){
        return RdvPompeAChaleur::where('partenaire_id',Auth::id())
        ->whereNull('classification')
        ->count(); 
        
    }



    ///comments and likes
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    // public function likes()
    // {
    //     return $this->hasMany(Like::class);
    // }
    public function likes()
{
    return $this->belongsToMany(Post::class, 'likes')->withTimestamps();
}

public function hasLiked(Post $post)
{
    return $this->likes->contains('id', $post->id);
}


}