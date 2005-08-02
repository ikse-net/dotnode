<h2>New .node member</h2>
{literal}
<script type='text/javascript'>

current_step='step0';

function display(step)
{
	if(current_step!= 'step'+step )
	{
		current = document.getElementById(current_step);

		current_link = document.getElementById('link'+current_step);
		current_link.style.border = "none";
		current_link.style.borderBottom = "1px silver solid";
		current_link.style.padding = "0 6px 0 6px";
		current_link.style.backgroundColor = "white";
		new_step = document.getElementById('step'+step);

		new_link = document.getElementById('linkstep'+step);
                new_link.style.borderColor = "silver";
                new_link.style.borderStyle = "solid";
                new_link.style.borderWidth = "1px";
		new_link.style.padding = "0 5px 0 5px";
                new_link.style.backgroundColor = "#f6fff1";
		new_link.style.borderBottomColor = "white";

		current.style.display = "none";
		new_step.style.display = "block";


		current_step = 'step'+step;
	}
}
</script>
{/literal}

<div id='tabmenu'>
{foreach name=step from=$step key=step_number item=step_name}
<a id='linkstep{$step_number}' class='{if $smarty.foreach.step.first}active{/if}' href="javascript:display({$step_number})">{$step_name}</a>
{/foreach}
</div>


<form action='/action/my/new/record' method='post' enctype="multipart/form-data">
<div id='tabcontent' class='even'>
<div id='step0'>
{include file='my/_new/general.tpl'}
<br />
<a class='button' href='javascript:display(1)'>{t}Next step{/t}</a>
</div>
<div id='step1' style='display: none'>
{include file='my/_new/contact.tpl'}
<br />
<a class='button' href='javascript:display(2)' />{t}Next step{/t}</a>
</div>
<div id='step2' style='display: none'>
{include file='my/_new/professional.tpl'}
<br />
<a class='button' href='javascript:display(3)' />{t}Next step{/t}</a>
</div>
<div id='step3' style='display: none'>
{include file='my/_new/interests.tpl'}
<br />
<a class='button' href='javascript:display(4)' />{t}Next step{/t}</a>
</div>
<div id='step4' style='display: none'>
{include file='my/_new/personal.tpl'}
<br />
<a class='button' href='javascript:display(5)' />{t}Next step{/t}</a>
</div>
<div id='step5' style='display: none'>
{include file='my/_new/photo.tpl'}
<br />
<a class='button' href='javascript:display(6)' />{t}Next step{/t}</a>
</div>
<div id='step6' style='display: none'>
<input type='submit' value='{t}Record{/t}' />
</div>

</div>
</form>
