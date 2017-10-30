<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Input,File;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $urlApi = 'http://10.10.1.66:8000';

    public function index()
    {
        return view('file');
    }

    public function uploadFile(Request $request){
        $client = new Client();
        $response = $client->request('POST', $this->urlApi.'/manager/api/upload', [
            'multipart' => [
                [
                    'name'     => 'directory',
                    'contents' => $request->directory
                ],
                [
                    'name'     => 'file',
                    'contents' => fopen(realpath($request->file), 'r'),
                    'filename' => $request->file->getClientOriginalName(),
                    'description' => ''
                ]
            ]
        ]);
        return $response->getBody();
    }

    public function getFileData(Request $request){
        $client = new Client();
        $res = $client->request('POST', $this->urlApi.'/manager/api/getFile',[
            'form_params' => [
                'hashCode' => $request->hashCode
            ]
        ]);
       // echo $res->getStatusCode();
       return $res->getBody();
       
      
    }

    public function createFolder(Request $request){
        $client = new Client();
        $res = $client->request('POST', $this->urlApi.'/manager/api/create_folder',[
            'form_params' => [
                'directory' => $request->directory,
                'folder_name' => $request->folder_name
            ]
        ]);
        return $res->getBody();
    }

    public function getList(){
        $client = new Client();
        $res = $client->request('GET',  $this->urlApi.'/manager/api/getAll');
        //echo $res->getStatusCode();
        // "200"
        //echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        $data = json_decode($res->getBody()->getContents());
        return view('list', compact('data'));
    }

    public function downloadFile(Request $request, $hashCode){
        $client = new Client();
        $res = $client->request('GET', $this->urlApi.'/manager/api/download/'.$hashCode);
        $data = $res->getBody()->getContents();
        return $data;

    }

    public function rename(Request $request){
        $client = new Client();
        $res = $client->request('POST', $this->urlApi.'/manager/api/rename_file',[
            'form_params'=>[
                'hashCode' => $request->hashCode,
                'new_Filename' => $request->new_Filename
            ]
        ]);
        $data = $res->getBody()->getContents();
        return $data;
    }


}
