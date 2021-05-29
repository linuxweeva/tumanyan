<?php

namespace App\Helpers;

class BackupHelper {
	public static function backup ( $public = false ) {
		$res = self::mysql( $public );
		if ( $public ) {
			// self::files();
			header( "Content-type: application/x-gzip" );
			header( 'Content-Disposition: attachment; filename=' . $res[ 1 ] );
			readfile( $res[ 0 ] );
			exit;
		}
		if ( true !== $res ) {
			exit( 'There was an error backing up db - ' . $res );
		}
		$res = self::files();
		exit( 'OK' );
	}
	protected static function mysql ( $public ) {
		$backupDir = env( 'BACKUP_DIR' );
		$dir = true;	
		if ( ! file_exists( $backupDir ) ) {
			$dir = mkdir( $backupDir , 0777, true );
		}
		if ( ! $dir ) {
			exit( 'COULDN\'T CREATE BACKUP DIR' );
		}
		$title = env( 'DB_DATABASE' ) . '_' . date( 'd' ) . '.sql.gz';
		$path = "{$backupDir}/{$title}";
		$cmd = "mysqldump --user=" . env( 'DB_USERNAME' ) . " --password=" . env( 'DB_PASSWORD' ) . " " . env( 'DB_DATABASE' ) . " | gzip > " . $path;
		$res = exec( $cmd );
		if ( $public ) {
			return [ $path , $title ];
		}
		return $res == '' ? true : $res;
	}
	protected static function files () {
		$appDir = env( 'APP_DIR' );
		$backupDir = env( 'BACKUP_DIR' );
		// $path = $backupDir . '/files_' . date( 'd' ) . '.gz';
		$path = "{$backupDir}/files.gz";
		$cmd = "tar --exclude='{$appDir}/vendor' --exclude='{$appDir}/.git' --exclude='{$appDir}/public' --exclude='{$path}' --exclude='{$appDir}/node_modules' --exclude='{$appDir}/storage' --absolute-names -cvf " . $path . " {$appDir}/ ";
		$res = exec( $cmd , $out , $oky );
		return true;
	}
}