<div id='leftblock' >
<img src='{$smarty.session.my_photo|default:'/photos/nop_en.png'}' alt='photo' />
</div>

<div id='home'>
<h2>{$smarty.session.my_fname}'s Blog</h2>
<form action='/action/my/blog/add' method='post'>
<fieldset style='width: 400px' class='blog'>
<legend>{t}Write a new ticket{/t}</legend>
<p>{t}The content of your blog is under your responsability.{/t}</p>
<span class='label'>{t}Status{/t}</span>{html_radios name='status' options=$labels.blog.status}<br />
<span class='label'>{t}Categorie{/t}</span>{html_options name='id_cat' options=$my.blog_cat}<br />
<span class='label'>{t}Title{/t}</span><input type='text' name='title' style='width: 100%' /><br />
<span class='label'>{t}Header{/t} ({t}optional{/t})</span><textarea name='chapeau' style='width: 100%' rows='3'></textarea><br />
<span class='label'>{t}Ticket content{/t}</span><textarea name='ticket' style='width: 100%' rows='10'></textarea><br />
<input type='submit' value='{t}Record{/t}'>
</fieldset>
</form>
</div>
<div style="clear:both"></div>
