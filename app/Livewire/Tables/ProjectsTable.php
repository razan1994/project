<?php

namespace App\Livewire\Tables;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;

final class ProjectsTable extends PowerGridComponent
{
    public string $tableName = 'projects-table-hrpps2-table';

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
        return Project::query()->withCount('media');
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
            Column::make('Order', 'order'),

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
        ];
    }

    #[\Livewire\Attributes\On('moveUp')]
    public function moveUp($rowId): void
    {
        $project = Project::find($rowId);
        if ($project->order <= 1) {
            return;
        }

        $projectAbove = Project::where('order', $project->order - 1)
            ->first();

        if ($projectAbove) {
            DB::transaction(function () use ($project, $projectAbove) {
                $originalOrder = $project->order;
                $targetOrder = $projectAbove->order;

                $project->order = 0;
                $project->save();

                $projectAbove->order = $originalOrder;
                $projectAbove->save();

                $project->order = $targetOrder;
                $project->save();
            });
        }

        $this->js('toastr.success("Project moved up successfully")');
    }

    #[\Livewire\Attributes\On('moveDown')]
    public function moveDown($rowId): void
    {
        $project = Project::find($rowId);
        $maxOrder = Project::max('order');

        if ($project->order >= $maxOrder) {
            return;
        }

        $projectBelow = Project::where('order', $project->order + 1)
            ->first();

        if ($projectBelow) {
            DB::transaction(function () use ($project, $projectBelow) {
                $originalOrder = $project->order;
                $targetOrder = $projectBelow->order;

                $project->order = 0;
                $project->save();

                $projectBelow->order = $originalOrder;
                $projectBelow->save();

                $project->order = $targetOrder;
                $project->save();
            });
        }

        $this->js('toastr.success("Project moved down successfully")');
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        redirect()->route('dashboard.projects.edit', $rowId);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $project = Project::find($rowId);
        if (!$project) {
            return;
        }
        $project->update([
            'status' => 0,
        ]);

        if (file_exists($project->image) && $project->image != null) {
            unlink($project->image);
        }

        $project->media()->delete();
        $project->delete();
        Storage::disk('public')->delete('projects/' . $project->id);
        $this->js('toastr.success("Project deleted successfully")');
    }

    #[\Livewire\Attributes\On('toggleStatus')]
    public function toggleStatus($rowId): void
    {
        $project = Project::find($rowId);
        $project->status = !$project->status;
        $project->save();
        $this->js('toastr.success("status changed successfully")');
    }

    #[\Livewire\Attributes\On('restore')]
    public function restore($rowId): void
    {
        $project = Project::withTrashed()->find($rowId);
        $project->restore();
        $this->js('toastr.success("Project restored successfully")');
    }

    public function actions(Project $row): array
    {
        $maxOrder = Project::max('order');

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

            Button::add('gallery')
                ->slot('<i class="fas fa-images"></i>')
                ->class('btn btn-secondary btn-sm rounded')
                ->route('dashboard.projects.gallery', ['id' => $row->id]),

            Button::add('delete')
                ->slot('<i class="fas fa-trash"></i>')
                ->class('btn btn-danger btn-sm rounded')
                ->confirm('Are you sure you want to delete this project?')
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

            Rule::button('gallery')
                ->when(fn($row) => $row->trashed())
                ->hide(),

            Rule::button('restore')
                ->when(fn($row) => !$row->trashed())
                ->hide(),
        ];
    }
}
