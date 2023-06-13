<?php

namespace App\Entities;

use Database\Factories\PatientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientEntity extends Model
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
    protected $table = 'patients';

    /** The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'cns',
        'mother_name',
        'birthdate',
        'photo',
    ];

    protected static function newFactory(): Factory
    {
        return PatientFactory::new();
    }

    public function address()
    {
        return $this->hasOne(AddressEntity::class, 'patient_id', 'id');
    }
}
