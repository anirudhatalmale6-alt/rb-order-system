<?php
/*
 * Customer lookup for the Add Order screen.
 *
 * The Add Order page used to render every customer in the database into a
 * single <select> (150k+ <option> tags, ~18 MB of HTML). This endpoint
 * returns at most 20 matches for what the cashier has actually typed, so
 * the page loads instantly and the search stays fast as the customer table
 * keeps growing.
 *
 * GET/POST: term=<mobile number or name>
 * Returns : JSON array of customer rows
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../class/class_orders.php';

$term = '';
if (isset($_REQUEST['term'])) {
    $term = $_REQUEST['term'];
}

$term = trim((string)$term);

// Fewer than 3 characters would match tens of thousands of rows - not useful
// to the cashier and needlessly heavy on the database.
if (strlen($term) < 3) {
    echo json_encode(array());
    exit;
}

$rows = class_orders::search_customers($term, 20);

echo json_encode($rows);
