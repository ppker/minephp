<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 14">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
<!--table
    {mso-displayed-decimal-separator:"\.";
    mso-displayed-thousand-separator:"\,";}
@page
    {margin:1.0in .75in 1.0in .75in;
    mso-header-margin:.5in;
    mso-footer-margin:.5in;}
.style0
    {mso-number-format:General;
    text-align:general;
    vertical-align:bottom;
    white-space:nowrap;
    mso-rotate:0;
    mso-background-source:auto;
    mso-pattern:auto;
    color:black;
    font-size:12.0pt;
    font-weight:400;
    font-style:normal;
    text-decoration:none;
    font-family:Calibri, sans-serif;
    mso-font-charset:134;
    border:none;
    mso-protection:locked visible;
    mso-style-name:Normal;
    mso-style-id:0;}
td
    {mso-style-parent:style0;
    padding-top:1px;
    padding-right:1px;
    padding-left:1px;
    mso-ignore:padding;
    color:black;
    font-size:12.0pt;
    font-weight:400;
    font-style:normal;
    text-decoration:none;
    font-family:Calibri, sans-serif;
    mso-font-charset:134;
    mso-number-format:General;
    text-align:general;
    vertical-align:bottom;
    border:none;
    mso-background-source:auto;
    mso-pattern:auto;
    mso-protection:locked visible;
    white-space:nowrap;
    mso-rotate:0;}
.text
    {mso-style-parent:style0;
    mso-number-format:"\@";}
-->
</style>
</head>
<body link=blue vlink=purple>


<!-- BEGIN CONTENT -->
<?php
 ?>
<table border=0 cellpadding=0 cellspacing=0 style="border-collapse: collapse; table-layout: fixed">
	<?php if(!empty($customHeader)): echo ($customHeader); ?>
	<?php else: ?>
		<tr height=15 style='height: 15.0pt'>
			<?php if(is_array($listFields)): $i = 0; $__LIST__ = $listFields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td><?php echo ($vo['title']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
		</tr><?php endif; ?>
	<?php if(is_array($objectData)): $i = 0; $__LIST__ = $objectData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		<?php if(is_array($listFields)): $i = 0; $__LIST__ = $listFields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fld): $mod = ($i % 2 );++$i; if(!empty($fld['valChange'])): ?><td class="text"><?php echo (htmlspecialchars($fld['valChange'][$vo[$fld['name']]])); ?></td>
			<?php else: ?>
				<td class="text"><?php echo (htmlspecialchars($vo[$fld['name']])); ?></td><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>

</body>
</html>