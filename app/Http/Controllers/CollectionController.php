<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use App\Models\Collection;
use App\Http\Resources\Collection as CollectionResource;
// use Dotenv\Validator as DotenvValidator;
// use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class CollectionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Collection::all();
        return $this->sendResponse(
            CollectionResource::collection($collection, 'posts fethced')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'namaKoleksi' => 'required',
            'jenisKoleksi' => 'required',
            'jumlahAwal' => 'required',
            'jumlahSIsa' => 'required',
            'jumlahKeluar' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $collection = Collection::create($input);

        return $this->sendResponse(new CollectionResource($collection), 'Post Created')
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection = Collection::find($id);
        if(is_null($collection)){
            return $this_>sendError('Post does not exist ');
        }
        return $this->sendResponse(new CollectionResource($collection), 'Post Fetched');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'namaKoleksi' =>'required',
            'jenisKoleksi' => 'required',
            'jumlahAwal' => 'required',
            'jumlahSIsa' => 'required',
            'jumlahKeluar' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $collection->namaKoleksi = $input['namaKoleksi'];
        $collection->jenisKoleksi = $input['jenisKoleksi'];
        $collection->jumlahAwal = $input['jumlahAwal'];
        $collection->jumlahSIsa = $input['jumlahSisa'];
        $collection->jumlahKeluar = $input['jumlahKeluar'];
        $collection->save();

        return $this->sendResponse(new CollectionResource($collection),'Post Updated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return $this->sendResponse([], 'Post deleted');
    }
}
