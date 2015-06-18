<?php include("globals.php"); ?>
<form action="<?php echo $website.$relative_string;?>" name="subscribe">
<fieldset>
<legend>Newsletter for updates!</legend>
<label for="email">
<input name="email" type="text" class="lform2" id="email" value="" size="30" />
<input name="subscribe" type="radio" value="true" id="sub4" checked="checked" />
<label for="sub4">Subscribe</label><br />
<input type="radio" name="subscribe" id="unsub4" value="false" />
<label for="unsub4">Un-Subscribe</label>
<input name="page" type="hidden" value="mail" />
<input name="Submit2" type="submit" class="lbut" value="Submit" />
</fieldset>
</form>