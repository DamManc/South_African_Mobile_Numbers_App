<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Storage;

class Phone extends Model
{
    use HasFactory;

    protected $tables;
    protected $records_acceptable;
    protected $records_revision;
    protected $records_incorrect;
    protected $headers_csv = ['Content-Type' => 'application/vnd.ms-excel'];

    public function importToDb(){
        $records_acceptable = [];
        $records_revision = [];
        $records_incorrect = [];
        $all_paths = glob(storage_path('app/public/csv/*.csv'));
        DB::table('acceptable_phones')->truncate();
        DB::table('revision_phones')->truncate();
        DB::table('incorrect_phones')->truncate();

        foreach ($all_paths as $path){
            $data = array_map('str_getcsv', file($path));
            foreach ($data as $row){
                $record = [];
                $id = $row[0];
                $sms_phone = $row[1];
                if(preg_match('/^27[0-9]{9}$/', $sms_phone)){
                    DB::table('acceptable_phones')->insert([
                        'id' => $id,
                        'sms_phone' => $sms_phone
                    ]);
                    $record['id'] = $id;
                    $record['sms_phone'] = $sms_phone;
                    array_push($records_acceptable, $record);

                } else if(preg_match('/^27[0-9]{9}$/', preg_filter('/\D*/', '', $sms_phone))){
                    $revision = preg_filter('/\d*/', '', $sms_phone);
                    $sms_phone = preg_filter('/\D*/', '', $sms_phone);
                    DB::table('revision_phones')->insert([
                        'id' => $id,
                        'sms_phone' => $sms_phone,
                        'revision' => $revision
                    ]);
                    $record['id'] = $id;
                    $record['sms_phone'] = $sms_phone;
                    $record['revision'] = $revision;
                    array_push($records_revision, $record);

                } else if(preg_match('/^27[0-9]{9}$/', preg_filter('/\D*[0-9]*$/', '', $sms_phone))){
                    $revision = preg_filter('/^27[0-9]{0,9}/', '', $sms_phone);
                    $sms_phone = preg_filter('/\D*[0-9]*$/', '', $sms_phone);
                    DB::table('revision_phones')->insert([
                        'id' => $id,
                        'sms_phone' => $sms_phone,
                        'revision' => $revision
                    ]);
                    $record['id'] = $id;
                    $record['sms_phone'] = $sms_phone;
                    $record['revision'] = $revision;
                    array_push($records_revision, $record);

                } else if(preg_match('/^[0-9]{11}$/', $sms_phone)){
                    $error = "this phone number is not correct(not Country Code 27)";
                    DB::table('incorrect_phones')->insert([
                        'id' => $id,
                        'sms_phone' => $sms_phone,
                        'error' => $error
                    ]);
                    $record['id'] = $id;
                    $record['sms_phone'] = $sms_phone;
                    $record['error'] = $error;
                    array_push($records_incorrect, $record);
                } else {
                    $error = "this is not a phone number even deleting the non-digits";
                    DB::table('incorrect_phones')->insert([
                        'id' => $id,
                        'sms_phone' => $sms_phone,
                        'error' => $error
                    ]);
                    $record['id'] = $id;
                    $record['sms_phone'] = $sms_phone;
                    $record['error'] = $error;
                    array_push($records_incorrect, $record);
                }
            }
        }

        if(isset($records_acceptable) && isset($records_revision) && isset($records_incorrect)){
            $this->tables = [$records_acceptable, $records_revision, $records_incorrect];
            $this->records_acceptable = $records_acceptable;
            $this->records_revision = $records_revision;
            $this->records_incorrect = $records_incorrect;
            return [$records_acceptable, $records_revision, $records_incorrect];
        } else {
            return false;
        }

    }


    public function exportToNewFile(){

        foreach ($this->tables as $k => $table){
            $row_w = '';
            foreach ($table as $row){
                $row_w .= implode(',', $row).PHP_EOL;
            }
            $write = print_r($row_w, true);
            $fileName = storage_path('app/public/new/'.$k.'.csv');
            file_put_contents($fileName, $write);
        }
    }

    public function downloadAcc()
    {
        return Storage::download('public/new/0.csv','acceptable.csv',$this->headers_csv);
    }

    public function downloadRev()
    {
        return Storage::download('public/new/1.csv','revision.csv',$this->headers_csv);
    }

    public function downloadInc()
    {
        return Storage::download('public/new/2.csv','incorrect.csv',$this->headers_csv);
    }

    public function apiEndPoint(){
        $tables = new \stdClass();
        $tables->acceptable = $this->records_acceptable;
        $tables->adjust = $this->records_revision;
        $tables->incorrect = $this->records_incorrect;
        $j_tables = json_encode($tables);
        return $j_tables;
    }


}
