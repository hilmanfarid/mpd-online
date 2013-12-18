<html>
<head>
    <title>MENU</title>
</head>
<frameset framespacing="1" frameborder="0" cols=*,220>
    <frame name="mamain" id="mamain" src="p_app_menu.php?parent_id=0&p_application_id=<?=$_GET["p_application_id"]?>&app_s_keyword=<?=$_GET["s_keyword"]?>&p_applicationGridPage=<?=$_GET["p_applicationGridPage"]?>">
    <frame name="matree" src="p_app_menu_tree.php?p_application_id=<?=$_GET["p_application_id"]?>&s_keyword=<?=$_GET["s_keyword"]?>&p_applicationGridPage=<?=$_GET["p_applicationGridPage"]?>&app_s_keyword=<?=$_GET["app_s_keyword"]?>">
    <noframes>
        <body>
            <p>
                This page uses frames, but your browser doesn't support them.
            </p>
        </body>
    </noframes>
</frameset>
</html>
