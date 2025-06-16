<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'service_category_id',
        'title',
        'description',
        'category',
        'latitude',
        'longitude',
        'address',
        'budget',
        'scheduled_date',
        'completion_deadline',
        'status',
        'cancellation_reason',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'completion_deadline' => 'datetime',
        'budget' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Status constants
    const STATUS_OPEN = 'open';
    const STATUS_ASSIGNED = 'assigned';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_OPEN => 'Terbuka',
            self::STATUS_ASSIGNED => 'Ditugaskan',
            self::STATUS_IN_PROGRESS => 'Sedang Berjalan',
            self::STATUS_COMPLETED => 'Selesai',
            self::STATUS_CANCELLED => 'Dibatalkan',
        ];
    }

    // 🔁 Relationships
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function attachments()
    {
        return $this->hasMany(JobAttachment::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'job_post_id');
    }

    // 🔧 Helper Methods
    public function getFormattedBudgetAttribute(): string
    {
        return 'Rp ' . number_format($this->budget, 0, ',', '.');
    }

    public function isOverdue(): bool
    {
        return $this->completion_deadline < now() && 
               !in_array($this->status, [self::STATUS_COMPLETED, self::STATUS_CANCELLED]);
    }

    public function canBeEdited(): bool
    {
        return in_array($this->status, [self::STATUS_OPEN, self::STATUS_ASSIGNED]);
    }

    public function canBeCancelled(): bool
    {
        return !in_array($this->status, [self::STATUS_COMPLETED, self::STATUS_CANCELLED]);
    }

    // 🔍 Scopes
    public function scopeOpen($query)
    {
        return $query->where('status', self::STATUS_OPEN);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', [self::STATUS_OPEN, self::STATUS_ASSIGNED, self::STATUS_IN_PROGRESS]);
    }

    public function scopeOverdue($query)
    {
        return $query->where('completion_deadline', '<', now())
                    ->whereNotIn('status', [self::STATUS_COMPLETED, self::STATUS_CANCELLED]);
    }
}