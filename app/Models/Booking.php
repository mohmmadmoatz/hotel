<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
     * Get all of the guests for the Booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guests()
    {
        return $this->hasMany(Customer::class, 'booking_id', 'id');
    }

    /**
     * Get the room that owns the Booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get all of the services for the Booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function servicesitems()
    {
        return $this->hasMany(Bookservice::class, 'booking_id', 'id');
    }

    function payments() {
        return $this->hasMany(Transaction::class, 'booking_id', 'id');
    }

}
