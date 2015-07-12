<?php
/* ==========================================================================

Copyright (C) 2005 - 2012 Jaspersoft Corporation. All rights reserved.
http://www.jaspersoft.com.

Unless you have purchased a commercial license agreement from Jaspersoft,
the following license terms apply:

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU Affero  General Public License for more details.

You should have received a copy of the GNU Affero General Public  License
along with this program. If not, see <http://www.gnu.org/licenses/>.

=========================================================================== */
use Jasper\JasperClient;
use Jasper\ResourceDescriptor;

require_once(dirname(__FILE__) . '/../client/JasperClient.php');


class JasperRunReportTest extends PHPUnit_Framework_TestCase {

    /** @var JasperClient $jc */
	protected $jc;
	protected $sample_report;

	public function setUp() {
		$bootstrap = parse_ini_file(dirname(__FILE__) . '/test.properties');

		$this->jc = new JasperClient(
				$bootstrap['hostname'],
				$bootstrap['port'],
				$bootstrap['admin_username'],
				$bootstrap['admin_password'],
				$bootstrap['base_url'],
				$bootstrap['admin_org']
				);

		$this->sample_report = "/reports/samples/AllAccounts";
		$this->sample_report_size = 220000;	// pre-determined

	}

	public function tearDown() {

	}

    /**
     * Checks whether the sample report when acquired as a PDF file has a plausible content length.
     */
    public function testRunReport_getsSomewhatProperFileSize() {
		$data = $this->jc->runReport($this->sample_report, 'pdf');
		$this->assertGreaterThan($this->sample_report_size, strlen($data));
	}

    /**
     * Checks whether HTML representation of Flash Chart Report is adequate, determined by
     * the required SWF file URL presence in output.
     */
    public function testRunFlashChartReport() {
        $report = $this->jc->runReport('/reports/samples/FlashChartReport', 'html');
        $this->assertContains('fusion/charts/Bar2D.swf', $report);
    }

    /**
     * Checks whether running a report with custom options actually runs it so.
     */
    public function testRunCascadingInputReport_WithCustomOptions() {
        $options = array(
            "Country_multi_select" => array("USA", "Canada"),
            "Cascading_state_multi_select" => array("CA", "OR"),
            "Cascading_name_single_select" => array("Alcorn-Miller Transportation Holdings")
        );
        $report = $this->jc->runReport('/reports/samples/Cascading_multi_select_report', 'csv', null, $options);
        $this->assertContains('[USA, Canada]', $report);
        $this->assertContains('[CA, OR]', $report);
        $this->assertRegExp("/Customer\ parameter\:\,*Alcorn\-Miller\ Transportation\ Holdings/", $report);
    }

    /**
     * Checks updateReportOptions() functionality by creating new ReportOptions, running them and verifying the output.
     */
    public function testRunCascadingInputReport_CreateOptions() {
        $options = array(
            "Country_multi_select" => array("Mexico", "USA"),
            "Cascading_state_multi_select" => array("Guerrero", "CA", "OR"),
            "Cascading_name_single_select" => array("Adina-Bohling Transportation Holdings")
        );
        $this->jc->updateReportOptions('/reports/samples/Cascading_multi_select_report', $options, 'USAAndMexicoReport', 'true');
        $report = $this->jc->runReport('/reports/samples/USAAndMexicoReport', 'csv');

        // Please note that this method works only when there are no whitespaces in the label.
        $this->jc->deleteReportOptions('/reports/samples/Cascading_multi_select_report', 'USAAndMexicoReport');

        $this->assertContains('[Mexico, USA]', $report);
        $this->assertContains('[Guerrero, CA, OR]', $report);
        $this->assertRegExp("/Customer\ parameter\:\,*Adina\-Bohling\ Transportation\ Holdings/", $report);
    }

    /**
     * Checks running a report with custom options when this report has input controls of various types.
     */
    public function testRunSalesByMonthReport() {
        $options = array(
            "TextInput" => array("1234"),
            "CheckboxInput" => array("false"),
            "ListInput" => array("3"),
            "DateInput" => array("2012-09-08"),             // Y-M-D
            "QueryInput" => array("sally")
        );
        $report = $this->jc->runReport('/reports/samples/SalesByMonth', 'csv', null, $options);
        $this->assertRegExp("/Number\,*[0-9\s]*[\,\s]*List\ item\,*([0-9]+\s*)*[\,\s]*Date\,*([0-9]{1,2}\s+\w*\s+[0-9]{4})[\,\s]*Query\ item\,*sally/u", $report);

        $this->jc->updateReportOptions('/reports/samples/SalesByMonth', $options, 'SalesByMonthTestOptions', 'true');
        $savedOptions = $this->jc->getReportInputControls('/reports/samples/SalesByMonthTestOptions');

        try {
            $this->jc->deleteReportOptions('/reports/samples/SalesByMonth', 'SalesByMonthTestOptions');
        } catch (Exception $e) {
            $this->jc->deleteResource('/reports/samples/SalesByMonthTestOptions');
        }

        $this->assertEquals(1234, (int)($savedOptions[0]->value));
        $this->assertEquals("false", $savedOptions[1]->value);
        $this->assertEquals("false", $savedOptions[2]->options[0]["selected"]);
        $this->assertEquals("false", $savedOptions[2]->options[1]["selected"]);
        $this->assertEquals("true", $savedOptions[2]->options[2]["selected"]);
        $this->assertEquals("2012-09-08", $savedOptions[3]->value);
        $this->assertEquals("true", $savedOptions[4]->options[6]["selected"]);
    }
}
?>
