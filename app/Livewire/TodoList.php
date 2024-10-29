<?php

namespace App\Livewire;

use App\Livewire\Forms\TodoForm;
use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, On};
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    public TodoForm $form;

    #[Url(as: 's', history: true)]
    public string $search = '';

    public string $editingTodoId = '';

    public string $sortByField = 'updated_at';

    #[Url]
    public string $sortDirection = 'desc';

    public function create(): void
    {
        $validatedRequest = $this->form->validateOnly('name');

        Todo::create($validatedRequest);

        $this->form->reset('name');

        $this->dispatch(event: 'swal', payload: [
            'title' => 'Todo Created Successfully !!!'
        ]);

        $this->resetPage();
    }

    public function edit(array $todo): void
    {
        $this->editingTodoId = $todo['id'];
        $this->form->editedName = $todo['name'];
    }

    public function update(Todo $todo): void
    {
        $validatedRequest = $this->form->validateOnly('editedName');

        $todo->update(['name' => $validatedRequest['editedName']]);

        $this->cancelEdit();

        $this->dispatch(event: 'swal', payload: [
            'title' => 'Todo Updated Successfully !!!'
        ]);
    }

    #[Computed]
    public function todos(): LengthAwarePaginator
    {
        return Todo::when(!empty($this->search), function ($query) {
            $this->resetPage();
            $query->where('name', 'like', "%{$this->search}%");
        })->orderBy($this->sortByField, $this->sortDirection)
            ->paginate(4);
    }

    public function render(): View
    {
        return view('livewire.todo-list');
    }

    public function placeholder(): View
    {
        return view('livewire.todo-list-skeleton');
    }

    #[On('delete-todo')]
    public function delete(Todo $todo): void
    {
        $todo->delete();

        $this->dispatch(event: 'swal', payload: [
            'title' => 'Todo Deleted Successfully !!!'
        ]);
    }

    public function sortBy(string $column): void
    {
        $this->sortByField = $column;
        $this->sortDirection = ($this->sortDirection === 'asc') ? 'desc' : 'asc';
    }

    public function toggleComplete(Todo $todo): void
    {
        $todo->update(['is_done' => !$todo->is_done]);
    }

    public function cancelEdit(): void
    {
        $this->reset('editingTodoId');

        $this->form->reset('editedName');
    }
}
