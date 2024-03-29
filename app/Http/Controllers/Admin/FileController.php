<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\File;
use App\Helpers\PdfHelper;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware( 'admin' );
    }
    protected function createFile ( $file , $type , $bookId ) {
        File::where( 'type_id' , $bookId ) -> whereType( $type ) -> delete();
        $filePath = $file -> getClientOriginalName();
        $fileName = pathinfo( $filePath , PATHINFO_FILENAME );
        $extension = pathinfo( $filePath , PATHINFO_EXTENSION );
        $fileDir = "/{$type}.{$extension}";
        $url = env( 'PDF_PATH_URL' ) . "/{$bookId}{$fileDir}";
        $absolute_url = env( 'APP_URL' ) . $url;
        $parentDir = env( 'PDF_PATH' ) . '/' . $bookId;
        $path = "{$parentDir}/{$fileDir}";
        $file -> move ( $parentDir ,  $fileDir );
        $size = filesize( $path );
        $input = [
            'type_id' => $bookId,
            'tmp_id' => $bookId,
            'type' => $type,
            'path' => $path,
            'size' => $size,
            'url' => $url,
            'absolute_url' => $absolute_url,
        ];
        $fileRecord = File::create( $input );
        PdfHelper::extractImages( $path , $type );
        return $fileRecord;
    }
    public function uploadPdf( Request $req ) {
        $file = $req -> file;
        $extensions = [ 'pdf' , 'png' , 'jpg' , 'jpeg' , 'webp' , 'webm' , 'bmp' , 'gif' ];
        $extension = pathinfo( $file -> getClientOriginalName() , PATHINFO_EXTENSION );
        if ( ! in_array( strtolower( $extension ) , $extensions ) ) {
            return response() -> json([ 'status' => 'error' , 'message' => __( 'Format not allowed. Allowed formats are ' ) . implode( ',' , $extensions ) ] , 413 );
        }
        $res = $this -> createFile( $file , $req -> type , $req -> bookId );
        return response() -> json([ 'status' => 'success' , 'response' => $res , 'message' => __( 'Success' ) ] , 200 );
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
