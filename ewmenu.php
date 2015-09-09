<?php

// Menu
define("EW_MENUBAR_VERTICAL_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "", TRUE);
define("EW_MENUBAR_RIGHTHOVER_IMAGE", "", TRUE);
?>
<?php

/**
 * Menu class
 */

class cMenu {
	var $Id;
	var $IsRoot = FALSE;
	var $NoItem = NULL;
	var $ItemData = array();

	function cMenu($id) {
		$this->Id = $id;
	}

	// Add a menu item
	function AddMenuItem($id, $text, $url, $parentid) {
		$item = new cMenuItem($id, $text, $url, $parentid);
		if (!MenuItem_Adding($item)) return;
		if ($item->ParentId < 0) {
			$this->AddItem($item);
		} else {
			if ($oParentMenu =& $this->FindItem($item->ParentId))
				$oParentMenu->AddItem($item);
		}
	}

	// Add item to internal array
	function AddItem($item) {
		$this->ItemData[] = $item;
	}

	// Find item
	function &FindItem($id) {
		$cnt = count($this->ItemData);
		for ($i = 0; $i < $cnt; $i++) {
			$item =& $this->ItemData[$i];
			if ($item->Id == $id) {
				return $item;
			} elseif (!is_null($item->SubMenu)) {
				if ($subitem =& $item->SubMenu->FindItem($id))
					return $subitem;
			}
		}
		return $this->NoItem;
	}

	// Render the menu
	function Render() {
		echo "<ul";
		if ($this->Id <> "") {
			if (is_numeric($this->Id)) {
				echo " id=\"menu_" . $this->Id . "\"";
			} else {
				echo " id=\"" . $this->Id . "\"";
			}
		}
		if ($this->IsRoot)
			echo " class=\"" . EW_MENUBAR_VERTICAL_CLASSNAME . "\"";
		echo ">\n";
		foreach ($this->ItemData as $item) {
			echo "<li><a";
			if (!is_null($item->SubMenu))
				echo " class=\"" . EW_MENUBAR_SUBMENU_CLASSNAME . "\"";
			if ($item->Url <> "")
				echo " href=\"" . htmlspecialchars(strval($item->Url)) . "\"";
			echo ">" . $item->Text . "</a>\n";
			if (!is_null($item->SubMenu))
				$item->SubMenu->Render();
			echo "</li>\n";
		}
		echo "</ul>\n";
	}
}

// Menu item class
class cMenuItem {
	var $Id;
	var $Text;
	var $Url;
	var $ParentId; 
	var $SubMenu = NULL; // Data type = cMenu

	function cMenuItem($id, $text, $url, $parentid) {
		$this->Id = $id;
		$this->Text = $text;
		$this->Url = $url;
		$this->ParentId = $parentid;
	}

	function AddItem($item) { // Add submenu item
		if (is_null($this->SubMenu))
			$this->SubMenu = new cMenu($this->Id);
		$this->SubMenu->AddItem($item);
	}
}

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
	$RootMenu->AddMenuItem(3, "Patient Detail", "patient_detail_list.php", -1);
	$RootMenu->AddMenuItem(4, "Patient Main", "patient_main_list.php", -1);
	$RootMenu->AddMenuItem(6, "Custom View 1", "customview1_list.php", -1);
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
