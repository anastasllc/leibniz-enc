<!DOCTYPE html>
<html>
<head>
<title>Leibniz Encryption</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</head>
<?php
   require('leibniz.class.php');
   $gearfile = 'gear.txt';
   $cypherfile = 'cyphers.txt';
?>
<body>
   Cypher Alphabets (one per line):<br />
   <textarea style="width: 30em; height: 1em;" disabled="disabled"><?=Leibniz::default_alphabet ?></textarea><br />
   <textarea name="alphabets" id="alphabets" style="width: 30em; height: 8em;"><?=file_get_contents($cypherfile); ?></textarea><br /><br />

   Leinbiz gear (string of binary digits of length equal to number of alphabets above):<br />
   <input type="text" name="gear" id="gear" value="<?=file_get_contents($gearfile) ?>" /><br /><br />

  <button id="save">Save settings</button><br /><br />
  <hr>

   Original / Decrypted Message:<br />
   <textarea name="dec-message" id="dec-message" style="width: 30em; height: 10em;"></textarea><br /><br />

  <button id="encrypt">Encrypt &#x2193;</button>
  <button id="decrypt">Decrypt &#x2191;</button>
   <br /><br />

   Encrypted Message:<br />
   <textarea name="enc-message" id="enc-message" style="width: 30em; height: 10em;"></textarea><br /><br />

</body>
</html>