<div>
    <div class="container content py-6 mx-auto">
        <div wire:offline class="flex items-center bg-teal-500 text-white text-sm font-bold px-4 py-3 mb-3 rounded"
            role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>Opps! your internet connection seems to be offline!</p>
        </div>
        <div class="mx-auto">

            @include('livewire.includes.create-todo-form')
        </div>
    </div>
    @include('livewire.includes.todo-search-box')
    <div id="todos-list">
        <div
            class="p-1.5 rounded flex flex-row items-center justify-between mb-4 text-xl font-semibold text-gray-600 hover:text-gray-900 hover:shadow cursor-pointer">
            <span wire:click="sortBy('name')" class="flex items-center gap-2">
                Todos
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                </svg>
            </span>
            <span>Actions</span>
        </div>
        @forelse ($this->todos as $todo)
            @include('livewire.includes.todo-card', $todo)
        @empty
            <div class="todo mb-5 card px-5 py-6 bg-white col-span-1 border-t-2 border-blue-500 hover:shadow">
                <div class="space-x-2 text-center">
                    <span>
                        {{ empty($search) ? 'Great! You have no task Pending. <3' : 'No records.' }}
                    </span>
                </div>
            </div>
        @endforelse
        <div class="my-2">
            {{ $this->todos->links() }}
        </div>
    </div>
</div>
