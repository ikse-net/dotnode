<?xml-stylesheet href="/foaf.css" type="text/css"?>
<rdf:RDF
      xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
      xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
      xmlns:foaf="http://xmlns.com/foaf/0.1/"
      xmlns:admin="http://webns.net/mvcb/"
      xmlns:bio="http://purl.org/vocab/bio/0.1/">
<foaf:PersonalProfileDocument rdf:about="">
  <foaf:maker rdf:nodeID="me"/>
  <foaf:primaryTopic rdf:nodeID="me"/>
  <admin:generatorAgent rdf:resource="http://dotnode.com"/>
  <admin:errorReportsTo rdf:resource="mailto:xml@dotnode.net"/>
</foaf:PersonalProfileDocument>
<foaf:Person rdf:nodeID="me">
<foaf:name>{$profile.info.fname|escape} {$profile.info.lname|escape}</foaf:name>
<foaf:givenname>{$profile.info.fname|escape}</foaf:givenname>
<foaf:family_name>{$profile.info.lname|escape}</foaf:family_name>
<foaf:nick>{$profile.info.login}</foaf:nick>
{if $profile.info.gender}
<foaf:gender>{$profile.info.gender}</foaf:gender>
{/if}
<foaf:mbox_sha1sum>{$profile.contact.email_sha1}</foaf:mbox_sha1sum>
{if $profile.general.web}
<foaf:homepage rdf:resource="{$profile.general.web}"/>
{/if}
{if $profile.info.nb_blogs}
<foaf:weblog rdf:resource="http://{$profile.info.login}.dotnode.com/blog/"/>
{/if}
<foaf:depiction rdf:resource="http://{$profile.info.login}.dotnode.com{$profile.info.photo_path}"/>
{if $profile.contact.phone}
<foaf:phone rdf:resource="tel:{$profile.contact.phone}"/>
{/if}
{if $profile.contact.im}
{if $profile.contact.im_type == 'aim'}
<foaf:aimID rdf:resource="{$profile.contact.im|escape}"/>
{elseif $profile.contact.im_type == 'icq'}
<foaf:icqID rdf:resource="{$profile.contact.im|escape}"/>
{elseif $profile.contact.im_type == 'jabber'}
<foaf:jabberID rdf:resource="{$profile.contact.im|escape}"/>
{elseif $profile.contact.im_type == 'msn'}
<foaf:msnID rdf:resource="{$profile.contact.im|escape}"/>
{elseif $profile.contact.im_type == 'yahoo'}
<foaf:yahooID rdf:resource="{$profile.contact.im|escape}"/>
{/if}
{/if}
{if $profile.contact.im2}
{if $profile.contact.im2_type == 'aim'}
<foaf:aimID rdf:resource="{$profile.contact.im2|escape}"/>
{elseif $profile.contact.im2_type == 'icq'}
<foaf:icqID rdf:resource="{$profile.contact.im2|escape}"/>
{elseif $profile.contact.im2_type == 'jabber'}
<foaf:jabberID rdf:resource="{$profile.contact.im2|escape}"/>
{elseif $profile.contact.im2_type == 'msn'}
<foaf:msnID rdf:resource="{$profile.contact.im2|escape}"/>
{elseif $profile.contact.im2_type == 'yahoo'}
<foaf:yahooID rdf:resource="{$profile.contact.im2|escape}"/>
{/if}
{/if}
{if $profile.professional.web}
<foaf:workplaceHomepage rdf:resource="{$profile.professional.web}"/>
<foaf:workInfoHomepage rdf:resource="{$profile.professional.web}"/>
{/if}
{if $profile.general.description}
<bio:olb>
{$profile.general.description|escape}
</bio:olb>
{/if}
{if $profile.general.birthday}
<bio:event>
 <bio:Birth>
  <bio:date>{$profile.general.birthday}</bio:date>
 </bio:Birth>
</bio:event>
{/if}
{if $profile.friends}
{foreach from=$profile.friends key=id_friend item=friend}
<foaf:knows>
 <foaf:Person>
  <foaf:name>{$friend.fname} {$friend.lname}</foaf:name>
  <foaf:mbox_sha1sum>{$friend.email_sha1}</foaf:mbox_sha1sum>
  <rdfs:seeAlso rdf:resource="http://{$friend.login}.dotnode.com/xml/foaf"/>
 </foaf:Person>
</foaf:knows>
{/foreach}
{/if}
</foaf:Person>
</rdf:RDF>
