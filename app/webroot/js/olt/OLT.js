if (typeof MSECS === 'undefined') {
	const MSECS = "milliseconds"
}
if (typeof SECS === 'undefined') {
	const SECS = "seconds"
}
if (typeof MINS === 'undefined') {
	const MINS = "minutes"
}
if (typeof HRS === 'undefined') {
	const HRS = "hours"
}
if (typeof SVG === 'undefined') {
	const SVG = '.svg';
}
if (typeof NOT_FOUND === 'undefined') {
	const NOT_FOUND = "NOT_FOUND"
}
// todo: create keyboard shortcuts (library already downloaded, jQuery.hotKeys, and it's from John Resig whose name you seem to know...
// todo: create custom error classes that can fire events/have listeners in order to simulate a raise() call (http://www.nczonline.net/blog/2009/03/03/the-art-of-throwing-javascript-errors/)
var OLT = {
	init: function (layout) {
		if ($("#developer-output").length  != 0 ) {
			$("#developer-output").on('click', function() {
					$(this).addClass('active');
			});
		}

		if ( $(".tutorial-window").length > 0) {
			OLT.fn.tutorial.init();
		}

		if (window.local) OLT.local = window.local;

		OLT.layout = layout; // literally, the name of the rendered cakephp layout

		if (layout == 'lab') {
			OLT.data.rset = new Rset($("body").data("rsetId"));
		}

		var sitrep = {
			evlns: OLT.fn.binds.init(),
			layout: OLT.fn.layout.init()
		};
		for (key in sitrep.keys) {
			if (key !== true) {
				OLT.fn.flash("OLT system failure; launch aborted.");
				throw "OLT.init() failed: " + key;
			}
		}
		if ("fetchList" in OLT.local) {
			for (key in OLT.local.fetchList) {
				if ( OLT.local.fetchList.hasOwnProperty(key) ) {
					OLT.local[key] = OLT.fn.util.fetchWithin(OLT.local.fetchList[key]);
				}
			}
		}
		if ("init" in OLT.local && isFunction(OLT.local.init) ) OLT.local.init();
		return true;
	},
	local:{},// for functions and vars only defined in and exclusively used by the current slide; loaded at OLT.init()
	data: {
		layout: null,
		rset: null,
		twins: null,
		pagevars:null, //todo: this should have been in OLT.manifest the whole time...
		svg: {
			__list:['arrowLabel']
		}
	},
	cfg: { // probably this should just mirror a PHP array, and should be populated by an AJAX call on init
		const: {
			path: {
				www: exists("WWW") ? WWW : "localhost",
				webroot:WWW
			},
			html5VLock: {
				until: null,
				since: null,
				all: true,
				forward: false,
				backward: false,
				postInterval: false,
				preInterval: false,
				withinInterval: false,
				release: true,
				secureRelease: true
			}
		},
		html5v: {
			defaultLockSettings: {
				allow: {
					play:true,
					refresh:true,
					jump:true,
					jumpBy:false,
					jumpTo:true,
					pause:true,
					playFor:false
				},
				except: {
					playFor:true
				}
			}
		},
		layout: {
			slideNavInit: false,
			flashContentSelector:"#flash-content-container",
			flashMessageSelector:"#flash-content",
			flashWidth:600
		},
		rUI: {
			baseSelector: ".olt-rui",
			field: ".olt-rfield"
		},
		requiredFieldSelector: "form *[data-required]",
		pagevarSelector: ".pagevar.menu",
		pagevarOptionSelector: "li[data-pagevar-opt]",
		paramOptionSelector: ".olt-param.olt-option",
		navFormSelector: "#LabNavForm",
		navTargetSelector: "#LabNavTarget",
		navRequestSelector: "#LabNavRequest",
		navClass: ".pagenav.enabled",
		labFinalizeSelector: ".lab-finalize-button",
		labFooter: "#footer.labnav",
		contentSelector: "#content",
		slideSectionSelector: "section.slide-section",
		slideSectionContentSelector: "section.slide-section div.slide-section-content:first-of-type",
		slideTitleSectionSelector: "section#slide-title_section",
		slideNavAnchorSelector: "li.slide-nav-anchor",
		instructionsContentSelector:"div.slide-section-content",
		instructionsInnerContentSelector:"div.slide-section-content div.instructions-content div.instructions-inner-content",
		labHeaderSelector: "#header",
		html5vBaseSelector: ".html5v",
		html5vControlSelector: ".html5v-control",
		html5vControlbarSelector: ".html5v .player-skin",
		html5vPlayerSelector: ".html5v-player"
	},
	e: {
		playForEnd: eCustom("playForEnd"),
		firstPlay: eCustom("firstPlay"),
		intervalChange: eCustom("intervalChange"),
		jumpTo: eCustom("jumpTo"),
		pagevarUpdate: eCustom("pagevarUpdate")
	},
	manifest: {
		html5v: {},
		params: {
			global: {},
			local: {}
		},
		ticket: {}
	},
	fn: {
		tutorial: {
			current:0,
			steps: [],
			init: function() {
				$(".tutorial-window").each(function() {
					var data = $(this).data();
					var tutorialOb = {
						element:this,
						top: null,
						left: null
					};
					var twWidth = 300;
					var twPadding = "2rem";

					if (data.id == "TUTORIAL_START" || data.id == "TUTORIAL_END") {
						tutorialOb.left = (window.outerWidth - twWidth) / 2;
						tutorialOb.top = 300;
						tutorialOb.bottom = false;

					} else {
						var id = asId(data.id);
						var anchorPos = $(id).offset();
						var anchorWidth = $(id).outerWidth();
						var anchorHeight = $(id).outerHeight();
						var horizontalPadding = 16;
						var verticalPadding = 16;
						tutorialOb.left = anchorPos.left + horizontalPadding;
						tutorialOb.top = anchorPos.top + verticalPadding;
						switch (data.register) {
							// todo: implement other registrations (ie. those not needed in demo lab)
							case "top":
								tutorialOb.left -= anchorPos.left / 2;
								tutorialOb.top = false;
								tutorialOb.bottom = anchorHeight;
								break;
							case "top-right":
								tutorialOb.left += anchorWidth;
								tutorialOb.top = false;
								tutorialOb.bottom = anchorHeight + verticalPadding;
								break;
							case "right":
								tutorialOb.left += anchorWidth;
								tutorialOb.top -= (anchorHeight / 2 ) + verticalPadding;
								break;
							case "bottom-left":
								tutorialOb.left -= twWidth + horizontalPadding;
								tutorialOb.top -= anchorHeight + verticalPadding;
								break;
						}
					}
					$(tutorialOb.element).on("click", OLT.fn.tutorial.advance);
					OLT.fn.tutorial.steps.push(tutorialOb);
				});
				OLT.fn.tutorial.advance()
			},
			advance: function() {
				var current = OLT.fn.tutorial.current;
				var last = current - 1;
				if (last >= 0) {
					var lastStep = OLT.fn.tutorial.steps[last];
					$(lastStep.element).fadeOut(150);
				}
				var step = OLT.fn.tutorial.steps[current];
				var height = 0;
				$(step.element).css({position:"fixed", left:-9999}).show( function() {
					var content = $(step.element).children(".joyride-content-wrapper")[0];
					height = $(content).innerHeight();
					$(step.element).hide();
				});
				if (step.top != false) {
					$(step.element).addClass("tutorial-tip-guide").css({
						top:step.top,
						height:height,
						left:step.left,
						position:"fixed",
						zIndex:99999
					}).fadeIn(300);
				} else {
//					pr($(content).innerHeight());
					$(step.element).addClass("tutorial-tip-guide").css({
						bottom:step.bottom,
						height:height,
						left:step.left,
						position:"fixed",
						zIndex:99999
					}).fadeIn(300);
				}
				OLT.fn.tutorial.current++;
			},
			complete: function() {
			}

		},
		/**
		 * flash Method
		 *
		 * @desc Similar to CakePHP's function of the same name, targets same layout element.
		 *       Possible types include:
		 *          - Message
		 *          - Error
		 *          - Success
		 *          - Warning
		 *          - Alert
		 * @param message
		 * @returns {boolean}
		 */
		flash: function (message, type) {
			if (arguments.length == 0) {
				$(OLT.cfg.layout.flashMessageSelector).html('');
				$(OLT.cfg.layout.flashContentSelector).fadeOut();
				return true;
			}
			if (arguments.length == 1) {
				message = arguments[0];
				type = "message"
			}
			if (arguments.length > 1) {
				type = arguments[1];
			}
			//todo: provide some interface for controlling presentation of message

			$(OLT.cfg.layout.flashMessageSelector).html(message);
			$(OLT.cfg.layout.flashContentSelector).fadeIn();
			return true;
		},


		/**
		 * issueTicket method
		 *
		 * @desc Logs a ticket to OLT.manifest.manifest and returns it to the requesting method.
		 * @param category The category
		 * @param issuedBy
		 * @param reissuable
		 * @returns {string}
		 */
		issueTicket: function (category, issuedBy, reissuable) {
			category = typeof(category) === "string" ? category : 'global';
			var ticket = new Ticket(category, issuedBy, reissuable);
			// keep a copy... as of this writing it just seems like a good idea, it's not to be used (yet)
			OLT.manifest.ticket[ticket.id] = ticket;
			return ticket;
		},


		/**
		 * resolveOpenTickets method
		 *
		 * @desc If it is found, sets a ticket's open property to false (see OLT.manifest.ticket)
		 * @param player
		 * @param method
		 * @param count
		 * @returns {bool}
		 */
		resolveOpenTickets: function (player, method, count) {
			var ticket;
			var success = true;
			count = count ? count : 1;
			if (count === "*" || method === "*") { // count == infinite || every ticket is resolving
				count = 1000000; // effectively infinite;
			} else if (!count) {
				count = 1;
			}
			if (typeof(count) != "number") {
				throw "Error: argument count must be an integer but " + typeof(count) + " was received.";
			}

			for (var ticket_id in player.tickets) {
				ticket = OLT.manifest.ticket[ticket_id];
				if (method === "*" || count > 0) {
					if (ticket.issuingMethod === method) {
						if (ticket.resolve()) {
							count--;
							delete player.tickets[ticket.id];
							if (ticket.id === player.engTicket) {
								player.locked = false;
								player.engaged = false;
								player.engagedWith = null;
								player.engTicket = null;
							}
						} else {
							success = false;
						}
					}
				}
			}
			if (!success) {
				throw "Error: couldn't resolve all tickets targeted.";
			}
			return true;
		},


		/**
		 * navigate method
		 * @desc
		 * @returns {boolean}
		 */
		navigate: function () {

			var target = $(this).data("target");
			var request = $(this).data("request");
			var executeNav = request == "next" ? OLT.fn.checkAdvacementReqs() : true;
			if (executeNav) {
				$(OLT.cfg.navRequestSelector).val(request);
				$(OLT.cfg.navTargetSelector).val(target);
				$(OLT.cfg.navFormSelector).submit();
			}

			return true;
		},
		checkAdvacementReqs: function() {
			debug = true;
			var complete = true;
			OLT.data.rset.refresh();
			$(OLT.cfg.requiredFieldSelector).each(function() {
				var name = $(this).attr("name");
				if (debug) pr(name, "checkAdvancementReqs: name");
				if (!OLT.fn.rUI.isSet(name, true)) complete = false
			});

			if (!complete) {
				OLT.fn.flash("You must complete this slide before advancing.");
				return false;
			} else {
				OLT.fn.flash();
				return true;
			}
		},


/*******************************************************************************************************************************
																														  LAYOUT
*******************************************************************************************************************************/
		layout: {

			init: function() {
				var sections = function() {
						$(OLT.cfg.slideSectionSelector).each( function() {
							if ( $(this).innerHeight() < window.innerHeight ) {
								$(this).css('height', window.innerHeight);
							}
						});
					};

				var expandedButtonGroups = function() {
						$("ul.expanded-button-group").each( function() {
							var children = $(this).children().length;
							var width = $(this).innerWidth();
							var childWidth = children / width;
							$(this).children().each(function() {
									$(this).css('width', childWidth);
							})
						});
				};


				var revealSlide = function () {
						$(OLT.cfg.contentSelector).fadeIn(300);
						return true;
				};

				var actionables = function() {
					var debug = false;
					if (debug) pr(OLT.local);
					$("*.actionable").each(function() {
						try {
							var data = $(this).data();
							var event = data.on;
							var action = null;
							var args = {};
							if (debug) pr(this, "OLT.layout.actionables.each.this");
							if (debug) pr(data, "OLT.layout.actionables.each.data");
							if ( typeof(data.do) != "string" ) {
								var action = data.do.action;
								var args = data.do.args;
								if (!isFunction(action) ) {
									action = OLT.fn.util.fetchWithin(action);
									if (!isFunction(action) ) {
										throw "Couldn't find {0} within the context of OLT.".format(data.do.action);
									}
								}
							} else {
								action = OLT.fn.util.fetchWithin(data.do);
							}
							$(this).on(event, null, args, action);
						} catch(e) {
							pr(e);
							OLT.fn.flash("Some functionality requested by elements of this page was not found to be actionable; this may cause a serious problem. If refreshing the page dose not resolve the issue, please contact an administrator. Proceeding from this point may not be advisable, especially if you are currently working with sensitive data. We apologize for the inconvenience.");
						}

					});
					};

				var nav = function() {
						$("#reveal-slide-nav button").on("click", function() {
								$(this).toggleClass("revealed");
								$("aside#nav").toggleClass("revealed");
						});

					return true;
				};

				var flash = function() {
					$(OLT.cfg.layout.flashContentSelector).css({
						top:0.25 * window.outerHeight,
						left:(window.outerWidth - OLT.cfg.layout.flashWidth)/2
					});
					return true;
				};

				var sitRep = {
					sections: sections(),
					expandedButtonGroups: expandedButtonGroups(),
					actionables: actionables(),
					nav: nav(),
					flash: flash()
				};
				for (key in sitRep.keys) {
					if (key !== true) {
						throw "OLT.init() failed: " + key;
					}
				}

				return revealSlide();
			},

			hide: function(target_id, method) {
				var scrollPos = null;
				if (isEvent(arguments[0]) ) {
					var e = arguments[0];
					target_id = e.data.target_id;
					method = e.data.method;
				}
				pr(target_id);
				pr(OLT.cfg.layout.flashContentSelector);
				if (target_id == OLT.cfg.layout.flashContentSelector) scrollPos = $(window).scrollTop();
				if (!method) {
					$(asId(target_id)).hide();
				} else {
					switch (method) {
						case "fade":
							$(asId(target_id)).fadeToggle();
							break;
					}
				}
				if (scrollPos) $(window).scrollTop(scrollPos);
			},

			hideFlash: function() {
				$(OLT.cfg.layout.flashContentSelector).fadeOut();
				$(OLT.cfg.layout.flashMessageSelector).html('');
			},




			 /**
			 * contentHeight method
			 * @returns {boolean}
			 */
			contentHeight: function () {
				$(window).on("resize", OLT.fn.layout.resectionalize);
				return true
			},


			resectionalize: function() {
				$(OLT.cfg.slideSectionSelector).each( function() {
					$(this).css('height', window.innerHeight);
				});
			},


			pairTwins: function() {
				OLT.data.twins = {};
				$("*[data-twin]").each( function() {
					var key = $(this).data("twin-key");
					var id = $(this).attr('id');

					// uses id attribute for comparisons; create one if needed
					if (!id) {
						id = OLT.fn.util.generateUID();
						$(this).attr('id', id);
					}
					if ( !(key in OLT.data.twins) ) {
						OLT.data.twins[key] = {twinOne:null, twinTwo:null};
					}
					if (OLT.data.twins[key].twinOne === null) {
						OLT.data.twins[key].twinOne = id;
					} else {
						OLT.data.twins[key].twinTwo = id;
					}
				}); // if (twins[key].twinTwo === null)

				for (key in OLT.data.twins) {
					$( asId(OLT.data.twins[key].twinOne) ).on('resize', null, OLT.data.twins[key], OLT.fn.util.refreshTwins);
					$( asId(OLT.data.twins[key].twinTwo) ).on('resize', null, OLT.data.twins[key], OLT.fn.util.refreshTwins);
					//$(window).on('resize', null, OLT.data.twins[key], OLT.fn.util.refreshTwins);

					//OLT.fn.util.refreshTwins(OLT.data.twins[key]);
				}
				return true;
			},
			updateNavScroll: function(sectionId) {
				if (isEvent(arguments[0])) {
					var e = arguments[0];
					sectionId = asId(e.data.sectionId);
				}
				var navSelector = "#slide-nav-content li[data-scroll-to='#"+sectionId+"']";
				if ( $(asId(sectionId)).scrollTop()>=$(navSelector).position().top) {
					$("#slide-nav-content li").each(function() {
						$(this).removeClass('active');
					});
					$(asId(sectionId)).addClass('active');
			    }
			}
		},
/*******************************************************************************************************************************
																														   BINDS
*******************************************************************************************************************************/
		binds: {
			init: function () {
				var sitrep = {
					pageNav: OLT.fn.binds.pageNav(),
					contentHeight: OLT.fn.layout.contentHeight(),
					html5videoInit: OLT.fn.binds.html5VInit(),
					responseUI: OLT.fn.binds.responseUI(),
					twins: OLT.fn.layout.pairTwins(),
					pagevars: OLT.fn.binds.initPageVars()
				};
				for (key in sitrep) {
					if (key === false) {
						throw "OLT could not start; binds.init() failed at:" + key;
					}
				}

				return true;
			},

			/**
			 *
			 * @returns {boolean}
			 */
			initPageVars: function() {
				var debug = false;

				//todo: right now this can only parse from & bind to ul & li elements; expand in the future
				OLT.data.pagevars = {};
				// get a reference to every element that uses a pagevar so as to only walk the entire DOM once
				var elements = [];
				$("*[data-pagevar]").each(function() {
						elements.push(this);
				});

				// then get all pagevar menus and map them to OLT.data
				$(OLT.cfg.pagevarSelector).each( function() {
					var pagevar = $(this).data("forPagevar");
					OLT.data.pagevars[pagevar] = {
							active:false,
							options:{},
							domElements:[]
					};
					$(this).children(OLT.cfg.pagevarOptionSelector).each( function() {
						var data = $(this).data();
						if (debug) pr(data,pagevar);
						OLT.data.pagevars[pagevar].options[data.pagevarOpt] = {name:data.pagevarOpt, properties:data.optProperties};
						if (data.active === 1) {
							OLT.data.pagevars[pagevar].active = data.pagevarOpt;
						}
						$(this).on("click", null, {pagevar:pagevar, option:data.pagevarOpt, properties:data.optProperties}, OLT.fn.util.setPagevar);
					});
				});
				// finally, group all pagevar elements by their respective pagevars such that
				// updating a pagevar only requires iterating over a known list
				$(elements).each(function() {
					var pagevar = $(this).data("pagevar");
					pagevar = pagevar.split(".");
					OLT.data.pagevars[pagevar[0]].domElements.push(this);
				});
				if (debug) pr(OLT.data.pagevars, "OLT.data.pagevars");
				return true;
			},


			/**
			 * pageNav method
			 * @returns {boolean}
			 */
			pageNav: function () {
				$("#slide-nav-toggle").on("click", function() {
						$("#slide-nav-hidden-switch").trigger("click");
						if ($(this).hasClass("open")) {
							$(this).animate({left:"0px"}, 300, "linear").removeClass("open");
						} else {
							$(this).animate({left:"250px"}, 300, "linear").addClass("open");
						}

				});

				if (OLT.layout != "lab") return true;
				$(OLT.cfg.navClass).on("click", null, OLT.fn.navigate);
				$(OLT.cfg.slideNavAnchorSelector).on("click", function() {
					$(OLT.cfg.slideNavAnchorSelector).each(function() {
						$(this).removeClass('active');
					});
					$(this).addClass('active');
					var target = $(this).data('scrollTo');
						$('html,body').animate({scrollTop: $(target).offset().top},500, "easeOutCubic");
				});
				$(OLT.cfg.labFinalizeSelector).on("click", OLT.fn.rUI.finalize);

				$('html,body').animate({scrollTop: $("#slide-title_section").offset().top},300, "easeOutCubic");
				return true
			},






			/**
			 * html5VInit method
			 *
			 * @desc Locate and initialize HTML5 video with OLT event listeners & data structures, then add them to OLT.manifest
			 * @returns {boolean}
			 */
			html5VInit: function () {
				$(OLT.cfg.html5vPlayerSelector).each(function () {
					var id = $(this).attr('id');
					var data = $(this).data();
					var player = this;

					player.__id = stripCssDelimeters(id);
					player.locked = false;
					player.engaged = false;
					player.engagedWith = null;
					player.engTicket = null;
					player.tickets = [];
					player.firstPlayInvoked = false;
					player.oltControls = data.controls;
					player.clock = stripCssDelimeters(id + "_clock");
					player.clockTime = 0;
					player.interval = null; // when set, is object formatted thus: {value: <val>, list:{0:time1,1:time2,...}}
					player.expectedDuration = data.duration;
					player.volume = .75;
					player.defaultMuted = false;
					player.cloneInterval = function() {
						return {index:player.interval.current.index, time:player.interval.current.time};
					};
					player.intervalTime = function(index) {
						if (!index) index = player.interval.current.index;
						if (typeof(index) == "string") {
							var operator = index[0];
							var value = Number(index.substr(1));
							if  (operator == "+") {
								index = player.interval.current.index + value;
							} else {
								index = player.interval.current.index - value;
							}
						}
						return player.interval.list[index];
					};
					player.intervalStr = function( padSize, padChar, padDir, prefix, suffix) {
						if (!padSize) padSize = 0;
						if (!padChar) padChar = 0;
						if (!padDir) padDir = 1;
						var output = strpad(player.intervalTime(), padSize, padChar, padDir)
						if (prefix) {
							if (suffix) {
								return "{0}{1}{3}".format(prefix, output, suffix);
							} else {
								return "{0}{1}".format(prefix, output);
							}
						} else {
							if (suffix) {
								return "{0}{1}".format(output, suffix)
							} else {
								return output;
							}
						}
					};

					//todo: split this into several statements so the user can be alerted to the error of using do/or without its pair
					if (data.on && data.do) {
						var evln = OLT.fn.util.fetchWithin(data.do, OLT);
						var e = OLT.fn.util.fetchWithin(data.on, OLT);
						$(player).on(e.type, null, {player:player}, evln);
					}

					if ( data.intervalize ) { OLT.fn.av.__intervalize(player, data.intervalize) }

					$(player).on("firstPlay", null, {player:player}, OLT.fn.av.__postFirstPlay);
					$(player).on("playForEnd", OLT.fn.binds.onPlayForEnd);
					OLT.manifest.html5v[id] = player;


					// bind click listeners to each ui button; bind a reference to the player to each so it exists in the event's data
					$(OLT.cfg.html5vControlSelector).each(function () {
						var data = $(this).data();
						if ( !("bind" in data) && !data.bind == false) {
							throw "Control not bound to an action; cannot be fired.";
						}
						data.player = OLT.manifest.html5v[data.for]; // switches string for actual obj
						if (typeof(data.action) == "string" ) {
							$(this).on(data.bind, null, data, OLT.fn.av[data['action']]);
						}
					});
				});

				return true;
			},


			responseUI: function () {
				$(OLT.cfg.rUI.baseSelector).each(function () {
					var rUIObject = this;
					var data = $(this).data();
					switch (data['type']) {
						case "decrementer":
							$(this).on(data['bind'], null, data, OLT.fn.rUI.updateCounter);
							break;
						case "incrementer":
							$(this).on(data['bind'], null, data, OLT.fn.rUI.updateCounter);
							break;
						case "save":
							$(this).on("click", null, {target:data.target, write:data.write, sourceElement:this}, OLT.fn.rUI.save);
							break;
						case "display":
							// do nothing!
							break;
						case "counter":
							//todo: this is an ad-hoc feature that will probably need to be generally available to all RUI elements

							if (data.activate) {
								$(asId(data.activate.target)).on(data.activate.event, null, {element:rUIObject}, OLT.fn.rUI.activateRUIElement);
							}
							if (data.deactivate) {
								$(asId(data.deactivate.target)).on(data.deactivate.event, null, {element:rUIObject}, OLT.fn.rUI.deactivateRUIElement);
							}
							break;
						default:
							// dick all
							break;
					}
				});
			},


			/**
			 * onFirstPlay method
			 *
			 */
			onTimeUpdate: function (player_id) {


			},


			/**
			 * onPlayForUpdate method
			 *
			 * @desc
			 * @returns {boolean}
			 */
			onPlayForUpdate: function () {
				var remove_listener = false;
				var player = this;

				// remove listener if called out of context (ie. player is not engaged)
				if (!player.engaged) {
					remove_listener = true;
				} else {
					var now = player.currentTime;
					remove_listener = (now - player.until) > 0;
					$(player).data("locked", player.release);
				}
				if (remove_listener) {
					$(player).off("timeupdate", OLT.fn.binds.onPlayForUpdate);
					$(player).trigger(OLT.e.playForEnd, player);
				}
				return true;
			},


			/**
			 * onPlayForEnd method
			 *
			 * @desc
			 * @param e
			 * @param player
			 * @returns {boolean}
			 */
			onPlayForEnd: function (e, player) {
				var engagedWith = player.engagedWith === "playFor" ? player.engagedWith : null;
				player.locked = false;
				player.engaged = !(engagedWith === null);
				player.engagedWith = engagedWith;

				OLT.fn.resolveOpenTickets(player, 'playFor', "*");
				OLT.fn.av.pause(player.__id, false);
				return true;
			}

		},

/*******************************************************************************************************************************
																															 RUI
*******************************************************************************************************************************/
		rUI: {
			finalize: function() {
				var debug = false;
				window.location = cakeUrl("rsets", "finalize", OLT.data.rset.id);
			},

			isSet: function(path, formCased) {
				var debug = false;
				var pathLen = path.length - 1;
				if (formCased) path = path.substring(5,pathLen).replace(/\]\[/g,"/");
				if (debug) pr( path, "rUI.isSet: path, after formCase check");
				var fieldVal = OLT.data.rset.read(path);
				if (debug) pr( fieldVal, "rUI.isSet: fieldVal after Rset.read()");
				return !(!fieldVal || fieldVal == NOT_FOUND);
			},

			/**
			 * updateCounter method
			 *
			 * @desc
			 * @param counter
			 * @param triggerData
			 * @returns {boolean}
			 */
			updateCounter: function (counter, triggerData) {
				if (isEvent(arguments[0])) {
					var e = arguments[0];
					counter = asId(e.data.counter);
					triggerData = e.data;
				}
				var counterData = $(counter).data();
				// if counter is inactive, stop the function
				if (!counterData.active) {
					flash("Oops! The counter isn't active when the video isn't playing.");
					//todo: create a inactivePress event to provide user feedback.
					return false;
				}

				var tallyId = counter.replace("_counter", "_tally");
				var tallyData = $(tallyId).data();

				// find out the new count value
				var newCount = null;
				if (triggerData['type'] == "incrementer") {
					newCount = Number(tallyData.tally) + Number(counterData.increment);
				} else if (triggerData['type'] == "decrementer") {
					newCount = Number(tallyData.tally) - Number(counterData.decrement);
					if (newCount < 0 && !counterData.allowNegative) {
						newCount = 0;
					}
				}
				// update the target value if there is one.
				if (counterData.target) {
					$(asId(counterData.target)).val(newCount);
				}

				$(tallyId).data('tally', newCount).html(newCount);

				return true;
			},


			activateRUIElement: function(element) {
				if ( isEvent(arguments[0]) ) {
					element = arguments[0].data.element;
				}
				if ( typeof(element) == "string" ) {
					element = $(asId(element));
				}
				$(element).data("active", true);

				return true;
			},


			deactivateRUIElement: function(element) {
					if ( isEvent(arguments[0]) ) {
						element = arguments[0].data.element;
					}
					if ( typeof(element) == "string" ) {
						element = $(asId(element));
					}
					$(element).data("active", false);

					return true;
				},


			/**
			 * save method
			 *
			 * @desc
			 * @param target_id
			 * @param write
			 * @param sourceElement
			 * @returns {boolean}
			 */
			save: function(target_id, write, sourceElement) {
				var debug = true;
				// clear flash area of previous content
				OLT.fn.flash();

				// clean up target_id, distinguish between direct and event call
				if (isEvent(arguments[0]) ) {
					var e = arguments[0];
					target_id = e.data.target;
					write = e.data.write;
					sourceElement = e.data.sourceElement;
				}
				if (debug) pr(sourceElement, "save.sourceElement");

				var sourceData = $(sourceElement).data();
				var createKeys = sourceData.createKeys;
				var createAfterDepth = sourceData.createAfterDepth;

				if (debug) pr(sourceData, "save.sourceData");
				// default to true if there is nothing to write, changes if a write fails
				var written = true;
				if (write) {
					for (var i = 0; i < write.length; i++) {
						var write_instruction = write[i];
						try {
							var id = asId(write_instruction.to);
							$(id).val(write_instruction.value);
						} catch (e) {
							written = false;
							pr(e.message, "OLT.save => e.message");
							flash("Oops! Looks like there's a problem saving the choice you've just made. You'll need an administrator for this. :(");
						}
					}
				}

				// don't continue with remote save if unable to write local data
				if (!written) {
					return false;
				}

				target_id = asId(target_id);
				if ( $(target_id).is("form") ) {
					var formData = $(target_id).serialize();
					var result = OLT.data.rset.save(formData, createKeys, createAfterDepth);
					result.done(function(resp) {
						if (debug) pr(resp, "OLT.fn.rUI.save: resp");
						try {
							resp = JSON.parse(resp); // todo:ffs this, too, should be in a try-catch statement
						} catch (e) {
							if ($("#developer-output").length != 0 ) {
								$("#developer-output").html(resp);
							}
							if (debug) pr(resp, "OLT.fn.rUI.save: resp");
						}
						if (resp.success) {
							OLT.data.rset.refresh(resp.rset);

							// if save element was part of a paramgroup, apply appropriate class
							if (sourceData.paramGroup != "undefined") {
								var setClass = sourceData.setClass ? sourceData.setClass : "active";
								$("*[data-param-group='" + sourceData.paramGroup +"']").each(function() {
									$(this).removeClass(setClass);
								});
								$(sourceElement).addClass(setClass);
							}
						} else {
							throw new Error("Save was unsuccesful; as was completion of this error message...");
						}
					});
				} else {
					pr("Target was not a valid form element. Weird, though, right?");
				}

				return true;
			},


			applyResponseFixtures: function(target) {

			}
		},

/*******************************************************************************************************************************
																															UTIL
*******************************************************************************************************************************/
		util: {
			/**
			 * setPagevar method
			 * @param {str} pagevar
			 * @param {str} option
			 * @returns {boolean}
			 */
			setPagevar: function(pagevar, option) {
				var debug = false;
				if (debug) pr([pagevar, option]);
				if (isEvent(arguments[0]) ) {
					var e = arguments[0];
					pagevar = e.data.pagevar;
					option = e.data.option;
				}
				if (!(pagevar in OLT.data.pagevars) ) {
					throw "The page variable '"+ pagevar +"' doesn't exist.";
				}
				// save outgoing value & assign new one
				var previousOption = OLT.data.pagevars[pagevar].active;
				OLT.data.pagevars[pagevar].active = option;

				// update pagevar menu
				$(OLT.cfg.pagevarSelector+"[data-for-pagevar='"+pagevar+"'] li[data-pagevar-opt]").each(function() {
						var active = $(this).data('pagevar-opt') == option;
						var addClass = active ? "active": "inactive";
						$(this).data('active', active).removeClass('active').addClass(addClass);
				});

				// apply new value where it's needed
				$(OLT.data.pagevars[pagevar].domElements).each( function() {
						var updateValue = $(this).data('pagevar').split(".");
						var updateTarget = $(this).data('pagevar-update').split(".");
						if (debug) pr(updateTarget, "pageVars:update.split()");
						var updateStr = null;
						if (updateValue.length == 2) {
							if (debug) pr([option, OLT.data.pagevars[pagevar]], "[option, pagevar]");
							option = OLT.data.pagevars[pagevar].options[option].properties[updateValue[1]];
						}

						if (debug) pr(option, 'option');
						if (debug) pr(this, 'this');
						if (debug) pr(updateStr, 'updateStr');
						switch (updateTarget[0]) {
							//todo: probably need use-cases like "id" or "partial-id" or "classname" or "attr", etc.
							default:
								if (updateTarget.length == 2) {
									switch (updateTarget[1]) {
										case "raw": // ie. value is expected to be formatted text
											updateStr = option;
											break;
										default:// ie. html.forhumans in data attr
											updateStr = selToStr(option);
											break;
									}
								} else {
									updateStr = selToStr(option);
								}
								$(this).html(updateStr);
								break;
						}
				});
				var eData = {
						pagevar:pagevar,
						currentValue:option,
						previousValue:previousOption,
						elements:OLT.data.pagevars[pagevar].elements,
						options:OLT.data.pagevars[pagevar].options
				};
				$(document).trigger(OLT.e.pagevarUpdate, eData);

				return true;
			},


			/**
			 * getPagevar method
			 * @desc
			 * @param {str} pagevar
			 *
			 * @returns {string}
			 */
			getPagevar: function(pagevar) {
				var debug = false;
				if (debug)  pr(pagevar, "getPagevar()");
				//todo: error checking & handling
				return OLT.data.pagevars[pagevar].active;
			},

			pxToInt: function(px) {
				return Number(px.replace('px',''));
			},


			/**
			 * generateUID
			 * @desc
			 *
			 * @returns {string}
			 */
			generateUID: (function() {
			  function s4() {
			    return Math.floor((1 + Math.random()) * 0x10000)
			               .toString(16)
			               .substring(1);
			  }
			  return function() {
			    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
			           s4() + '-' + s4() + s4() + s4();
			  };
			})(),


			/**
			 * refreshTwins method
			 * @desc
			 * @param twinOne
			 * @param twinTwo
			 * @returns {boolean}
			 */
			refreshTwins: function(twinOne, twinTwo) {
				// todo: decide how or whether to obey max-height rules
				if (isEvent(arguments[0]) ) {
					var e = arguments[0];
					twinOne = asId(e.data.twinOne);
					pr($(twinOne).innerHeight());
					twinTwo = asId(e.data.twinTwo);
				} else {
					twinOne = asId(twinOne);
					twinTwo = asId(twinTwo);
				}

				// build objects to be used in fn
				var twins = [
							{id: twinOne, height:null, padding: null, total:null },
							{id: twinTwo, height:null, padding: null, total:null }
							];
				for (var i=0; i<2; i++) {
					twins[i].height =  OLT.fn.util.pxToInt($(twins[i].id).css('height'));
					twins[i].total =  twins[i].height;
					twins[i].padding =   OLT.fn.util.pxToInt($(twins[i].id).css('padding-top') );
					twins[i].padding +=   OLT.fn.util.pxToInt($(twins[i].id).css('padding-bottom') );
					twins[i].total +=  twins[i].padding;
				}

				var shortTwin = null;
				var targetHeight = null;

				if (twins[0].total > twins[1].total) {
					shortTwin = twins[1];
					targetHeight = twins[0].total;
				}

				pr(shortTwin);

				var heightDiff = targetHeight - shortTwin.total;
				var newHeight = shortTwin.height + heightDiff - shortTwin.padding;
				$(shortTwin.id).css('height', newHeight);

				return true;
			},

			/**
			 * toClockTime method
			 *
			 * @desc
			 * @param time
			 * @param unit
			 * @returns {string}
			 */
			toClockTime: function (time, unit) {
				unit = unit === null || unit === undefined ? 'seconds' : unit;
				if (typeof(unit) != 'string') {
					throw "Error: argument [unit] of toClockTime() must be string; " + typeof(unit) + " received";
				}
				if (typeof(time) != 'number') {
					throw "Error: argument [time] of toClockTime() must be number; " + typeof(time) + " received";
				}
				if (unit === MSECS) {
					time = time / 1000;
				}
				if (unit === MINS) {
					time = time * 60;
				}
				if (unit === HRS) {
					time = time * 3600;
				}

				return strpad(Math.floor(time / 3600), 2) + ":" + strpad(Math.floor(time / 60), 2) + ":" + strpad(time % 60, 2);
			},


			/**
			 * toCamelCase method
			 * @param data
			 * @param ignoreHyphens
			 */
			toCamelCase: function (data, ignoreHyphens) {
				if (typeof(data) != "array") {
					data = [data];
				}

				for (var i = 0;  i < data.length; i++) {
					for (var j =0; j < data[i].length; j++) {
						if (data[i][j] == "_") {
							data[i] = data[i].charAt(j+1).toUpperCase();
							data[i] = data[i].replace("_","");
							if (ignoreHyphens === false) {
								data[i] = data[i].replace("-","");
							}
						}
					}
				}
			},


			/**
			 * updateContentHeight method
			 *
			 * @desc
			 * @param cb
			 * @returns {*}
			 */
			updateContentHeight: function (cb) {
				//todo generalize this function and then call it once with body & content-wrapper as arguments
				var offset = $("body").css("padding-top").substr(0, 2); // equal to header height
				var content_height = window.innerHeight - offset;
				$("#content-wrapper").css({height: content_height + "px"});

				//OLT.fn.layout.resectionalize();
				return typeof(cb) === "function" ? cb() : null;
			},


			/**
			 * fetchWithin method
			 *
			 * @param path
			 * @param context
			 * @param delimiter
			 *
			 * @returns {*}
			 */
			fetchWithin: function(path, context, delimiter) {
				if (!delimiter) {
					delimiter = ".";
				}
				if (typeof(context) != "Array" && typeof(context) != "object") {
					//todo: handle errors;
				}
				if (!context) {
					context = OLT;
				}
				var pathParts = typeof(path) === "string" ? splitPath(path, ".") : path;
				var index = pathParts.shift();
				if (index in context) {
					if (pathParts.length == 0) {
						return context[index];
					} else {
						return OLT.fn.util.fetchWithin(pathParts.join("."), context[index]);
					}
				}

				return false;
			}
		},
/*******************************************************************************************************************************
																															  AV
*******************************************************************************************************************************/
		av: {
			__adjustVolume: function(target_id, adjustment) {
				if (isEvent(arguments[0]) ) {
					var e = arguments[0];
					target_id = e.data.for;
					adjustment = Number(e.data.adjustment);
				}
				var player = OLT.manifest.html5v[stripCssDelimeters(target_id)];
				var currentVolume = player.volume;
				var proposedVolume = player.volume + adjustment;
				if (proposedVolume > 0 && proposedVolume < 1) {
					player.volume = proposedVolume;
				} else if (player.volume < 1 && proposedVolume > 0) {
					player.volume = 1;
				} else if (player.volume > 0 && proposedVolume < 0) {
					player.volume = 0;
				}

				return true;
			},

			increaseVolume: function(target_id, adjustment) {
				if (isEvent(arguments[0]) ) {
					var e = arguments[0];
					target_id = e.data.for;
					adjustment = e.data.adjust;
				}

				return OLT.fn.av.__adjustVolume(target_id, adjustment);
			},

			decreaseVolume: function() {
				if (isEvent(arguments[0]) ) {
								var e = arguments[0];
								target_id = e.data.for;
								adjustment = e.data.adjust;
							}

				return OLT.fn.av.__adjustVolume(target_id, adjustment);
			},

			toggleMute: function(target_id) {
				if (isEvent(arguments[0]) ) {
					var e = arguments[0];
					target_id = e.data.for;
				}
				var player = OLT.manifest.html5v[stripCssDelimeters(target_id)];
				player.muted = player.muted === false;

				pr(player.muted, "player.muted");
				return true;
			},


			/**
			 * setClock method
			 *
			 * @desc
			 * @param target_id
			 * @returns {string}
			 */
			setClock: function (target_id) {
				var player = OLT.manifest.html5v[stripCssDelimeters(target_id)];
				player.clockTime = Math.floor(player.currentTime);
				return target_id;
			},


			/**
			 * updateClock method
			 *
			 * @desc
			 * @param target_id
			 * @returns {string}
			 */
			updateClock: function (target_id) {
				if (isEvent(arguments[0]) ) {
					var e = arguments[0];
					target_id = e.data.target_id;
				}
				var player = OLT.manifest.html5v[stripCssDelimeters(target_id)];
				var time = Math.floor(player.currentTime);

				// update if currentTime and clockTime vary by more than 1s (the smallest interval to be displayed)
				if (Math.abs(time - parseInt(player.clockTime, 10)) >= 1 || player.clockTime === 0) {
					OLT.fn.av.setClock(player.__id);
					$(asId(player.clock)).html(OLT.fn.util.toClockTime(time, "s"));
				}

				return target_id;
			},




			/**
			 * pause method
			 *
			 * @desc
			 * @param target_id
			 */
			pause: function (target_id) {
				var player = null;
				if ( isEvent(arguments[0]) ) {
					var e = arguments[0];
					player = e.data.player;
					target_id = player.__id;
				} else {
					player = OLT.manifest.html5v[stripCssDelimeters(target_id)];
				}

				$(player).trigger("pause");

				return target_id;
			},


			/**
			 * play method
			 *
			 * @desc
			 * @param target_id
			 * @param isFirstPlay
			 */
			play: function (target_id, isFirstPlay) {
				var player;

				if (isEvent(arguments[0])) {
					var e = arguments[0];
					player = e.data.player;
					target_id = player.__id;
				} else {
					player = OLT.manifest.html5v[stripCssDelimeters(target_id)];
				}
				var unlocked = OLT.fn.av.__queryLock(player, "play");
				if (unlocked) {
					if (!player.firstPlayInvoked === true) $(player).trigger(OLT.e.firstPlay);
					player.play();
				}

				return target_id;
			},


			/**
			 * playFor method
			 *
			 * @desc
			 * @param target_id the video element to be played
			 * @param interval duration for which the player should play
			 * @param play_from play head position to play from
			 * @param lock_config [optional] forbid flags & intervals as a JS object; overrides listener data
			 */
			playFor: function (target_id, interval, play_from, lock_config) {
				/* todo: lock_config should describe conditions whereby a locked player can be unlocked or modified before
				 the lock agreement has expired */
				var player = null;
				var ticket = null;

				if (isEvent(arguments[0])) {
					var e = arguments[0];
					player = e.data.player;
					target_id = player.__id;
					interval = $(this).data('interval'); // 'this' will be an html5v-control
					play_from = player.currentTime;
				} else {
					player = OLT.manifest.html5v[stripCssDelimeters(target_id)];
				}

				if (!interval) {
					throw "playFor() called but no interval was provided or could be inferred.";
				}
				if (OLT.fn.av.__queryLock(player, "playFor")) {
					// if play_from is provided, set playehad
					play_from > 0 && play_from > player.duration ? player.currentTime = play_from : null;
					ticket = OLT.fn.issueTicket("html5v", "playFor", false);
					player.locked = true;
					player.lockConfig = lock_config;
					player.since = player.currentTime;
					player.until = player.currentTime + interval;
					player.engaged = true;
					player.engagedWith = "playFor";
					player.engTicket = ticket.id;
					player.tickets[ticket.id] = ticket;
					player.playForInterval = interval;
					$(player).on("timeupdate", OLT.fn.binds.onPlayForUpdate);


					return OLT.fn.av.play(target_id, !player.firstPlayInvoked);
				} else {
					return false;
				}
			},


			/**
			 * __intervalize method
			 *
			 * @param player
			 * @param interval
			 * @returns {*}
			 * @private
			 */
			__intervalize: function(player, interval) {
				var duration = isNaN(player.duration) ? Math.floor(player.expectedDuration) : Math.floor(player.duration);
				var list = {};
				var i = 0;
				while (duration > 0) {
					list[i] = i*interval;
					duration -=  i == 0 ? 0 : interval;
					i++;
				}
				player.interval = {initialized:false, intervalized: true, value:interval, current:{index:0, time:0}, list:list};
				$(player).on("timeupdate", null, {player:player}, OLT.fn.av.__refreshInterval);

				return player;
			},




			/**
			 * __refreshInterval method
			 *
			 * @param player
			 * @returns {boolean}
			 * @private
			 */
			__refreshInterval: function(player) {
				if ( isEvent(arguments[0]) ) {
					player = arguments[0].data.player;
				}

				var deltaTime = Math.abs( player.currentTime - player.intervalTime() );
				var deltaIntervals = Math.floor( deltaTime / player.interval.value);
				var eData = null;

				if ( deltaIntervals >= 1) {
					// save the outgoing interval
					var previousInterval = player.cloneInterval();
					//change the interval
					player.interval.current.index = Math.floor(player.currentTime / player.interval.value);
					player.interval.current.time = player.intervalTime();
					var currentInterval = player.cloneInterval();

					// create event data containing both intervals & a reference to the player
					eData = { player:player, previousInterval: previousInterval, currentInterval: currentInterval};

					// trigger the intervalChange event
					$(player).trigger(OLT.e.intervalChange, eData);

				} else if (!player.interval.initialized) {
					eData = {player:player, previousInterval: false, currentInterval: player.interval.current};
					$(player).trigger(OLT.e.intervalChange,eData);
					player.interval.initialized = true;
				}

				return true;
			},


			/**
			 * __postFirstPlay method
			 *
			 * @desc On an olt-video element's first play, binds 'timeupdate' event listener whilst removing 'firstPlay' event listener
			 * @param player
			 * @private
			 */
			__postFirstPlay: function(player) {
				if (isEvent(arguments[0]) ) {
					player = arguments[0].data.player;
				}
				player.firstPlayInvoked = true;
				$(player).off("firstPlay")
					.on("timeupdate", null, {target_id:player.__id}, OLT.fn.av.updateClock)
					.on("seeked",null, {target_id:player.__id}, OLT.fn.av.updateClock);
			},


			/**
			 * jumpTo method
			 *
			 * @desc Interface/syntactic sugar for __jump()
			 * @param target_id
			 * @param time
			 * @param autoplay
			 * @returns {boolean}
			 */
			jumpTo: function (target_id, time, autoplay) {
				var player = null;

				// set up the arguments for explicit vs event-handling calls
				if (isEvent(arguments[0])) {
					var e = arguments[0];
					player = e.data.player;
					target_id = player.__id;
					time = e.data.playhead;
					autoplay = e.data.autoplay;
				} else {
					target_id = stripCssDelimeters(target_id);
					player = OLT.manifest.html5v[target_id];
					autoplay = autoplay === true;
					if (typeof(time) != "number") {
						throw "Error: jumpTo() requires that the argument 'time' be an integer, but " + typeof(time) + " received."
					}
				}
				$(player).trigger(OLT.e.jumpTo, {player:player, time:time, autoplay:autoplay});
				return OLT.fn.av.__jump(player, target_id, time, "to", autoplay);
			},


			/**
			 * jumpBy method
			 *
			 * @desc Interface/syntactic sugar for __jump()
			 * @param target_id
			 * @param time
			 * @param autoplay
			 * @returns {boolean}
			 */
			jumpBy: function (target_id, time, autoplay) {
				var player = null;

				// set up the arguments for explicit vs event-handling calls
				if (isEvent(arguments[0])) {
					var e = arguments[0];
					player = e.data.player;
					target_id = player.__id;
					time = e.data.interval + player.currentTime;
				} else {
					target_id = asId(target_id);
					player = OLT.manifest.html5v[target_id];
					if (typeof(time) != "number") {
						throw "Error: jumpBy() requires that the argument 'time' be an integer, but " + typeof(time) + " received."
					} else {
						time = time + player.currentTime;
					}
					autoplay = autoplay === true;
				}

				return OLT.fn.av.__jump(player, target_id, time, "by", autoplay);
			},


			/**
			 * __jump method
			 *
			 * @desc
			 * @param player
			 * @param target_id
			 * @param time
			 * @param method
			 * @param autoplay
			 * @returns {boolean}
			 * @private
			 */
			__jump: function (player, target_id, time, method, autoplay) {
				var debug = false;
				if (debug) pr([player, target_id, time, method, autoplay], "__jump()");
				var jump_direction = player.currentTime > time ? -1 : 1; // expected to be of use later in dev.
				if (!method) {
					throw "Error: argument 'method' is required.";
				}
				if (OLT.fn.av.__queryLock(player, "jump" + ucfirst(method))) {
					// throw an error if 'time' is outside of the player's duration or negative
					if (player.duration < time || time < 0) {
						throw "Error: the playhead cannot be moved to time [ " + OLT.fn.util.toClockTime(time, 's') + " ] because it is outside of the resource's duration.";
					}
					player.currentTime = time;

					if (autoplay) {
						autoplay === true ? OLT.fn.av.play(target_id, false) : OLT.fn.av.playFor(target_id, autoplay, player.currentTime);
					} else {
						OLT.fn.av.updateClock(target_id);
					}

					return target_id;
				} else {
					return false;
				}
			},


			/**
			 * refresh method
			 *
			 * @desc
			 * @param target_id
			 * @returns {boolean}
			 */
			refresh: function (target_id) {
				var player = null;
				if (isEvent(arguments[0])) {
					player = arguments[0].data.player;
					target_id = player.__id;
				} else {
					player = OLT.manifest.html5v[target_id];
				}
				if (OLT.fn.resolveOpenTickets(player, "*", "*")) {
					player.currentTime = 0;
					player.clockTime = 0;
					OLT.fn.av.updateClock(target_id);
					if (!player.paused) OLT.fn.av.pause(target_id);
					if (player.locked) OLT.fn.av.__unlock(player, "refresh");

					return true;
				} else {
					throw "Error: refresh() broke. Pack your things, call your loved ones. Flee.";
				}
			},


			/**
			 * __queryLock private method
			 *
			 * @desc
			 * @param player
			 * @param method
			 * @returns {boolean}
			 * @private
			 */
			__queryLock: function (player, method) {
				if (player.locked) {
					var ticket = player.tickets[player.engTicket];
					if (ticket.issuingMethod == method && ticket.reissuable) {
						return true;
					}

					// this is going to get hells more complicated
					if ( OLT.cfg.html5v.defaultLockSettings.allow[method] ) {
						return true;
					}

					if ( OLT.cfg.html5v.defaultLockSettings.except[method] ) {
						switch (method) {
						case "playFor":
							if (player.paused) {
								OLT.fn.av.play(player.__id);
								return false;
							}
						}
					}
				} else {
					return true;
				}
			},


			/**
			 * unlock Method
			 *
			 * @param player
			 * @param method
			 * @returns {boolean}
			 * @private
			 */
			__unlock: function (player, method) {
				// placeholder method, will eventually be elaborated
				if (method in ["refresh"]) {
					player.locked = false;
				}
				return true;
			}
		}
	}
};

