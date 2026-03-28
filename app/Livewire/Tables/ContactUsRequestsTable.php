<?php

namespace App\Livewire\Tables;

use App\Models\ContactUsRequest;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;

use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
final class ContactUsRequestsTable extends PowerGridComponent
{
     public string $tableName = 'contact-us-requests-table-hrpps2-table';

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
        return ContactUsRequest::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('full_name')
            ->add('email')
            ->add('phone')
            ->add('subject')
            ->add('message');
    }


    public function columns(): array
    {
        return [
            Column::make('Name', 'full_name')
                ->sortable()
                ->searchable(),

            Column::make('email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('phone', 'phone')
                ->sortable()
                ->searchable(),
            Column::make('subject', 'subject')
                ->sortable()
                ->searchable(),
            Column::make('message', 'message')
                ->sortable()
                ->searchable()
                ->bodyAttribute('style="max-width: 30px; white-space: normal; word-break: break-word;"'),


            Column::action('Action'),
        ];
    }


    public function filters(): array
    {
        return [

        ];
    }


    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $messageRequest = ContactUsRequest::find($rowId);
        if (!$messageRequest) {
            return;
        }

        $messageRequest->delete();
        $this->js('toastr.success("Request deleted successfully")');
    }


    public function actions(ContactUsRequest $row): array
    {
        return [

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
