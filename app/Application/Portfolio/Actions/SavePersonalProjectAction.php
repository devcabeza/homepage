<?php

declare(strict_types=1);

namespace App\Application\Portfolio\Actions;

use App\Application\Portfolio\DTOs\ProjectDTO;
use App\Application\Portfolio\DTOs\SaveProjectDTO;
use App\Domain\Portfolio\Models\Project;
use App\Ports\Out\Persistence\ProjectRepositoryInterface;
use Illuminate\Support\Str;

final readonly class SavePersonalProjectAction
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository,
    ) {}

    public function execute(SaveProjectDTO $dto): ProjectDTO
    {
        $slug = $dto->slug !== '' ? Str::slug($dto->slug) : Str::slug($dto->title);
        $subdomain = $dto->subdomain !== null && trim($dto->subdomain) !== ''
            ? Str::slug($dto->subdomain)
            : $slug;

        $project = new Project(
            id: $dto->id ?? 0,
            slug: $slug,
            title: trim($dto->title),
            tagline: trim($dto->tagline),
            summary: trim($dto->summary),
            category: $dto->category,
            role: trim($dto->role),
            period: $dto->period,
            metricBadge: $dto->metricBadge,
            techStack: $dto->techStack,
            highlights: $dto->highlights,
            isPersonal: $dto->isPersonal,
            featured: $dto->featured,
            sortOrder: $dto->sortOrder,
            url: $dto->url,
            githubUrl: $dto->githubUrl,
            subdomain: $subdomain,
            monthlyRevenue: $dto->monthlyRevenue,
            status: $dto->status,
            logoUrl: $dto->logoUrl,
            revenueVerified: $dto->revenueVerified,
        );

        $saved = $this->projectRepository->save($project);

        return ProjectDTO::fromDomain($saved);
    }
}
