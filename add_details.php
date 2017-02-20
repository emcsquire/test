<?php
/* Encoding listing of Pipeline
 * 07.01.2014 - TSI and Prem added attributes step=any (To surpass HTML5 validation on decimals, integers alike
 * 07.05.2014 - Application of Pipeline Phase II
 * 09.15.2014 - Added Ok to Issue Status
 *            - Remove Assign to on Renewal and New Business
 *            - Added condition clause where ho_tag is null ("Ok to Issue" and "Ok to Quote"
 */

session_start();
ini_set ("display_errors", "1");
if (!isset($_SESSION['Username'])  ) {
            session_destroy(); 
            header("Location: index.php");   
	exit(); // Quit the script.
}

include 'include/db_config.php';
$clg = $_REQUEST['clg'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="css/jquery.min.js"></script>
        <link href="css/accord.css" rel="stylesheet" type="text/css" />   
        <link rel="stylesheet" type="text/css" media="all" href="jsDatePick.css"></link>
        <title>CPAIC - Pipeline</title>
        <link href="css/templatemo_style_original.css" rel="stylesheet" type="text/css" />   	
        
            <!-- Calendar Date Script-->
            <link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />    
            <script type="text/javascript" src="jquery.1.4.2.js"></script>
            <script type="text/javascript" src="jsDatePick.jquery.min.1.3.js"></script>
            <script type="text/javascript">
                window.onload = function() {
                    new JsDatePick({
                        useMode: 2,
                        target: "incept",
                        dateFormat: "%Y-%m-%d",
                    });
                };
            </script>  
            <script type="text/javascript">
                window.onload = function() {
                    new JsDatePick({
                        useMode: 2,
                        target: "effdate",
                        dateFormat: "%Y-%m-%d",
                    });
                };
            </script>  
        
        <script>
        function OpenWindow()
          {
            var x=document.forms["create_pline"]["mName"].value;
            var y=document.forms["create_pline"]["mFile"].value;
            var z=document.forms["create_pline"]["assd_contact"].value;
            var a=document.forms["create_pline"]["tsi"].value;
            
            var InspectStat=document.forms["create_pline"]["status_cd"].value;
            var InspectLocRisk1=document.forms["create_pline"]["locrisk1"].value;            
            var InspectDate=document.forms["create_pline"]["InspectDate"].value;            
            var InspectCurDate=document.forms["create_pline"]["InspectCurDate"].value;
            var RenewType = document.forms["create_pline"]["renew_type"].value;
            var Remarks = document.forms["create_pline"]["remarks"].value;            
          
                //For each radio button if it is checked get the value and break.
                 for (var i = 0; i < RenewType.length; i++){
                    if (RenewType[i].checked){
                       message = message + "\n" + RenewType[i].value;
                       break
                    }
                 }
                 alert(message)            
          
            if (InspectDate > InspectCurDate)
            {
                alert ("Maximum Sched of Inspection is after FIVE (5) days per System Date");
                return false;
            }
            if (InspectStat=='A' && z=="")
            {
                    alert ("Assured Contact required for Status - For Inspection");
                    return false;
            }
            if (InspectStat=='A' && InspectLocRisk1=="")
            {
                    alert ("Location of Risk required for Status - For Inspection");
                    return false;
            }
            
          if (y!=="" && x=="") 
          {
                alert("File Name is Required");
                return false;
          }
          if (y=="" && x!=="") 
          {
                alert("Upload File Empty");
                return false;
          }          
          
          }
        </script>
        
        <script>
            // Script to Show Province per Region
            function showCity(str)
            {
            if (str=="")
              {
              document.getElementById("txtHint").innerHTML="";
              return;
              } 
            if (window.XMLHttpRequest)
              {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
              }
            else
              {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
            xmlhttp.onreadystatechange=function()
              {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
                }
              }
            xmlhttp.open("GET","getCity.php?q="+str,true);
            xmlhttp.send();
            }
        </script>
        
        <script>
            // Script to Show Intermediary per Selected Intm Type
            function showIntm(str)
            {
            if (str=="")
              {
              document.getElementById("txtIntm").innerHTML="";
              return;
              } 
            if (window.XMLHttpRequest)
              {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
              }
            else
              {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
            xmlhttp.onreadystatechange=function()
              {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                document.getElementById("txtIntm").innerHTML=xmlhttp.responseText;
                }
              }
            xmlhttp.open("GET","getIntm.php?q="+str,true);
            xmlhttp.send();
            }
        </script>  

        <script>
            function showUpload(str)
            {
            if (str=="")
              {
              document.getElementById("txtUpload").innerHTML="";
              return;
              } 
            if (window.XMLHttpRequest)
              {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
              }
            else
              {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
            xmlhttp.onreadystatechange=function()
              {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                document.getElementById("txtUpload").innerHTML=xmlhttp.responseText;
                }
              }
            xmlhttp.open("GET","getUpload.php?q="+str,true);
            xmlhttp.send();
            }
        </script>  

          <script>
                function showStat(str)
                {
                    if (str == "")
                    {
                        document.getElementById("txtStat").innerHTML = "";
                        return;
                    }
                    if (window.XMLHttpRequest)
                    {// code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
                    {// code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            document.getElementById("txtStat").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "getStat.php?q=" + str, true);
                    xmlhttp.send();
                }
            </script> 
            
           <script>
                function showRenewal(str)
                {
                    if (str == "")
                    {
                        document.getElementById("txtRenewal").innerHTML = "";
                        return;
                    }
                    if (window.XMLHttpRequest)
                    {// code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
                    {// code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            document.getElementById("txtRenewal").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "getRenewal.php?q=" + str, true);
                    xmlhttp.send();
                }
            </script>         
        
        
</head>   
    
<body>       
    
<div id="templatemo_content_wrapper">        
    <div id="templatemo_content">
    <div class="cleaner_h30">&nbsp;</div>
   	<?php
	echo "<b><font size=3>Charter Ping An Insurance Corporation</font></b><br>
		<font size=2><b>Pipeline</b></font><br>";
		date_default_timezone_set("Asia/Hong_Kong");
                echo date("l\, F jS\, Y ", time());
                echo "<font id=ur></font>";
                echo "<br>";	 
	?>    
            
                <div id="content_left1">
                    <div class="cleaner_h30">&nbsp;</div>
                    <?php include("css/menus/accord.php"); ?>
                    <div class="cleaner_h30">&nbsp;</div>
                    <div class="cleaner_h30">&nbsp;</div>
                    <div class="cleaner_h30">&nbsp;</div>
                    <div class="cleaner_h30">&nbsp;</div>
                </div> 

    
<div id="content_right1">   
    <div class="cleaner_h30">&nbsp;</div>
    <div class="cleaner_h30">&nbsp;</div>

                    <?php 
                    //Renewal 
                    if (filter_input( INPUT_GET, 'typ') == 1 and filter_input( INPUT_GET, 'endt') == 'x') { ?>
                    <form name="create_pline" method="POST" action="save_details.php?typ=a&clg=<?php echo $clg; ?>" enctype=multipart/form-data onsubmit="return OpenWindow()">                       
                        <table border=1 cellspacing=0 cellpadding="2">
                            <tr> 
                                <td colspan=2 align=center bgcolor=#FFBE7D height=30><b>Pipeline Creation </b></td>
                            </tr>
                            <tr>
                                <td>Line</td>
                                <td>
                                    <?php
                                    $line = filter_input( INPUT_GET, 'line');
                                    $result = $db->justQuery("SELECT line_cd, line_name from pipe_line 
                                            WHERE line_cd <> '$line'");

                                    //For user pick
                                    $result1 = $db->justQuery("SELECT line_cd, line_name from pipe_line 
                                            WHERE line_cd = '$line'");

                                    while ($row = $result1->fetch_assoc()) {
                                        $name = $row['line_name'];
                                    }

                                    echo "<select name='line_cd' required='required'>";
                                    echo "<option value='$line'>$name</option>";
                                    while ($row = $result->fetch_assoc()) {
                                        $line_cd = $row['line_cd'];
                                        $line_name = $row['line_name'];
                                        echo "<option value=$line_cd>$line_name</option>";
                                    }
                                    echo "</select>";
                                    echo "</p>";
                                    ?>

                                </td> 
                            </tr> 
                            <tr>
                                <td>Assured</td>
                                <td><input type="text" name="assured" value="<? echo $_GET['assd'] ?>" size="70" style="text-transform:uppercase;"></td> 
                            </tr> 
                            <tr>
                                <td>Status</td>
                                <td>                  
                                    <?php
                                    $result = $db->justQuery("SELECT status_cd, status_desc, order_tag FROM pline_sources 
                                        WHERE visible_tag = 'Y'
                                        AND head_tag IS NULL
                                        ORDER BY ORDER_tag");
                                    echo "<select name='status_cd' required='required' onchange='showStat(this.value)'>";
                                    echo "<option value=''>Please Select </option>";
                                    while ($row = $result->fetch_assoc()) {
                                        $status_cd = $row['status_cd'];
                                        $status_desc = $row['status_desc'];
                                        echo "<option value=$status_cd>$status_desc</option>";
                                    }
                                    echo "</select>";
                                    ?>  
                                    <div id="txtStat"></div>
                                </td>
                            </tr>    
                            <tr>
                                <td>Source</td>
                                <td>
                                    <?php
                                    $result = $db->justQuery('SET NAMES utf8');
                                    $result = $db->justQuery("SELECT iss_cd, iss_name FROM pipe_branches ORDER BY iss_name");
                                    echo "<select name='iss_cd' required='required'>";
                                    echo "<option value=''>Please Select </option>";
                                    while ($row = $result->fetch_assoc()) {
                                        $iss_name = $row['iss_name'];
                                        $iss_cd = $row['iss_cd'];
                                        echo "<option value=$iss_cd>$iss_name</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </td> 
                            </tr>   
                            <tr>
                                <td>Policy No</td>  
                                <td>
                                <input type="text" name="policyno" value="" size="50" style="text-transform:uppercase;" required ="required"> ex: MC-PAS-SP-14-6-0 
                                <div id="txtStat"></div>
                                </td> 
                            </tr>                              
                            <tr>	
                                <td>Renewal Type</td>
                                <td><input type="radio" name="renew_type" value="0" required="required" onchange='showRenewal(this.value)'>As Is&nbsp;&nbsp;
                                    <input type="radio" name="renew_type" value="1" required="required" onchange='showRenewal(this.value)'>With Changes
                            <div id="txtRenewal"></div>            
                                        </td>                                
                            </tr>    
                          <tr>
                                <td>Remarks</td>
                                <td>
                                    <textarea name="remarks" value="" cols="35" rows="4" maxlength="2000"></textarea>
                                </td> 
                            </tr> 

                            <tr>
                                <td colspan="2" >
                                    <input type=hidden name=MAX_FILE_SIZE value=2097152 />
                                    File Name: <input type=text name=mName id=mName value=""/> .jpeg,  .pdf, .doc, .xls, .zip
                                    <br>
                                        Choose a file to upload: <input type=file name=mFile id=mFile value=""/>
                                        <br>
                                            <b>Upload Limit 3MB</b>
                                            </td>
                                            </tr>                            
                                            <tr>
                                                <td colspan="2" align="center"><input type="submit" name="addrecord" value="Submit" onclick="return confirm('Are you sure you want to Submit?'); showBoxes(this.form)"  ></td>

                                            </tr>
                            <input type="hidden" name="tsi" id ="tsi" value =0 size="20">
                            <input type="hidden" name="prem" value=0 size="50">                            
                        </table>
                        
                    </form>
                    <?php } 
                    //New Business
                    elseif (filter_input( INPUT_GET, 'typ') !=1 and filter_input( INPUT_GET, 'endt') == 'x') {
                        
                        ?>            
                        <form name="create_pline" method="POST" action="save_details.php?typ=b&clg=<?php echo $clg; ?>" enctype="multipart/form-data" onsubmit="return OpenWindow()">                                
                        <table border=1 cellspacing=0 cellpadding="2">
                            <tr> 
                                <td colspan=2 align=center bgcolor=#FFBE7D height=30><b>Pipeline Creation </b></td>
                            </tr>
                            <tr>
                                <td>Line</td>
                                <td>
                                    <?php
                                    $line = filter_input( INPUT_GET, 'line');
                                    $result = $db->justQuery("SELECT line_cd, line_name from pipe_line 
                                            WHERE line_cd <> '$line'");

                                    //For user pick
                                    $result1 = $db->justQuery("SELECT line_cd, line_name from pipe_line 
                                            WHERE line_cd = '$line'");

                                    while ($row = $result1->fetch_assoc()) {
                                        $name = $row['line_name'];
                                    }

                                    echo "<select name='line_cd' required='required'>";
                                    echo "<option value='$line'>$name</option>";
                                    while ($row = $result->fetch_assoc()) {
                                        $line_cd = $row['line_cd'];
                                        $line_name = $row['line_name'];
                                        echo "<option value=$line_cd>$line_name</option>";
                                    }
                                    echo "</select>";
                                    echo "</p>";
                                    ?>

                                </td> 
                            </tr>
                            <tr>
                                <td>Assured</td>
                                <td><input type="text" name="assured" value="<? echo $_GET['assd'] ?>" size="70" style="text-transform:uppercase;"></td> 
                            </tr> 
                            <tr>
                                <td>Status</td>
                                <td>                  
                                    <?php
                                    $result = $db->justQuery("SELECT status_cd, status_desc, order_tag FROM pline_sources 
                                        WHERE visible_tag = 'Y'
                                        AND head_tag IS NULL
                                        ORDER BY ORDER_tag");
                                    echo "<select name='status_cd' required='required' onchange='showUpload(this.value)'>";
                                    echo "<option value=''>Please Select </option>";
                                    while ($row = $result->fetch_assoc()) {
                                        $status_cd = $row['status_cd'];
                                        $status_desc = $row['status_desc'];
                                        echo "<option value=$status_cd>$status_desc</option>";
                                    }
                                    echo "</select>";
                                    ?>  
                                    <div id="txtUpload"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>In Accout Of / Leased to</td>
                                <td><input type="text" name="acctOf" value="" size="70"  maxlength="100" style="text-transform:uppercase;"></td> 
                            </tr> 


                            <?php
                            $result = $db->justQuery("select prop_cd, prop_desc from pipe_propcover where line = '{$_GET['line']}'");

                            if ($result->num_rows <> 0) {
                                echo "<tr>
                        <td>Covered</td>
                        <td><select name='prop_desc' required='required'>
                            <option value=''>Please Select </option> ";
                                while ($row = $result->fetch_assoc()) {
                                    $prop_cd = $row['prop_cd'];
                                    $prop_desc = $row['prop_desc'];
                                    echo "<option value=$prop_desc>$prop_desc</option>";
                                }
                                echo "</select>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td>Source</td>
                                <td>
                                    <?php
                                    $result = $db->justQuery('SET NAMES utf8');
                                    $result = $db->justQuery("SELECT iss_cd, iss_name FROM pipe_branches ORDER BY iss_name");
                                    echo "<select name='iss_cd' required='required'>";
                                    echo "<option value=''>Please Select </option>";
                                    while ($row = $result->fetch_assoc()) {
                                        $iss_name = $row['iss_name'];
                                        $iss_cd = $row['iss_cd'];
                                        echo "<option value=$iss_cd>$iss_name</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </td> 
                            </tr>
                            <?php
                            if ($line == 'MC')
                            {    
                                echo "<td>Unit to be Insured</td>
                                        <td><input type=text name=mcunit value='' size=70 required=required style=text-transform:uppercase;></td> ";
                            }
                            ?>

                            <tr>
                                <td>Assured Contact No.</td>
                                <td><input type="text" name="assd_contact" value="" size="50" maxlength="50"></td> 
                            </tr>    
                            <tr>
                                <td rowspan="4">Location of Risk</td>
                                <td>Province &nbsp;
                                    <?php
                                    $result = $OraDB->justQuery("select province_cd, province_desc 
                                                        from giis_province order by province_desc");
                                    echo "<select name='province_cd' onchange='showCity(this.value)' required='required'>";
                                    echo "<option value=''>Please Select </option>";
                                    while ($row = oci_fetch_assoc($result)) {
                                        $province_cd = $row['PROVINCE_CD'];
                                        $province_desc = $row['PROVINCE_DESC'];
                                        echo "<option value=$province_cd>$province_desc</option>";
                                    }
                                    echo "</select>";
                                    echo "</p>";
                                    ?>
                                </td>
                                <tr><td><div id="txtHint">City &nbsp;
                                            <select name='' required='required'>
                                                <option value=''>Please Select </option>
                                            </select>
                                        </div>
                                    </td></tr>
                                <tr><td><input type="text" name="locrisk1" value="" size="70" maxlength="150" ></td></tr>
                                <tr><td><input type="text" name="locrisk2" value="" size="70" maxlength="150"></td></tr>
                            </tr>
                            <tr>
                                <td>Sum Insured</td>
                                <td>
                                    <input type="number" name="tsi" id ="tsi" size="20" required="required" step="any">
                                </td>                   
                            </tr>               
                            <tr>
                                <td>Intm Type </td>
                                <td> <?php
                                $result = $OraDB->justQuery("select intm_desc, intm_type from giis_intm_type");
                                echo "<select name='intm_desc' onchange='showIntm(this.value)' required='required'>";
                                echo "<option value=''>Please Select </option>";
                                while ($row = oci_fetch_assoc($result)) {
                                    $intm_desc = $row['INTM_DESC'];
                                    $intm_type = $row['INTM_TYPE'];
                                    echo "<option value=$intm_type>$intm_desc</option>";
                                }
                                echo "</select>";
                                echo "</p>";
                                    ?></td> 
                            </tr> 
                            <tr>
                                <td>Intermediary &nbsp; </td>
                                <td><div id="txtIntm">
                                        <select name='' required='required'>
                                            <option value=''>Please Select </option>
                                        </select>
                                    </div></td>
                            </tr>
                            <tr>
                                <td>Agent Contact Name</td>
                                <td><input type="text" name="contact_name" value="" size="50"  maxlength="70" ></td> 
                            </tr> 
                            <tr>
                                <td>Agent Contact No.</td>
                                <td><input type="text" name="contact" value="" size="50" maxlength="50"></td> 
                            </tr> 

                            <tr>
                                <td>Premium</td>
                                <td><input type="number" name="prem" value="0" size="50" step="any"> <font size="1">Net Amount</font>
                                </td> 
                            </tr>   
                            <tr>
                                <td>Inception Date</td>
                                <td>
                                    <input  type="text" name="incept"  id="incept" value="<? echo date("Y-m-d", time()) ?>" size="30" required="required"> 
                                        <font size="1">yyyy-mm-dd</font>
                                </td> 
                            </tr>  
                            <tr>
                                <td>Remarks</td>
                                <td>
                                    <textarea name="remarks" value="" cols="35" rows="4" maxlength="2000"></textarea>
                                </td> 
                            </tr> 

                            <tr>
                                <td colspan="2" >
                                    <input type=hidden name=MAX_FILE_SIZE value=2097152 />
                                    File Name: <input type=text name=mName id=mName value=""/> .jpeg,  .pdf, .doc, .xls, .zip
                                    <br>
                                        Choose a file to upload: <input type=file name=mFile id=mFile value=""/>
                                        <br>
                                            <b>Upload Limit 3MB</b>
                                            </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" align="center"><input type="submit" name="addrecord" value="Submit" onclick="return confirm('Are you sure you want to Submit?');"></td>

                                            </tr>
                                                <input type="hidden" name="renew_type" value="<?php echo $_REQUEST['typ'] ?>">
                                            </table>
                            
                      
                        </form>
                    <?php } 
                    //Endorsement
                    elseif (filter_input( INPUT_GET, 'typ') ==1  or filter_input( INPUT_GET, 'typ') ==0 and filter_input( INPUT_GET, 'endt') == 'e') { ?>
                    <form name="create_pline" method="POST" action="save_details.php?typ=e&clg=<?php echo $clg; ?>" enctype="multipart/form-data" onsubmit="return OpenWindow()">
                        <table border=1 cellspacing=0 cellpadding="2">
                            <tr> 
                                <td colspan=2 align=center bgcolor=#FFBE7D height=30><b>Pipeline Creation </b></td>
                            </tr>
                            <tr>
                                <td>Line</td>
                                <td>
                                    <?php
                                    $line = filter_input( INPUT_GET, 'line');
                                    $result = $db->justQuery("SELECT line_cd, line_name from pipe_line 
                                            WHERE line_cd <> '$line'");

                                    //For user pick
                                    $result1 = $db->justQuery("SELECT line_cd, line_name from pipe_line 
                                            WHERE line_cd = '$line'");

                                    while ($row = $db->justQuery($result1)) {
                                        $name = $row['line_name'];
                                    }

                                    echo "<select name='line_cd' required='required'>";
                                    echo "<option value='$line'>$name</option>";
                                    while ($row = $result->fetch_assoc()) {
                                        $line_cd = $row['line_cd'];
                                        $line_name = $row['line_name'];
                                        echo "<option value=$line_cd>$line_name</option>";
                                    }
                                    echo "</select>";
                                    echo "</p>";
                                    ?>

                                </td> 
                            </tr> 
                            <tr>
                                <td>Assured</td>
                                <td><input type="text" name="assured" value="<? echo $_GET['assd'] ?>" size="70" style="text-transform:uppercase;"></td> 
                            </tr> 
                            <tr>
                                <td>Status</td>
                                <td><select name='status_cd' required='required'>
                                        <option value='A1'>FOR ENDORSEMENT</option>
                                    </select>                                    
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <td>Assignee</td>
                                <td><input type=text name=assignee value='' required=required>
                                </td>
                            </tr> 10.10.2014 - Application of Ok to Issue Process-->
                            <tr>
                                <td>Source</td>
                                <td>
                                    <?php
                                    $result = $db->justQuery('SET NAMES utf8');
                                    $result = $db->justQuery("SELECT iss_cd, iss_name FROM pipe_branches ORDER BY iss_name");
                                    echo "<select name='iss_cd' required='required'>";
                                    echo "<option value=''>Please Select </option>";
                                    while ($row = $result->fetch_assoc()) {
                                        $iss_name = $row['iss_name'];
                                        $iss_cd = $row['iss_cd'];
                                        echo "<option value=$iss_cd>$iss_name</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </td> 
                            </tr> 
                            <tr>
                                <td>Policy No</td>
                                <td><input type="text" name="policyno" value="" size="50" style="text-transform:uppercase;" required ="required"> ex:   MC-PAS-SP-14-6-0</td> 
                            </tr>                             
                            <tr>	
                                <td>Type of Endorsement</td>
                                <td>                  
                                    <?php
                                    $result = $db->justQuery("SELECT id, endt_type FROM pipe_endt_type");
                                    echo "<select name='endt_type' required='required'>";
                                    echo "<option value=''>Please Select </option>";
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['id'];
                                        $endt_type = $row['endt_type'];
                                        echo "<option value=$id>$endt_type</option>";
                                    }
                                    echo "</select>";
                                    ?>  
                                    
                                </td>                                    
                            </tr> 
                            <tr>
                                <td>Effectivity Date</td>
                                <td>
                                    <input  type="text" name="effdate"  id="effdate" value="<? echo date("Y-m-d", time()) ?> " size="30" required="required"> 
                                        <font size="1">yyyy-mm-dd</font>
                                </td> 
                            </tr>                              
                            <tr>
                                <td>Sum Insured</td>
                                <td>
                                    <input type="number" name="tsi" id ="tsi" size="20" value="0">
                                </td>                   
                            </tr>    
                            <tr>
                                <td>Premium</td>
                                <td><input type="number" name="prem" value="0" size="50" step="any"> <font size="1">Net Amount</font>
                                </td> 
                            </tr>                               
                          <tr>
                                <td>Remarks</td>
                                <td>
                                    <textarea name="remarks" value="" cols="35" rows="4" maxlength="2000" required ="required"></textarea>
                                </td> 
                            </tr> 

                            <tr>
                                <td colspan="2" >
                                    <input type=hidden name=MAX_FILE_SIZE value=2097152 />
                                    File Name: <input type=text name=mName id=mName value=""/> .jpeg,  .pdf, .doc, .xls, .zip
                                    <br>
                                        Choose a file to upload: <input type=file name=mFile id=mFile value=""/>
                                        <br>
                                            <b>Upload Limit 3MB</b>
                                            </td>
                                            </tr>                            
                                            <tr>
                                                <td colspan="2" align="center"><input type="submit" name="addrecord" value="Submit" onclick="return confirm('Are you sure you want to Submit?'); showBoxes(this.form)"  ></td>

                                            </tr>
                            <input type="hidden" name="renew_type" value="<?php echo $_REQUEST['typ'] ?>">
                                
                        </table>
                        
                    </form>                    
                
                
                    <?php }
                    ?>       
    
    </br></br>
      
</div>
        
    </body>
</div>
    </div>  
    </div>
</html>

