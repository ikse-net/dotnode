<RDF:RDF xmlns:RDF="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:DOTNODE="http://dotnode.com/rdf#">

<RDF:Description RDF:about="http://dotnode.com/communities">
  <DOTNODE:name>Communities</DOTNODE:name>
</RDF:Description>

{foreach from=$communities item=community key=id}
<RDF:Description RDF:about="http://dotnode.com/community/{$id}">
  <DOTNODE:name>{$community.name|escape}</DOTNODE:name>
  <DOTNODE:description>{$community.description|escape}</DOTNODE:description>
</RDF:Description>

{/foreach}
<RDF:Seq RDF:about="http://dotnode.com/my-communities">
  <RDF:li>
    <RDF:Seq RDF:about="http://dotnode.com/communities">
{foreach from=$communities item=community key=id}
      <RDF:li RDF:resource="http://dotnode.com/community/{$id}"/>
{/foreach}
    </RDF:Seq>
  </RDF:li>
</RDF:Seq>

</RDF:RDF>
