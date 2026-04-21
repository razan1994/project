<?php

namespace App\Livewire\Tables;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;

final class ServiceTable extends PowerGridComponent
{
     public string $tableName = 'service-table-hrpps2-table';

    public function setUp(): array
    {
       return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage(
                    $perPage = 20,
                    $perPageValues = [10, 20, 50, 100, 0]
                )
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Service::query()->withCount('media');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title_ar', function ($value) {
                return "<p>" . $value->title_ar . "</p>";
            })
            ->add('title_en', function ($value) {
                return "<p>" . $value->title_en . "</p>";
            })
            ->add('image', function ($value) {
                if (file_exists($value->image) && $value->image != null) {
                    return '<img src="' . asset($value->image) . '" alt=" Image" style="width: 90px; height: 90px; object-fit: contain;" loading="lazy" class="img-thumbnail">';
                }
                return '-';
            })
            ->add('desc_ar', function ($value) {
                return "<p>" . $value->desc_ar . "</p>";
            })
            ->add('desc_en', function ($value) {
                return "<p>" . $value->desc_en . "</p>";
            })

            ->add('status', function ($value) {
                if ($value->status == 1) {
                    return '<span class="badge badge-success w-100">Active</span>';
                }
                return '<span class="badge badge-danger w-100">Inactive</span>';
            })

            ->add('created_at');
    }


    public function columns(): array
    {
        return [
            Column::make('Title (Ar)', 'title_ar')
                ->sortable()
                ->searchable(),

            Column::make('Title (En)', 'title_en')
                ->sortable()
                ->searchable(),
            Column::make('Image', 'image'),

            Column::make('Type', 'type')
                ->sortable(),

            Column::make('Status', 'status')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::boolean(
                'status',
            )->label('Active', 'Inactive'),

            Filter::datepicker(
                'created_at',
            ),

            Filter::select('type', 'type')
                ->dataSource(
                    [
                        [
                            'id' => 'online',
                            'name' => 'online',
                        ],
                        [
                            'id' => 'offline',
                            'name' => 'offline',
                        ]
                    ]
                )
                ->optionLabel('name')
                ->optionValue('id'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        redirect()->route('dashboard.Services.edit', $rowId);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $service = Service::find($rowId);
        if (!$service) {
            return;
        }
        $service->update([
            'status' => 0,
        ]);

        // if (file_exists($service->image) && $service->image != null) {
        //     unlink($service->image);
        // }
        $service->delete();
        $this->js('toastr.success("Service deleted successfully")');
    }

    #[\Livewire\Attributes\On('toggleStatus')]
    public function toggleStatus($rowId): void
    {
        $service = Service::find($rowId);
        $service->status = !$service->status;
        $service->save();
        $this->js('toastr.success("status changed successfully")');
    }

    #[\Livewire\Attributes\On('restore')]
    public function restore($rowId): void
    {
        $service = Service::withTrashed()->find($rowId);
        $service->restore();
        $this->js('toastr.success("Service restored successfully")');
    }

    #[\Livewire\Attributes\On('seo')]
    public function seo($rowId): void
    {
        $this->dispatch('openServiceSeoModal', ['service' => $rowId]);
    }

    public function actions(Service $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fas fa-edit"></i>')
                ->class('btn btn-primary btn-sm rounded')
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('toggleStatus')
                ->slot($row->status == 1 ? '<i class="fas fa-toggle-on"></i>' : '<i class="fas fa-toggle-off"></i>')
                ->class('btn btn-info btn-sm rounded')
                ->dispatch('toggleStatus', ['rowId' => $row->id]),

            Button::add('seo')
                ->slot('<i class="fas fa-search"></i> SEO')
                ->class('btn btn-warning btn-sm rounded')
                ->dispatch('seo', ['rowId' => $row->id]),

            Button::add('gallery')
                ->slot('<i class="fas fa-images"></i>')
                ->class('btn btn-secondary btn-sm rounded')
                ->route('dashboard.Services.gallery', ['id' => $row->id]),

            Button::add('delete')
                ->slot('<i class="fas fa-trash"></i>')
                ->class('btn btn-danger btn-sm rounded')
                ->confirm('Are you sure you want to delete this service?')
                ->dispatch('delete', ['rowId' => $row->id]),


            Button::add('restore')
                ->slot('<i class="fas fa-trash-restore"></i>')
                ->id()
                ->class('btn btn-success btn-sm rounded ')
                ->dispatch('restore', ['rowId' => $row->id]),

        ];
    }


    public function actionRules($row): array
    {
        return [
            Rule::button('edit')
                ->when(fn($row) => $row->trashed())
                ->hide(),

            Rule::button('delete')
                ->when(fn($row) => $row->trashed())
                ->hide(),

            Rule::button('toggleStatus')
                ->when(fn($row) => $row->trashed())
                ->hide(),

            Rule::button('seo')
                ->when(fn($row) => $row->trashed() || auth()->user()?->email !== 'seo-admin@smartzone.com')
                ->hide(),

            Rule::button('gallery')
                ->when(fn($row) => $row->trashed())
                ->hide(),

            Rule::button('restore')
                ->when(fn($row) => !$row->trashed())
                ->hide(),
        ];
    }
}
