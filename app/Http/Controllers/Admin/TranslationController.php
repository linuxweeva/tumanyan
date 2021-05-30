<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Translation;


class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $translations = Translation::paginate( 10000 ); // maybe paginate
        $data = compact( 'translations' );
        return view( 'admin.translations' , $data );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $translations = $req -> input( 'translations' );
        if ( ! $translations || ! count( $translations ) ) {
            return redirect() -> back() -> withErrors([
                'Something\'s wrong'
            ]);
        }
        foreach ( $translations as $id => $vals ) {
            $key = $vals[ 'key' ];
            if ( strlen( $key ) < 1 ) {
                if (
                    strlen( $vals[ 'am' ] ) < 1 &&
                    strlen( $vals[ 'ru' ] ) < 1 &&
                    strlen( $vals[ 'en' ] ) < 1
                ) {
                    continue;
                }
                $key = "key" . rand( 200 , 5000 );
            }
            unset( $vals[ 'key' ] );
            $data = [
                'id' => $id,
                // 'key' => $key
            ];
            $row = Translation::where( $data ) -> first();
            if ( null === $row ) { // is new
                $checkIfKeyExists = Translation::whereKey( $key ) -> count();
                if ( $checkIfKeyExists ) {
                    $row = $checkIfKeyExists;
                } else {
                    $row = new Translation;
                    $row -> key = $key;
                }
            }
            foreach ( $vals as $valKey => $val ) {
                if ( strlen( $val ) < 2 ) {
                    $vals[ $valKey ] = $key;
                }
            }
            $row -> am = trim( $vals[ 'am' ] );
            $row -> ru = trim( $vals[ 'ru' ] );
            $row -> en = trim( $vals[ 'en' ] );
            $row -> key = trim( $row -> key );
            try {
                $row -> save();
            } catch ( \Exception $e ) {}
        }
        return redirect() -> back() -> withStatus(
            'Success'
        );
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
