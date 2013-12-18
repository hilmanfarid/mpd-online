<?php
//Include Common Files @1-6B6005D9
define("RelativePath", "..");
define("PathToCurrentPage", "/include/");
define("FileName", "f_report.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");

$name_of_report=CCGetRequestParam("name_of_report",ccsGet,"_");
$caller_program=CCGetRequestParam("caller_program",ccsGet,"_");
$source_of_report=CCGetRequestParam("source_of_report",ccsGet,"_");
$rpt_qs=CCGetQueryString("QueryString",Array("name_of_report","caller_program","source_of_report"));
$all_qs=CCGetQueryString("QueryString",Array("source_of_report"));
?>
<html>
<frameset id="LAPORAN" framespacing="1" frameborder="0" rows="20,*">
    <frame scrolling="no" name="hlap" src="head_report.php?<?=$all_qs?>">
    <frame scrolling="no" name="ilap" id="ilap" src="<?=$source_of_report?>?<?=$rpt_qs?>">
    <noframes>
        <body>
            <p>
                This page uses frames, but your browser doesn't support them.
            </p>
        </body>
    </noframes>
</frameset>
</html>

