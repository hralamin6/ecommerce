<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable ($query)
    {
        return datatables ()
            ->eloquent ($query)
            ->filterColumn ('user_type', function($query, $keyword){
                $query->where('user_type', 'like', "%$keyword%");
            })
            ->addColumn('#', 'app.users.checkbox')
            ->addColumn ('avatar', 'app.users.avatar')
            ->addColumn ('action', 'app.users.action')
            ->rawColumns (['#', 'avatar', 'action' ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query (User $model)
    {
        return $model->newQuery ();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html ()
    {
        return $this->builder ()
            ->setTableId ('users-table')
            ->addCheckbox ()
            ->columns ($this->getColumns ())
            ->minifiedAjax ()
            ->orderBy (0)
            ->buttons (
                Button::make ('create'),
                Button::make ('export'),
                Button::make ('print'),
                Button::make ('reset'),
                Button::make ('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns (): array
    {
        return [
            Column::make ('#'),
            Column::make ('avatar')->searchable(),
            Column::make ('name'),
            Column::make ('username'),
            Column::make ('rank'),
            Column::make ('email'),
            Column::make ('phone'),
            Column::make ('user_type')->title ('Type'),
            Column::make ('point')->title ('E-Balance'),
            Column::make ('balance')->title ('I-Balance'),
            Column::computed ('action')
                ->exportable (false)
                ->printable (false)
                ->width (60)
                ->addClass ('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename (): string
    {
        return 'Users_' . date ('YmdHis');
    }
}
