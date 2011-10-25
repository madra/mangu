<?php
#set the javascript
while (list($key,$value) = each($ui->js)) {
                echo
                "
 <script src='".STATIC_BASE_PATH."js/$value.js' type='text/javascript'></script>
                    ";
            }
?>
<div class="footer"></div>
</body>
</html>

