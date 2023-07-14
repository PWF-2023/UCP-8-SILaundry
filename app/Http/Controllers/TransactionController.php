<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Service;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)
            ->orderBy('is_complete', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        $transactionsCompleted = Transaction::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->count();
        return view('transaction.index', compact('transactions', 'transactionsCompleted'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required|max:255',
            'service_id' => 'nullable',
            'berat' => 'required|numeric',
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'required|date',
        ]);

        $service = Service::find($request->service_id);

        $transaction = Transaction::create([
            'customer' => ucfirst($request->customer),
            'service_id' => $request->service_id,
            'berat' => $request->berat,
            'total_harga' => $request->berat * $service->harga,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_keluar' => $request->tgl_keluar,
            'is_complete' => false,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaction created successfully!');
    }

    public function create()
    {
        if (auth()->user()->is_admin) {
            $services = Service::all();
        } else {
            $services = Service::where('user_id', '!=', auth()->user()->id)->get();
        }
        return view('transaction.create', compact('services'));
    }

    public function edit(Transaction $transaction)
    {
        if (auth()->user()->is_admin) {
            $services = Service::all();
        } else {
            $services = Service::where('user_id', '!=', auth()->user()->id)->get();
        }

        if (auth()->user()->id == $transaction->user_id) {
            return view('transaction.edit', compact('transaction', 'services'));
        } else {
            return redirect()->route('transaction.index')->with('danger', 'You are not authorized to edit this transaction!');
        }
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'customer' => 'required|max:255',
            'service_id' => 'required',
            'berat' => 'required|numeric',
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'required|date',
        ]);

        $service = Service::find($request->service_id);

        $transaction->update([
            'customer' => ucfirst($request->customer),
            'service_id' => $request->service_id,
            'berat' => $request->berat,
            'total_harga' => $request->berat * $service->harga,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_keluar' => $request->tgl_keluar,
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaction updated successfully!');
    }

    public function complete(Transaction $transaction)
    {
        if (auth()->user()->id == $transaction->user_id) {
            $transaction->update([
                'is_complete' => true,
            ]);
            return redirect()->route('transaction.index')->with('success', 'Transaction completed successfully!');
        } else {
            return redirect()->route('transaction.index')->with('danger', 'You are not authorized to complete this transaction!');
        }
    }

    public function uncomplete(Transaction $transaction)
    {
        if (auth()->user()->id == $transaction->user_id) {
            $transaction->update([
                'is_complete' => false,
            ]);
            return redirect()->route('transaction.index')->with('success', 'Transaction uncompleted successfully!');
        } else {
            return redirect()->route('transaction.index')->with('danger', 'You are not authorized to uncomplete this transaction!');
        }
    }

    public function destroy(Transaction $transaction)
    {
        if (auth()->user()->id == $transaction->user_id) {
            $transaction->delete();
            return redirect()->route('transaction.index')->with('success', 'Transaction deleted successfully!');
        } else {
            return redirect()->route('transaction.index')->with('danger', 'You are not authorized to delete this transaction!');
        }
    }

    public function destroyCompleted()
    {
        $transactionsCompleted = Transaction::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->get();

        foreach ($transactionsCompleted as $transaction) {
            $transaction->delete();
        }

        return redirect()->route('transaction.index')->with('success', 'All completed transactions deleted successfully!');
    }
}
