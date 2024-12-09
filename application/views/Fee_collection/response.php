
<!DOCTYPE html>
<html>
<head>
	<title>format2</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
</head>
<body>
	<div id="body">
		<div id="box1">
			<img src="<?php //echo base_url($school_logo); ?>" height="73px" width="78px;">
			<div class="table_heading">
				<span class="heading"><?php //echo $school_name; ?></span><BR>
				<span class="address"><?php //echo $school_add; ?></span><br>
				<span class="telaff">Tel No: <?php //echo $school_phone; ?> ,</span><span class="telaff"> Affln No: <?php //echo $school_aff; ?></span><br>
				<span class="webemail">Website: <?php //echo $school_web; ?></span><!-- <span class="webemail"> Email: <?php //echo $school_email; ?></span> --><br>
				<span class="feecopy">FEE-RECEIPT(OFFICE COPY)</span>
			</div>
            <table class="table_data" width="100%" border="1" class="trable_main">
                <tr>
                    <td colspan="3">
                        <table width="100%" class="table1">
                            <tr class="tr1">
                                <td class="td1">Receipt No:</td>
                                <td class="td1"><?php //echo $RECT_NO; ?></td>
                                <td class="td1">Receipt Date:</td>
                                <td class="td1"><?php //echo date('d-M-Y',strtotime($RECT_DATE)); ?></td>
                            </tr>
							<tr class="tr1">
								<td class="td1">Adm No:</td>
                                <td class="td1"><?php //echo $ADM_NO; ?></td>
                                <td class="td1">Class/Sec:</td>
                                <td class="td1"><?php //echo $CLASS."/".$SEC; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td1">Student Name:</td>
                                <td class="td1" colspan="3"><?php //echo $STU_NAME; ?></td>
                            </tr>
							<tr class="tr1">
                                <td class="td1">Father Name:</td>
                                <td class="td1" colspan="3" ><?php //echo $father_name; ?></td>
                            </tr>
							<tr class="tr1">
                                <td class="td1">Bus Stoppage:</td>
                                <td class="td1" colspan="3"><?php //echo $bsn; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td1">Fee For:</td>
                                <td class="td1"><?php //echo $FEE_FOR; ?></td>
								<td class="td1">Payment Mode:</td>
                                <td class="td1"><?php //echo $Payment_Mode; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="tr_main">
                    <td width="2%" class="td_main">Sl.No</td>
                    <td class="td_main">Description</td>
                    <td width="22%" class="td_main">Amount (&#8377;)</td>
                </tr>
                
                <tr class="tr_main">
                    <td colspan="2" class="td_main" style="text-align:right; padding-right:5px;">Total Amount (&#8377;)</td>
                    <td class="td_main" style="text-align:right; padding-right:3px;"><?php //echo $TOTAL.".00"; ?></td>
                </tr>
                <tr class="tr_main">
                    <td colspan="2" style='text-align:left;'><?php //echo $amtinword; ?></td>
                    <td style="padding-top:15px;">Auth.Sign</td>
                </tr>
            </table>
		</div>
	</div>
	</body>
</html>