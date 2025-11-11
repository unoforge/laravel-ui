@props(['column' => 'Prop'])

<x-ui.table noDivider wrapper="rounded-lg border border-border-strong/70 p-1 mt-6">
    <x-ui.table.columns header-bg-style="gray" class="*:first:rounded-l-md *:last:rounded-r-md">
        <x-ui.table.column>
            {{ $column }}
        </x-ui.table.column>
        <x-ui.table.column>
            Description
        </x-ui.table.column>
    </x-ui.table.columns>
    <x-ui.table.rows>
        {{ $slot }}
    </x-ui.table.rows>
</x-ui.table>
