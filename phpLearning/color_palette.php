<html>
<head>
<title>Web-Safe Color Palette</title>
</head>
<body>
<table>
<tr>
<?php
//PHP 生成一个颜色选择面板 (Color Palette)
     $i = 1;
     $row_size = 18;
   
     for($red = 0; $red <= 5; $red++)
     for($green = 0; $green <= 5; $green++) {
          for($blue = 0; $blue <= 5; $blue++)
          {
               $red_hex = str_pad(dechex($red * 51), 2, "0", STR_PAD_LEFT);
               $green_hex = str_pad(dechex($green * 51), 2, "0", STR_PAD_LEFT);
               $blue_hex = str_pad(dechex($blue * 51), 2, "0", STR_PAD_LEFT);
               $hex_color = $red_hex . $green_hex . $blue_hex;
   
               print("<td bgcolor=\"#$hex_color\" width=\"15\">&nbsp;</td>");
   
               if(($i % $row_size) == 0)
                    print("</tr><tr>");
   
               $i++;
          }
     }    
?>
</tr>
</table>
</body>
</html>