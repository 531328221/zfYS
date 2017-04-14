require.config({
	baseUrl: "static/js",
	paths: {
		"jquery"    : "jquery",
		"jquery/ui" : "jquery/jquery-ui-1.9.2"
	}
});
define('globalfun',[], function ($) {
	"use strict";
	/*添加样式*/
	function checkAddClass(el, $class) {
		if(!el.hasClass($class)) {
			el.addClass($class);
		}
	}

	/*移除样式*/
	function checkRemoveClass(el, $class) {
		if(el.hasClass($class)) {
			el.removeClass($class);
		}
	}

}
);
define('pmenubar', [
	'jquery',
	'jquery/ui',
	'globalfun'
], function($){
	'use strict';

	$.widget('ys.personalMenuBar', {
		options: {
			selectors: {
				menu: "#nav",
				currentItem: '._current',
				topLevelItem: '.level-0',
				topLevelHref: '> a',
				subMenu:'> .submenu',
				closeSubmenuBtn: '[data-role="close-submenu"]'
			},
			overlayTmpl: '<div class="personal__menu-overlay"></div>'
		},

	_create: function() {
		var selectors = this.options.selectors;
		this.menu = this.element;
		this.menuLinks = $(selectors.topLevelHref, selectors.topLevelItem);
		this.closeActions = $(selectors.closeSubmenuBtn);

		this._initOverlay()
			._bind();
	},

	_initOverlay: function() {
		this.overlay = $(this.options.overlayTmpl).appendTo('body').hide(0);

		return this;
	},

	_bind: function() {
		var focus = this._focus.bind(this),
			open  = this._open.bind(this),
			blur  = this._blur.bind(this),
			keyboard = this._keyboard.bind(this);

			this.menuLinks 
				.on('focus', focus)
				.on('click', open);

			this.menuLinks.last().on('blur', blur);
			this.closeActions.on('keydown', keyboard);
	},

	_blur: function(e) {
		var selectors = this.options.selectors,
		menuItem = $(e.target).closest(selectors.topLevelItem),
		currentItem = $(selectors.menu).find(selectors.currentItem);

		menuItem.removeClass('_active');
		currentItem.addClass('_active');
	},

	_keyboard: function(e) {
		var selectors = this.options.selectors,
		menuItem = $(e.target).closest(selectors.topLevelItem);

		if(e.which == 13) {
			this.close(e);
			$(selectors.topLevelHref, menuItem).focus();
		}
	},

	_focus: function(e) {
		var selectors = this.options.selectors,
		menuItem = $(e.target).closest(selectors.topLevelItem);

		menuItem.addClass('_active')
			.siblings(selectors.topLevelItem)
			.removeClass('_active');
	},

	_closeSubmenu: function(e) {
		var selectors = this.options.selectors,
		currentItem = $(selectors.menu).find(selectors.currentItem);
		this._close(e);

		currentItem.addClass('_active');
	},

	_open:function(e) {
		var selectors = this.options.selectors,
		menuItemSelectors = selectors.topLevelItem,
		menuItem = $(e.target).closest(menuItemSelectors),
		subMenu = $(selectors.subMenu,menuItem),
		close = this._closeSubmenu.bind(this),
		closeBtn = subMenu.find(selectors.closeSubmenuBtn);

		if(subMenu.length) {
			e.preventDefault();
		}

		menuItem.addClass('_show')
			.siblings(menuItemSelectors)
			.removeClass('_show');

		subMenu.attr('ys-expanded', true);

		closeBtn.on('click', close);

		this.overlay.show(0).on('click', close);
		this.menuLinks.last().off('blur');
	},

	_close: function(e){
		var selectors = this.options.selectors,
		menuItem = this.menu.find(selectors.topLevelItem),
		subMenu = $(selectors.subMenu, menuItem),
		closeBtn = subMenu.find(selectors.closeSubmenuBtn),
		blur = this._blur.bind(this);

		e.preventDefault();

		this.overlay.hide(0).off('click');

		this.menuLinks.last().on('blur', blur);

		closeBtn.off('click');

		subMenu.attr('ys-expanded', 'false');

		menuItem.removeClass('_show _active');
	}
});

return $.ys.personalMenuBar;
});

define('initWidgets',[
	'pmenubar'
],function(){
	$('.menu-wrapper').personalMenuBar();
});
require(['initWidgets']);