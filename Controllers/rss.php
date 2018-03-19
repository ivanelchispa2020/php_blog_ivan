<?php
header("Content-Type: application/rss+xml"); 
echo "<?xml version='1.0' encoding='iso-8859-1'?>";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"> 

  <channel> 
    <title><![CDATA[Ultimos articulos - Lo más nuevo]]></title> 
    <link><![CDATA[http://www.misitio.com/]]></link> 
    <description><![CDATA[Mi Sitio.com - Lo más nuevo]]></description>
    <language>es-es</language> 
    <copyright><![CDATA[Iván Lopez]]></copyright>
    <atom:link href="http://localhost/blog_ivan/rss.php" rel="self" type="application/rss+xml" />
    <ttl>15</ttl> 

	<image>
	<url>http://www.gifbin.com/bin/50yuyu29839.gif</url> <!--///logo-->

		<title>MiSitio.com - Lo más nuevo</title>
		<link>http://www.misitio.com</link>
	</image>
<?php
include("gestiona.php"); 
$tra=new trabajo();
$datos=$tra->getArticulos();
foreach($datos as $reg)
{
?>	
<item>
<title>
<![CDATA[<?php echo $reg["titulo"];?>]]>
</title>
<link>
<![CDATA[<?php echo "detalle.php?id_noticia=".$reg["id"];?>]]>
</link>
<description>
<![CDATA[<div align='justify'><?php echo $reg["parrafo"];?></div>]]>
</description>
<guid isPermaLink="true"> <!--false para desconectar el link-->
<![CDATA[<?php echo "http://localhost/poo/index.php?id=".$reg["id"];?>]]>
</guid>
<author>

<![CDATA[<?php echo $reg["fecha"];?>]]>
</author>
<pubDate>
<![CDATA[<?php echo $reg["fecha"];?>]]>
</pubDate>
</item>

 <?php
 }
 ?>
  </channel>

</rss>