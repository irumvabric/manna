<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\BeneficiaryExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function index(Request $request, Beneficiary $beneficiary)
    {
        $expenses = $beneficiary->expenses()->latest()->paginate(10);
        return view('admin.beneficiaries.expenses.index', compact('beneficiary', 'expenses'));
    }

    public function store(Request $request, Beneficiary $beneficiary)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:stage,deplacement,inscription,materiel,divers',
            'description' => 'nullable|string',
            'expense_date' => 'required|date',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['beneficiary_id'] = $beneficiary->id;

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('expenses', 'public');
        }

        BeneficiaryExpense::create($data);

        return redirect()->back()->with('success', 'Expense recorded successfully and beneficiary balance updated.');
    }

    public function update(Request $request, BeneficiaryExpense $expense)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:stage,deplacement,inscription,materiel,divers',
            'description' => 'nullable|string',
            'expense_date' => 'required|date',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists
            if ($expense->attachment) {
                Storage::disk('public')->delete($expense->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('expenses', 'public');
        }

        $expense->update($data);

        return redirect()->back()->with('success', 'Expense updated successfully and beneficiary balance adjusted.');
    }

    public function destroy(BeneficiaryExpense $expense)
    {
        if ($expense->attachment) {
            Storage::disk('public')->delete($expense->attachment);
        }
        
        $expense->delete();

        return redirect()->back()->with('success', 'Expense deleted successfully and beneficiary balance restored.');
    }
}
