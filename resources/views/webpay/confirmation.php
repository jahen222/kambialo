<script>
	/*parent.document.body.insertAdjacentHTML('beforeend',
		'<form action="<?= $response->urlRedirection ?>" method="post" style="display=none;" id="form-voucher" target="_blank">\
			<input type="hidden" name="token_ws" value="<?= $_POST['token_ws'] ?>">\
		</form>');
	parent.document.getElementById('form-voucher').submit;*/
	parent.document.getElementById('voucher').value ='<?= $response->urlRedirection ?>';
	parent.document.getElementById('token_ws').value ='<?= $_POST['token_ws'] ?>';
	parent.document.getElementById('buyorder').value ='<?= $response->buyOrder ?>';
	parent.document.getElementById('amount').value ='<?= $response->detailOutput->amount ?>';
	parent.document.getElementById('webpay-iframe').height = 0;
</script>