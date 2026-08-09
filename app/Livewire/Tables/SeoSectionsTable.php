<?php

namespace App\Livewire\Tables;

use App\Models\SeoSection;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Facades\Filter;

final class SeoSectionsTable extends PowerGridComponent
{
    public string $tableName = 'seo-sections-table';


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
        return SeoSection::query();
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

            ->add('status', function ($value) {

                if ($value->status == 1) {

                    return '<span class="badge badge-success w-100">
                                Active
                            </span>';
                }

                return '<span class="badge badge-danger w-100">
                            Inactive
                        </span>';
            })

            ->add('created_at');
    }


    public function columns(): array
    {
        return [

            Column::make(
                'Title (Ar)',
                'title_ar'
            )
                ->sortable()
                ->searchable(),


            Column::make(
                'Title (En)',
                'title_en'
            )
                ->sortable()
                ->searchable(),


            Column::make(
                'Status',
                'status'
            )
                ->sortable(),


            Column::make(
                'Created at',
                'created_at'
            )
                ->sortable(),


            Column::action('Action'),
        ];
    }


    public function filters(): array
    {
        return [
            Filter::boolean('status')
                ->label(
                    'Active',
                    'Inactive'
                ),
        ];
    }


    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        redirect()->route(
            'dashboard.seo-sections.edit',
            $rowId
        );
    }


    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $seoSection = SeoSection::find($rowId);

        if (!$seoSection) {
            return;
        }


        $seoSection->delete();


        $this->js(
            'toastr.success("SEO Section deleted successfully")'
        );
    }


    #[\Livewire\Attributes\On('toggleStatus')]
    public function toggleStatus($rowId): void
    {
        $seoSection = SeoSection::find($rowId);

        if (!$seoSection) {
            return;
        }


        $seoSection->status = !$seoSection->status;

        $seoSection->save();


        $this->js(
            'toastr.success("Status changed successfully")'
        );
    }


    public function actions(SeoSection $row): array
    {
        return [

            Button::add('edit')
                ->slot(
                    '<i class="fas fa-edit"></i>'
                )
                ->class(
                    'btn btn-primary btn-sm rounded'
                )
                ->dispatch(
                    'edit',
                    [
                        'rowId' => $row->id
                    ]
                ),


            Button::add('toggleStatus')
                ->slot(
                    $row->status == 1
                        ? '<i class="fas fa-toggle-on"></i>'
                        : '<i class="fas fa-toggle-off"></i>'
                )
                ->class(
                    'btn btn-info btn-sm rounded'
                )
                ->dispatch(
                    'toggleStatus',
                    [
                        'rowId' => $row->id
                    ]
                ),


            Button::add('delete')
                ->slot(
                    '<i class="fas fa-trash"></i>'
                )
                ->class(
                    'btn btn-danger btn-sm rounded'
                )
                ->confirm(
                    'Are you sure you want to delete this SEO Section?'
                )
                ->dispatch(
                    'delete',
                    [
                        'rowId' => $row->id
                    ]
                ),
        ];
    }
}
