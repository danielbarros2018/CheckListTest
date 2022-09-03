<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\newCake;
use App\Models\Cake;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CakeController extends Controller
{
    private Cake $cake;

    public function __construct(
        Cake $cake
    ) {
        $this->cake = $cake;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return response()->json($this->cake->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $interest_list = $request->get('interest_list');
            unset($data['interest_list']);

            $cake = $this->cake->updateOrCreate($data);

            foreach ($interest_list as $key => $item) {
                Email::insert([
                    'cake_id' => $cake['id'],
                    'email' => $item
                ]);

                if ($key < $cake->quantidade) {
                    $dataCake = [
                        'nome' => $cake->nome,
                        'peso' => $cake->peso,
                        'valor' => $cake->valor,
                    ];

                    newCake::dispatch($item, $dataCake);
                }
            }

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return response()->json(["message" => "Bolo cadastrado e emails enviados."], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cake = $this->cake->find($id);
        if ($cake) {
            return response()->json($cake);
        }
        return response()->json(["message" => "Id not found."], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $cake = $this->cake->find($id);
        if ($cake) {
            $cake->update($data);
            return response()->json($cake);
        }
        return response()->json(["message" => "Id not found."], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($cake = $this->cake->find($id)) {
            $cake->delete();
            return response()->json(["message" => "deleted"]);
        }
        return response()->json(["message" => "Not found."], 404);
    }
}
