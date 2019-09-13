<script type="text/javascript">
	function getMeta(metaName) {
		const metas = document.getElementsByTagName('meta');
		for (let i = 0; i < metas.length; i++) {
			if (metas[i].getAttribute('name') === metaName) {
				return metas[i].getAttribute('content');
			}
		}
		return '';
	}

	var x = document.createElement("INPUT");
	x.setAttribute("type", "text");
	x.setAttribute("id", "custom_token");
	x.setAttribute("value", "shorabh");
	document.body.appendChild(x);
	alert(getMeta('_token'));
</script>