!function(e,t){"use strict";t.module("sequence",["sequence.common","sequence.elements"]).config(["$provide","$locationProvider",function(e){!function(t){e.value("ApplicationPaths",{images:t.getAttribute("data-image-path"),tools:t.getAttribute("data-tools-path")})}(document.querySelector("head")),e.value("Breakpoints",{xs:480,sm:768,md:992,lg:1200})}])}(window,window.angular),angular.module("sequence.common",[]),angular.module("sequence.elements",[]),angular.module("sequence.common").controller("CtrlContactForm",["$scope","$http",function(e,t){e.forceDisable=!1,e.submitHandler=function(n){n.preventDefault();var o=angular.element(n.target.querySelector('button[type="submit"]'));o.empty().text("Sending..."),t.post(n.target.getAttribute("action"),e.form_data).success(function(){o.empty().text("Sent! We will be in touch."),e.forceDisable=!0}).error(function(){})},e.isDisabled=function(){return e.forceDisable===!0?!0:e.contactForm.$invalid}}]),angular.module("sequence.common").controller("CtrlRoot",["$window","$rootScope","$scope","Modernizr","FastClick","$compile","ApplicationPaths","ModalData",function(e,t,n,o,a,l,r,i){function c(){n._modal=i,n._modal.src.url=r.tools+"/disclaimer",n._modal.classes.disclaimer=!0,n._modal.open=!0,u=!0}function s(){return u?(angular.element(e).off("scroll",s),void 0):(n.$apply(c),void 0)}a.attach(document.body),t.rootClasses={"sidebar-nav":!1};var u=!1;document.querySelector("body").hasAttribute("can-admin")?(angular.element(document).on("keydown",function(e){e.ctrlKey&&77===e.keyCode&&angular.element("html").toggleClass("edit-mode-mobile")}),"undefined"!=typeof ConcreteEvent&&ConcreteEvent.subscribe("EditModeUpdateBlockComplete",function(){l(document.body)(t)})):o.touch?c():angular.element(e).on("scroll",s)}]),angular.module("sequence.common").provider("Modernizr",function(){this.$get=["$window","$log",function(e,t){return e.Modernizr||(t.warn("Modernizr unavailable!"),!1)}]}).provider("Tween",function(){this.$get=["$window","$log",function(e,t){return e.TweenMax||e.TweenLite||(t.warn("Tween library unavailable!"),!1)}]}).provider("Isotope",function(){this.$get=["$window","$log",function(e,t){return e.Isotope||(t.warn("Isotope unavailable!"),!1)}]}).provider("FastClick",function(){this.$get=["$window","$log",function(e,t){return e.FastClick||(t.warn("FastClick unavailable!"),!1)}]}).provider("moment",function(){this.$get=["$window","$log",function(e,t){return e.moment||(t.warn("Moment unavailable!"),!1)}]}),angular.module("sequence.elements").directive("accordion",["Tween",function(e){function t(t,n,o){var a=n[0].querySelectorAll(".group"),l=n[0].querySelectorAll(".accordion-body"),r=+o.speed;angular.element(a).on("click",function(){return angular.element(this).hasClass("active")?(e.to(l,r,{height:0}),angular.element(a).removeClass("active"),void 0):(e.to(l,r,{height:0}),e.to(this.querySelector(".accordion-body"),r,{height:this.querySelector(".accordion-content").clientHeight}),angular.element(a).removeClass("active"),angular.element(this).addClass("active"),void 0)})}return{restrict:"A",link:t}}]),angular.module("sequence.elements").directive("header",["$window","Tween",function(){function e(e,t,n,o){angular.element(document.querySelector("nav")).on("click",function(){o.toggleSidebarNav()})}return{restrict:"E",link:e,controller:["$rootScope",function(e){this.toggleSidebarNav=function(){e.$apply(function(){e.rootClasses["sidebar-nav"]=!e.rootClasses["sidebar-nav"]})}}]}}]),angular.module("sequence.elements").directive("incrementable",["Tween",function(e){function t(e){var t=e[0].getBoundingClientRect(),n=Math.round(t.top-s.top),o=n+(e._tolerance||0);m[o]||(m[o]={complete:!1,nodes:[]}),m[o].nodes.push(e),r=Object.keys(m)}function n(e,t){this.text(Math.ceil(e.target[t]))}function o(t){for(var o=0,a=m[t].nodes.length;a>o;o++)e.to({val:0},m[t].nodes[o]._duration,{val:+m[t].nodes[o].text(),onUpdate:n,onUpdateScope:m[t].nodes[o],onUpdateParams:["{self}","val"]})}function a(){if(c!==window.pageYOffset){c=window.pageYOffset;for(var t=0,n=r.length;n>t;t++){var l=+r[t],s=window.pageYOffset+document.documentElement.clientHeight>l;s&&m[l].complete===!1&&(i++,m[l].complete=!0,o(l)),i===n&&e.ticker.removeEventListener("tick",a)}}}function l(e,n,o){n._tolerance=+(o.tolerance||u),n._duration=+(o.duration||d),t(n)}var r,i=0,c=window.pageYOffset,s=document.body.getBoundingClientRect(),u=50,d=1.5,m={};return e.ticker.addEventListener("tick",a),{restrict:"A",link:l}}]),angular.module("sequence.elements").directive("isotope",["Isotope",function(e){function t(t,n,o){var a=n[0],l=a.querySelectorAll("[isotope-filters] a[data-filter]"),r=a.querySelector("[isotope-grid]"),i=a.querySelectorAll(".isotope-node");!function c(e){return e.classList.contains("container")?(e.style.width="100%",e.style.padding=0,void 0):(c(e.parentElement),void 0)}(a),t.isotopeInstance=new e(r,{itemSelector:".isotope-node",layoutMode:o.isotope||"masonry"}),angular.element(l).on("click",function(){angular.element(l).removeClass("active"),angular.element(this).addClass("active");var e=this.getAttribute("data-filter");t.isotopeInstance.arrange({filter:e})}),angular.element(i).on("click",function(){angular.element(i).removeClass("active"),angular.element(this).addClass("active")})}return{restrict:"A",scope:!0,link:t}}]),angular.module("sequence.elements").directive("linkScroll",["$window","Tween",function(e,t){function n(n,o,a){var l=document.querySelector("#"+a.linkScroll);l&&o.on("click",function(n){n.preventDefault(),t.to(e,.65,{scrollTo:{y:l.offsetTop},ease:Power2.easeOut})})}return{restrict:"A",link:n,scope:!1}}]),angular.module("sequence.elements").directive("masthead",["Tween",function(e){function t(t,n,o){function a(t){var n=t,o=c[d],a=o.querySelector(".node-content").children,l=c[n],r=l.querySelector(".node-content").children;e.to(o,f,{autoAlpha:0}),e.staggerTo(a,f,{x:200,autoAlpha:0},f/a.length),e.staggerFromTo(r,f,{x:-200,autoAlpha:0},{x:0,autoAlpha:1},f/r.length),e.to(l,f,{autoAlpha:1}),d=n,u.removeClass("active").eq(d).addClass("active")}function l(){a(d===s?0:d+1)}function r(){a(0===d?s:d-1)}var i=n[0],c=i.querySelectorAll(".node"),s=c.length-1,u=angular.element(i.querySelectorAll(".markers a")),d=0,m=+(o.loopTiming||0),f=+(o.transitionSpeed||.75);angular.element(i.querySelectorAll(".arrows")).on("click",function(){return angular.element(this).hasClass("icn-angle-left")?(r(),void 0):(l(),void 0)}),u.on("click",function(){var e=Array.prototype.slice.call(i.querySelectorAll(".markers a")).indexOf(this);a(e)}),m>0&&!function g(e){setTimeout(function(){l(),g(e)},1e3*m)}(3e3)}return{restrict:"A",link:t}}]),angular.module("sequence.elements").factory("ModalData",[function(){return{open:!1,classes:{open:!1},src:{url:null}}}]).directive("modalize",[function(){function e(e,t,n){t.on("click",function(){e.$apply(function(){e._data.src.url=n.modalize,angular.isArray(e.extraClasses)&&angular.forEach(e.extraClasses,function(t){e._data.classes[t]=!0})})})}return angular.element(document.querySelector("body")).append('<div modal-window ng-class="_data.classes"></div>'),{restrict:"A",scope:{extraClasses:"=modalClasses"},link:e,controller:["$scope","ModalData",function(e,t){e._data=t}]}}]).directive("closeModal",["ModalData",function(e){function t(t,n){n.on("click",function(){t.$apply(function(){e.open=!1})})}return{restrict:"A",scope:!1,link:t}}]).directive("modalWindow",["$rootScope",function(e){function t(t){t.$watch("_data.open",function(n){e.rootClasses["no-scroll"]=t._data.open,t._data.classes.open=t._data.open,n||(t._data.src.url=null,t._data.classes={open:!1},angular.element(document.querySelectorAll(".isotope-node")).removeClass("active"))})}return{restrict:"A",scope:!0,link:t,template:'<div class="modal-inner" ng-include="_data.src.url"></div>',controller:["$scope","ModalData",function(e,t){e._data=t,e.$on("$includeContentLoaded",function(){e._data.open=!0})}]}}]).directive("modalSwap",[function(){function e(e,t){t.on("click",function(){var n=document.querySelector(".isotope-node.active"),o=n.parentNode.children,a=o.length-1,l=Array.prototype.slice.call(o).indexOf(n),r=t.hasClass("prev")?0===l?a:l-1:l===a?0:l+1;angular.element(n).removeClass("active"),angular.element(o[r]).addClass("active"),e.$apply(function(){e._data.src.url=o[r].getAttribute("modalize")})})}return{restrict:"A",scope:!0,link:e,controller:["$scope","ModalData",function(e,t){e._data=t}]}}]),angular.module("sequence.elements").directive("quoteCycle",["Tween",function(e){function t(t,n,o){function a(){var e=0;return angular.forEach(r,function(t){e=t.clientHeight>e?t.clientHeight:e}),e}var l=n[0],r=l.querySelectorAll(".group"),i=r.length-1,c=0,s=1e3*+(o.quoteCycle||5);e.fromTo(l,.5,{height:l.clientHeight},{height:a()}),function u(t){setTimeout(function(){e.fromTo(l,.5,{height:l.clientHeight},{height:a()});var n=c===i?0:c+1;e.to(r[c],.5,{y:-100,autoAlpha:0}),e.fromTo(r[n],.5,{y:100,autoAlpha:0},{y:0,autoAlpha:1,delay:.5}),c=n,u(t)},t)}(s)}return{restrict:"A",link:t}}]),angular.module("sequence.elements").directive("scrollTop",["$window","Tween",function(e,t){function n(n,o){var a=e.pageYOffset>0;o.toggleClass("visible",a),t.ticker.addEventListener("tick",function(){return!a&&e.pageYOffset>0?(a=!0,o.toggleClass("visible",a),void 0):(a&&0===e.pageYOffset&&(a=!1,o.toggleClass("visible",a)),void 0)}),o.on("click",function(){t.to(e,1,{scrollTo:{y:0},ease:Power2.easeOut})})}return{restrict:"A",scope:!1,link:n}}]),angular.module("sequence.elements").filter("timeAgo",["moment",function(e){return function(t){return e(t).fromNow()}}]).directive("showTwitterFeed",["$http","$interval","$timeout",function(e,t){return{restrict:"A",link:function(n,o,a){var l=angular.element(document.querySelectorAll("ul.errors")),r=angular.element(document.querySelectorAll(".twitter div.container"));l[0].style.display="none";var i=angular.element("<div class='waitForIt'><i class='fa fa-circle-o-notch fa-spin fa-5x'></i></div>");o.append(i),n.moving=!1,n.tweetWatcher=null,n.$watch("tweetWatcher",function(e,t){e&&e!==t&&(n.tweets=e)});var c=function(){e.get(a.showTwitterFeed).success(function(e){e.errors?(n.errors=e.errors,i[0].style.display="block",l[0].style.display="block",r[0].style.display="none"):(i[0].style.display="none",l[0].style.display="none",r[0].style.display="block",n.tweetWatcher=e)}).error(function(e,t){console.log("ERROR"),console.log(e),console.log(t)})},s=function(){n.moving&&n.tweets.push(n.tweets.shift()),n.moving=!n.moving};c(),t(c,12e4),t(s,2e3)}}}]);