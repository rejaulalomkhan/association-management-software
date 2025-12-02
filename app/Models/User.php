<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use HasinHayder\Tyro\Concerns\HasTyroRoles;



class User extends Authenticatable
{
    use HasApiTokens, HasTyroRoles;


    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'father_name',
        'dob',
        'permanent_address',
        'present_address',
        'blood_group',
        'profession',
        'religion',
        'nationality',
        'position',
        'profile_pic',
        'status',
        'joined_at',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    public function getTotalPaidAmount()
    {
        return $this->payments()->where('status', 'approved')->sum('amount');
    }

    public function getPendingAmount()
    {
        return $this->payments()->where('status', 'pending')->sum('amount');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
