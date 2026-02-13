<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index(Request $request)
    {
        $query = Beneficiary::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('departement', 'like', '%' . $request->search . '%')
                  ->orWhere('faculte', 'like', '%' . $request->search . '%');
        }

        $beneficiaries = $query->latest()->paginate(10);

        return view('admin.beneficiaries.index', compact('beneficiaries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'departement' => 'nullable|string|max:255',
            'faculte' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'amount_received' => 'required|numeric|min:0',
            'tuition' => 'required|numeric|min:0',
        ]);

        Beneficiary::create($request->all());

        return redirect()->back()->with('success', 'Beneficiary added successfully.');
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'departement' => 'nullable|string|max:255',
            'faculte' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'amount_received' => 'required|numeric|min:0',
            'tuition' => 'required|numeric|min:0',
        ]);

        $beneficiary->update($request->all());

        return redirect()->back()->with('success', 'Beneficiary updated successfully.');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        $beneficiary->delete();
        return redirect()->back()->with('success', 'Beneficiary deleted successfully.');
    }
}
