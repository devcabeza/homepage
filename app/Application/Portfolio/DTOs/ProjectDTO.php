<?php

declare(strict_types=1);

namespace App\Application\Portfolio\DTOs;

use App\Domain\Portfolio\Enums\ProjectCategory;
use App\Domain\Portfolio\Models\Project;

final readonly class ProjectDTO
{
    /**
     * @param  list<string>  $techStack
     * @param  list<string>  $highlights
     */
    public function __construct(
        public int|string $id,
        public string $slug,
        public string $title,
        public string $tagline,
        public string $summary,
        public ProjectCategory $category,
        public string $categoryLabel,
        public string $role,
        public ?string $period,
        public ?string $metricBadge,
        public array $techStack,
        public array $highlights,
        public bool $isPersonal,
        public bool $featured,
        public int $sortOrder,
        public ?string $url,
        public ?string $githubUrl,
        public ?string $subdomain = null,
        public ?string $toolUrl = null,
        public float $monthlyRevenue = 0.0,
        public string $monthlyRevenueFormatted = '$0/mo',
        public string $status = 'active',
        public ?string $logoUrl = null,
        public bool $revenueVerified = true,
    ) {}

    public static function fromDomain(Project $project, ?string $rootDomain = null): self
    {
        $root = $rootDomain ?: (string) config('portfolio.root_domain', 'alejandrocabeza.dev');

        return new self(
            id: $project->id,
            slug: $project->slug,
            title: $project->title,
            tagline: $project->tagline,
            summary: $project->summary,
            category: $project->category,
            categoryLabel: $project->category->label(),
            role: $project->role,
            period: $project->period,
            metricBadge: $project->metricBadge,
            techStack: $project->techStack,
            highlights: $project->highlights,
            isPersonal: $project->isPersonal,
            featured: $project->featured,
            sortOrder: $project->sortOrder,
            url: $project->url,
            githubUrl: $project->githubUrl,
            subdomain: $project->subdomain ?? $project->slug,
            toolUrl: $project->resolveToolUrl($root),
            monthlyRevenue: $project->monthlyRevenue,
            monthlyRevenueFormatted: $project->formattedMonthlyRevenue(),
            status: $project->status,
            logoUrl: $project->logoUrl,
            revenueVerified: $project->revenueVerified,
        );
    }
}
