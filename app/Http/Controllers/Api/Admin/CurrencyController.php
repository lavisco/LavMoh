<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use Exception;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return Currency::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(CurrencyRequest $request)
    {
        ///$this->authorize('create', Currency::class);
        return Currency::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $currency);
        return Currency::findOrFail($id);
    }

    public function update(CurrencyRequest $request, Currency $currency)
    {
        ///$this->authorize('update', $currency);
        $currency->update($request->all());
    }

    public function destroy(Currency $currency)
    {
        ///$this->authorize('delete', $currency);
        $currency->delete();
    }

    public function getExchangerate()
    {
        $req_url = 'https://api.exchangerate.host/latest?base=LKR&symbols=USD,AUD';
        $response_json = file_get_contents($req_url);

        if(false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if($response->success === true) {
                    return $response->rates;
                }
            } catch(Exception $e) {
                var_dump($e);
            }
        }  
    }
}
