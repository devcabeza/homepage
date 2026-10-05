<?php

declare(strict_types=1);

namespace App\Application\Portfolio\Queries;

use App\Application\Portfolio\DTOs\ProjectDTO;
use App\Ports\Out\Persistence\ProjectRepositoryInterface;

final readonly class IndiePageData
{
    /**
     * @param  list<ProjectDTO>  $projects
     */
    public function __construct(
        public array $projects,
        public float $totalMonthlyRevenue,
        public string $totalMonthlyRevenueFormatted,
        public int $activeProjectsCount,
        public int $verifiedProjectsCount,
    ) {}
}

final readonly class GetIndiePageDataQuery
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository,
    ) {}

    public function execute(?string $rootDomain = null): IndiePageData
    {
        $domainProjects = $this->projectRepository->all();

        $projects = array_map(
            fn ($p): ProjectDTO => ProjectDTO::fromDomain($p, $rootDomain),
            $domainProjects
        );

        $totalRevenue = $this->projectRepository->getTotalMonthlyRevenue();

        $activeCount = count(array_filter($domainProjects, fn ($p): bool => $p->status === 'active'));
        $verifiedCount = count(array_filter($domainProjects, fn ($p): bool => $p->revenueVerified && $p->monthlyRevenue > 0));

        $formattedRevenue = $this->formatRevenue($totalRevenue);

        return new IndiePageData(
            projects: $projects,
            totalMonthlyRevenue: $totalRevenue,
            totalMonthlyRevenueFormatted: $formattedRevenue,
            activeProjectsCount: $activeCount,
            verifiedProjectsCount: $verifiedCount,
        );
    }

    private function formatRevenue(float $revenue): string
    {
        if ($revenue <= 0) {
            return '$0/mes';
        }

        if ($revenue >= 1000) {
            $k = round($revenue / 1000, 1);

            return '$'.($k == (int) $k ? (int) $k : $k).'k/mes';
        }

        return '$'.number_format($revenue, 0, ',', '.').'/mes';
    }
}
