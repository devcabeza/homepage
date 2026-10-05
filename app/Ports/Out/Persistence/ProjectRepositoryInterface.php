<?php

declare(strict_types=1);

namespace App\Ports\Out\Persistence;

use App\Domain\Portfolio\Enums\ProjectCategory;
use App\Domain\Portfolio\Models\Project;

interface ProjectRepositoryInterface
{
    /**
     * Get all portfolio projects ordered by sort order.
     *
     * @return list<Project>
     */
    public function all(): array;

    /**
     * Get projects filtered by category.
     *
     * @return list<Project>
     */
    public function findByCategory(ProjectCategory $category): array;

    /**
     * Find a project by unique slug.
     */
    public function findBySlug(string $slug): ?Project;

    /**
     * Search projects by keyword/technology and optional category.
     *
     * @return list<Project>
     */
    public function search(string $query, ?ProjectCategory $category = null): array;

    /**
     * Find a project by ID.
     */
    public function findById(int|string $id): ?Project;

    /**
     * Save (create or update) a project.
     */
    public function save(Project $project): Project;

    /**
     * Delete a project by ID.
     */
    public function delete(int|string $id): bool;

    /**
     * Calculate total monthly revenue (MRR) from all active personal projects.
     */
    public function getTotalMonthlyRevenue(): float;
}
