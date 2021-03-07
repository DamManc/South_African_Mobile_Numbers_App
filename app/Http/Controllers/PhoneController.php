<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\View\Components\Table;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;



class PhoneController extends Controller
{
    protected $v_data_page;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = '';
        $paths = $request->segments();
        $this->v_data_page = null;
        if (empty($paths) || $paths[0] === 'home') {
            $page .= 'home';
        } else if ($paths[0] === 'test') {
            $page .= 'test';
        } else if ($paths[0] === 'result') {
            $page .= 'result';
            $model = new Phone;
            $this->v_data_page = $model->importToDb();
            new Table($this->v_data_page);
        } else if ($paths[0] === 'downloadacc') {
            $model = new Phone;
            $model->importToDb();
            $model->exportToNewFile();
            return $model->downloadAcc();
        } else if ($paths[0] === 'downloadrev') {
            $model = new Phone;
            $model->importToDb();
            $model->exportToNewFile();
            return $model->downloadRev();
        } else if ($paths[0] === 'downloadinc') {
            $model = new Phone;
            $model->importToDb();
            $model->exportToNewFile();
            return $model->downloadInc();
        } else if ($paths[0] === 'apiendpoint') {
            $model = new Phone;
            $model->importToDb();
            $model->exportToNewFile();
            return $model->apiEndPoint();
        }
        return view('pages/' . $page, ['v_data_page' => $this->v_data_page]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,text',
        ]);

        if ($validator->fails()) {
            return response()
                ->view('home', 500);
        }
        $file = file($request->file->getRealPath());
        $first_lines = 2;                               //------ 2 is changeable based on need
        $data = array_slice($file, $first_lines);
        $files = array_chunk($data, 200);               //------- 200 is changeable for large files
        foreach ($files as $k => $file) {
            $fileName = storage_path('app/public/csv/' . $k . '.csv');
            file_put_contents($fileName, $file);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        $model = new Phone;
        $model->exportToNewFile();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        $files_old = Storage::files('public/csv');
        $files_new = Storage::files('public/new');
        Storage::delete($files_old);
        Storage::delete($files_new);
        return view('pages/home');
    }
}
