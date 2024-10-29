<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a wire:navigate href="{{ route('dashboard') }}">
                {{ __('Todo - App') }}
            </a>
        </h2>
    </x-slot>

    <div class="py-1">
        <div id="content" class="mx-auto" style="max-width:500px;">
            <livewire:todo-list lazy />
        </div>
    </div>
</x-app-layout>
