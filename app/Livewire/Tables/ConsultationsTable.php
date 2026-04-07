<?php

namespace App\Livewire\Tables;

use App\Models\ConsultationRequest;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;

use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ConsultationsTable extends PowerGridComponent
{
    public string $tableName = 'consultations-table-hrpps2-table';

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
        return ConsultationRequest::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('client_name')
            ->add('building_type')
            ->add('contact_number');
    }


    public function columns(): array
    {
        return [
            Column::make('Name', 'client_name')
                ->sortable()
                ->searchable(),

            Column::make('Building Type', 'building_type')
                ->sortable()
                ->searchable(),

            Column::make('Contact Number', 'contact_number')
                ->sortable()
                ->searchable(),

            Column::action('Action'),
        ];
    }


    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId): void
    {
        $consultationRequest = ConsultationRequest::find($rowId);
        if (!$consultationRequest) {
            $this->js('toastr.error("Request not found")');
            return;
        }

        redirect()->route('dashboard.contactUs.consultation-request-show', $consultationRequest->id);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $consultationRequest = ConsultationRequest::find($rowId);
        if (!$consultationRequest) {
            return;
        }

        $consultationRequest->delete();
        $this->js('toastr.success("Request deleted successfully")');
    }


    public function actions(ConsultationRequest $row): array
    {
        return [

            Button::add('show')
                ->slot('<i class="fas fa-eye"></i>')
                ->class('btn btn-success btn-sm rounded')
                ->dispatch('show', ['rowId' => $row->id]),


            Button::add('delete')
                ->slot('<i class="fas fa-trash"></i>')
                ->class('btn btn-danger btn-sm rounded')
                ->confirm('Are you sure you want to delete this request?')
                ->dispatch('delete', ['rowId' => $row->id]),

        ];
    }


    /*     public function actionRules($row): array
    {
        return [
            Rule::button('edit')
                ->when(fn($row) => $row->trashed())
                ->hide(),

            Rule::button('delete')
                ->when(fn($row) => $row->trashed())
                ->hide(),

        ];
    } */
}
