<?php
/**
 * Created by PhpStorm.
 * User: rino
 * Date: 10/6/2017
 * Time: 11:51 AM
 */ ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>#RB0<?php echo $_GET['inv_code'];?></title>
     <style>
        .invoice-box {
            max-width: 420px;
            margin: auto;
            padding: 30px;
            
            
            font-size: 12px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #000000;
        }
        
        @font-face{
            font-family:'UNVRSIT0_0'; 
            src:url(https://demo.roxwallwebs.com/mr.hari/admin/assets/site/fonts/UNVRSIT0_0.TTF);
            }
        
        @media print {
            .hidden-print {
                display: none !important;
            }
        }
        html,body
        {
            height: 100%;
            margin: 0px;
        }
        body > div
        {
            position: absolute;
            margin-left: 50px;
            bottom: 10%;
            left: 0px;
        }
    </style>
</head>

<body>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0" border="0"  width="100%">
        <tr class="top">
            <td colspan="6">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td> &nbsp;</td>
                        <td align="center" width="250">
                   <div style="font-weight:bold; font-size:12px; font-family:UNVRSIT0_0, Arial; letter-spacing: 7px; color: #666">
                   The Royal Bakery</div>
                   <div style="font-weight:bold; font-size:24px; font-family: Hind, 'Open Sans', Arial;; color: #aaa">
                   BILL AUTHORIZED</div>
                   <div style="font-weight:bold; font-size:10px; font-family: Hind, 'Open Sans', Arial; letter-spacing: 2px; color: #666">
                   <?php echo date("Y-m-d");?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php date_default_timezone_set("Asia/Kolkata");
echo date("h:i:sa");?></div>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

   
    </table>
<!--    <input type="submit" class="hidden-print" onclick="window.print();" target="_blank" style="cursor:pointer;" value="Print">-->

</div>


    <script>
        window.onload= function () {
            window.print();
            setTimeout(function(){ window.close(); }, 3000);

        }

    </script>

</body>
</html>
