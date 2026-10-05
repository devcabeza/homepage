<?php

declare(strict_types=1);

namespace App\Domain\Portfolio\Enums;

enum ProjectCategory: string
{
    case PersonalTool = 'personal_tool';
    case DevOpsInfra = 'devops_infra';
    case Enterprise = 'enterprise';

    public function label(): string
    {
        return match ($this) {
            self::PersonalTool => 'Herramientas & Open Source',
            self::DevOpsInfra => 'Infraestructura & DevOps',
            self::Enterprise => 'Sistemas Empresariales',
        };
    }
}
