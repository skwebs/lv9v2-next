<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AdmitCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'mother',
        'father',
        'gender',
        'dob',
        'aadhaar',
        'mobile',
        'address',
        'class',
        'roll',
        'user_id',
        'student_type',
        'image',
        'created_by',
        'updated_by',
    ];

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    /**
     * Interact with the student's name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            //  get: fn ($value) => ucfirst($value),
            set: fn ($value) => ucwords(strtolower($value)),
        );
    }

    /**
     * Interact with the student's name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function dob(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d-m-Y', strtotime($value)),
            // set: fn ($value) => ucwords(strtolower($value)),
        );
    }

    /**
     * Interact with the student's mother name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function mother(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower($value)),
        );
    }

    /**
     * Interact with the student's father name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function father(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower($value)),
        );
    }

    /**
     * Interact with the student's father name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function address(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(strtolower($value)),
        );
    }

    // using old mutator method
    public function setClassAttribute($value)
    {
        $this->attributes['class'] = $value;
        switch ($value) {
            case 'Play':
                $this->attributes['class_order'] = 0;
                break;
            case 'Nursery':
                $this->attributes['class_order'] = 1;
                break;
            case 'LKG':
                $this->attributes['class_order'] = 2;
                break;
            case 'UKG':
                $this->attributes['class_order'] = 3;
                break;
            case 'Std.1':
                $this->attributes['class_order'] = 4;
                break;
            case 'Std.2':
                $this->attributes['class_order'] = 5;
                break;
            case 'Std.3':
                $this->attributes['class_order'] = 6;
                break;
            case 'Std.4':
                $this->attributes['class_order'] = 7;
                break;
            case 'Std.5':
                $this->attributes['class_order'] = 8;
                break;
            case 'Std.6':
                $this->attributes['class_order'] = 9;
                break;
            default:
                $this->attributes['class_order'] = null;
        }
    }

    /*
    //before laravel 9

    //accessor
    protected function getDobAttribute($value){
	    return date('d M Y', strtotime($value));
    }

    // mutators
    protected function setNameAttribute($value){
    	$this->attributes['name'] = ucwords(strtolower($value));
    }
    protected function setMotherAttribute($value){
    	$this->attributes['mother'] = ucwords(strtolower($value));
    }
    protected function setFatherAttribute($value){
    	$this->attributes['father'] = ucwords(strtolower($value));
    }
    protected function setAddressAttribute($value){
    	$this->attributes['address'] = ucwords(strtolower($value));
    }
    */
}
