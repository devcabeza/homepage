<?php

declare(strict_types=1);

namespace App\Livewire\Portfolio;

use App\Application\Portfolio\DTOs\ProjectDTO;
use App\Application\Portfolio\Queries\FindProjectBySlugQuery;
use App\Application\Portfolio\Queries\GetPortfolioProjectsQuery;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProjectsRegistry extends Component
{
    #[Url(as: 'categoria')]
    public string $category = 'all';

    #[Url(as: 'buscar')]
    public string $search = '';

    #[Url(as: 'modelo')]
    public string $pricing = 'all';

    public ?string $selectedSlug = null;

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function setPricing(string $pricing): void
    {
        $this->pricing = $pricing;
    }

    public function showProject(string $slug): void
    {
        $this->selectedSlug = $slug;
    }

    public function closeModal(): void
    {
        $this->selectedSlug = null;
    }

    public function clearFilters(): void
    {
        $this->category = 'all';
        $this->search = '';
        $this->pricing = 'all';
    }

    public function render(
        GetPortfolioProjectsQuery $getProjectsQuery,
        FindProjectBySlugQuery $findProjectQuery,
    ): View {
        /** @var list<ProjectDTO> $projects */
        $projects = $getProjectsQuery->execute($this->category, $this->search, $this->pricing);

        /** @var ProjectDTO|null $activeProject */
        $activeProject = $this->selectedSlug
            ? $findProjectQuery->execute($this->selectedSlug)
            : null;

        // Statistics for filter badges
        $allProjects = $getProjectsQuery->execute('all');
        $counts = [
            'all' => count($allProjects),
            'personal_tool' => count(array_filter($allProjects, fn (ProjectDTO $p) => $p->category->value === 'personal_tool')),
            'devops_infra' => count(array_filter($allProjects, fn (ProjectDTO $p) => $p->category->value === 'devops_infra')),
            'enterprise' => count(array_filter($allProjects, fn (ProjectDTO $p) => $p->category->value === 'enterprise')),
            'freemium' => count(array_filter($allProjects, fn (ProjectDTO $p) => $p->isFreemium)),
            'paid' => count(array_filter($allProjects, fn (ProjectDTO $p) => ! $p->isFreemium)),
        ];

        return view('livewire.portfolio.projects-registry', [
            'projects' => $projects,
            'activeProject' => $activeProject,
            'counts' => $counts,
        ]);
    }
}
