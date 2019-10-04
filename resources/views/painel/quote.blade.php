@extends('painel.templates.painel')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-8">
                <form action="{{route('quote')}}">
                    <div class="form-group">
                        <label for="" class="control-label">Quote</label>
                        <input name="symbol" type="text" class="form-control" value="{{request('symbol')}}" required>
                    </div>

                    <button class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-8">
                <table class="table mt-4 table-latest-price">
                    <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">Latest Price</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$quote['company']}}</td>
                            <td>{{$quote['latestPrice']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-8">
                <form action="{{route('quote')}}">
                    <input type="hidden" name="symbol" value="{{request('symbol')}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Period</label>
                                <select name="range" class="form-control">
                                    <option value="1m" {{request('range') ? (request('range') == '1m' ? 'selected' : '') : ''}}>1m</option>
                                    <option value="3m" {{request('range') ? (request('range') == '3m' ? 'selected' : '') : ''}}>3m</option>
                                    <option value="6m" {{request('range') ? (request('range') == '6m' ? 'selected' : '') : ''}}>6m</option>
                                    <option value="1y" {{request('range') ? (request('range') == '1y' ? 'selected' : '') : ''}}>1y</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary">Apply</button>
                </form>
                <table class="table mt-4 table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Open</th>
                            <th scope="col">Close</th>
                            <th scope="col">High</th>
                            <th scope="col">Low</th>
                            <th scope="col">Volume</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $h)
                            <tr>
                                <td>{{$h->date}}</td>
                                <td>{{$h->open}}</td>
                                <td>{{$h->close}}</td>
                                <td>{{$h->high}}</td>
                                <td>{{$h->low}}</td>
                                <td>{{number_format($h->volume, 0)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection