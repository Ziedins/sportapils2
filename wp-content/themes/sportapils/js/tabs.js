/**
 * File tabs.js.
 *
 * Handles toggling the tabs
 * tabs support for dropdown menus.
 */
( function() {
	// Get all the tabs elements within the tab navigation.
	const listTabs = document.querySelectorAll(".list-nav > .list-tab");

	// Return early if the tabs don't exist.
	if ( ! listTabs ) {
		return;
	}

	/**
	 * Sets or removes .opened class on an element.
	 */
	function toggleClass(target) {
	  const parent = target.parentElement; 
	  if (parent.classList.contains('opened')) {
	    parent.classList.remove('opened');
	  } else {
	    parent.classList.add('opened');  
	  }
	}
	// Toggle the .active class each time the tab is clicked.
	function listTabClicks(tabClickEvent) {
	  const myContentPanes = document.querySelectorAll(".list-panel");
	  const anchorReference = tabClickEvent.target;
	  const activePaneId = anchorReference.getAttribute("href");
	  const activePane = document.querySelector(activePaneId);
	  const clickedTab = tabClickEvent.currentTarget;
	  
	  for (let i = 0; i < listTabs.length; i++) {
	    listTabs[i].classList.remove("active");
	  }

	  clickedTab.classList.add("active");
	
	  toggleClass(clickedTab)
	
	  tabClickEvent.preventDefault();
	
	  for (let i = 0; i < myContentPanes.length; i++) {
	    myContentPanes[i].classList.remove("active");
	  }

	  activePane.classList.add("active");
	}

	for (i = 0; i < listTabs.length; i++) {
	  listTabs[i].addEventListener("click", listTabClicks)
	}

	// remove first button in favor of tabs
	const tabs = document.querySelectorAll('.list-tabs');
	tabs[0].previousElementSibling.querySelector('.button-wrapper.list').classList.add('paginate-links');

}() );
