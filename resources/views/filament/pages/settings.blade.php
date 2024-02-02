<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}

        <br>
        <x-filament-panels::form.actions
            :actions="$this->getFormActions()"
        />
{{--        <x-filament::button type="submit" form="submit">--}}
{{--            Atualizar dados--}}
{{--        </x-filament::button>--}}
    </form>
</x-filament-panels::page>
