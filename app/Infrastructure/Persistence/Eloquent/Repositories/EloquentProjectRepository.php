<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Portfolio\Enums\ProjectCategory;
use App\Domain\Portfolio\Models\Project;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentProject;
use App\Ports\Out\Persistence\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

final class EloquentProjectRepository implements ProjectRepositoryInterface
{
    /**
     * @return list<Project>
     */
    public function all(): array
    {
        return array_values(
            EloquentProject::query()
                ->where('is_personal', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (EloquentProject $model): Project => $this->toDomainEntity($model))
                ->all()
        );
    }

    /**
     * @return list<Project>
     */
    public function findByCategory(ProjectCategory $category): array
    {
        return array_values(
            EloquentProject::query()
                ->where('is_personal', true)
                ->where('category', $category->value)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (EloquentProject $model): Project => $this->toDomainEntity($model))
                ->all()
        );
    }

    public function findBySlug(string $slug): ?Project
    {
        /** @var EloquentProject|null $model */
        $model = EloquentProject::query()->where('slug', $slug)->first();

        return $model ? $this->toDomainEntity($model) : null;
    }

    /**
     * @return list<Project>
     */
    public function search(string $query, ?ProjectCategory $category = null): array
    {
        $term = trim($query);

        return array_values(
            EloquentProject::query()
                ->where('is_personal', true)
                ->when($category !== null, fn (Builder $q) => $q->where('category', $category->value))
                ->when($term !== '', function (Builder $q) use ($term) {
                    $like = '%'.strtolower($term).'%';
                    $q->where(function (Builder $sub) use ($like) {
                        $sub->whereRaw('LOWER(title) LIKE ?', [$like])
                            ->orWhereRaw('LOWER(summary) LIKE ?', [$like])
                            ->orWhereRaw('LOWER(tagline) LIKE ?', [$like])
                            ->orWhereRaw('LOWER(role) LIKE ?', [$like])
                            ->orWhereRaw('LOWER(tech_stack) LIKE ?', [$like]);
                    });
                })
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (EloquentProject $model): Project => $this->toDomainEntity($model))
                ->all()
        );
    }

    public function findById(int|string $id): ?Project
    {
        /** @var EloquentProject|null $model */
        $model = EloquentProject::query()->find($id);

        return $model ? $this->toDomainEntity($model) : null;
    }

    public function save(Project $project): Project
    {
        /** @var EloquentProject $model */
        $model = (! empty($project->id)
            ? EloquentProject::query()->find($project->id)
            : EloquentProject::query()->where('slug', $project->slug)->first()) ?? new EloquentProject;

        $model->fill([
            'slug' => $project->slug,
            'title' => $project->title,
            'tagline' => $project->tagline,
            'summary' => $project->summary,
            'category' => $project->category->value,
            'role' => $project->role,
            'period' => $project->period,
            'metric_badge' => $project->metricBadge,
            'tech_stack' => $project->techStack,
            'highlights' => $project->highlights,
            'is_personal' => $project->isPersonal,
            'featured' => $project->featured,
            'sort_order' => $project->sortOrder,
            'monthly_revenue' => $project->monthlyRevenue,
            'status' => $project->status,
            'logo_url' => $project->logoUrl,
            'revenue_verified' => $project->revenueVerified,
            'url' => $project->url,
            'github_url' => $project->githubUrl,
            'subdomain' => $project->subdomain ?? $project->slug,
        ]);
        $model->save();

        return $this->toDomainEntity($model);
    }

    public function delete(int|string $id): bool
    {
        return (bool) EloquentProject::query()->where('id', $id)->delete();
    }

    public function getTotalMonthlyRevenue(): float
    {
        return (float) EloquentProject::query()
            ->where('is_personal', true)
            ->where('status', 'active')
            ->sum('monthly_revenue');
    }

    private function toDomainEntity(EloquentProject $model): Project
    {
        return new Project(
            id: (int) $model->id,
            slug: (string) $model->slug,
            title: (string) $model->title,
            tagline: (string) $model->tagline,
            summary: (string) $model->summary,
            category: ProjectCategory::from((string) $model->category),
            role: (string) $model->role,
            period: $model->period ? (string) $model->period : null,
            metricBadge: $model->metric_badge ? (string) $model->metric_badge : null,
            techStack: (array) ($model->tech_stack ?? []),
            highlights: (array) ($model->highlights ?? []),
            isPersonal: (bool) $model->is_personal,
            featured: (bool) $model->featured,
            sortOrder: (int) $model->sort_order,
            url: $model->url ? (string) $model->url : null,
            githubUrl: $model->github_url ? (string) $model->github_url : null,
            subdomain: $model->subdomain ? (string) $model->subdomain : (string) $model->slug,
            monthlyRevenue: (float) ($model->monthly_revenue ?? 0.0),
            status: (string) ($model->status ?? 'active'),
            logoUrl: $model->logo_url ? (string) $model->logo_url : null,
            revenueVerified: (bool) ($model->revenue_verified ?? true),
        );
    }
}
