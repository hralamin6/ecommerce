<?php

    namespace App\DataTables;

    use App\Models\Transaction;
    use Yajra\DataTables\Html\Column;
    use Yajra\DataTables\Html\Builder;
    use Yajra\DataTables\DataTableAbstract;
    use Yajra\DataTables\Services\DataTable;

    class TransactionsDataTable extends DataTable
    {
        /**
         * Build DataTable class.
         *
         * @param mixed $query Results from query() method.
         *
         * @return DataTableAbstract
         */
        public function dataTable($query): DataTableAbstract
        {
            return datatables()
                ->eloquent($query)
                ->addColumn('action', function ($item) {
                    if ($item->type == 'withdraw' && $item->status == 0) return '<a href="#" onclick="acceptWithdraw(' . $item->id . ')" class="btn btn-xs btn-primary"><i class="fas fa-check-circle"></i></a>';
                })
                ->rawColumns(['note', 'action']);
        }

        /**
         * Get query source of dataTable.
         *
         * @param Transaction $model
         *
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public function query(Transaction $model): \Illuminate\Database\Eloquent\Builder
        {
            return $model->newQuery()->with('user:id,name')->whereIn('type', ['withdraw', 'send money', 'incentive i-Balance', 'incentive e-Balance', 'rank']);
        }

        /**
         * Optional method if you want to use html builder.
         *
         * @return Builder
         */
        public function html(): Builder
        {
            return $this->builder()
                ->setTableId('transactions-table')
                ->responsive()
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->orderBy(3);

        }

        /**
         * Get columns.
         *
         * @return array
         */
        protected function getColumns(): array
        {
            return [

                Column::make('id')->responsivePriority(0),
                Column::make('user.name')->title('User')->responsivePriority(1),
                Column::make('type'),
                Column::make('amount'),
                Column::make('note')->responsivePriority(0),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];
        }

        /**
         * Get filename for export.
         *
         * @return string
         */
        protected function filename(): string
        {
            return 'Transactions_' . date('YmdHis');
        }
    }
