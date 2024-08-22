<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Set the due_date attribute and convert it to a Gregorian date.
     *
     * @param  string  $value
     * @return void
     */
  /*  public function setDueDateAttribute($value)
    {
        // Convert the Solar Hijri date to Gregorian date
        $this->attributes['due_date'] = Jalalian::fromFormat('Y/m/d H:i', $value)->toCarbon()->format('Y-m-d H:i:s');
    }
    */
    /**
     * Get the due_date attribute and convert it to a Solar Hijri date.
     *
     * @param  string  $value
     * @return string
     */
  /*  public function getDueDateAttribute($value)
    {
        // Convert the Gregorian date to Solar Hijri date
        return Jalalian::fromDateTime($value)->format('Y/m/d H:i');
    }*/
}
