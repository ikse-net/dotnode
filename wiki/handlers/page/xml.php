<?php
if ($HasAccessRead=$this->HasAccess("read"))
{
// TODO : Return an empty xml ?
// TODO : Return an error read (noaccess) xml ?
	if ($this->page)
	{
		// display page
		print($this->Format($this->page["body"], "action"));
	}
}
?>
