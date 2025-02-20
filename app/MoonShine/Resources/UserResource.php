<?php

namespace App\MoonShine\Resources;

use App\Models\User;
use MoonShine\Screen;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Email;
use MoonShine\Fields\Password;
use MoonShine\Fields\Select;
use MoonShine\Decorations\Block;

class UserResource extends ModelResource
{
    protected string $model = User::class;
    protected string $title = 'Users';

    public function fields(): array
    {
        return [
            Block::make('User Information', [
                ID::make()->sortable(),
                Text::make('Nome')
                    ->required(),
                Email::make('Email')
                    ->required(),
                Password::make('Password')
                    ->hideOnIndex(),
                Select::make('Role', 'role_id')
                    ->options([
                        0 => 'Usuário',
                        1 => 'Administrador',
                        2 => 'Coordenador'
                    ])
                    ->required()
            ])
        ];
    }

    public function rules($item): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => $item->exists 
                ? ['nullable', 'string', 'min:8']
                : ['required', 'string', 'min:8'],
            'role_id' => ['required', 'integer', 'in:0,1,2']
        ];
    }
}
