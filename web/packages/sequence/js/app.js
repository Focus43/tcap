!function(e,t){"use strict";t.module("sequence",["sequence.common","sequence.elements"]).config(["$provide","$locationProvider",function(e){!function(t){e.value("ApplicationPaths",{images:t.getAttribute("data-image-path")})}(document.querySelector("head")),e.value("Breakpoints",{xs:480,sm:768,md:992,lg:1200})}])}(window,window.angular),angular.module("sequence.common",[]),angular.module("sequence.elements",[]),angular.module("sequence.common").controller("CtrlRoot",["$rootScope","Modernizr","FastClick",function(e,t,n){n.attach(document.body),e.rootClasses={"sidebar-nav":!1}}]),angular.module("sequence.common").provider("Modernizr",function(){this.$get=["$window","$log",function(e,t){return e.Modernizr||(t.warn("Modernizr unavailable!"),!1)}]}).provider("Tween",function(){this.$get=["$window","$log",function(e,t){return e.TweenMax||e.TweenLite||(t.warn("Tween library unavailable!"),!1)}]}).provider("Isotope",function(){this.$get=["$window","$log",function(e,t){return e.Isotope||(t.warn("Isotope unavailable!"),!1)}]}).provider("FastClick",function(){this.$get=["$window","$log",function(e,t){return e.FastClick||(t.warn("FastClick unavailable!"),!1)}]}),angular.module("sequence.elements").directive("accordion",["Tween",function(e){function t(t,n,o){var a=n[0].querySelectorAll(".group"),l=n[0].querySelectorAll(".accordion-body"),r=+o.speed;angular.element(a).on("click",function(){return angular.element(this).hasClass("active")?(e.to(l,r,{height:0}),angular.element(a).removeClass("active"),void 0):(e.to(l,r,{height:0}),e.to(this.querySelector(".accordion-body"),r,{height:this.querySelector(".accordion-content").clientHeight}),angular.element(a).removeClass("active"),angular.element(this).addClass("active"),void 0)})}return{restrict:"A",link:t}}]),angular.module("sequence.elements").directive("incrementable",["Tween",function(e){function t(e){var t=e[0].getBoundingClientRect(),n=Math.round(t.top-u.top),o=n+(e._tolerance||0);f[o]||(f[o]={complete:!1,nodes:[]}),f[o].nodes.push(e),r=Object.keys(f)}function n(e,t){this.text(Math.ceil(e.target[t]))}function o(t){for(var o=0,a=f[t].nodes.length;a>o;o++)e.to({val:0},f[t].nodes[o]._duration,{val:+f[t].nodes[o].text(),onUpdate:n,onUpdateScope:f[t].nodes[o],onUpdateParams:["{self}","val"]})}function a(){if(c!==window.pageYOffset){c=window.pageYOffset;for(var t=0,n=r.length;n>t;t++){var l=+r[t],u=window.pageYOffset+document.documentElement.clientHeight>l;u&&f[l].complete===!1&&(i++,f[l].complete=!0,o(l)),i===n&&e.ticker.removeEventListener("tick",a)}}}function l(e,n,o){n._tolerance=+(o.tolerance||s),n._duration=+(o.duration||d),t(n)}var r,i=0,c=window.pageYOffset,u=document.body.getBoundingClientRect(),s=50,d=1.5,f={};return e.ticker.addEventListener("tick",a),{restrict:"C",link:l}}]),angular.module("sequence.elements").directive("header",["$window","Tween",function(e,t){function n(n,o,a,l){angular.element(document.querySelector("nav")).on("click",function(){l.toggleSidebarNav()}),angular.element(document.querySelectorAll('header [href*="#"]')).on("click",function(n){n.preventDefault();var o=document.querySelector(this.getAttribute("href"));o&&t.to(e,.65,{scrollTo:{y:o.offsetTop},ease:Power2.easeOut})})}return{restrict:"E",link:n,controller:["$rootScope",function(e){this.toggleSidebarNav=function(){e.$apply(function(){e.rootClasses["sidebar-nav"]=!e.rootClasses["sidebar-nav"]})}}]}}]),angular.module("sequence.elements").directive("isotope",["Isotope",function(e){function t(t,n,o){var a=n[0],l=a.querySelectorAll("[isotope-filters] a[data-filter]"),r=a.querySelector("[isotope-grid]"),i=a.querySelectorAll(".isotope-node");t.isotopeInstance=new e(r,{itemSelector:".isotope-node",layoutMode:o.isotope||"masonry"}),angular.element(l).on("click",function(){angular.element(l).removeClass("active"),angular.element(this).addClass("active");var e=this.getAttribute("data-filter");t.isotopeInstance.arrange({filter:e})}),angular.element(i).on("click",function(){angular.element(i).removeClass("active"),angular.element(this).addClass("active")})}return{restrict:"A",link:t}}]),angular.module("sequence.elements").directive("masthead",["Tween",function(e){function t(t,n,o){function a(t){var n=t,o=c[d],a=o.querySelector(".node-content").children,l=c[n],r=l.querySelector(".node-content").children;e.to(o,g,{autoAlpha:0}),e.staggerTo(a,g,{x:200,autoAlpha:0},g/a.length),e.staggerFromTo(r,g,{x:-200,autoAlpha:0},{x:0,autoAlpha:1},g/r.length),e.to(l,g,{autoAlpha:1}),d=n,s.removeClass("active").eq(d).addClass("active")}function l(){a(d===u?0:d+1)}function r(){a(0===d?u:d-1)}var i=n[0],c=i.querySelectorAll(".node"),u=c.length-1,s=angular.element(i.querySelectorAll(".markers a")),d=0,f=+(o.loopTiming||0),g=+(o.transitionSpeed||.75);angular.element(i.querySelectorAll(".arrows")).on("click",function(){return angular.element(this).hasClass("icn-angle-left")?(r(),void 0):(l(),void 0)}),s.on("click",function(){var e=Array.prototype.slice.call(i.querySelectorAll(".markers a")).indexOf(this);a(e)}),f>0&&!function m(e){setTimeout(function(){l(),m(e)},1e3*f)}(3e3)}return{restrict:"A",link:t}}]),angular.module("sequence.elements").factory("ModalData",[function(){return{open:!1,src:{url:null}}}]).directive("modalize",[function(){function e(e,t,n){t.on("click",function(){e.$apply(function(){e._data.src.url=n.modalize})})}return angular.element(document.querySelector("body")).append('<div modal-window ng-class="{open:_data.open}"></div>'),{restrict:"A",scope:!0,link:e,controller:["$scope","ModalData",function(e,t){e._data=t}]}}]).directive("modalWindow",[function(){function e(e,t){angular.element(t[0].querySelector(".icn-close")).on("click",function(){e.$apply(function(){e._data.open=!1})}),e.$watch("_data.open",function(t){angular.element(document.documentElement).toggleClass("no-scroll",e._data.open),t||(e._data.src.url=null)})}return{restrict:"A",scope:!0,link:e,template:'<span class="icn-close"></span><div class="modal-inner" ng-include="_data.src.url"></div>',controller:["$scope","ModalData",function(e,t){e._data=t,e.$on("$includeContentLoaded",function(){e._data.open=!0})}]}}]).directive("modalReload",[function(){function e(e,o){o.on("click",function(){var a,l=Array.prototype.slice.call(t).indexOf(document.querySelector(".isotope-node.active"));a=o.hasClass("prev")?0===l?n:l-1:l===n?0:l+1,angular.element(t).removeClass("active"),angular.element(t[a]).addClass("active"),e.$apply(function(){e._data.src.url=t[a].getAttribute("modalize")})})}var t=document.querySelectorAll(".isotope-node"),n=t.length-1;return{restrict:"A",scope:!0,link:e,controller:["$scope","ModalData",function(e,t){e._data=t}]}}]),angular.module("sequence.elements").directive("quoteCycle",["Tween",function(e){function t(t,n,o){function a(){var e=0;return angular.forEach(r,function(t){e=t.clientHeight>e?t.clientHeight:e}),e}var l=n[0],r=l.querySelectorAll(".group"),i=r.length-1,c=0,u=1e3*+(o.quoteCycle||5);e.fromTo(l,.5,{height:l.clientHeight},{height:a()}),function s(t){setTimeout(function(){var n=c===i?0:c+1;e.to(r[c],.5,{y:-100,autoAlpha:0}),e.fromTo(r[n],.5,{y:100,autoAlpha:0},{y:0,autoAlpha:1,delay:.5}),c=n,s(t)},t)}(u)}return{restrict:"A",link:t}}]),angular.module("sequence.elements").directive("scrollTop",["$window","Tween",function(e,t){function n(n,o){var a=e.pageYOffset>0;o.toggleClass("visible",a),t.ticker.addEventListener("tick",function(){return!a&&e.pageYOffset>0?(a=!0,o.toggleClass("visible",a),void 0):(a&&0===e.pageYOffset&&(a=!1,o.toggleClass("visible",a)),void 0)}),o.on("click",function(){t.to(e,1,{scrollTo:{y:0},ease:Power2.easeOut})})}return{restrict:"A",scope:!1,link:n}}]);