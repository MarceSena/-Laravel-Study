@extends('layout.principal')
@section('conteudo')
    <h1>Listagem de produtos</h1>

    @if (empty($produtos))
        <div class="alert alert-danger">
            Você não tem nenhum produto cadastrado.
        </div>
    @else
        <table class="table table-striped table-bordered table-hover">
            @foreach ($produtos as $p)
                <tr class="{{ $p->quantidade <= 1 ? 'table-danger' : '' }}">
                    <td>{{ $p->nome }}</td>
                    <td>{{ $p->valor }}</td>
                    <td>{{ $p->descricao }}</td>
                    <td>{{ $p->quantidade }}</td>
                    <td><a href="{{ route('produto', $p->id) }}">Visualizar</a></td>
                    <td><a href="{{ route('remove', $p->id) }}">Remover</a></td>
                </tr>
            @endforeach
        </table>
    @endif


    <h4>
        <span class="label label-danger pull-right">
            Um ou menos itens no estoque
        </span>
    </h4>
    @if(old('nome'))
        <div class="alert alert-success">
            <strong>Sucesso!</strong>
            O produto {{ old('nome') }} foi adicionado.
        </div>
    @endif

@stop
