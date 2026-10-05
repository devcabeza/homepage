<?php

declare(strict_types=1);

namespace App\Application\Portfolio\Queries;

use App\Application\Portfolio\DTOs\ProjectDTO;
use App\Ports\Out\Persistence\ProjectRepositoryInterface;

final readonly class FindProjectBySlugQuery
{
    public function __construct(
        private ProjectRepositoryInterface $repository,
    ) {}

    public function execute(string $slug): ?ProjectDTO
    {
        $project = $this->repository->findBySlug($slug);

        return $project ? ProjectDTO::fromDomain($project) : null;
    }
}
