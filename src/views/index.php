<form action="<?php echo $site; ?>user/login" id="formID" method="post" autocomplete="off">

	<dl>
		<dt>Login</dt>
		<dd>
			<input type="text" name="user" id="user" value="" class="validate[required]" />
		</dd>
	</dl>
	<dl>
		<dt>Contraseña</dt>
		<dd>
			<input type="password" name="passwd" id="passwd" value="" class="validate[required]" />
		</dd>
	</dl>
	<dl>
		<dt></dt>
		<dd>
			<input type="button" id="pf_btn_accept" value="Login" />
			<a href="<?php echo $site ?>user/register" >Registrarse</a>
			<a href="<?php echo $site ?>user/forget" >¿ Olvido su Clave ?</a>
		</dd>
	</dl>

</form>