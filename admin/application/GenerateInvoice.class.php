<?php
require_once ('Mailer.class.php');
require_once ('DBHelper.class.php');
require_once ('Invoice.class.php');
class GenerateInvoice {

	static function generateConsoleInvoice($relativePathOfgenerator, $data, $relativePathToInvoice) {
		$tempPDF = tempnam('/tmp', 'generated-invoice');
		//$url = 'http://flexihire.co.in/invoice/invoice-console.php?';
		$url = 'http://localhost/skillchamps/flexihire/invoice/invoice-console.php?';
		$url = $url . "data=" . urlencode(json_encode($data));
		//echo $url;
		$output = shell_exec('"C:/Program Files/wkhtmltopdf/bin/wkhtmltopdf.exe" ' . $url . ' ' . $tempPDF);
		//$output = exec( $relativePathOfgenerator."wkhtmltopdf  $url  $tempPDF" );
		$page = file_get_contents($tempPDF);
		$fileName = str_replace("/", "_", $data[0]["consol_invoice_number"]);
		$file = $relativePathToInvoice . $fileName . '.pdf';
		file_put_contents($file, $page);
		unlink($tempPDF);
	}

	static function generateConsoleInvoiceVolume($relativePathOfgenerator, $data, $relativePathToInvoice) {
		$tempPDF = tempnam('/tmp', 'generated-invoice');
		//$url = 'http://flexihire.co.in/invoice/invoice-template.php?';
		$url = 'http://localhost/skillchamps/flexihire/invoice/invoice-console-volume.php?';
		$url = $url . "data=" . urlencode(json_encode($data));
		//echo $url;
		$output = shell_exec('"C:/Program Files/wkhtmltopdf/bin/wkhtmltopdf.exe" ' . $url . ' ' . $tempPDF);
		//$output = exec( $relativePathOfgenerator."wkhtmltopdf  $url  $tempPDF" );
		$page = file_get_contents($tempPDF);
		$fileName = str_replace("/", "_", $data[0]["consol_invoice_number"]);
		$file = $relativePathToInvoice . $fileName . '.pdf';
		file_put_contents($file, $page);
		unlink($tempPDF);
	}

	static function generateCmcorpsInvoice($relativePathOfgenerator, $data, $relativePathToInvoice) {
		$tempPDF = tempnam('/tmp', 'generated-invoice');
		//$url = 'http://flexihire.co.in/invoice/refund-voucher.php?';
		$url = 'http://localhost/skillchamps/flexihire/invoice/invoice-template.php?';
		$url = $url . "data=" . urlencode(json_encode($data));
		//echo $url;
		$output = shell_exec('"C:/Program Files/wkhtmltopdf/bin/wkhtmltopdf.exe" ' . $url . ' ' . $tempPDF);
		//$output = exec( $relativePathOfgenerator."wkhtmltopdf  $url  $tempPDF" );
		$page = file_get_contents($tempPDF);
		$fileName = str_replace("/", "_", $data[0]["consol_invoice_number"]);
		$file = $relativePathToInvoice . $fileName . '.pdf';
		file_put_contents($file, $page);
		unlink($tempPDF);
	}

	static function generateRefundVoucher($relativePathOfgenerator, $data) {
		$tempPDF = tempnam('/tmp', 'generated-invoice');
		//$url = 'http://flexihire.co.in/invoice/refund-voucher.php?';
		$url = 'http://localhost/skillchamps/flexihire/invoice/refund-voucher.php?';
		$url = $url . "data=" . urlencode(json_encode($data));
		//echo $url;
		$output = shell_exec('"C:/Program Files/wkhtmltopdf/bin/wkhtmltopdf.exe" ' . $url . ' ' . $tempPDF);
		//$output = exec( $relativePathOfgenerator."wkhtmltopdf  $url  $tempPDF" );
		$page = file_get_contents($tempPDF);
		$file = '../../invoice/generated/' . $data[0]["refund_number"] . '.pdf';
		file_put_contents($file, $page);
		unlink($tempPDF);
	}

