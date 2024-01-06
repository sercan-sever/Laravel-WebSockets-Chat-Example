<?php

namespace App\Enums;

use App\Traits\EnumValues;

enum StatusEnum: string
{

    use EnumValues;

    case ACTIVE = 'a';
    case PASSIVE = 'p';


    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::ACTIVE  => "Aktif",
            self::PASSIVE => "Pasif",
            default       => '',
        };
    }

    /**
     * @param StatusEnum $enum
     *
     * @return string
     */
    public static function getStatusHtml(StatusEnum $enum = null): string
    {
        return match ($enum) {
            StatusEnum::ACTIVE => '<i class="mdi mdi-circle text-success align-middle me-1"></i> Aktif',
            StatusEnum::PASSIVE => '<i class="mdi mdi-circle text-secondary align-middle me-1"></i> Pasif',
            default => '',
        };
    }
}
