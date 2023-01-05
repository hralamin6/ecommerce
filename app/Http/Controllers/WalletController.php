<?php

    namespace App\Http\Controllers;

    use App\Models\Transaction;
    use Illuminate\Http\Request;
    use Illuminate\Http\JsonResponse;
    use App\DataTables\TransactionsDataTable;

    class WalletController extends Controller
    {
        public function index(TransactionsDataTable $dataTable)
        {
            return $dataTable->render('app.wallet.index');
        }

        public function confirm_withdraw(Request $request): JsonResponse
        {
            Transaction::query()->find($request->id)->update(['status' => 1]);
            return response()->json(['message' => 'Withdraw confirmed!']);
        }


    }
