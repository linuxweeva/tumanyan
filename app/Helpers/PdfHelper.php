<?php

namespace App\Helpers;
use App\Models\File;

class PdfHelper {
	public static function extractImages( $param , $type = 'full' ) {
		$pdfPath = $param;
		if ( intval( $param ) == $param ) { // $id
			$fileRecord = File::where( 'type_id' , $param ) -> where( 'type' , $type ) -> first();
			if ( null === $fileRecord ) return null;
			$pdfPath = $fileRecord -> path;
		}
		$xpl = explode( '/' , $pdfPath );
		$pdfFile = array_pop( $xpl );
		$pdfDir = rtrim( implode( '/' , $xpl ) , '/' );
		$saveDir = "{$pdfDir}/{$type}";
		$cmdRemove = "rm -r {$saveDir}";
		exec( $cmdRemove );
		mkdir( $saveDir );
		$pdfTitle = explode( '.pdf' , $pdfFile )[ 0 ];
		$outputFormat = env( "PAGE_FORMAT_CONVERTER" );
		$prefix = env( "PAGE_PREFIX" );
		$cmd = <<<EOD
		cd {$pdfDir}
		&& cp {$pdfPath} {$saveDir}/{$pdfTitle}.pdf
		&& cd {$saveDir}
		&& pdftoppm -{$outputFormat} {$saveDir}/{$pdfTitle}.pdf {$prefix}
		&& rm {$saveDir}/{$pdfTitle}.pdf
		&& echo success
		EOD;
		$cmd = str_replace( "\r\n" , ' ' , $cmd );
		$str = $cmd . PHP_EOL . $pdfPath;
		$response = exec( $cmd );
		return $response === "success" ? true : false;
		return true;
	}
	protected static function log ( $str ) {
		file_put_contents( env( 'LOG_PATH' ) . '/pdfHelper.log' , $str . PHP_EOL , FILE_APPEND );
	}
	// public static function getImages() {
	// 	$cmd = "cd /var/www/tumanyan/public/pdf/2279029329800 && pdfimages -j /var/www/tumanyan/public/pdf/2279029329800/full_88.pdf image_full_88.pdf -png";
	// }
}