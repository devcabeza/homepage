<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Application\Portfolio\Actions\DeletePersonalProjectAction;
use App\Application\Portfolio\Actions\SavePersonalProjectAction;
use App\Application\Portfolio\DTOs\SaveProjectDTO;
use App\Domain\Portfolio\Enums\ProjectCategory;
use App\Ports\Out\Persistence\ProjectRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Panel de Control — Alejandro Cabeza')]
final class ProjectsManager extends Component
{
    public bool $showModal = false;

    public ?int $editingId = null;

    public string $title = '';

    public string $slug = '';

    public string $subdomain = '';

    public string $tagline = '';

    public string $summary = '';

    public string $category = 'personal_tool';

    public string $role = 'Creador & Arquitecto';

    public ?string $period = '2026';

    public ?string $metricBadge = 'En Producción';

    public string $techStackInput = 'Laravel 13, Livewire 4, Docker, Tailwind CSS';

    public string $highlightsInput = '';

    public float $monthlyRevenue = 0.0;

    public string $status = 'active';

    public bool $revenueVerified = true;

    public ?string $url = null;

    public ?string $githubUrl = null;

    public int $sortOrder = 0;

    public ?string $feedbackMessage = null;

    public function updatedTitle(string $value): void
    {
        if ($this->editingId === null) {
            $this->slug = Str::slug($value);
            $this->subdomain = Str::slug($value);
        }
    }

    public function openCreate(): void
    {
        $this->reset([
            'editingId',
            'title',
            'slug',
            'subdomain',
            'tagline',
            'summary',
            'category',
            'role',
            'period',
            'metricBadge',
            'techStackInput',
            'highlightsInput',
            'monthlyRevenue',
            'status',
            'revenueVerified',
            'url',
            'githubUrl',
            'sortOrder',
            'feedbackMessage',
        ]);

        $this->category = 'personal_tool';
        $this->role = 'Creador & Arquitecto';
        $this->status = 'active';
        $this->period = (string) date('Y');
        $this->revenueVerified = true;
        $this->showModal = true;
    }

    public function openEdit(int $id, ProjectRepositoryInterface $repository): void
    {
        $project = $repository->findById($id);

        if (! $project) {
            $this->feedbackMessage = 'Proyecto no encontrado.';

            return;
        }

        $this->editingId = (int) $project->id;
        $this->title = $project->title;
        $this->slug = $project->slug;
        $this->subdomain = $project->subdomain ?? $project->slug;
        $this->tagline = $project->tagline;
        $this->summary = $project->summary;
        $this->category = $project->category->value;
        $this->role = $project->role;
        $this->period = $project->period;
        $this->metricBadge = $project->metricBadge;
        $this->techStackInput = implode(', ', $project->techStack);
        $this->highlightsInput = implode("\n", $project->highlights);
        $this->monthlyRevenue = $project->monthlyRevenue;
        $this->status = $project->status;
        $this->revenueVerified = $project->revenueVerified;
        $this->url = $project->url;
        $this->githubUrl = $project->githubUrl;
        $this->sortOrder = $project->sortOrder;
        $this->feedbackMessage = null;

        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    public function save(SavePersonalProjectAction $action): void
    {
        $this->validate([
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:100'],
            'subdomain' => ['required', 'string', 'max:100'],
            'tagline' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:1000'],
            'category' => ['required', 'string', 'in:personal_tool,devops_infra,enterprise'],
            'role' => ['required', 'string', 'max:100'],
            'monthlyRevenue' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'in:active,paused,development'],
            'sortOrder' => ['required', 'integer', 'min:0'],
            'period' => ['nullable', 'string', 'max:50'],
            'metricBadge' => ['nullable', 'string', 'max:100'],
            'url' => ['nullable', 'string', 'max:255'],
            'githubUrl' => ['nullable', 'string', 'max:255'],
        ]);

        $techStack = array_values(array_filter(
            array_map('trim', explode(',', $this->techStackInput))
        ));

        $highlights = array_values(array_filter(
            array_map('trim', explode("\n", $this->highlightsInput))
        ));

        $categoryEnum = ProjectCategory::from($this->category);

        $dto = new SaveProjectDTO(
            id: $this->editingId,
            title: $this->title,
            slug: $this->slug,
            subdomain: $this->subdomain,
            tagline: $this->tagline,
            summary: $this->summary,
            category: $categoryEnum,
            role: $this->role,
            period: $this->period,
            metricBadge: $this->metricBadge,
            techStack: $techStack,
            highlights: $highlights,
            monthlyRevenue: (float) $this->monthlyRevenue,
            status: $this->status,
            url: $this->url ?: "https://{$this->subdomain}.alejandrocabeza.dev",
            githubUrl: $this->githubUrl,
            logoUrl: null,
            revenueVerified: $this->revenueVerified,
            isPersonal: true,
            featured: true,
            sortOrder: $this->sortOrder,
        );

        $action->execute($dto);

        $this->showModal = false;
        $this->feedbackMessage = '¡Proyecto guardado correctamente!';
    }

    public function deleteProject(int $id, DeletePersonalProjectAction $action): void
    {
        $action->execute($id);
        $this->feedbackMessage = 'Proyecto eliminado con éxito.';
    }

    public function render(ProjectRepositoryInterface $repository): View
    {
        $projects = $repository->all();
        $totalRevenue = $repository->getTotalMonthlyRevenue();

        return view('livewire.dashboard.projects-manager', [
            'user' => Auth::user(),
            'projects' => $projects,
            'totalRevenue' => $totalRevenue,
            'totalRevenueFormatted' => '$'.number_format($totalRevenue, 2).' / mes',
        ]);
    }
}
