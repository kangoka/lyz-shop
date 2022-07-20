<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'payment_status', 'midtrans_url', 'midtrans_booking_code', 'quantity', 'price', 'is_delivered', 'order_modal'];

    /**
     * Get the Product that owns the Checkout
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the User that owns the Checkout
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Review that owns the Checkout
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'midtrans_booking_code', 'order_id');
    }
}
