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

// cookie Policy 
function setCookie(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

window.onload = function() {
	const cookiePolicy = document.getElementById('cookie-policy');
	const buttonElement = document.getElementById('cookieAgree');
	if (!getCookie('cookiePolicy')) {
		cookiePolicy.classList.remove('hidden');
	}
	buttonElement.addEventListener('click', function (event) {
	  setCookie('cookiePolicy', true, 360);
	  cookiePolicy.classList.add('hidden');
	});
};