	static function emailInvoice($to, $user, $orderNumber, $attachement) {
		$mailer1 = new Mailer;
		$subject = "FLEXIHIRE-Manpower Charge Invoice";
		$message = "Hi " . $user . ", 
                <br>Greetings from FLEXIHIRE.Your order with order number:" . $orderNumber . " has been placed successfully please find the invoice of the same attached with this email.";

		$emailfrom = "admin@flexihire.co.in";
		$fromname = "FLEXIHIRE";
		$to = $to . ",admin@flexihire.co.in";
		$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
		$mailer1 -> sendMailWithAttachment($to, $emailfrom, $subject, $message, "", "", $attachement);
	}

	static function emailInvoices($to, $user, $orderNumber, $dbHelper, $mysqli, $relativePath) {
		$data = array();
		$attachment = array();
		$data = $dbHelper -> getDataFromQuery($mysqli, "Select DISTINCT consol_invoice_number from invoice where order_number='" . $orderNumber . "'");
		for ($i = 0; $i < count($data); $i++) {
			$fileName = str_replace("/", "_", $data[$i]["consol_invoice_number"]);
			$file = $relativePath . $fileName . '.pdf';
			array_push($attachment, $file);
		}
		$mailer1 = new Mailer;
		$subject = "FLEXIHIRE-Invoice";
		$message = "Hi " . $user . ", 
                <br>Greetings from FLEXIHIRE.Your order with order number:" . $orderNumber . " has been placed successfully please find the invoice of the same attached with this email.";

		$emailfrom = "admin@flexihire.co.in";
		$fromname = "FLEXIHIRE";
		$to = $to . ",admin@flexihire.co.in";
		$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
		$mailer1 -> sendMailWithAttachment($to, $emailfrom, $subject, $message, "", "", $attachment);
	}

	static function emailServiceChargeInvoice($to, $user, $orderNumber, $attachement) {
		$mailer1 = new Mailer;
		$subject = "FLEXIHIRE-Service Charge Invoice";
		$message = "Hi " . $user . ", 
                <br>Greetings from FLEXIHIRE.Your order with order number:" . $orderNumber . " has been placed successfully please find the invoice of the same attached with this email.";

		$emailfrom = "admin@flexihire.co.in";
		$fromname = "FLEXIHIRE";
		$to = $to . ",admin@flexihire.co.in";
		$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
		$mailer1 -> sendMailWithAttachment($to, $emailfrom, $subject, $message, "", "", $attachement);
	}

	static function emailRefund($to, $user, $orderNumber, $attachement) {
		$mailer1 = new Mailer;
		$subject = "FLEXIHIRE-Refund Receipt";
		$message = "Hi " . $user . ", 
                <br>Greetings from FLEXIHIRE.Your refund with order number:" . $orderNumber . " has been processed successfully please find the refund receipt of the same attached with this email.";

		$emailfrom = "admin@flexihire.co.in";
		$fromname = "FLEXIHIRE";
		$to = $to . ",admin@flexihire.co.in";
		$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
		$mailer1 -> sendMailWithAttachment($to, $emailfrom, $subject, $message, "", "", $attachement);
	}

	static function downloadInvoice($dbHelper, $mysqli, $relativePath, $orderNumber) {
		$data = $dbHelper -> getDataFromQuery($mysqli, "Select DISTINCT consol_invoice_number from invoice where order_number='" . $orderNumber . "'");
		if (count($data) > 0) {
			GenerateInvoice::downlaodFile($data, $relativePath);
		} else {
			GenerateInvoice::generateAndDownloadInvoiceVolume($dbHelper, $mysqli, $orderNumber);
		}

	}

