<?php



$list = array (
    array('aaa', 'bbb', 'ccc', 'dddd'),
    array('123', '456', '789'),
    array('"aaa"', '"bbb"')
);
$column_names = array('col1', 'col2', 'col3', 'col4');
$filename="cheff.csv";
array_to_csv_download($column_names,$list,$filename);