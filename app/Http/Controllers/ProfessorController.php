<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    $professores = Professor::all();
    return view('professores.index', compact('professores'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('professores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $professor= new Professor;
            $professor->fill($request->all());
            $professor->save();
            return redirect()
                ->route('professores.index')
                ->with('successo', 'Professor salvo com sucesso!');    
        }
        catch (Exception $e) {
            return 'Houve um erro no banco de dados';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Professor $professor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         // 1. Busca o professor específica pelo ID
        $professor = \App\Models\Professor::findOrFail($id);

        // 3. Manda tudo "limpo" para a View
        return view('professores.edit', compact( 'professor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        // 1. Validação dos dados recebidos do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
        ], [
            'nome.required' => 'O nome do professor é obrigatório.',
        ]);

        // 2. Tenta atualizar o registro no banco de dados
        try {
            // Busca o registro original
            $professor = \App\Models\Professor::findOrFail($id);
            
            // Atualiza os dados usando Mass Assignment
            $professor->update($request->all());

            // Redireciona para a listagem com a mensagem de sucesso
            return redirect()
                ->route('professores.index')
                ->with('successo', 'Professor atualizado com sucesso!');

        } catch (\Exception $e) {
            // Se der algum erro de banco, volta para a tela anterior mantendo o que o usuário digitou
            return back()
                ->withInput()
                ->with('erro', 'Erro ao atualizar o professor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professor $professore)
    {
        $professore->delete();
        return redirect()
            ->route('professores.index')
            ->with('successo', 'excluido com sucesso');
    }
    }

