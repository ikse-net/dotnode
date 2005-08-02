<RDF:RDF xmlns:RDF="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:DOTNODE="http://dotnode.com/rdf#">

<RDF:Description RDF:about="http://dotnode.com/friends">
  <DOTNODE:fname>Friends</DOTNODE:fname>
</RDF:Description>

{foreach from=$friends item=friend key=id}
<RDF:Description RDF:about="http://dotnode.com/profile/{$id}">
  <DOTNODE:fname>{$friend.fname|escape}</DOTNODE:fname>
  <DOTNODE:lname>{$friend.lname|escape}</DOTNODE:lname>
  <DOTNODE:nick>{$friend.nick|escape}</DOTNODE:nick>
</RDF:Description>

{/foreach}
<RDF:Seq RDF:about="http://dotnode.com/my-friends">
  <RDF:li>
    <RDF:Seq RDF:about="http://dotnode.com/friends">
{foreach from=$friends item=friend key=id}
      <RDF:li RDF:resource="http://dotnode.com/profile/{$id}"/>
{/foreach}
    </RDF:Seq>
  </RDF:li>
</RDF:Seq>

</RDF:RDF>
