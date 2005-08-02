<?php

// only claim ownership if this page has no owner, and if user is logged in.
if ($this->page && !$this->GetPageOwner() && $this->GetUser())
{
	$this->SetPageOwner($this->GetPageTag(), $this->GetUserName());
	$this->SetMessage("Vous êtes maintenant le propriétaire de cette page");
}

$this->Redirect($this->href());

?>
