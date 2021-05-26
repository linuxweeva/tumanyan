namespace App\Helpers;


class PdfHelper {
	public static function getImages() {
		$cmd = "cd /var/www/tumanyan/public/pdf/2279029329800 && pdfimages -j /var/www/tumanyan/public/pdf/2279029329800/full_88.pdf image_full_88.pdf -png";
	}
}