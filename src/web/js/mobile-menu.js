if (typeof andrewdanilov === "undefined" || !andrewdanilov) {
	var andrewdanilov = {};
}

andrewdanilov.mobileMenu = {
	wrapperId: '',
	showNavbar: false,
	init: function() {
		var menu = jQuery('#' + andrewdanilov.mobileMenu.wrapperId);
		if (menu.length) {
			menu.mmenu({
				"slidingSubmenus": false,
				"navbar": {
					"add": andrewdanilov.mobileMenu.showNavbar
				}
			});
		}
	}
};