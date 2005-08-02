<div class="page">
<?php

if ($this->UserIsOwner())
{
	if ($pages = $this->IsOrphanedPage($this->GetPageTag()))
	{
		foreach ($pages as $page)
		{
			$this->DeleteOrphanedPage($this->GetPageTag());
		}
	}
	else
	{
		print("<i>This is not an orphaned page.</i>");
	}

}
else
{
	print("<i>You're not the owner of this page.</i>");
}

?>
</div>
