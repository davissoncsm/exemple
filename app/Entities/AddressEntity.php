<?php

namespace App\Entities;

use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressEntity extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /** The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'cep',
        'complement',
    ];

    protected static function newFactory(): Factory
    {
        return AddressFactory::new();
    }

}
