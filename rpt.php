<?php
session_start();        
// Establishing a connection to the database
include('database.php');
$loggedInUserStid = $_SESSION['stid'];
$start_datetime = $_POST["start_datetime"];
$end_datetime = $_POST["end_datetime"];
$username_or_email = $_SESSION['username_or_email'];

require_once('tcpdf/tcpdf.php');

// Create a PDO database connection
$dsn = 'mysql:host=localhost;dbname=atcdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

// Define the MYPDF class extending TCPDF
class MYPDF extends TCPDF {
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Add system date and username_or_email
        $system_date = date('Y-m-d'); // Get current system date
        global $username_or_email; // Get username_or_email from session
        $this->Cell(0, 10, 'System Date: ' . $system_date . ' | Watch Manager: ' . $username_or_email, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Your TCPDF code continues here...

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($username_or_email);
$pdf->SetTitle('Serviceability Report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('Serviceability Report');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' ', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 9);

// add a page
$pdf->AddPage();

// Initialize left column content

// Assuming you have established a database connection
// and fetched data for 10 tables from your database

// Example queries for left column
$left_table_queries = array(
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 1 AND machine_type = 'vhf_communication' AND loid='CACC'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 1 AND machine_type = 'scanners' AND loid='CACC'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 1 AND machine_type = 'links' AND loid='CACC'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 2 AND machine_type = 'None' AND loid='CACC'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 2 AND machine_type = 'rwy04' AND loid='CACC'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 2 AND machine_type = 'rwy22' AND loid='CACC'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 3 AND machine_type = 'equipments' AND loid='CACC'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 3 AND machine_type = 'surveillance' AND loid='CACC'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 3 AND machine_type = 'surveillance supports' AND loid='CACC'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 4 AND machine_type = 'item' AND loid='CACC'",
  
    // Add queries for other tables here...
);
    
$left_column .= '<h1 style="color:blue;">CACC</h1>';
// Loop through each query to generate tables for left column
$count = 0;
$categories = array('Communication', 'Navigation', 'Surveillance', 'IT');
foreach ($left_table_queries as $query) {
    // Execute the query and fetch results
    $stmt = $pdo->query($query);
    $table_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Extract machine_type from the query
    preg_match("/machine_type = '([^']+)'/", $query, $matches);
    $machine_type = isset($matches[1]) ? $matches[1] : '';

    // Generate HTML table from query results
    $table_html = '<table>';
    
    // Add table header row with machine_type as the header
    if ($count % 3 == 0) {
        $header_index = $count / 3;
        $left_column .= '<h1>' . $categories[$header_index] . '</h1>';
    }
    
    $table_html .= '<tr><th colspan="2" style="font-size: 20px; color: #FF0000;">' . $machine_type . '</th></tr>';
    $table_html .= '<tr>';
    $table_html .= '<th style="width:70%;"><b>Equipment</b></th>'; // Replace "Column 1" with your desired column heading
    $table_html .= '<th><b>Serviceability</b></th>'; // Replace "Column 2" with your desired column heading
    // Add more <th> elements for additional columns
    $table_html .= '</tr>';
    
    foreach ($table_data as $row) {
        $table_html .= '<tr>';
        // Display specific columns from the query results
        $table_html .= '<td>' . $row['equipment'] . '</td>'; // Replace "column_name_1" with the actual column name
        $table_html .= '<td>' . $row['serviceability'] . '</td>'; // Replace "column_name_2" with the actual column name
        // Add more <td> elements for additional columns
        $table_html .= '</tr>';
    }
    $table_html .= '</table>';

    // Append the generated table HTML to the left column content
    $left_column .= $table_html;
    $count++;
}





// Example queries for right column
$right_table_queries = array(
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 1 AND machine_type = 'vhf_communication' AND loid='Control Tower'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 1 AND machine_type = 'scanners' AND loid='Control Tower'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 1 AND machine_type = 'links' AND loid='Control Tower'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 2 AND machine_type = 'None' AND loid='Control Tower'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 2 AND machine_type = 'rwy04' AND loid='Control Tower'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 2 AND machine_type = 'rwy22' AND loid='Control Tower'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 3 AND machine_type = 'equipments' AND loid='Control Tower'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 3 AND machine_type = 'surveillance' AND loid='Control Tower'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 3 AND machine_type = 'surveillance supports' AND loid='Control Tower'",
    "SELECT * FROM serviceability_log WHERE datetime >= '$start_datetime' AND datetime <= '$end_datetime' AND stid = $loggedInUserStid AND cid = 4 AND machine_type = 'item' AND loid='Control Tower'", 
   
    // Add queries for other tables here...
);

$right_column .= '<h1 style="color:blue;">Control Tower</h1>';
// Loop through each query to generate tables for right column
$count = 0;
$categories = array('Communication', 'Navigation', 'Surveillance', 'IT');
foreach ($right_table_queries as $query) {
    // Execute the query and fetch results
    $stmt = $pdo->query($query);
    $table_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Extract machine_type from the query
    preg_match("/machine_type = '([^']+)'/", $query, $matches);
    $machine_type = isset($matches[1]) ? $matches[1] : '';

    // Generate HTML table from query results
    $table_html = '<table>';
    
    // Add table header row with machine_type as the header
    if ($count % 3 == 0) {
        $header_index = $count / 3;
        $right_column .= '<h1>' . $categories[$header_index] . '</h1>';
    }
    
    $table_html .= '<tr><th colspan="2" style="font-size: 20px; color: #FF0000;">' . $machine_type . '</th></tr>';
    $table_html .= '<tr>';
    $table_html .= '<th style="width:70%;"><b>Equipment</b></th>'; // Replace "Column 1" with your desired column heading
    $table_html .= '<th><b>Serviceability</b></th>'; // Replace "Column 2" with your desired column heading
    // Add more <th> elements for additional columns
    $table_html .= '</tr>';
    
    foreach ($table_data as $row) {
        $table_html .= '<tr>';
        // Display specific columns from the query results
        $table_html .= '<td>' . $row['equipment'] . '</td>'; // Replace "column_name_1" with the actual column name
        $table_html .= '<td>' . $row['serviceability'] . '</td>'; // Replace "column_name_2" with the actual column name
        // Add more <td> elements for additional columns
        $table_html .= '</tr>';
    }
    $table_html .= '</table>';

    // Append the generated table HTML to the right column content
    $right_column .= $table_html;
    $count++;
}




// Now $right_column contains HTML tables generated from queries for right column

// get current vertical position
$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 200);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// write the first column
// Write a blank cell to create a gap between left and right columns
$pdf->writeHTMLCell(20, '', '', $y, '', 0, 0, 0, true, 'J', true);

// Write the first column (left)
$pdf->writeHTMLCell(90, '', '', $y, $left_column, 1, 0, 1, true, 'J', true);

// Write the second column (right)
$pdf->writeHTMLCell(90, '', '', '', $right_column, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(215, 235, 255);

// set color for text
$pdf->SetTextColor(127, 31, 0);

// write the second column

// reset pointer to the last page
$pdf->lastPage();
// Add the system date and first name at the end of the PDF

// Close and output PDF document
ob_end_clean(); // Clean (erase) the output buffer and turn off output buffering
$pdf->Output('Serviceability Report.pdf', 'D'); // Output the PDF as a download with the filename "Serviceability Report.pdf"
exit(); // Stop executing the script// ---------------------------------------------------------
//Close and output PDF document
?>
