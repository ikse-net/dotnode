<?xml-stylesheet href="/rss.css" type="text/css"?>
<rdf:RDF
  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
  xmlns:admin="http://webns.net/mvcb/"
  xmlns:cc="http://web.resource.org/cc/"
  xmlns="http://purl.org/rss/1.0/">

<channel rdf:about="http://{$profile.info.login}.dotnode.com/blog/">
  <title>{$profile.info.login|escape|capitalize}'s blog</title>
  <description>{$profile.info.description</description>
  <link>http://{$profile.info.login}.dotnode.com/blog/</link>
  <dc:creator>{$profile.info.fname|escape} {$profile.info.lname|escape}</dc:creator>

  <dc:rights></dc:rights>
  <dc:date>{$smarty.now|date_format:"%Y-%m-%d"}T{$smarty.now|date_format:"%H-%M-%S"}+02:00</dc:date>
  <admin:generatorAgent rdf:resource="http://dotnode.com/" />
  
  
  <items>
  <rdf:Seq>
    <rdf:li rdf:ressource="p6" />
  <rdf:li rdf:ressource="p5" />
  <rdf:li rdf:ressource="p4" />

  <rdf:li rdf:ressource="p3" />
  <rdf:li rdf:ressource="p2" />
  <rdf:li rdf:ressource="p1" />
  </rdf:Seq>
  </items>
</channel>

<item rdf:ID="p6">
  <title>.node launched</title>
  <link>http://alexx.ikse.org/blog/2004/06/18/6-NodeLaunched</link>

  <dc:date>2004-06-18T15:14:04+00:00</dc:date>
  <dc:creator>Alexx</dc:creator>
  <dc:subject>Developpement</dc:subject>
  <description>Tout le monde en parle déjà sauf moi ...
.node, le réseau social d'origine française à vocation
internationale a été lancé publiquement le 16 juin 2004.
...</description>
</item>
<item rdf:ID="p5">
  <title>SideBar Generator 2...</title>

  <link>http://alexx.ikse.org/blog/2004/04/08/5-SidebarGenerator2</link>
  <dc:date>2004-04-08T16:04:59+00:00</dc:date>
  <dc:creator>Alexx</dc:creator>
  <dc:subject>Developpement</dc:subject>
  <description>Toujours plus fort ...
A présent, le générateur de panel gère le champs
'description' du RSS ...
De plus, un cache permet de decharger le serveur du RSS
distant en le stockant pour 10 minutes.
Enfin, l'UTF8 est correctement supporté. ...</description>
</item>
<item rdf:ID="p4">

  <title>IE respecte les normes W3C les plus récentes</title>
  <link>http://alexx.ikse.org/blog/2004/03/24/4-IeRespecteLesNormesW3cLesPlusRecentes</link>
  <dc:date>2004-03-24T12:09:18+00:00</dc:date>
  <dc:creator>Alexx</dc:creator>
  <dc:subject>Coup de gueule</dc:subject>
  <description>Nan, ca, c'etait une blague ...
Par contre, quand il n'aime pas qqchose, il le fait bien
savoir !

Pour preuve, la page : http://iebug.ikse.org ...</description>

</item>
<item rdf:ID="p3">
  <title>Re: Google censuré par la république bananière Française !</title>
  <link>http://alexx.ikse.org/blog/2004/03/23/3-ReGoogleCensureParLaRepubliqueBananiereFranaise</link>
  <dc:date>2004-03-23T21:48:43+00:00</dc:date>
  <dc:creator>Alexx</dc:creator>
  <dc:subject>Coup de gueule</dc:subject>

  <description>Marre des paranoïaques ... ...</description>
</item>
<item rdf:ID="p2">
  <title>Créer ses propres Panels/SideBars à partir de RSS/RDF</title>
  <link>http://alexx.ikse.org/blog/2004/03/09/2-CreerSesPropresPanelssidebarsAPartirDeRssrdf</link>
  <dc:date>2004-03-09T22:45:47+00:00</dc:date>
  <dc:creator>Alexx</dc:creator>

  <dc:subject>Developpement</dc:subject>
  <description>Je me suis amusé ce soir à faire un générateur de
Panel/SideBar pour Mozilla/Fire[bird|fox]/Galeon à partir
des RSS/RDF que l'on peut trouver de plus en plus souvent
sur les sites de news (linuxfr en tete bien sur ;), mais
aussi libération, clubic.com ...)

Pour tester, c'est par ici :
http://alexx.ikse.org/?p=create ...</description>
</item>
<item rdf:ID="p1">
  <title>SCO Connerie Observée (notez la recursion ;) )</title>
  <link>http://alexx.ikse.org/blog/2004/01/31/1-ScoConnerieObserveeNotezLaRecursion</link>
  <dc:date>2004-01-31T21:19:20+00:00</dc:date>

  <dc:creator>Alexx</dc:creator>
  <dc:subject>Juste pour rire ...</dc:subject>
  <description>Nos amis SCO (sco.com je me demande pourquoi je le precise)
devraient préciser la phrase qui est sur leur page
d'accueil :
"MyDoom virus alert - Be caution about opening emails with
attachments."
ainsi :
"MyDoom virus alert - Under Microsoft(r) Windows(c)(tm) All
version : Be caution about opening emails with attachments."
...</description>
</item>

</rdf:RDF>
