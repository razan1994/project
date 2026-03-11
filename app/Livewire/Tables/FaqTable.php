<?php

namespace App\Livewire\Tables;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;

final class FaqTable extends PowerGridComponent
{
   public string $tableName = 'faq-table-hrpps2-table';

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
        return Faq::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('question_ar')
            ->add('question_en')
            ->add('answer_ar')
            ->add('answer_en')
            ->add('status', function ($value) {
                if ($value->status == 1) {
                    return '<span class="badge badge-success w-100">Active</span>';
                }
                return '<span class="badge badge-danger w-100">Inactive</span>';
            })
            ->add('order')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Question ar', 'question_ar')
                ->sortable()
                ->searchable(),

            Column::make('Question en', 'question_en')
                ->sortable()
                ->searchable(),

            Column::make('Answer ar', 'answer_ar')
                ->sortable()
                ->searchable(),

            Column::make('Answer en', 'answer_en')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Order', 'order')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::boolean('status')
                ->label('Active', 'Inactive'),
            Filter::datepicker('created_at', 'created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        redirect()->route('dashboard.faq.edit', $rowId);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $faq = Faq::find($rowId);
        if (!$faq) {
            return;
        }
        $faq->update([
            'status' => 0,
        ]);

        $faq->delete();
        $this->js('toastr.success("Faq deleted successfully")');
    }

    #[\Livewire\Attributes\On('toggleStatus')]
    public function toggleStatus($rowId): void
    {
        $faq = Faq::find($rowId);
        $faq->status = !$faq->status;
        $faq->save();
        $this->js('toastr.success("status changed successfully")');
    }

    #[\Livewire\Attributes\On('restore')]
    public function restore($rowId): void
    {
        $faq = Faq::withTrashed()->find($rowId);
        $faq->restore();
        $this->js('toastr.success("Faq restored successfully")');
    }

    public function actions(Faq $row): array
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

            Button::add('delete')
                ->slot('<i class="fas fa-trash"></i>')
                ->class('btn btn-danger btn-sm rounded')
                ->confirm('Are you sure you want to delete this faq?')
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

            Rule::button('restore')
                ->when(fn($row) => !$row->trashed())
                ->hide(),
        ];
    }
}
