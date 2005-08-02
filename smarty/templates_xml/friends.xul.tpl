<?xml-stylesheet href="chrome://global/skin/" type="text/css"?>
<window
	id="friends"
	title="Friends .node"
	orient="vertical"
	xmlns="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul" > 

	<tree id="friend-tree" enableColumnDrag="true" flex="1" datasources="rdf/friends.rdf?{0|@rand:1000}" ref="http://dotnode.com/my-friends" flags="dont-build-content">
		<treecols>
			<treecol id="FName" label="First name" primary="true" flex="1"/>
			<splitter/>
			<treecol id="LName" label="Last name" flex="1"/>
			<splitter/>
			<treecol id="NName" label="Nick name" flex="1"/>
		</treecols>

		<template>
			<rule>
				<treechildren flex="1">
					<treeitem uri="rdf:*" open="true">
						<treerow>
							<treecell label="non rdf:http://dotnode.com/rdf#fname"/>
							<treecell label="rdf:http://dotnode.com/rdf#lname"/>
							<treecell label="rdf:http://dotnode.com/rdf#nick"/>
						</treerow>
					</treeitem>
				</treechildren>
			</rule>
		</template>
	</tree>

	<tree id="communities-tree" enableColumnDrag="true" flex="1" datasources="rdf/communities.rdf?{0|@rand:1000}" ref="http://dotnode.com/my-communities" flags="dont-build-content">
		<treecols>
			<treecol id="Name" label="Name" primary="true" flex="1"/>
			<splitter/>
			<treecol id="Descrption" label="Description" flex="1"/>
		</treecols>

		<template>
			<rule>
				<treechildren flex="1">
					<treeitem uri="rdf:*">
						<treerow>
							<treecell label="rdf:http://dotnode.com/rdf#name"/>
							<treecell label="rdf:http://dotnode.com/rdf#description"/>
						</treerow>
					</treeitem>
				</treechildren>
			</rule>
		</template>
	</tree>


</window>
