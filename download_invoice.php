<?php
session_start();
include('config.php');

// Retrieve order details from session
$package_id = $_SESSION['package_id'] ?? null;
$domain_name = $_SESSION['domain'] ?? null;

// Check if package_id exists in session before proceeding
if (!$package_id) {
    echo "Error: Package ID is missing.";
    exit;
}

// Fetch package details from the database
$sql = "SELECT * FROM packages WHERE id = :package_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['package_id' => $package_id]);
$package = $stmt->fetch();

if (!$package) {
    echo "Error: Package not found.";
    exit;
}

// Set the correct price for the package
$price = $package['price'];

// Generate PDF using TCPDF (or any other PDF library)
require_once('tcpdf.php'); // Make sure to include the TCPDF library

// Create PDF document
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Add content to PDF
$pdf->Cell(0, 10, 'Invoice ID: ' . uniqid('INV-', true), 0, 1, 'C');
$pdf->Cell(0, 10, 'Domain Name: ' . $_SESSION['domain'] . '.com', 0, 1);
$pdf->Cell(0, 10, 'Package: ' . $package['name'], 0, 1);
$pdf->Cell(0, 10, 'Price: $' . number_format($price, 2), 0, 1);
$pdf->Cell(0, 10, 'Customer Details:', 0, 1);
$pdf->Cell(0, 10, 'Name: ' . $_SESSION['name'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $_SESSION['email'], 0, 1);
$pdf->Cell(0, 10, 'Phone: ' . $_SESSION['phone'], 0, 1);
$pdf->Cell(0, 10, 'Address: ' . $_SESSION['address'], 0, 1);
$pdf->Cell(0, 10, 'WhatsApp: ' . $_SESSION['whatsapp'], 0, 1);

// Output the PDF to the browser
$pdf->Output('invoice.pdf', 'D'); // 'D' will force download
?>
