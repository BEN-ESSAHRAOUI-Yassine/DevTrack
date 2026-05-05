<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    public const STATUSES = ['todo', 'in_progress', 'done'];

    public const PRIORITIES = ['low', 'medium', 'high'];

    protected $fillable = [
        'project_id',
        'assigned_to',
        'title',
        'description',
        'status',
        'priority',
        'deadline',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'todo' => 'A faire',
            'in_progress' => 'En cours',
            'done' => 'Termine',
            default => 'Inconnu',
        };
    }

    public function getDeadlineStatusAttribute(): string
    {
        if ($this->status === 'done') {
            return 'Termine';
        }

        if ($this->deadline->isPast()) {
            return 'En retard';
        }

        if ($this->deadline->lte(now()->addHours(48))) {
            return 'Urgent';
        }

        return 'Normal';
    }

    public function scopeUrgent(Builder $query): Builder
    {
        return $query
            ->where('status', '!=', 'done')
            ->where('deadline', '<=', now()->addHours(48));
    }
}
