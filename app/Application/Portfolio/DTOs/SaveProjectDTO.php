<?php

declare(strict_types=1);

namespace App\Application\Portfolio\DTOs;

use App\Domain\Portfolio\Enums\ProjectCategory;

final readonly class SaveProjectDTO
{
    /**
     * @param  list<string>  $techStack
     * @param  list<string>  $highlights
     */
    public function __construct(
        public ?int $id,
        public string $title,
        public string $slug,
        public ?string $subdomain,
        public string $tagline,
        public string $summary,
        public ProjectCategory $category,
        public string $role,
        public ?string $period,
        public ?string $metricBadge,
        public array $techStack,
        public array $highlights,
        public float $monthlyRevenue,
        public string $status = 'active',
        public ?string $url = null,
        public ?string $githubUrl = null,
        public ?string $logoUrl = null,
        public bool $revenueVerified = true,
        public bool $isPersonal = true,
        public bool $featured = true,
        public int $sortOrder = 0,
    ) {}
}
