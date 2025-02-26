<?php

namespace App\MoonShine\Resources;

// Remove Column import as it's not needed
use App\Models\User;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Date;
use MoonShine\Actions\DeleteAction;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;


class UserResource extends ModelResource 
{
    protected string $model = User::class;
    protected string $title = 'Users';
    protected string $column = 'nome';

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Nome')->sortable(),
            Email::make('Email')->sortable(),
            Date::make('Created At', 'created_at')
                ->format('Y-m-d')
                ->sortable(),
            Text::make('Role', 'role.name')
                ->sortable()
        ];
    }

    public function fields(): array
    {
        return [
            Grid::make([
                [
                    'xs' => 12,
                    'md' => 6,
                    'component' => Text::make('Nome')
                        ->required()
                        ->default(fn($item) => optional($item)->nome),
                ],
                [
                    'xs' => 12,
                    'md' => 6,
                    'component' => Email::make('Email')
                        ->required()
                        ->default(fn($item) => optional($item)->email),
                ],
            ]),

            Grid::make([
                [
                    'xs' => 12,
                    'md' => 6,
                    'component' => Password::make('Password')
                        ->eye()
                        ->nullable()
                        ->customAttributes(['autocomplete' => 'new-password'])
                        ->hint('Leave empty to keep current password'),
                ],
                [
                    'xs' => 12,
                    'md' => 6,
                    'component' => Select::make('Role', 'role_id')
                        ->required()
                        ->searchable()
                        ->default(fn($item) => optional($item)->role_id)
                        ->options(
                            \App\Models\Role::query()
                                ->pluck('name', 'id')
                                ->toArray()
                        ),
                ],
            ])
        ];
    }

    public function formFields(): array
    {
        return $this->fields();
    }

    public function rules($item): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . ($item->id ?? '')],
            'password' => $item->exists 
                ? ['nullable', 'string', 'min:8']
                : ['required', 'string', 'min:8'],
            'role_id' => ['required', 'integer', 'in:0,1,2']
        ];
    }

    protected function beforeSave(mixed $item): mixed
    {
        if (request()->filled('password')) {
            $item->password = bcrypt(request()->input('password'));
        }
        
        return $item;
    }

    protected function afterSave(mixed $item, FieldsContract $fields): mixed
    {
        return $item;
    }

    public function actions(): array
    {
        return [
            DeleteAction::make('Delete'),
        ];
    }
}
