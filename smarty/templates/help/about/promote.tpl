<h2>{t}You want to help .node ?{/t}</h2>
<h3>{t}Insert a logo on your site{/t}</h3>
<p>
<img src='http://{$config.domain}/img/dotnode-member8015.png' alt='See my .page' style='width:80px; height: 15px; border:none;' /><br />
{t}In order to display this logo, simply copy the HTML code and insert it into your page{/t} :
<pre style='border: 1px gray solid; padding: 5px'>
&lt;a href='http://{$smarty.session.my_login}.{$config.domain}' title='See my .page'&gt;
&lt;img src='http://{$smarty.session.my_login}.{$config.domain}/img/dotnode-member8015.png' alt='See my .page' style='width:80px; height: 15px; border:none;'  /&gt;
&lt;/a&gt;
</pre>
</p>
