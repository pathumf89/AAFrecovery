<?php
$c = new Client("http://localhost:8080/jasperserver","jasperadmin","jasperadmin","organization_1");
//$report = $c->reportService()->runReport('/reports/Blank_A4_1', 'pdf');
 
//$js = $c->jobService();
//print_r($js);
$c->jobService()->getJobs("/reports/samples/AllAccounts");
?>