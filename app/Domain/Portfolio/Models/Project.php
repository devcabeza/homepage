<?php

declare(strict_types=1);

namespace App\Domain\Portfolio\Models;

use App\Domain\Portfolio\Enums\ProjectCategory;

final class Project
{
    /**
     * @param  list<string>  $techStack
     * @param  list<string>  $highlights
     */
    public function __construct(
        public readonly int|string $id,
        public readonly string $slug,
        public readonly string $title,
        public readonly string $tagline,
        public readonly string $summary,
        public readonly ProjectCategory $category,
        public readonly string $role,
        public readonly ?string $period = null,
        public readonly ?string $metricBadge = null,
        public readonly array $techStack = [],
        public readonly array $highlights = [],
        public readonly bool $isPersonal = false,
        public readonly bool $featured = false,
        public readonly int $sortOrder = 0,
        public readonly ?string $url = null,
        public readonly ?string $githubUrl = null,
        public readonly ?string $subdomain = null,
        public readonly float $monthlyRevenue = 0.0,
        public readonly string $status = 'active',
        public readonly ?string $logoUrl = null,
        public readonly bool $revenueVerified = true,
    ) {}

    public function isPersonalTool(): bool
    {
        return $this->category === ProjectCategory::PersonalTool || $this->isPersonal;
    }

    public function isDevOps(): bool
    {
        return $this->category === ProjectCategory::DevOpsInfra;
    }

    public function isGeneratingRevenue(): bool
    {
        return $this->monthlyRevenue > 0;
    }

    public function formattedMonthlyRevenue(): string
    {
        if ($this->monthlyRevenue <= 0) {
            return '$0/mo';
        }

        if ($this->monthlyRevenue >= 1000) {
            $k = round($this->monthlyRevenue / 1000, 1);

            return '$'.($k == (int) $k ? (int) $k : $k).'k/mo';
        }

        return '$'.number_format($this->monthlyRevenue, 0).'/mo';
    }

    public function resolveToolUrl(?string $rootDomain = null): string
    {
        $subdomain = $this->subdomain ?? $this->slug;
        $domain = $rootDomain ?: 'alejandrocabeza.dev';

        return "https://{$subdomain}.{$domain}";
    }
}
