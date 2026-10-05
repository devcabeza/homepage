<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentProject extends Model
{
    protected $table = 'portfolio_projects';

    protected $fillable = [
        'slug',
        'subdomain',
        'title',
        'tagline',
        'summary',
        'category',
        'role',
        'period',
        'metric_badge',
        'tech_stack',
        'highlights',
        'is_personal',
        'featured',
        'sort_order',
        'monthly_revenue',
        'status',
        'logo_url',
        'revenue_verified',
        'url',
        'github_url',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'highlights' => 'array',
            'is_personal' => 'boolean',
            'featured' => 'boolean',
            'sort_order' => 'integer',
            'monthly_revenue' => 'float',
            'revenue_verified' => 'boolean',
        ];
    }
}
