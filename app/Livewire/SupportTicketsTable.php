<?php

namespace App\Livewire;

use App\Models\Supplier;
use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;

use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;


final class SupportTicketsTable extends PowerGridComponent
{

 public string $tableName = 'support-tickets-table-hrpps2-table';


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
        return SupportTicket::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('error_description', function ($value) {
                return "<div style='text-wrap: wrap'>$value->error_description</div>";
            })
            ->add('function_name', function ($value) {
                return "<div style='text-wrap: wrap'>$value->function_name</div>";
            })
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),

            Column::make('Error description', 'error_description')
                ->searchable(),

            Column::make('Function name', 'function_name')
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

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
        $this->js('alert(' . $rowId . ')');
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $supportTicket =  SupportTicket::find($rowId);
        if (!$supportTicket) {
            $this->js('toastr.error("Support Ticket not found")');
            return;
        }

        $supportTicket->forceDelete();
        $this->js('toastr.success("Support Ticket deleted successfully")');
    }

    public function actions(SupportTicket $row): array
    {
        return [
            Button::add('delete')
                ->slot('<i class="fas fa-trash"></i>')
                ->id()
                ->class('btn btn-danger btn-sm rounded')
                ->dispatch('delete', ['rowId' => $row->id]),

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
