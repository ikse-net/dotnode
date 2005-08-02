{literal}
<style type='text/css'>
#main table {
	border: none;
}
#main table td, #main table th {
	padding: 0em 1em;
	text-align: center;
}

#main .female {
	color: #ff4cca;
}
#main .male {
	color: #1d8fde;
}

</style>
{/literal}

<h2>{t}Country representation{/t}</h2>
<table>
<tr><th></th><th></th><th></th><th>{t}Total{/t}</th><th class='female'>{t}Female{/t}</th><th class='male'>{t}Male{/t}</th></tr>
{foreach name=country from=$stats.country item=country key=name}
<tr><td>{$smarty.foreach.country.iteration}.</td><td><b>{$name}</b></td><td>{$country.percent|string_format:"%.2f"}&nbsp;%</td><td>{$country.nb}</td><td class='female'>{$country.female|string_format:"%.2f"}&nbsp;%</td><td class='male'>{$country.male|string_format:"%.2f"}&nbsp;%</td></tr>
{/foreach}
</table>
<br />

<h2>{t}Interested in{/t}</h2>
<ul>
{foreach from=$stats.interest key=type item=nb}
<li><b>{$type}</b>: {$nb|string_format:"%.2f"}&nbsp;%</li>
{/foreach}
</ul>

<h2>{t}Relationship status{/t}</h2>
<table>
<tr><th></th><th></th><th>{t}Total{/t}</th><th class='female'>{t}Female{/t}</th><th class='male'>{t}Male{/t}</th></tr>
{foreach from=$stats.relationship key=name item=relationship}
<tr><td><b>{$relationship.label}</b></td><td>{$relationship.percent|string_format:"%.2f"}&nbsp;%</td><td>{$relationship.nb}</td><td class='female'>{$relationship.female|string_format:"%.2f"}&nbsp;%</td><td class='male'>{$relationship.male|string_format:"%.2f"}&nbsp;%</td></tr>
{/foreach}
</table>


