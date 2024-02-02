<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ViewRecord;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions;

class ViewUser extends ViewRecord
{
    use HasPageSidebar;

    protected static string $resource = UserResource::class;
}
