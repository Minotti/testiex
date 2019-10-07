<?php

namespace App\Http\Controllers;

use App\Repositories\IEXRepository;
use Illuminate\Http\Request;

class PainelController extends Controller
{
    private $rqt, $iex;

    public function __construct(Request $request, IEXRepository $IEXRepository)
    {
        $this->rqt = $request;
        $this->iex = $IEXRepository;
    }

    public function index()
    {
        return view('painel.index');
    }

    public function quote()
    {
        $symbol = $this->rqt->symbol;
        $quote = $this->iex->quote($symbol);
        $range = $this->rqt->range ?? '1m';

        $history = $this->iex->history($symbol, $range);
        $data = $history;

        if($quote['code'] == 200)
            return view('painel.quote', compact('quote', 'history', 'data'));

        return back()->withErrors($quote['message']);
    }
}