<?php

namespace App\Livewire\Tables;

use App\Models\SeoPage;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class SeoPagesTable extends PowerGridComponent
{
    public string $tableName = 'seo-pages-table-hrpps2-table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage(
                    $perPage = 50,
                    $perPageValues = [10, 20, 50, 100]
                )
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return SeoPage::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('seo_title_en', function ($row) {
                return "<p style='max-width: 350px ; text-wrap: wrap'>$row->seo_title_en</p>";
            })
            ->add('seo_title_ar', function ($row) {
                return "<p style='max-width: 350px ; text-wrap: wrap'>$row->seo_title_ar</p>";
            })
        ;
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('SEO Title (EN)', 'seo_title_en')->sortable(),
            Column::make('SEO Title (AR)', 'seo_title_ar')->sortable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        redirect()->route('dashboard.seo-pages.edit', $rowId);
    }

    public function actions(SeoPage $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fas fa-edit"></i>')
                ->class('btn btn-primary btn-sm rounded')
                ->dispatch('edit', ['rowId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
