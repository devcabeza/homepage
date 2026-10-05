<?php

declare(strict_types=1);

namespace App\Application\Portfolio\Actions;

use App\Ports\Out\Persistence\ProjectRepositoryInterface;

final readonly class DeletePersonalProjectAction
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository,
    ) {}

    public function execute(int|string $id): bool
    {
        return $this->projectRepository->delete($id);
    }
}