	static function generateAndDownloadInvoiceVolume($dbHelper, $mysqli, $relativePath, $orderNumber) {
		$dataOrder = $dbHelper -> getDataFromQuery($mysqli, "Select DISTINCT consol_invoice_number from invoice where order_number='" . $orderNumber . "'");
		if (count($dataOrder) > 0) {
			GenerateInvoice::downlaodFile($dataOrder, $relativePath);
		} else {
			$data = $dbHelper -> getData($mysqli, "sp_getDataForInvoiceVolume", array($orderNumber));
			$serviceCharge = 0;
			if (count($data) > 0) {
				$consolInvoiceNumber = Invoice::generateConsoleInvoiceNumber($dbHelper, $mysqli);
				for ($i = 0; $i < count($data); $i++) {
					$totalamount = $data[$i]["total_amount"];
					$invoiceNumber = Invoice::generateInvoiceNumber($dbHelper, $mysqli);
					$tempInvoiceAmount = $data[$i]["total"];
					$tempCgst = $tempInvoiceAmount * 9 / 100;
					$tempSgst = $tempInvoiceAmount * 9 / 100;
					$tempTotal = $tempInvoiceAmount + $tempCgst + $tempSgst;
					$serviceCharge = $serviceCharge + ($totalamount - $tempInvoiceAmount);
					$parms = array($invoiceNumber, $orderNumber, $consolInvoiceNumber, $data[$i]["state_code"], $data[$i]["state_name"], $data[$i]["customer_name"], $data[$i]["billing_address"], $data[$i]["gstin"], $data[$i]["provider_name"], $data[$i]["description"], $data[$i]["hsn"], $data[$i]["state_code"], $data[$i]["state_name"], 0, 0, $tempInvoiceAmount, $tempCgst, $tempSgst, $tempIgst, $tempTotal);
					Invoice::insertInvoice($dbHelper, $mysqli, $parms);
				}
				GenerateInvoice::generateConsoleInvoiceVolume("../../../wkhtmltox/bin/", $dbHelper -> getData($mysqli, "sp_getInvoiceByConsoleInvoiceNumber", array($consolInvoiceNumber)), $relativePath);
				$consoleInvoiceNumberCis = Invoice::generateConsoleInvoiceNumber($dbHelper, $mysqli);
				$tempInvoiceAmount = $serviceCharge;
				$tempCgst = 0;
				$tempSgst = 0;
				$tempIgst = 0;
				$tempTotal = 0;
				if ($data[0]["state_code"] == "07") {
					$tempCgst = $tempInvoiceAmount * 9 / 100;
					$tempSgst = $tempInvoiceAmount * 9 / 100;
					$tempTotal = $tempInvoiceAmount + $tempCgst + $tempSgst;
				} else {
					$tempIgst = $tempInvoiceAmount * 18 / 100;
					$tempTotal = $tempInvoiceAmount + $tempIgst;
				}

				Invoice::insertInvoice($dbHelper, $mysqli, array("", $orderNumber, $consoleInvoiceNumberCis, $data[0]["state_code"], $data[0]["state_name"], $data[0]["customer_name"], $data[0]["billing_address"], $data[0]["gstin"], "CMCORPS INTEGRATED SERVICES PRIVATE LIMITED", "Service charge for using Skillchamps", "9997", "07", "Delhi", "", "", $tempInvoiceAmount, $tempCgst, $tempSgst, $tempIgst, $tempTotal));
				GenerateInvoice::generateCmcorpsInvoice("../../../wkhtmltox/bin/", $dbHelper -> getData($mysqli, "sp_getInvoiceByConsoleInvoiceNumber", array($consoleInvoiceNumberCis)), $relativePath);
			}
			$dataOrder = $dbHelper -> getDataFromQuery($mysqli, "Select DISTINCT consol_invoice_number from invoice where order_number='" . $orderNumber . "'");
			if (count($dataOrder) > 0) {
				GenerateInvoice::downlaodFile($dataOrder, $relativePath);
			}
		}
	}

	static function downlaodFile($data, $relativePath) {
		$archive_file_name = 'order.zip';
		$zip = new ZipArchive();
		if ($zip -> open($archive_file_name, ZIPARCHIVE::CREATE) !== TRUE) {
			exit("cannot open <$archive_file_name>\n");
		}
		for ($i = 0; $i < count($data); $i++) {
			$fileName = str_replace("/", "_", $data[$i]["consol_invoice_number"]);
			$file = $relativePath . $fileName . '.pdf';
			$zip -> addFile($file);
		}
		$zip -> close();
		header("Content-type: application/zip");
		header("Content-Disposition: attachment; filename=$archive_file_name");
		header("Pragma: no-cache");
		header("Expires: 0");
		readfile("$archive_file_name");
		unlink($archive_file_name);
	}

}
?>