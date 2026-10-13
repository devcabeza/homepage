<?php

declare(strict_types=1);

namespace App\Application\Portfolio\Queries;

use App\Application\Portfolio\DTOs\ProjectDTO;
use App\Domain\Portfolio\Enums\ProjectCategory;
use App\Domain\Portfolio\Models\Project;
use App\Ports\Out\Persistence\ProjectRepositoryInterface;

final readonly class GetPortfolioProjectsQuery
{
    public function __construct(
        private ProjectRepositoryInterface $repository,
    ) {}

    /**
     * @return list<ProjectDTO>
     */
    public function execute(?string $category = null, string $search = '', ?string $pricing = null): array
    {
        $categoryEnum = null;
        if ($category !== null && $category !== '' && $category !== 'all') {
            $categoryEnum = ProjectCategory::tryFrom($category);
        }

        $isFreemium = match ($pricing) {
            'freemium' => true,
            'paid' => false,
            default => null,
        };

        $term = trim($search);

        if ($term !== '') {
            $projects = $this->repository->search($term, $categoryEnum, $isFreemium);
        } elseif ($categoryEnum !== null) {
            $projects = $this->repository->findByCategory($categoryEnum, $isFreemium);
        } else {
            $projects = $this->repository->all($isFreemium);
        }

        return array_map(
            fn (Project $project): ProjectDTO => ProjectDTO::fromDomain($project),
            $projects,
        );
    }
}
