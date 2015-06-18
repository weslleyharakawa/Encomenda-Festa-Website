<?php include("globals.php"); ?>
<form action="<?php echo $website.$relative_string;?>" name="subscribe" method="post">
<fieldset><legend>newsletter</legend>
<label for="email2">email</label><input name="email" type="text" class="box" id="email2" value="Seu endereço de e-mail" size="20" />
<input name="subscribe" type="radio" id="sub1" value="true" checked="checked" />
<label for="sub1">Subscribe </label><br />
<input type="radio" name="subscribe" id="unsub1" value="false" />
<label for="unsub1">Un-Subscribe</label>
<input name="Submit2" type="submit" class="box" value="Assinar" />
</fieldset>
</form>
