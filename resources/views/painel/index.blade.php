@extends('painel.templates.painel')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-8">
                <h5>Pesquise o último valor da Ação</h5>

                <div id="alert" class="alert-dismissable" data-dismiss="alert" role="alert"></div>

                <form action="{{route('quote')}}">
                    <div class="form-group">
                        <label for="" class="control-label">Ação</label>
                        <input name="symbol" type="text" class="form-control" placeholder="Ex.: AAPL" required>
                    </div>

                    <button class="btn btn-primary">Buscar</button>
                </form>
            </div>
        </div>
    </div>
@endsection