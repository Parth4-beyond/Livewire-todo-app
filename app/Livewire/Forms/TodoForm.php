<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class TodoForm extends Form
{
    #[Validate(
        rule: 'required|min:3|max:255',
        attribute: 'todo', message: ['required' => 'The :attribute field is required.']
    )]
    public string $name = '';

    #[Validate(
        rule: 'required|min:3|max:255',
        attribute: 'todo', message: ['required' => 'The :attribute field is required.']
    )]
    public string $editedName = '';
}
