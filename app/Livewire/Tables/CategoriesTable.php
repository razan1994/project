<?php

namespace App\Livewire\Tables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;

final class CategoriesTable extends PowerGridComponent
{
    public string $tableName = 'categories-table-hrpps2-table';

    public string $sortField = 'order';

    public string $sortDirection = 'asc';
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
        return Category::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('order')
            ->add('title_ar', function ($value) {
                return "<p>" . $value->title_ar . "</p>";
            })
            ->add('title_en', function ($value) {
                return "<p>" . $value->title_en . "</p>";
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

            Column::make('Order', 'order'),
            Column::make('Status', 'status')
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
        ];
    }

    #[\Livewire\Attributes\On('moveUp')]
    public function moveUp($rowId): void
    {
        $category = Category::find($rowId);
        if ($category->order <= 1) {
            return;
        }

        $categoryAbove = Category::where('order', $category->order - 1)
            ->first();

        if ($categoryAbove) {
            DB::transaction(function () use ($category, $categoryAbove) {
                $originalOrder = $category->order;
                $targetOrder = $categoryAbove->order;

                $category->order = 0;
                $category->save();

                $categoryAbove->order = $originalOrder;
                $categoryAbove->save();

                $category->order = $targetOrder;
                $category->save();
            });
        }

        $this->js('toastr.success("Category moved up successfully")');
    }

    #[\Livewire\Attributes\On('moveDown')]
    public function moveDown($rowId): void
    {
        $category = Category::find($rowId);
        $maxOrder = Category::max('order');

        if ($category->order >= $maxOrder) {
            return;
        }

        $categoryBelow = Category::where('order', $category->order + 1)
            ->first();

        if ($categoryBelow) {
            DB::transaction(function () use ($category, $categoryBelow) {
                $originalOrder = $category->order;
                $targetOrder = $categoryBelow->order;

                $category->order = 0;
                $category->save();

                $categoryBelow->order = $originalOrder;
                $categoryBelow->save();

                $category->order = $targetOrder;
                $category->save();
            });
        }

        $this->js('toastr.success("Category moved down successfully")');
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $category = Category::find($rowId);
        if (!$category) {
            $this->js('toastr.error("Category not found")');
            return;
        }
        redirect()->route('dashboard.categories.edit', $rowId);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $category = Category::find($rowId);
        if (!$category) {
            $this->js('toastr.error("Category not found")');
            return;
        }

        $this->js('toastr.success("Category deleted successfully")');
    }

    #[\Livewire\Attributes\On('toggleStatus')]
    public function toggleStatus($rowId): void
    {
        $category = Category::find($rowId);
        if (!$category) {
            $this->js('toastr.error("Category not found")');
            return;
        }
        $category->status = !$category->status;
        $category->save();
        $this->js('toastr.success("Status changed successfully")');
    }

    public function actions(Category $row): array
    {
        $maxOrder = Category::max('order');
        return [
            Button::add('moveUp')
                ->slot('<i class="fas fa-arrow-up"></i>')
                ->class('btn btn-secondary btn-icon btm-sm' . ($row->order <= 1 ? ' disabled' : ''))
                ->dispatch('moveUp', ['rowId' => $row->id]),
                
            Button::add('moveDown')
                ->slot('<i class="fas fa-arrow-down"></i>')
                ->class('btn btn-secondary btn-icon btm-sm' . ($row->order >= $maxOrder ? ' disabled' : ''))
                ->dispatch('moveDown', ['rowId' => $row->id]),

            Button::add('edit')
                ->slot('<i class="fas fa-edit"></i>')
                ->class('btn btn-primary btn-sm rounded')
                ->dispatch('edit', ['rowId' => $row->id]),


            Button::add('toggleStatus')
                ->slot($row->status == 1 ? '<i class="fas fa-toggle-on"></i>' : '<i class="fas fa-toggle-off"></i>')
                ->class('btn btn-info btn-sm rounded')
                ->dispatch('toggleStatus', ['rowId' => $row->id]),

            Button::add('delete')
                ->slot('<i class="fas fa-trash"></i>')
                ->class('btn btn-danger btn-sm rounded')
                ->confirm('Are you sure you want to delete this category?')
                ->dispatch('delete', ['rowId' => $row->id]),

        ];
    }


    /* public function actionRules($row): array
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

            Rule::button('gallery')
                ->when(fn($row) => $row->trashed())
                ->hide(),

            Rule::button('restore')
                ->when(fn($row) => !$row->trashed())
                ->hide(),
        ];
    } */
}
