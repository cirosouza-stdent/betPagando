<?php

namespace App\Http\Controllers;

use App\Models\BetHouse;
use Illuminate\Http\Request;

class BetHouseController extends Controller
{
    public function index(Request $request)
    {
        $bets = BetHouse::query()
            ->orderByDesc('created_at')
            ->get();

        return view('minha-bet.index', [
            'bets' => $bets,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['is_active'] = $request->boolean('is_active');

        BetHouse::create($data);

        return redirect()
            ->route('minha-bet.index')
            ->with('status', 'Casa de aposta cadastrada com sucesso.');
    }

    public function update(Request $request, BetHouse $betHouse)
    {
        $data = $this->validatedData($request);
        $data['is_active'] = $request->boolean('is_active');

        $betHouse->update($data);

        return redirect()
            ->route('minha-bet.index')
            ->with('status', 'Cadastro atualizado com sucesso.');
    }

    public function destroy(BetHouse $betHouse)
    {
        $betHouse->delete();

        return redirect()
            ->route('minha-bet.index')
            ->with('status', 'Cadastro removido com sucesso.');
    }

    public function search(Request $request)
    {
        $term = trim((string) $request->query('term', ''));

        if ($term === '') {
            return response()->json([]);
        }

        $results = BetHouse::query()
            ->where('name', 'like', "%{$term}%")
            ->orderBy('name')
            ->limit(8)
            ->pluck('name');

        return response()->json($results);
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url', 'max:255'],
            'current_balance' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'in:BRL,USD,EUR,BTC'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'link.url' => 'O link informado precisa ser uma URL válida.',
        ]);
    }
}
