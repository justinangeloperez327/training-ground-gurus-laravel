<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    /** @use HasFactory<\Database\Factories\StockMovementFactory> */
    use HasFactory;

    protected $fillable = [
        'item_id',
        'warehouse_id',
        'type',
        'quantity',
        'created_by'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

        public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
}
