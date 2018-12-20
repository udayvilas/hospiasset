<?php

ob_start();

?>

<html

    xmlns:o='urn:schemas-microsoft-com:office:office'

    xmlns:w='urn:schemas-microsoft-com:office:word'

    xmlns='https://www.w3.org/TR/html401/'>

    <head>

        <title>Generate a document Word</title>

        <!--[if gte mso 9]-->

    <xml>

        <w:WordDocument>

            <w:View>Print</w:View>

            <w:Zoom>100</w:Zoom>

            <w:DoNotOptimizeForBrowser/>

        </w:WordDocument>

        <w:fonts>

	<w:defaultFonts w:ascii="Times New Roman" w:fareast="Times New Roman" w:h-ansi="Times New Roman" w:cs="Times New Roman"/>

	<w:sz w:val="20"/>

    </xml>

    <!-- [endif]-->

    <style>

        p.MsoFooter, li.MsoFooter, div.MsoFooter{

  

           mso-pagination:widow-orphan;

           mso-page-orientation:PORTRAIT;

        }

        @page Section1

        {



            size: 74mm 35mm;

            margin: 0.1cm 0cm 0cm 0.1cm; 

        }

        div.Section1 { page:Section1;}

    </style>

</head>

<body>

<?php

foreach($pdevices as $pdevice)

{

	$dept_name = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $pdevice[$this->devices->DEPT_ID]));
  //  echo $this->db->last_query(); die();
	if($dept_name=="-" OR $dept_name=="")

	{

		$dept_name=$pdevice[$this->devices->DEPT_ID];

	}

?>

<div class="Section1" style="margin-left:0px;">

<br clear=all style='mso-special-character:line-break;page-break-after:always' />

	<table border="1" style="border-collapse:collapse;border:1px groove black;" width="99.8%">

	<tr>

	<td colspan="4" align="center" style="font-weight:bold;font-size:7.0pt;font-family:Arial;">ID : <?= $pdevice[$this->devices->E_ID]; ?>

	</td>

	</tr>

	<tr> 

		<td rowspan="5" align="center">

			<img height="107" width="107" src="<?= $pdevice[$this->devices->QR_CODE]; ?>" />

		</td>

	</tr>

	<tr>

		<td align="left" style="font-weight:bold;font-size:8.0pt;font-family:Arial;">Dept</td>

		<td align="left" style="font-weight:bold;font-size:8.0pt;font-family:Arial;"><?= $pdevice[$this->devices->DEPT_ID]; ?></td>

	</tr>

	<tr>

		<td align="left" style="font-weight:bold;font-size:8.0pt;font-family:Arial;">Name</td>

	   <td align="left" style="font-weight:bold;font-size:8.0pt;font-family:Arial;"><?= $pdevice[$this->devices->E_NAME]; ?></td>

	</tr>

	<tr>

		<td align="left" style="font-weight:bold;font-size:8.0pt;font-family:Arial;">Serial No</td>

		<td align="left" style="font-weight:bold;font-size:8.0pt;font-family:Arial;"><?= $pdevice[$this->devices->ES_NUMBER]; ?></td>

	</tr>

	<tr>

		<td align="left" style="font-weight:bold;font-size:8.0pt;font-family:Arial;">Model</td>

		<td align="left" style="font-weight:bold;font-size:8.0pt;font-family:Arial;"><?= $pdevice[$this->devices->E_MODEL]; ?></td>

	</tr>

	</table>

</div>

<?php

}

$download_date = date('d-m-Y h_i_s_A');

header("Content-type: application/vnd.ms-word");

header('Content-Disposition: attachment;Filename="Equipments-QRList-('.$download_date.').doc"');

exit();

?>