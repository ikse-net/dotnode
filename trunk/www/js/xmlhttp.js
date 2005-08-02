var agent = navigator.userAgent.toLowerCase();
var is_ie = (agent.indexOf('msie') != -1);
var is_ie5 = (agent.indexOf('msie 5') != -1);

function CreateXmlHttpReq(handler) {
	var xmlhttp = null;
	if (is_ie) {
		var control = (is_ie5) ? "Microsoft.XMLHTTP" : "Msxml2.XMLHTTP";
		try {
			xmlhttp = new ActiveXObject(control);
			xmlhttp.onreadystatechange = handler;
		} catch(e) {
			alert("Vous devez activer les scripts actifs et les controls ActiveX. Pour plus de sécurité, utilisez Mozilla FireFox (mozilla.org)");
		}
	} else {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onload = handler;
		xmlhttp.onerror = handler;
	}
	return xmlhttp;
}
function DummyHandler() { }

function XmlHttpGET(xmlhttp, url) {
	xmlhttp.open('GET', url, true);
	xmlhttp.send(null);
}
function SendRequest(url) {
	var xmlhttp = CreateXmlHttpReq(DummyHandler);
	XmlHttpGET(xmlhttp, url);
}
