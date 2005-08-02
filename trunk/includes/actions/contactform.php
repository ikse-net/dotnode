<?php
/****************************************************** Open .node ***
 * Description:   
 * Status:        Stable.
 * Author:        Alexandre Dath <alexandre@dotnode.com>
 * $Id$
 *
 * Copyright (C) 2005 Alexandre Dath <alexandre@dotnode.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 ******************** http://opensource.ikse.net/projects/dotnode ***/

// Action d'envoi d'email par un formulaire

if( array_key_exists('rval', $_GET) )
{
        switch($_GET['rval'])
        {
        case 0:
                print "L'email a été envoyé avec succés.";
		break;
	case 99:
		print "L'email que vous avez indiquez n'est pas valide.<br />\n";
		break;
	case 999:
		print "Erreur inconnu\n";
		break;
        default:
		print $_GET['rval'];
        }
}
else
{
        print "<div id='contactform'>\n";
        print "<form action='/action.php' method='post'><br />\n";
        print "<label for='nom'><b>Nom :</b></label><br /><input id='nom' name='nom'><br />\n";
        print "<label for='societe'><b>Société :</b></label><br /><input id='societe' name='societe'><br />\n";
        print "<label for='adresse'>Adresse :</label><br /><textarea id='adresse' name='adresse' cols='30' rows='4'></textarea><br />\n";
	print "<label for='cp'>Code Postal :</label><br /><input id='cp' name='cp' /><br />\n";
        print "<label for='ville'>Ville :</label><br /><input id='ville' name='ville' /><br />\n";
        print "<label for='tel'>Tel :</label><br /><input id='tel' name='tel' /><br />\n";
        print "<label for='fax'>Fax :</label><br /><input id='fax' name='fax' /><br />\n";
        print "<label for='email'><b>Email :</b></label><br /><input id='email' name='email' /><br />\n";
	print "<label for='sujet'><b>Sujet de l'email :</b></label><br /><input id='sujet' name='sujet' /><br />\n";
        print "<label for='contenu'><b>Contenu de l'email :</b></label><br />\n";
        print "<input type='hidden' name='rurl' value='".$_SERVER["PHP_SELF"]."' />\n";
        print "<input type='hidden' name='p' value='static' />\n";
        print "<input type='hidden' name='s' value='contact' />\n";
        print "<input type='hidden' name='a' value='email' />\n";
        print "<textarea id='contenu' name='contenu' cols='70' rows='10'></textarea><br />\n";
	print "<input type='submit' name='submit' value='Envoyer' />\n";
        print "</form>\n";
        print "</div>\n";
}


?>
