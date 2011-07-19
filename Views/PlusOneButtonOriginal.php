<?php
    $url = 'https://plusone.google.com/u/0/_/+1/button?hl=' . $this->lang .
           '&amp;jsh=r%3Bgc%2F22326474-d7ea9837&amp;url=' . rawurlencode($this->url) .
           '&amp;size=' . $this->type . '&amp;count=' . ($this->showCounter ? 'true' : 'false') .
           '&amp;id=I14_1310643374209&amp;parent=' . rawurlencode($this->parentHost) .
           '&amp;rpctoken=297253946&amp;_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe';
    
    if ('tall' == $this->type && $this->showCounter) {
        $width  = '50px';
        $height = '60px';
    } else if ('tall' == $this->type && !$this->showCounter) {
        $width  = '50px';
        $height = '20px';
    } else if ('medium' == $this->type && $this->showCounter) {
        $width  = '90px';
        $height = '20px';
    } else if ('medium' == $this->type && !$this->showCounter) {
        $width  = '32px';
        $height = '20px';
    } else if ('standard' == $this->type && $this->showCounter) {
        $width  = '106px';
        $height = '24px';
    } else if ('standard' == $this->type && !$this->showCounter) {
        $width  = '38px';
        $height = '24px';
    } else if ('small' == $this->type && $this->showCounter) {
        $width  = '70px';
        $height = '15px';
    } else if ('small' == $this->type && !$this->showCounter) {
        $width  = '24px';
        $height = '15px';
    }
?><!DOCTYPE html>
<title>Google +1</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
html,body,div {margin: 0;padding: 0;}
/*<![CDATA[*/
iframe{border:none;display:block;margin:2em auto;height:<?php print $height; ?>;width:<?php print $width; ?>;}
#Intro{color:#666;font:bold 15px Arial,Helvetica,sans-serif;margin:4em 0 2em 0;text-align:center;}
#Close{margin:1em;text-align:center;}
noscript{font:bold 15px Arial,Helvetica,sans-serif;margin:1em auto;border:2px solid #900;display:block;padding:1em;text-align:center;width:80%;}
/*]]>*/
</style>
<body>
<div>
    <noscript>Unfortunately, this button does not work without JavaScript. That is
    not our fault but Google's. Please contact them if you want a button that works
    without JavaScript.</noscript>
    <div id="Intro">Please click the button below to +1 this page.</div>
    <iframe  src="<?php print $url; ?>">
        Google +1 button could not be loaded. Please visit <a href="<?php print $url; ?>">this link</a> manually.
    </iframe>
    <div id="Close"><button>Close this window</button></div>
    <script type="text/javascript">
        document.getElementById('Close').getElementsByTagName('button')[0].onclick = function() {
            window.close();
        };
    </script>
</div>